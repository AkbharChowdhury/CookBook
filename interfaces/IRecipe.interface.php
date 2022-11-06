<?php
// methods declared in an interface MUST be declared in the implemented class
interface IRecipe {

    public function fetchRecipes();
    public function getTotalRecipes();
    public function getRecipeDetails();
    public function getPrepMethod();
    public function getIngredients();

}
