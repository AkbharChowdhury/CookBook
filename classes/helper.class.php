<?php

final class Helper {
    /* Notes
     * self:: is used to access static methods and fields rather than using $this keyword as static classes cannot be instantiated. 
     * in this class we only want to get methods without instantiating the class itself.
     */
    private function __construct(){}

    private static $directory = false; // default directory is false
    private const SEARCH_PAGES = array('index', 'recipe');

    private static $currentPage = null; // navbar active link

    public static function currentPage($currentPage){
        self::$currentPage = $currentPage;
    }

    // get active navbar link
    public static function activeLink($link) {
        return self::$currentPage === $link ? 'active' : null;
    }
    // screen-reader for accessibility purposes
    public static function srOnly($link){
        return self::$currentPage === $link ? '<span class="sr-only">(current)</span>' : null;
    }
    

    // Check if the user is logged in, if not then redirect them to login page
    public static function userIsLoggedIn($loginFilePath) {
        if (!isset($_SESSION["logged_in"]) || $_SESSION["logged_in"] !== true) {
            $_SESSION['message'] = 'Please login to access the page you have requested';
            $_SESSION['msg_type'] = 'warning';
            $_SESSION['redirect'] = $_SERVER['REQUEST_URI']; // get the current url of the page requested
            header("location: {$loginFilePath}");
        }
    }

    // remove session variables
    public static function removeSessionMsg() {
        unset($_SESSION['message']);
        unset($_SESSION['msg_type']);
    }
    public static function setErrorMessage($error) {
        return 'Only ' .$error .' may access this page!';
    }

    // sanitize data and output html.
    public static function html($text) {
        return htmlspecialchars($text, ENT_QUOTES, 'UTF-8');
    }


    // Check root directory for dynamic link/path - admin folder
    public static function path() {

        return self::$directory;
    }

    // set (file) directory - setter directory field
    public static function setDirectory($status) {
        self::$directory = $status;
    }

    // default no cook-time message - checkbox on recipe data entry form
    public static function noCookingMsg() {
        return 'No cooking time required';
    }
    public static function image($path) {
        return self::path() ? 'img/' . $path : '../../img/' . $path;
    }

    // include search.js file to format search-text
    public static function formatSearchText($currentPage) {
        return in_array($currentPage, self::SEARCH_PAGES) ? '<script src="js/search.js"></script>' : null;
    }

    // Prevent author editing others recipes by redirecting to manage_recipes page    
    public static function validateAuthorRecipeID($login) {
        if (!in_array($_GET['editRecipe'], array_column($login->getAuthorRecipeID($login->getAuthorID()), 'recipe_id'))){
            header('location: manage_recipe.php');
        }
    }
    public static function validateAuthorID($login){
        if ($_GET['editAuthor'] !== $login->getAuthorID()) { // check if author id is the same as session
            // prevent the user from editing other authors except their own
            $_GET['editAuthor'] = $login->getAuthorID();
        }
    }
        

    // format the total cooking-time in the recipe details page
    public static function formatTime($totalCookingTime) {

       $totalCookingTime = (int) $totalCookingTime;

        if (floor($totalCookingTime / 60 < 1)) {
            // check for one minute
            if ($totalCookingTime === 1) {
                return ($totalCookingTime) . ' minute';
            }
            // minutes only
            return ($totalCookingTime % 60) . ' minutes';
        } 
        if ($totalCookingTime % 60 === 0) {
            // only for 1 hour
            return floor($totalCookingTime / 60) . ' hour';
        } else if (floor($totalCookingTime >= 60 && $totalCookingTime < 120)) {
            // includes over 1 hour but less than 2 hours
            return floor($totalCookingTime / 60) . ' hour ' . ($totalCookingTime % 60) . ' minutes';
        }
        // display default duration
        return floor($totalCookingTime / 60) . ' hours ' . ($totalCookingTime % 60) . ' minutes';
    }

    // breadcrumb used for the recipe details page
    public static function breadcrumb($name, $authorID, $categoryID, $term, $page) { ?>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <!-- Go back to the previous page and show previous search results -->
                <li class="breadcrumb-item"><a href="index.php?author_id=<?= $authorID; ?>&category_id=<?= $categoryID; ?>&s=<?= $term ?>&search=&page=<?= $page ?>">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page"><?= $name; ?></li>
            </ol>
        </nav>
        <?php
    }

}
