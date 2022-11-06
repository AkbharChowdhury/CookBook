<?php
// interface path
require_once '../../includes/interface-autoload.php';
// class autoload path
require_once '../../includes/class-autoload.php';

$recipe = ManageRecipe::getInstance();
if (isset($_POST['ingredient_id'])) {
    $ingredient_id = Helper::html($_POST['ingredient_id']);
    if ($recipe->deleteIngredient($ingredient_id)) {
        echo 'record deleted';
    } else {
        echo 'unable to delete ingredient id';
    }
}

if (isset($_POST['prep_id'])) {
    $prep_id = Helper::html($_POST['prep_id']);
    if ($recipe->deletePrepMethod($prep_id)) {
        echo 'record deleted';
    } else {
        echo 'unable to delete prep id';
    }
}