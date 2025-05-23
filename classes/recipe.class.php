<?php

class Recipe extends Database implements IRecipe
{

    private
     $recipeName,
        $pageNumber,
        $authorID, $categoryID,
        $searchTerm;
    // search recipes from database properties
    private $select, $from, $where, $combinedSearch,
    // construct query
    $placeholders = [];
    // count recipes from database properties
    private $selectCount, $fromCount, $whereCount, $combinedSearchCount;

    private const RECORDS_PER_PAGE = 6;

    private $fromRecordNum; // set limit 


    public function setRecipeName($recipeName)
    {

        $this->recipeName = $recipeName;
        return $this;
    }

    public function setPageNumber($pageNumber)
    {

        $this->pageNumber = $pageNumber;
        return $this;
    }

    public function setAuthorID($authorID)
    {

        $this->authorID = $authorID;
        return $this;
    }

    public function setCategoryID($categoryID)
    {

        $this->categoryID = $categoryID;
        return $this;
    }

    public function setSearchTerm($searchTerm)
    {

        $this->searchTerm = $searchTerm;
        return $this;
    }

    public function getRecordsPerPage()
    {
        return self::RECORDS_PER_PAGE;
    }

    public function setFromRecordNum($fromRecordNum)
    {
        $this->fromRecordNum = $fromRecordNum;
        return $this;
    }

    public function getSearchSQL()
    {
        return $this->combinedSearch;
    }

    private static $instance = null;

    private function __construct()
    {
    }

    public static function getInstance()
    {

        return self::$instance === null ? self::$instance = new Recipe() : self::$instance;
    }


    /**
     * getPageNumber() Notes:
     * get the current page number to determine the ordering of query using sessions
     * Check if page number is one: randomize rand(seed) and store it in a session to pass to other pages.
     * Otherwise return the existing recipe random order.
     */
    private function getPageNumber()
    {
        $this->pageNumber = intval($this->pageNumber);
        return $this->pageNumber === 1 ? $_SESSION['existing_recipe'] = rand(1, 100) : $_SESSION['existing_recipe'];
    }

    /** ******************************** populate drop down list ********************************** */

    // get category list
    public function getCategory()
    {

        // select unique categories from recipes table
        $sql = "SELECT DISTINCT c.`category_id`, c.`category_name` FROM `RecipeCategory` rc JOIN `Categories` c USING (category_id)";
        $stmt = $this->getConnection()->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    // get author list - filter authors based on search results
    public function getAuthor()
    {
        $this->placeholders = [];
        // reset $this->where property
        $this->where = null;

        // select unique Authors from recipes table
        $this->where = "SELECT DISTINCT
        r.`author_id`,
        CONCAT(a.`firstname`, ' ', a.`lastname`) AS `author_name`
        FROM
            `RecipeCategory` rc
            JOIN `Recipes` r ON
            rc.`recipe_id` = r.`recipe_id`
        JOIN `Author` a ON
            r.`author_id` = a.`author_id`
        JOIN `Categories` c ON
            c.`category_id` = rc.`category_id`";
        // check if category is selected
        $this->categorySelected(" AND c.`category_id` LIKE :category_id", $this->where);

        $stmt = $this->getConnection()->prepare($this->where);
        $stmt->execute($this->placeholders);
        return $stmt->fetchAll();
    }

    /** ******************************** end of populate drop down list ********************************** */

    public function getMinCategory($category)
    {



        $sql = ' WITH cte_category_time AS(
                    SELECT
                        MIN((r.`prep_time` + r.`cook_time`)) AS `total_cooking_time`
                    FROM
                        `RecipeCategory` rc
                    JOIN `Recipes` r USING(recipe_id)
                    JOIN `Categories` c USING(category_id)
                    WHERE
                        c.`category_name` LIKE :category
                    GROUP BY
                        c.`category_name`)
        
                SELECT
                    total_cooking_time
                FROM
                    cte_category_time';

       

        $stmt = $this->getConnection()->prepare($sql);
        $stmt->execute([':category' => '%' . $category . '%']);
        $row = $stmt->fetch();
        return $row['total_cooking_time'];
    }

    public function getRecipeDetails($recipeID)
    {
        $sql = "
       SELECT
    r.`name`,
    r.`prep_time`,
    r.`cook_time`,
    r.`servings`,
    r.`description`,
    r.`image`,
    r.`alt`,
    GROUP_CONCAT(c.`category_name` SEPARATOR ', ') AS `category_name`,
    (r.`prep_time` + r.`cook_time`) AS `total_cooking_time`,
    CONCAT(a.`firstname`, ' ', a.`lastname`) AS `author_name`,
    a.`email`
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
LIMIT 1;
        
        ";

        $stmt = $this->getConnection()->prepare($sql);
        $stmt->bindParam(":recipe_id", $recipeID);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    final public function getIngredients($recipeID)
    {

        $sql = "SELECT r.`name`, i.`ingredient_id`, i.`ingredient`, i.`title` FROM `Recipes` r JOIN `Ingredients` i  ON r.`recipe_id` = i.`recipe_id` WHERE i.`recipe_id` = :id";
        $stmt = $this->getConnection()->prepare($sql);
        $stmt->bindParam(':id', $recipeID);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    final public function getPrepMethod($recipeID)
    {

        $sql = "SELECT r.`name`, pm.`prep_id`,pm.`method` FROM `Recipes` r JOIN `PrepMethod` pm  ON r.`recipe_id` = pm.`recipe_id` WHERE pm.`recipe_id` = :id";
        $stmt = $this->getConnection()->prepare($sql);
        $stmt->bindParam(':id', $recipeID);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    // used for paging recipes
    public function getTotalRecipes()
    {
        $query = "SELECT COUNT(DISTINCT(`recipe_id`)) AS `recipe_total` FROM `RecipeCategory`";
        return $this->getConnection()->query($query)->fetchColumn();
    }

    //************ check if search filters are selected ******************/
    // Check if a category is selected
    private function categorySelected($filter, $args)
    {
        if (!empty($this->categoryID)) {
            $this->filterRecipe($filter, $args);
            $this->placeholders[':category_id'] = '%' . $this->categoryID . '%';
        }
    }

    // Check if an author is selected
    private function authorSelected($filter, $args)
    {
        if (!empty($this->authorID)) {
            $this->filterRecipe($filter, $args);
            $this->where .= $filter;
            $this->placeholders[':author_id'] = $this->authorID;
        }
    }

    // Check if a text is entered
    private function searchTerm($filter, $args)
    {
        if (!empty($this->searchTerm)) {
            $this->filterRecipe($filter, $args);
            $this->where .= $filter;
            $this->placeholders[':name'] = '%' . $this->searchTerm . '%';
        }
    }

    // filter the recipe depending on which where property is used
    private function filterRecipe($filter, $args)
    {
        if ($args === $this->where) {
            $this->where .= $filter;
        } else {
            $this->whereCount .= $filter;
        }
    }

    /*     * ********** End of  check if search filters are selected ***************** */

    /* Search recipes in the database */
    private function disableGroupBy(){
        return "SET sql_mode = (SELECT REPLACE(@@sql_mode, 'ONLY_FULL_GROUP_BY', ''));";
    }
    public function fetchRecipes()
    {

        $this->select = "SELECT
        rc.`category_id`,
        r.`recipe_id`,
        r.`name`,
        r.`prep_time`,
        r.`cook_time`,
        r.`servings`,
        r.`description`,
        r.`image`,
        r.`alt`,
        GROUP_CONCAT(c.`category_name` SEPARATOR ', ') AS `category_name`,
        GROUP_CONCAT(c.`category_id`) AS `categories`,
        CONCAT(a.`firstname`, ' ', a.`lastname`) AS `author_name`";

        $this->from = " FROM
       `RecipeCategory` rc";

        $this->from .= " JOIN `Recipes` r ON
        rc.`recipe_id` = r.`recipe_id`";

        $this->from .= " JOIN `Author` a ON
        r.`author_id` = a.`author_id`";

        $this->from .= " JOIN `Categories` c ON
        rc.`category_id` = c.`category_id`";

        $this->where = ' WHERE TRUE';

        $this->authorSelected(" AND r.`author_id` = :author_id", $this->where);
        $this->searchTerm(" AND r.`name` LIKE :name", $this->where);

        $this->where .= ' GROUP BY r.`name`';
        $this->categorySelected(" HAVING `categories` LIKE :category_id", $this->where);

        // randomize query and set page limit
        $this->where .= " ORDER BY RAND({$this->getPageNumber()}) LIMIT {$this->fromRecordNum}," . self::RECORDS_PER_PAGE;

        //resulting query
        $this->combinedSearch = $this->select . $this->from . $this->where;
        $stmt = $this->getConnection()->prepare($this->combinedSearch);
        $stmt->execute($this->placeholders);
        return $stmt->fetchAll();


        
    }

    // if no search results are found then show the list of all the recipes for the selected author
    public function relatedRecipeResults()
    {
        // select query
        $this->select = "SELECT
        r.`recipe_id`,
        r.`name`,
        CONCAT(a.`firstname`, ' ', a.`lastname`) AS `author_name`";

        $this->from = " FROM `Recipes` r";

        $this->from .= " JOIN `Author` a ON r.`author_id` = a.`author_id`";


        $this->where = ' WHERE TRUE';

        // Check if an author is selected
        $this->authorSelected(" AND r.`author_id` = :author_id", $this->where);

        // group by
        $this->where .= ' GROUP BY r.`name`';

        // randomize query - show a limited number of results
        $this->where .= " ORDER BY  rand({$this->getPageNumber()}) LIMIT 10";

        //resulting query
        $this->combinedSearch = $this->select . $this->from . $this->where;
        //prepare query
        $stmt = $this->getConnection()->prepare($this->combinedSearch);
        // execute query
        $stmt->execute($this->placeholders);
        return $stmt->fetchAll();
    }

    // count total number of recipes
    public function countAllByUsingSearch()
    {

        $this->selectCount = "SELECT COUNT(DISTINCT(rc.`recipe_id`)) AS `total_rows`";

        $this->fromCount .= " FROM `RecipeCategory` rc";

        $this->fromCount .= " JOIN Recipes r USING (recipe_id)";

        $this->fromCount .= " JOIN Author a USING (author_id)";

        $this->fromCount .= " JOIN Categories c USING (category_id)";

        $this->fromCount .= ' WHERE TRUE';

        /** count results to filter***************** */
        // Check if an author is selected
        $this->authorSelected(" AND r.`author_id` = :author_id", $this->whereCount);
        // Check if text is entered
        $this->searchTerm(" AND r.`name` LIKE :name", $this->whereCount);

        // if category is selected
        $this->categorySelected(" AND rc.`category_id` LIKE :category_id", $this->whereCount);

        //resulting query for count recipes
        $this->combinedSearchCount = $this->selectCount . $this->fromCount . $this->whereCount;

        // prepare query statement
        $stmt = $this->getConnection()->prepare($this->combinedSearchCount);
        $stmt->execute($this->placeholders);
        $row = $stmt->fetch();

        return $row['total_rows'];
    }

    // search by recipe name - autocomplete
    public function getRecipeName()
    {

        $query = "SELECT `name` FROM `Recipes` WHERE name LIKE :name";
        $stmt = $this->getConnection()->prepare($query);
        $stmt->bindValue(':name', '%' . $this->recipeName . '%');
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function removeFullStopEnd($str)
    {

        return $str[strlen($str) - 1] === '.' ? $str = substr($str, 0, -1) : $str;
    }

}
