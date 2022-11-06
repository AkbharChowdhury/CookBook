<?php
//$selected_author = $_REQUEST['author_id'] ?? '';

Breadcrumb::getInstanceSubDirectory($current_page, 'manage_recipe.php', null, $page_title)->createBreadCrumb();

/**
 * Note:
 * As there are issues storing dynamic input fields when page is refreshed (dynamic input fields disappear)
 * for form validation via server side, client side validation has been implemented via JQuery 
 */
// instantiate objects
require_once "../../includes/interface-autoload.php";
$recipe = ManageRecipe::getInstance();
$login = Login::getInstance();


// if the form was submitted
if ($_POST) {

    $validation = ValidateRecipes::getInstance($_POST);
    $errors = $validation->validateForm();
    if (!isset($_POST['categories'])) {
        $categoryError = 'please select a category!';
        return;
    }

    if (!array_filter($errors)) {

        // posted values
        $_POST['cook_time'] = $_POST['cook_time'] ?? Helper::noCookingMsg();


        $recipe->addData('name', $_POST['recipe_name'])
            ->addData('prep_time', $_POST['prep_time'])
            ->addData('cook_time', $_POST['cook_time'])
            ->addData('servings', $_POST['servings'])
            ->addData('description', $_POST['description'])
            ->addData('image', $_POST['image'])
            ->addData('alt', $_POST['alt'])
            ->addData('author_id', $login->getAuthorID());


        $category_list = $_POST['categories'];
        $ingredients = $_POST['ingredient_list'];
        $prep_method = $_POST['prep_method_list'];

        try {
            // if insert query is successful
            if ($recipe->addRecipe($ingredients, $prep_method, $category_list)) {

                $_SESSION['message'] = 'Recipe Added';
                $_SESSION['msg_type'] = 'success';
                header('location: manage_recipe.php');
                return;
            }
            echo 'cannot add recipe';


        } catch (PDOException $e) {
            echo 'There was an error adding recipes' . $e->getMessage();
        }
    } else {

        if (!empty($_POST['categories'])) {
            foreach ($_POST['categories'] as $category) {
                $selected_categories[] = $category;
            }
        }
        foreach ($_POST['ingredient_list'] as $ingredient) {
            $_SESSION['ingredients'] = $ingredient;
        }
        // will not work as javascript is disabled
        if (isset($_SESSION['ingredients'])) {
            //print_r(var_dump($_SESSION['ingredients']));
        }
    }
}
