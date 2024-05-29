<?php

require_once ($current_page === 'admin_home') ? '../includes/class-autoload.php' : '../../includes/class-autoload.php';
$isRootDir = Helper::path();
// Specify dynamic hyperlink
define("FILE_PATH", [
    'home' => ($isRootDir) ? 'index.php' : '../index.php',
    'mail' => ($isRootDir) ? 'mailing/mailing_lists.php' : '../mailing/mailing_lists.php',
    'recipe' => ($isRootDir) ? 'recipes/manage_recipe.php' : '../recipes/manage_recipe.php',
    'category' => ($isRootDir) ? 'categories/manage_categories.php' : '../categories/manage_categories.php',
    'author' => ($isRootDir) ? 'authors/manage_authors.php' : '../authors/manage_authors.php',
    'css' => ($isRootDir) ? '../css/style.css' : '../../css/style.css',
    'login' => ($isRootDir) ? '../login.php' : '../../login.php',
    'logout' => ($isRootDir) ? '../logout.inc.php' : '../../logout.inc.php',
    'scriptFile' => ($isRootDir) ? '../js/script.js' : '../../js/script.js',
]);
