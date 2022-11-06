<?php
declare(strict_types=1);
//sessions are a way of storing variables and accessing them through multiple pages
session_start();
define('ADMIN_PAGES', array('admin_home','manage_authors','manage_recipe','manage_categories' ,'mailing_lists'));
define('ERROR_PAGE', dirname(__FILE__, 2) . DIRECTORY_SEPARATOR . 'includes/error.inc.php');    


if(in_array($current_page, PAGES)){

    require_once 'includes/class-autoload.php';
    require_once 'includes/interface-autoload.php';
    Helper::currentPage($current_page);
    Helper::setDirectory(true);
}

// admin pages
if(in_array($current_page, ADMIN_PAGES)){
    $_SESSION['page_accessed'] = true;
    define('Helper_Class_Path', dirname(__FILE__, 2) . DIRECTORY_SEPARATOR . 'classes/helper.class.php');    
    include_once Helper_Class_Path;
    require_once ($current_page === 'admin_home') ? '../admin/adminIncludes/file-directory.inc.php' : '../adminIncludes/file-directory.inc.php';
    Helper::userIsLoggedIn(FILE_PATH['login']);
    Helper::currentPage($current_page);
}

// Site Administrator - categories
if($current_page === 'manage_categories'){
    $login = Login::getInstance();
    if(!$login->userHasRole('Site Administrator')){
        $errorMsg = Helper::setErrorMessage('Site Administrator');
        include_once ERROR_PAGE;
        exit;
    }
}

// Account Administrator - authors
if($current_page === 'manage_authors'){
    $login = Login::getInstance();
    if(!$login->userHasRole('Account Administrator')){
        $errorMsg = Helper::setErrorMessage('Account Administrator');
        include_once ERROR_PAGE;
        exit;

    }
}

// Content Editor - recipes
if($current_page === 'manage_recipe'){
    $login = Login::getInstance();
    if(!$login->userHasRole('Content Editor')){
        $errorMsg = Helper::setErrorMessage('Content Editor');
        include_once ERROR_PAGE;
        exit;
    }
}

//check if the recipe button is clicked
isset($_GET['recipe']) ? $current_page = 'recipe' : null;
?>
