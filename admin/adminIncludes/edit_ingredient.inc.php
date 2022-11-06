<?php
if (!isset($_GET['editRecipe'])) header('location: manage_recipe.php');

require_once "../../includes/interface-autoload.php";
$recipe = ManageRecipe::getInstance();

// code logic
if (isset($_GET['editRecipe'])) {
    Helper::validateAuthorRecipeID(Login::getInstance());

    $recipeID = $_GET['editRecipe'] ?? null;
    $recipe->addData('recipe_id', $_GET['editRecipe']);
    foreach ($recipe->getRecipeDetails() as $row) {
        // store values in an array
        define("RECIPE_INFO", array(
            'recipe_id' => $row['recipe_id'],
            'name' => $row['name'],
        ));
        
    }
    $recipe->getRecipeDetails();
}

// create dynamic breadcrumb
Breadcrumb::getInstanceSubDirectory($current_page, 'manage_recipe.php', null, $page_title)
->setEditStatus(true)
->setEditName(Helper::html(RECIPE_INFO['name']))
->setEditLink(Helper::html(RECIPE_INFO['recipe_id']))
->createBreadCrumb();
if ($_POST) {
    try {
        foreach($_POST['ingredient_list'] as $i){
            if (empty($i)) {
                $ingredientError = 'ingredient is required';
                return;
            }
        }

        $recipe->setRecipeID($recipeID);

        if ($recipe->addUpdatedIngredients($_POST['ingredient_list'])) {

            $_SESSION['message'] = 'Ingredients added';
            $_SESSION['msg_type'] = 'success';
            header('location: edit_recipe.php?editRecipe=' . RECIPE_INFO['recipe_id']);
            return;
        }

    } catch (PDOException $e) {
        echo 'There was an error adding recipes' . $e->getMessage();
    }
}
