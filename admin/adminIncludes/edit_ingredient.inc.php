<?php
if (!isset($_GET['editRecipe'])) header('location: manage_recipe.php');

require_once "../../includes/interface-autoload.php";
$recipe = ManageRecipe::getInstance();
if (isset($_GET['editRecipe'])) {
    Helper::validateAuthorRecipeID(Login::getInstance());
    $recipeID = $_GET['editRecipe'];
    foreach ($recipe->getRecipeDetails($recipeID) as $row) {
        define("RECIPE", [
            'recipe_id' => $row['recipe_id'],
            'name' => $row['name'],
        ]);
        
    }
}

Breadcrumb::getInstanceSubDirectory($current_page, 'manage_recipe.php', null, $page_title)
->setEditStatus(true)
->setEditName(Helper::html(RECIPE['name']))
->setEditLink(Helper::html(RECIPE['recipe_id']))
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
            header('location: edit_recipe.php?editRecipe=' . RECIPE['recipe_id']);
            return;
        }

    } catch (PDOException $e) {
        echo 'There was an error adding recipes' . $e->getMessage();
    }
}
