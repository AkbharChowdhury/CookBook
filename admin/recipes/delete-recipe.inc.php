<?php

require_once '../../includes/class-autoload.php';
require_once '../../includes/interface-autoload.php';


$recipe = ManageRecipe::getInstance();

if (isset($_POST['recipe_id'])) {
    $recipeID = Helper::html($_POST['recipe_id']);
    $recipe->addData('recipe_id',$recipeID);
    if($recipe->deleteRecipe()){
        echo 'Recipe deleted';
    }
}
