<?php

$current_page = 'index';
$page_title = 'Home - Cookbook - Get cooking today';
require_once 'templates/header.php';

// instantiate recipe class
$recipe = Recipe::getInstance();

// core.php holds pagination variables
require_once 'includes/core.inc.php';

// count total rows - used for pagination
$total_rows = $recipe->getTotalRecipes();

// get search results and trim it to remove white spaces
$search_term = isset($_GET['s']) ? trim(Helper::html($_GET['s'])) : '';
// remove full stop at the end of text
$search_term = !empty($search_term) ? $recipe->removeFullStopEnd($search_term) : null;


/* ----------------------- Select drop down -------------------------------- */
// get selected author 
$selected_author = $_GET['author_id'] ?? '';
// get selected category 
$selected_category = $_GET['category_id'] ?? '';
/* -------------------------------------------------------------------------- */

// store session variables for recipe details page - home link on breadcrumb menu
$_SESSION['author'] = Helper::html($selected_author);
$_SESSION['category'] = Helper::html($selected_category);
$_SESSION['search'] = $search_term;
$_SESSION['page'] = $page;

// set recipe object properties
$recipe->setPageNumber($page)
->setAuthorID($selected_author)
->setCategoryID($selected_category)
->setSearchTerm($search_term)
->setFromRecordNum($from_record_num);

// query the recipes - search results
$stmt = $recipe->fetchRecipes();

// get current php file  
$current_file = htmlspecialchars($_SERVER['PHP_SELF']);
// specify the page where paging is used
$page_url = "{$current_file}?s={$search_term}&";

// count total rows - used for pagination
$total_rows = $recipe->countAllByUsingSearch();
