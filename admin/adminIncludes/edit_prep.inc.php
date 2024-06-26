<?php
if (!isset($_GET['editRecipe'])) header('location: manage_recipe.php');

require_once "../../includes/interface-autoload.php";

$recipe = ManageRecipe::getInstance();
// code logic
$recipeID = null;

if (isset($_GET['editRecipe'])) {
    Helper::validateAuthorRecipeID(Login::getInstance());


    $recipeID = $_GET['editRecipe'];
    $recipe->addData('recipe_id', $_GET['editRecipe']);
    foreach ($recipe->getRecipeDetails($recipeID) as $row) {
        define("RECIPE", [
            'recipe_id' => $row['recipe_id'],
            'name' => $row['name'],
        ]);
    }
} 


// create dynamic breadcrumb
Breadcrumb::getInstanceSubDirectory($current_page, 'manage_recipe.php', null, $page_title)
->setEditStatus(true)
->setEditName(Helper::html(RECIPE['name']))
->setEditLink(Helper::html(RECIPE['recipe_id']))
->createBreadCrumb();
// if form submitted
if ($_POST) {

    try {
        // if insert query is successful
        $recipe->setRecipeID($recipeID);
        // prep list
        $prep_list = $_POST['prep_method_list'];

        if ($recipe->addUpdatedPrepMethod($prep_list, $recipeID)) {
            $_SESSION['message'] = 'prep method added';
            $_SESSION['msg_type'] = 'success';
            
            header('location: edit_recipe.php?editRecipe=' . RECIPE['recipe_id']);
        } 
        echo 'There was an error adding recipes';
        
    } catch (PDOException $e) {
        echo 'There was an error adding recipes' . $e->getMessage();
    }
}
