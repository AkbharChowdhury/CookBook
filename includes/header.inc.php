<?php
declare(strict_types=1);
session_start();
const ADMIN_PAGES = ['admin_home', 'manage_authors', 'manage_recipe', 'manage_categories', 'mailing_lists'];
const PAGES = ['index', 'about', 'contact', 'recipe', 'login', 'register', 'profile'];

define('ERROR_PAGE', dirname(__FILE__, 2) . DIRECTORY_SEPARATOR . 'includes/error.inc.php');    


if(in_array($current_page, PAGES)){

    require_once 'includes/class-autoload.php';
    require_once 'includes/interface-autoload.php';
    Helper::currentPage($current_page);
    Helper::setDirectory(true);
}

if(in_array($current_page, ADMIN_PAGES)){
    $_SESSION['page_accessed'] = true;
    define('Helper_Class_Path', dirname(__FILE__, 2) . DIRECTORY_SEPARATOR . 'classes/helper.class.php');    
    include_once Helper_Class_Path;
    require_once ($current_page === 'admin_home') ? '../admin/adminIncludes/file-directory.inc.php' : '../adminIncludes/file-directory.inc.php';
    Helper::userIsLoggedIn(FILE_PATH['login']);
    Helper::currentPage($current_page);
}



function authenticateRoles(){
    $roles = [
        'Site Administrator' => 'manage_categories',
        'Account Administrator' => 'manage_authors',
        'Content Editor' => 'manage_recipe',
    ];
    foreach ($roles as $role => $page) {
        if ($current_page === $page) {
            $login = Login::getInstance();
            if (!$login->userHasRole($role)) {
                $errorMsg = Helper::setErrorMessage($role);
                include_once ERROR_PAGE;
                exit;
            }
        }
    }
}


authenticateRoles();



//check if the recipe button is clicked
isset($_GET['recipe']) ? $current_page = 'recipe' : null;
?>
