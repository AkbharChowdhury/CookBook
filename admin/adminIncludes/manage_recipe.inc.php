<?php
/**
 * @param Breadcrumb
 * @param $currentPage ,
 * @param $menuLink ,
 * @param $menuDescription
 */

Breadcrumb::getInstanceRootDirectory($current_page, null, true)
->createBreadCrumb();

require_once '../../includes/interface-autoload.php';

$recipe = ManageRecipe::getInstance();
$recipe_exists = $recipe->fetchRecipes();

$current_file = htmlspecialchars($_SERVER['PHP_SELF']);


if (isset($_GET['delete'])) {

    $recipe->addData('recipe_id', $_GET['delete']);

    if ($recipe->deleteRecipe()) {

        $_SESSION['message'] = 'Recipe Deleted';
        $_SESSION['msg_type'] = 'danger';
        header('location: manage_recipe.php');

    }
}