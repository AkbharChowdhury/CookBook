<?php

$recipe = Recipe::getInstance();

//check if recipe_id is found
if (isset($_GET['recipe_selected_id'])) {
    
    $recipe->addData('recipe_id', $_GET['recipe_selected_id']);

    // loop through table
    foreach ($recipe->getRecipeDetails() as $row) {
        define("RECIPE_INFO", array(
            'email' => $row['email'],
            'name' => $row['name'],
            'prep_time' => $row['prep_time'],
            'cook_time' => $row['cook_time'],
            'servings' => $row['servings'],
            'description' => $row['description'],
            'image' => $row['image'],
            'author' => $row['author_name'],
            'alt' => $row['alt'],
            'total_cooking_time' => $row['total_cooking_time'],
            'category_name' => $row['category_name']
        ));
    }
} else {
    // redirect to homepage
    header('location: .');
}