<?php

// validate category 
class ValidateRecipes extends validation {

    
    // Hold the class instance.
    private static $instance = null;

    public static function getInstance($postData) {
        
        return self::$instance === null ? self::$instance = new ValidateRecipes($postData) : self::$instance;

    }

    private function __construct($postData) {
        $this->data = $postData;
    }

    public function validateForm() {
       

        $this->recipeName();
        $this->description();
        $this->prepTime();
        $this->cookTime();
        $this->servings();
        $this->prepMethod();
        $this->image();
        $this->alt();
        $this->ingredients();
        $this->authorID();
        $this->categories();

        return $this->errors;
    }

    

   
}
