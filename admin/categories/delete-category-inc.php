<?php

// class autoload path
require_once '../../includes/class-autoload.php';
$category = category::getInstance();

if (isset($_POST['category_id'])) {
    $categoryID = Helper::html($_POST['category_id']);
    $category->addData('category_id', $categoryID);
    if($category->deleteCategoryID()){
        echo 'category deleted';
    }
}
