<?php

$recipe = Recipe::getInstance();
if (!isset($_GET['recipe_selected_id'])) header('location: .');
foreach ($recipe->getRecipeDetails($_GET['recipe_selected_id']) as $row) {
    define("RECIPE", [
        'id' => $_GET['recipe_selected_id'],
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
    ]);
}
