<?php
if(!isset($_GET['editRecipe'])) header('location: manage_recipe.php');

Breadcrumb::getInstanceSubDirectory($current_page, 'manage_recipe.php', null, $page_title)->createBreadCrumb();
require_once '../../includes/interface-autoload.php';
$recipe = ManageRecipe::getInstance();

//check if recipe_id is found
if (isset($_GET['editRecipe'])) {
    
    Helper::validateAuthorRecipeID(Login::getInstance());

    $recipe->addData('recipe_id', $_GET['editRecipe']);
    $recipe->setRecipeID($_GET['editRecipe']);


    foreach ($recipe->getCategories() as $row) {
        $selected_categories[] = $row['category_id'];
    }
    $cat = Category::getInstance();
    foreach ($cat->showCategories() as $row) {
        $categories[] = array(
            'category_id' => $row['category_id'],
            'category_name' => $row['category_name'],
            'selected' => in_array($row['category_id'], $selected_categories)
        );
    }

    // loop through table
    foreach ($recipe->getRecipeDetails() as $row) {
        // store values in an array
        define("RECIPE_INFO", array(
            'recipe_id' => $row['recipe_id'],
            'name' => $row['name'],
            'image' => $row['image'],
            'category_name' => $row['category_name'],
            'alt' => $row['alt'],
            'prep_time' => $row['prep_time'],
            'cook_time' => $row['cook_time'],
            'servings' => $row['servings'],
            'description' => $row['description'],
            'author_id' => $row['author_id'],
            'author_name' => $row['author_name'],
        ));

        $selected_author = RECIPE_INFO['author_id'] ?? '';
    }
}

// if form was submitted
if ($_POST) {
    $validation = ValidateRecipes::getInstance($_POST);
    $errors = $validation->validateForm();
    if (!array_filter($errors)) {

        // posted values
        $_POST['cook_time'] = $_POST['cook_time'] ?? Helper::noCookingMsg();

        
        $recipe->addData('name', $_POST['recipe_name'])
        ->addData('prep_time', $_POST['prep_time'])
        ->addData('cook_time', $_POST['cook_time'])
        ->addData('servings', $_POST['servings'])
        ->addData('description', $_POST['description'])
        ->addData('image', $_POST['image'])
        ->addData('alt', $_POST['alt']);

        $recipe->setRecipeID($_POST['recipe_id']); 
        $ingredientList = $_POST['ingredient_list'];
        $prepMethodList = $_POST['prep_method_list'];
        $category_list = $_POST['categories'];


        if ($recipe->updateRecipe($ingredientList, $prepMethodList, $category_list)) {
            
            $_SESSION['message'] = '"'.$recipe->getData('name').'" Recipe Updated';
            $_SESSION['msg_type'] = 'warning';
            header('location: manage_recipe.php');
            return;
        }
        die('there was an error updating recipe');
    }



    
}
