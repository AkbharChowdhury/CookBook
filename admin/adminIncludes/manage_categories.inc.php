<?php

$breadcrumb = Breadcrumb::getInstanceRootDirectory($current_page, null, true)->createBreadCrumb();

$current_file = htmlspecialchars($_SERVER['PHP_SELF']);

$category = Category::getInstance();
$category_exists = $category->showCategories();


if (isset($_GET['delete'])) {
    
    $category->addData('category_id', $_GET['delete']);

    if ($category->deleteCategoryID()) {
        $_SESSION['message'] = 'Category Deleted';
        $_SESSION['msg_type'] = 'danger';
        header('location: manage_categories.php');
    }
}