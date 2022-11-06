<?php
declare(strict_types=1);

class Category extends Database {


    private static $instance = null;

    private function __construct(){}


    public static function getInstance() {
        return self::$instance === null ? self::$instance = new Category() : self::$instance;
    }

    
    public function getTotalCategory() {
        $sql = "SELECT COUNT(*) FROM `Categories`";
        return $this->getConnection()->query($sql)->fetchColumn();
    }

    public function showCategories() {

        $sql = "SELECT
        c.*,
        COUNT(DISTINCT(rc.`recipe_id`)) AS `total_recipe`
    FROM
        `Categories` c
    LEFT JOIN `RecipeCategory` rc ON
        c.`category_id` = rc.`category_id`
    GROUP BY
        c.`category_id`";
        
    return $this->getConnection()->query($sql)->fetchAll();
      
    }

    public function getCategoryID() {
        // query to select retrieve a single category 
        $sql = "SELECT * FROM `Categories` WHERE `category_id` = :category_id";
        $stmt = $this->getConnection()->prepare($sql);
        $stmt->execute($this->data);
        return $stmt->fetchAll();
    }

    function deleteCategoryID() {

        $deleteCategory = "DELETE FROM `Categories` WHERE `category_id` = :category_id";
        return $this->getConnection()->prepare($deleteCategory)->execute($this->data);

    }

    // check for duplicate category
    public function checkCategoryExists() {
        $duplicateCategory = "SELECT `category_name` FROM `Categories` WHERE  `category_name` LIKE :category_name";
        $categoryExists = $this->getConnection()->prepare($duplicateCategory);
        //bind values
        $categoryExists->bindValue(":category_name", '%' . $this->data['category_name'] . '');
        $categoryExists->execute();
        return $categoryExists->rowCount() === 1 ? true : false;  
    }

    public function addCategory() {

        $sql = "INSERT INTO `Categories` SET category_name = :category_name";       
        return $this->getConnection()->prepare($sql)->execute($this->data);

    }

    public function updateCategory() {

        $sql = "UPDATE `Categories` SET  `category_name` = :category_name WHERE `category_id` = :category_id";
        return $this->getConnection()->prepare($sql)->execute($this->data);

    }

}
