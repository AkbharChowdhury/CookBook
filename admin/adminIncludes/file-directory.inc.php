
<?php

/* * ************ Locate class folder **************************** */
require_once ($current_page === 'admin_home') ? '../includes/class-autoload.php' : '../../includes/class-autoload.php';
/* * ************ end of Locate class folder **************************** */

// Specify dynamic hyperlink
define("FILE_PATH", array(
    'home' => (Helper::path()) ? 'admin_home.php' : '../admin_home.php',
    'mail' => (Helper::path()) ? 'mailing/mailing_lists.php' : '../mailing/mailing_lists.php',
    'recipe' => (Helper::path()) ? 'recipes/manage_recipe.php' : '../recipes/manage_recipe.php',
    'category' => (Helper::path()) ? 'categories/manage_categories.php' : '../categories/manage_categories.php',
    'author' => (Helper::path()) ? 'authors/manage_authors.php' : '../authors/manage_authors.php',
    'css' => (Helper::path()) ? '../css/style.css' : '../../css/style.css',
    'login' => (Helper::path()) ? '../login.php' : '../../login.php',
    'logout' => (Helper::path()) ? '../logout.inc.php' : '../../logout.inc.php',
    'scriptFile' => (Helper::path()) ? '../js/script.js' : '../../js/script.js',
));
