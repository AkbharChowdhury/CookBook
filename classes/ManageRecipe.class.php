<?php
declare(strict_types=1);
/**
 * Note: Permission may be denied to delete image file on the university servers
 * query() PDO::method can be used instead of prepared statements when you do not need to sanitize user input data
 * e.g. counting all the recipes - getTotalRecipes();
 */
class ManageRecipe extends Recipe implements IRecipe {

    // note: getTotalRecipes() is derived from superclass 
    // class properties
    private static $instance = null;
    private $recipeID, $lastInsertedRecipeID;


    public function setRecipeID($recipeID){

        $this->recipeID = $recipeID;
        return $this;
    }
    private function __construct(){}


    public static function getInstance() {
        return self::$instance === null ? self::$instance = new ManageRecipe() : self::$instance;
    }


    public function fetchRecipes() {
        $sql = "SELECT
        r.`recipe_id`,
        r.`name`,
        r.`prep_time`,
        r.`cook_time`,
        r.`servings`,
        r.`description`,
        r.`image`,
        r.`alt`,
        CONCAT(a.`firstname`, ' ', a.`lastname`) AS `author_name`
    FROM
        `Recipes` r
    JOIN `Author` a ON
        r.`author_id` = a.`author_id`
        WHERE a.`email` = :email";
        
            $stmt = $this->getConnection()->prepare($sql);
            $stmt->bindParam(':email', $_SESSION['email']);
            $stmt->execute();
            return $stmt->fetchAll();
        
    }

    public function getAuthorTotalRecipes($email){
        $query = "SELECT
        COUNT(DISTINCT(rc.`recipe_id`)) AS `recipe_total`
    FROM
        `RecipeCategory` rc
    JOIN `Recipes` r ON
        r.recipe_id = rc.`recipe_id`
    JOIN Author a ON
        r.`author_id` = a.`author_id`
    WHERE
        a.`email` = :email";
            $stmt = $this->getConnection()->prepare($query);
            $stmt->bindParam(':email', $email);
            $stmt->execute();
            return $stmt->fetchColumn();
        
    }

    public function getTotalRecipes() {


        $query = "SELECT
        COUNT(DISTINCT(rc.`recipe_id`)) AS `recipe_total`
    FROM
        `RecipeCategory` rc
    JOIN `Recipes` r ON
        r.recipe_id = rc.`recipe_id`
    JOIN Author a ON
        r.`author_id` = a.`author_id`
    WHERE
        a.`author_id` = :author_id";
            $stmt = $this->getConnection()->prepare($query);
            $stmt->bindParam(':author_id', $id);
            $stmt->execute();
            return $stmt->fetchColumn();

        
    }
  
    public function fetchRecipesAuthor() {
        $sql = "SELECT
        r.`recipe_id`,
        r.`name`,
        r.`prep_time`,
        r.`cook_time`,
        r.`servings`,
        r.`description`,
        r.`image`,
        r.`alt`,
        CONCAT(a.`firstname`, ' ', a.`lastname`) AS `author_name`
    FROM
        `Recipes` r
    JOIN `Author` a ON
        r.`author_id` = a.`author_id`
        WHERE r.author_id = :author_id";
    
    $stmt = $this->getConnection()->prepare($sql);
    $stmt->execute($this->data);
    return $stmt->fetchAll();
    }

    // display single recipe
    public function getRecipeDetails() {
        // query to select and retrieve a single recipe 
        $sql = "SELECT
        rc.`recipe_id`,
        r.`author_id`,
        r.`name`,
        r.`prep_time`,
        r.`cook_time`,
        r.`servings`,
        r.`description`,
        r.`image`,
        r.`alt`,
        GROUP_CONCAT(c.`category_name` SEPARATOR ', ') AS `category_name`,
        (r.`prep_time` + r.`cook_time`) AS `total_cooking_time`,
        CONCAT(a.`firstname`, ' ', a.`lastname`) AS `author_name`
    FROM
        `RecipeCategory` rc
    JOIN `Recipes` r ON
        rc.`recipe_id` = r.`recipe_id`
    JOIN `Categories` c ON
        rc.`category_id` = c.`category_id`
    JOIN `Author` a ON
        r.`author_id` = a.`author_id`
    WHERE
        rc.`recipe_id` = :recipe_id 
        
    LIMIT 1";
        $stmt = $this->getConnection()->prepare($sql);
        $stmt->execute($this->data);
        return $stmt->fetchAll();
    }

    // get recipe category
    public function getCategories() {
        $sql = "SELECT `category_id` FROM `RecipeCategory` WHERE `recipe_id` = :recipe_id";
        $stmt = $this->getConnection()->prepare($sql);
        $stmt->execute($this->data);
        return $stmt->fetchAll();
    }

    /*     * ******************************* Update ingredients ************************************** */

    // Update recipe ingredients
    public function updateRecipe(array $ingredientList, array $prepMethodList, array $categoryList) {
        $sql = "UPDATE
                `Recipes`
            SET
                `name` = :name, 
                `prep_time` = :prep_time, 
                `cook_time` = :cook_time, 
                `servings` = :servings, 
                `description` = :description, 
                `image` = :image,
                `alt` = :alt
            WHERE
                recipe_id = :recipe_id";
      
        $this->getConnection()->prepare($sql)->execute($this->data);

        if ($this->updateIngredients($ingredientList) && $this->updatePrepMethod($prepMethodList) && $this->updateCategories($categoryList)) {
            return true;
        }
        return false;
    }

    public function updateIngredients(array $ingredientList) {

        // delete all the ingredients first from the associated recipe
        $sql = "DELETE FROM `Ingredients` WHERE `recipe_id` = :recipe_id";
        $stmt = $this->getConnection()->prepare($sql);
        $stmt->bindParam(':recipe_id', $this->recipeID);
        $stmt->execute();
        foreach ($ingredientList as $ingredient) {

            $updatedIngredients = "INSERT INTO `Ingredients` SET
            `recipe_id` = :recipe_id,
            `ingredient` = :ingredient";
            $stmt = $this->getConnection()->prepare($updatedIngredients);
            // bind values
            $stmt->bindParam(":recipe_id", $this->recipeID);
            $stmt->bindParam(":ingredient", $ingredient);
            $stmt->execute();
        }
        return true;
    }

    public function updatePrepMethod(array $prepMethodList) {
        // delete all the method(Cooking directions) first from the associated recipe
        $sql = "DELETE FROM `PrepMethod` WHERE `recipe_id` = :recipe_id";
        $stmt = $this->getConnection()->prepare($sql);
        $stmt->bindParam(':recipe_id', $this->recipeID);
        $stmt->execute();
        foreach ($prepMethodList as $prepMethod) {
            // insert the updated prep-method
            $updatedPrep = "INSERT INTO `PrepMethod` SET
            `recipe_id` = :recipe_id,
            `method` = :method";
            $stmt = $this->getConnection()->prepare($updatedPrep);
            // bind values
            $stmt->bindParam(":recipe_id", $this->recipeID);
            $stmt->bindParam(":method", $prepMethod);
            $stmt->execute();
        }
        return true;
    }

    public function updateCategories(array $categoryList) {
        // delete categories associated with the recipe id
        $sql = "DELETE FROM `RecipeCategory` WHERE `recipe_id` = :recipe_id";
        $stmt = $this->getConnection()->prepare($sql);
        $stmt->bindParam(':recipe_id', $this->recipeID);
        $stmt->execute();
        foreach ($categoryList as $category) {

            // append updated categories associated with the recipe id
            $updatedCategory = "INSERT INTO `RecipeCategory` SET
            `recipe_id` = :recipe_id,
            `category_id` = :category_id";
            $stmt = $this->getConnection()->prepare($updatedCategory);
            // bind values
            $stmt->bindParam(":recipe_id", $this->recipeID);
            $stmt->bindParam(":category_id", $category);
            $stmt->execute();
        }
        return true;
    }

    //  insert into 3 tables, Recipes, Ingredients and PrepMethod
    public function addRecipe(array $ingredientList, array $prepMethodList, array $categoryList) {

        $recipeSql = "INSERT INTO `Recipes` SET 
        `name` = :name, 
        `prep_time` = :prep_time, 
        `cook_time` = :cook_time, 
        `servings` = :servings, 
        `description` = :description, 
        `image` = :image,
        `alt` = :alt,
        `author_id` = :author_id";
        $this->getConnection()->prepare($recipeSql)->execute($this->data);

        $this->lastInsertedRecipeID = $this->con->lastInsertId();
        if ($this->addIngredients($ingredientList) && $this->addPrepMethod($prepMethodList) && $this->addCategories($categoryList)) {
            return true;
        }
    }

    private function addIngredients(array $ingredientList) {
        // add recipe ingredients
        foreach ($ingredientList as $ingredient) {

            $sql = "INSERT INTO `Ingredients` SET
            `recipe_id` = :recipe_id,
            `ingredient` = :ingredient";
            $stmt = $this->getConnection()->prepare($sql);
            // bind values
            $stmt->bindParam(":recipe_id", $this->lastInsertedRecipeID);
            $stmt->bindParam(":ingredient", $ingredient);
            $stmt->execute();
        }
        return true;
    }

    private function addPrepMethod(array $prepMethodList) {
        // add prep method - return
        foreach ($prepMethodList as $prepMethod) {

            $sql = "INSERT INTO `PrepMethod` SET `recipe_id` = :recipe_id, `method` = :method";
            $stmt = $this->getConnection()->prepare($sql);
            // bind values
            $stmt->bindParam(":recipe_id", $this->lastInsertedRecipeID);
            $stmt->bindParam(":method", $prepMethod);
            $stmt->execute();
        }
        return true;
    }

    /*********************************** Update ingredients and prep method ********************** */

    // add updated ingredients
    private function addCategories(array $categoryList) {
        // add recipe ingredients
        foreach ($categoryList as $categories) {

            $sql = "INSERT INTO `RecipeCategory` SET
            `recipe_id` = :recipe_id,
            `category_id` = :category_id";
            $stmt = $this->getConnection()->prepare($sql);
            // bind values
            $stmt->bindParam(":recipe_id", $this->lastInsertedRecipeID);
            $stmt->bindParam(":category_id", $categories);
            $stmt->execute();
        }
        return true;
    }

    // add updated prep-method
    public function addUpdatedIngredients(array $ingredientList) {
        // add recipe ingredients
        foreach ($ingredientList as $ingredient) {

            $sql = "INSERT INTO `Ingredients` SET
            `recipe_id` = :recipe_id,
            `ingredient` = :ingredient";
            $stmt = $this->getConnection()->prepare($sql);
            // bind values
            $stmt->bindParam(":recipe_id", $this->recipeID);
            $stmt->bindParam(":ingredient", $ingredient);
            $stmt->execute();
        }
        return true;
    }

    // add prep method
    public function addUpdatedPrepMethod(array $prepMethodList, $rID) {
        // add prep method - return
        foreach ($prepMethodList as $prepMethod) {

            $sql = "INSERT INTO `PrepMethod` SET `recipe_id` = :recipe_id, `method` = :method";
            $stmt = $this->getConnection()->prepare($sql);
            // bind values
            $stmt->bindParam(":recipe_id", $rID);
            $stmt->bindParam(":method", $prepMethod);
            $stmt->execute();
        }
        return true;
    }

    // used ONLY FOR AJAX
    public function deleteIngredient($ingredientID) {

        $sql = "DELETE FROM `Ingredients` WHERE `ingredient_id` = :ingredient_id";
        $stmt = $this->getConnection()->prepare($sql);
        $stmt->bindParam(':ingredient_id', $ingredientID);
        return $stmt->execute();
    }

    // used ONLY FOR AJAX 
    public function deletePrepMethod($prepID) {

        $sql = "DELETE FROM `PrepMethod` WHERE `prep_id`= :prep_id";
        $stmt = $this->getConnection()->prepare($sql);
        $stmt->bindParam(':prep_id', $prepID);
        return $stmt->execute();

    }

    public function deleteRecipe() {
        // inserts new student record to database
        $sql = "DELETE FROM `Recipes` WHERE `recipe_id` = :recipe_id";
        $stmt = $this->getConnection()->prepare($sql);
        // delete recipe image - permission may be denied
        //$this->deleteRecipeImage();
        return $stmt->execute($this->data);
    }

    // delete the recipe image - Note the permission may be denied
    public function deleteRecipeImage() {

        $sql = "SELECT `image` FROM `Recipes` WHERE `recipe_id` = :recipe_id";
        $stmt = $this->getConnection()->prepare($sql);
        $stmt->execute($this->data);
        $row = $stmt->fetch();
        // unlink is used to delete a file
        return unlink('../../img/' . $row['image']);
    }

}
