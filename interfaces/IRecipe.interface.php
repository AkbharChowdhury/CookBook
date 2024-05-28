<?php
// methods declared in an interface MUST be declared in the implemented class
interface IRecipe {

    public function fetchRecipes();
    public function getTotalRecipes();
    public function getRecipeDetails($recipeID);
    public function getPrepMethod($recipeID);
    public function getIngredients($recipeID);

}
