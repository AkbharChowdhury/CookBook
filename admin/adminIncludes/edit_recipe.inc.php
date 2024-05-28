<?php
if (!isset($_GET['editRecipe'])) header('location: manage_recipe.php');

Breadcrumb::getInstanceSubDirectory($current_page, 'manage_recipe.php', null, $page_title)->createBreadCrumb();
require_once '../../includes/interface-autoload.php';
$recipe = ManageRecipe::getInstance();

$id = $_GET['editRecipe'];
function getID()
{
    return $_GET['editRecipe'];

}

//$info = $recipe->getRecipeDetails($id);
//print_r(var_dump($info));
//$car = array("brand"=>"Ford", "model"=>"Mustang", "year"=>1964);
//echo $info[0]["alt"];
//foreach ($info as $item) {
//    echo '<h1>'.$item['description'].'</h1>';
//
//}
//print_r(var_dump( $info));
//die();


//check if recipe_id is found
if (isset($_GET['editRecipe'])) {

    Helper::validateAuthorRecipeID(Login::getInstance());
    $recipeID = $_GET['editRecipe'];
//    $recipe->addData('recipe_id', $_GET['editRecipe']);
    $recipe->setRecipeID($recipeID);

    function selectedCategories()
    {
        $recipe = ManageRecipe::getInstance();
        $selected_categories = [];
        foreach ($recipe->getCategories(getID()) as $row) {
            $selected_categories[] = $row['category_id'];
        }
        return $selected_categories;

    }

//    foreach ($recipe->getCategories($recipeID) as $row) {
//        $selected_categories[] = $row['category_id'];
//    }

    function categories()
    {
        $cat = Category::getInstance();
        $categories = [];
        foreach ($cat->showCategories() as $row) {
            $categories[] = [
                'category_id' => $row['category_id'],
                'category_name' => $row['category_name'],
                'selected' => in_array($row['category_id'], selectedCategories())
            ];
        }
        return $categories;

    }



    function getRecipeDetails($id)
    {
        $recipe = ManageRecipe::getInstance();
        foreach ($recipe->getRecipeDetails($id) as $row) {

            return [
                'recipe_id' => $row['recipe_id'],
                'name' => $row['name'],
                'image' => $row['image'],
                'category_name' => $row['category_name'],
                'alt' => $row['alt'],
                'prep_time' => $row['prep_time'],
                'cook_time' => $row['cook_time'],
                'servings' => $row['servings'],
                'description' => $row['description'],
                'author_id' => $row['author_id'],
                'author_name' => $row['author_name'],
            ];

        }

    }


    if ($_POST) {
        $validation = ValidateRecipes::getInstance($_POST);
        $errors = $validation->validateForm();
        if (!array_filter($errors)) {

            $_POST['cook_time'] = $_POST['cook_time'] ?? Helper::noCookingMsg();


            $recipe->addData('name', $_POST['recipe_name'])
                ->addData('prep_time', $_POST['prep_time'])
                ->addData('cook_time', $_POST['cook_time'])
                ->addData('servings', $_POST['servings'])
                ->addData('description', $_POST['description'])
                ->addData('image', $_POST['image'])
                ->addData('alt', $_POST['alt']);
            $recipe->setRecipeID($_POST['recipe_id']);
            $ingredientList = $_POST['ingredient_list'];
            $prepMethodList = $_POST['prep_method_list'];
            $category_list = $_POST['categories'];


            if ($recipe->updateRecipe($ingredientList, $prepMethodList, $category_list)) {

                $_SESSION['message'] = '"' . $recipe->getData('name') . '" Recipe Updated';
                $_SESSION['msg_type'] = 'warning';
                header('location: manage_recipe.php');
                return;
            }

            die('there was an error updating recipe');
        }


    }
}
    

