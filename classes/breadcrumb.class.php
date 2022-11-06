<?php

// singleton design pattern- where the constructor is private to allow a single instance of a class to occur
// this class is used to create dynamic breadcrumb menu
class Breadcrumb {

    private $currentPage;
    //specify the page url 
    private $menuLink = null;
    // check if we are in the root directory
    private $rootDirectory = false;
    // changes the text for the menu description
    private $menuDescription = null;
    // Hold the class instance.
    private static $instance = null;
    private $editStatus = false;
    private $editName, $editLink;
    private $homeLink = true; // admin_home.php by default

    /**
     * The object is created from within the class itself
     * only if the class has no instance.
     * getInstanceRootDirectory is used for the root directory folder for Authors, recipes and categories
     */


    
    public static function getInstanceRootDirectory($currentPage, $menuLink, $menuDescription) {
        
        return self::$instance === null ? self::$instance = new Breadcrumb($currentPage, $menuLink, $menuDescription) : self::$instance;

    }
    

    public static function getInstanceSubDirectory($currentPage, $menuLink, $rootDirectory, $menuDescription) {
      
        return self::$instance === null ? self::$instance = new Breadcrumb($currentPage, $menuLink, $rootDirectory, $menuDescription) : self::$instance;

        
    }

    // constructor which automatically gets invoked when created 
    private function __construct($currentPage, $menuLink = null, $rootDirectory = null, $menuDescription = null) {
        $this->currentPage = $currentPage;
        $this->menuLink = $menuLink;
        $this->rootDirectory = $rootDirectory;
        $this->menuDescription = $menuDescription;
    }

    public function setEditStatus($editStatus) {
         $this->editStatus = $editStatus;
         return $this;
    }
    public function setHomeLink($link) {
        $this->homeLink = $link;
        return $this;

    }
    public function setEditName($editName){

        $this->editName = $editName;
        return $this;

    }
    public function setEditLink ($editLink) {
        $this->editLink = $editLink;
        return $this;

    }

    private function splitWords() {
        /*
         * replace _ with " " with title case
         * ucwords - Returns a string with the first character of each word in str capitalized, if that character is alphabetic.
         */

        return ucwords(str_replace("_", " ", $this->currentPage));
    }

    public function createBreadCrumb() { ?>
        <?php if ($this->currentPage !== 'admin_home') : // display breadcrumb menu on all pages except the homepage ?>

            <div class="container">
                <div class="pt-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb"> 
                            <li class="breadcrumb-item"><a href="<?=$this->homeLink ? '../admin_home.php' : '.';?>">Home</a></li>
                            <?php if (!$this->rootDirectory) : //if the current directory is true?>
                                <li class="breadcrumb-item"><a href="<?= $this->menuLink ?>"><?= $this->splitWords() ?></a></li>

                                <?php if ($this->editStatus): ?>
                                <li class="breadcrumb-item"><a href="edit_recipe.php?editRecipe=<?= $this->editLink ?>"><?= $this->editName ?></a></li>
                            <?php endif; ?>
                                <li class="breadcrumb-item active"
                                    aria-current="page"><?= $this->menuDescription ?></li>

                            <?php else :  //otherwise remove the sub-hyperlink and display text ?>
                                <li class="breadcrumb-item active" aria-current="page"><?= $this->splitWords() ?></li>
                            <?php endif; ?>
                        </ol>
                    </nav>
                </div>
            </div>

        <?php endif; ?>

        <?php
    } // end of breadcrumb function
}