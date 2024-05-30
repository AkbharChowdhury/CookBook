<?php
if(!isset($_GET['editCategory'])) header('location: manage_categories.php');

Breadcrumb::getInstanceSubDirectory($current_page, 'manage_categories.php', null, $page_title)->createBreadCrumb();

$category = Category::getInstance();

if (isset($_GET['editCategory'])) {

    $category->addData('category_id',$_GET['editCategory']);
    foreach ($category->getCategoryID() as $row) {
        $category_info = [
            'category_id' => $row['category_id'],
            'category_name' => $row['category_name'],
        ];
    }
}

if ($_POST) {
    
    $category->addData('category_name', $_POST['category_name'])->addData('category_id', $_POST['category_id']);
    $category->updateCategory();
    if ($category->updateCategory()) {
        $_SESSION['message'] = 'Category Updated';
        $_SESSION['msg_type'] = 'warning';
        header('Location: manage_categories.php');
    }
}
