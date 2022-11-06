<?php

// create the breadcrumb menu
Breadcrumb::getInstanceSubDirectory($current_page, 'manage_categories.php', null, $page_title)->createBreadCrumb();

$category = Category::getInstance();
// if the form was submitted
if ($_POST) {

    $validation = ValidateCategory::getInstance($_POST);
    $errors = $validation->validateForm();
    if (!array_filter($errors)) {
        // if there are no errors in form then redirect and insert values

        $category->addData('category_name', $_POST['category_name']);

        if ($category->checkCategoryExists()) {
            
            $_SESSION['message'] = $category->getData('category_name').' category already exists!';
            $_SESSION['msg_type'] = 'danger';
            return;
        } 
        if ($category->addCategory()) {

            $_SESSION['message'] = 'Category Added';
            $_SESSION['msg_type'] = 'success';
            header('location: ../categories/manage_categories.php');
        }
        
    } // filter array
}
 