<?php

/**
 * Notes:
 * This class defines the methods to validate which is extended by other classes.
 * This class is an abstract class so cannot be instantiated.  
 * param  $additionalChecks is set to true so all validations are executed
 * when $additionalChecks is set to false, the default validation is to check for empty fields. 
 */
abstract class Validation {

    protected $data;
    protected $additionalChecks = true;
    protected $errors = [];
    


    private function isValidName($name) {
        return boolval(preg_match('/^[a-zA-Z]+$/', $name));
    
     }
     private function nameError($name) {
        return "$name cannot contain spaces, numbers or special characters";
    
     }


    public function setAdditionalChecks($value){
        $this->additionalChecks = $value;
        return $this;
    }


    // *********************************** register user
    final protected function firstName(){
        if (array_key_exists('firstname', $this->data)) {
            $val = trim($this->data['firstname']);
            $key = 'firstname';

            if (empty($val)) {
                $this->addError($key, 'firstname is required');
                return;
            }

            if (!$this->isValidName($val)) {
                $this->addError($key, $this->nameError($val));
            }
        }
    }

    final protected function lastName(){
        if (array_key_exists('lastname', $this->data)) {
            $val = trim($this->data['lastname']);
            $key = 'lastname';


            if (empty($val)) {
                $this->addError($key, 'lastname is required');
                return;
            }

            if (!$this->isValidName($val)) {
                $this->addError($key, $this->nameError($val));
            }
        }
    }

    final protected function email(){
        if (array_key_exists('email', $this->data)) {
            $email = trim($this->data['email']);

            if (empty($email)) {
                $this->addError('email', 'email is required');
                return;
            }

            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $this->addError('email', 'Please enter a valid email address');
            }
        }
    }

    final protected function password(){
        if (array_key_exists('password', $this->data)) {
            $password = $this->data['password'];
            if (trim(empty($password))) {
                $this->addError('password', 'password is required');
                return;
            }

            if($this->additionalChecks){

                if (trim(strlen($password)) < 8) {
                    $this->addError('password', 'password must be at least 8 characters');
                }
            }
        }
    }

    final protected function subject(){
        if (array_key_exists('subject', $this->data)) {
            $subject = $this->data['subject'];
            if (trim(empty($subject))) {
                $this->addError('subject', 'subject is required');
            }

           
        }
    }


    final protected function message(){

        if (array_key_exists('message', $this->data)) {
            $message = $this->data['message'];
            if (trim(empty($message))) {
                $this->addError('message', 'message is required');
            }

        }
    }


    final protected function verificationCode(){
        if (array_key_exists('verification_code', $this->data)) {
            $verificationCode = trim($this->data['verification_code']);

            if (empty($verificationCode)) {
                $this->addError('verification_code', 'verification code is required');
                return;
            }
            if ($_POST["verification_code"] != $_SESSION["verification_code"] || empty($_SESSION["verification_code"])) {
                $this->addError('verification_code', 'Incorrect verification code');


            }
        }
    }

    



    final protected function categoryName(){

        if (array_key_exists('category_name', $this->data)) {
            $categoryName = trim($this->data['category_name']);
            if (empty($categoryName)) {
                $this->addError('category_name', 'Category is required');
                return;
            }
            if (!preg_match('/^[a-zA-Z]+$/', $categoryName)) {
                $this->addError('category_name', 'category name cannot contain spaces, numbers or special characters');
            }
        }
    }


    final protected function recipeName(){
        if (array_key_exists('recipe_name', $this->data)) {
            $recipeName = trim($this->data['recipe_name']);
            if (empty($recipeName)) {
                $this->addError('recipe_name', 'Recipe is required');
                return;
            }
            if (strlen($recipeName) < 5) {
                $this->addError('recipe_name', 'recipe name must be at least 5 characters long');
            }
        }
    }

    final protected function description(){

        if (array_key_exists('description', $this->data)) {
            $description = trim($this->data['description']);

            if (empty($description)) {
                $this->addError('description', 'description is required');
                return;
            }

            // check the length of the string
            if (strlen($description) < 20) {
                $this->addError('description', 'recipe description must be at least 20 characters long');
            }
        }
    }


    final protected function image(){
        if (array_key_exists('image', $this->data)) {
            $image = trim($this->data['image']);

            if (empty($image)) {
                $this->addError('image', 'image is required');
                return;
            }

            if (!filter_var($image, FILTER_VALIDATE_URL)) {
                $this->addError('image', 'Please enter a valid url address');
            }
        }
    }


    final protected function alt(){
        if (array_key_exists('alt', $this->data)) {
            $alt = trim($this->data['alt']);

            if (empty($alt)) {
                $this->addError('alt', 'alt is required');
            }
        }
    }


    final protected function ingredients(){
        if (array_key_exists('ingredient_list', $this->data)) {
            $ingredients = $this->data['ingredient_list'];
            if (!array_filter($ingredients)) {
                $this->addError('ingredient_list', 'ingredients is required');
            }
        }
    }

    final protected function prepMethod(){
        if (array_key_exists('prep_method_list', $this->data)) {
            $prepMethod = $this->data['prep_method_list'];

            if (!array_filter($prepMethod)) {
                $this->addError('prep_method_list', 'prep method is required');
            }
        }
    }

    final protected function cookTime(){
        if (array_key_exists('cook_time', $this->data)) {
            $cookTime = trim($this->data['cook_time']);
            if (empty($cookTime)) {
                $this->addError('cook_time', 'cook time is required');
                return;
            }
         
            if(!$cookTime === Helper::noCookingMsg() || !is_numeric($cookTime)){
                $this->addError('cook_time', 'cook_time must be a valid number e.g. 15');

            }
        }
    }

    final protected function servings(){
        if (array_key_exists('servings', $this->data)) {
            $servings = trim($this->data['servings']);
            if (empty($servings)) {
                $this->addError('servings', 'servings time is required');
            }
        }
    }

    final protected function prepTime(){
        if (array_key_exists('prep_time', $this->data)) {
            $prepTime = trim($this->data['prep_time']);
            if (empty($prepTime)) {
                $this->addError('prep_time', 'prep_time is required');
                return;
            }
            if (!is_numeric($prepTime)) {
                $this->addError('prep_time', 'prep_time must be a valid number e.g. 15');
            }
        }
    }

    final protected function authorID(){
        if (array_key_exists('author_id', $this->data)) {
            $authorID = trim($this->data['author_id']);
            if (empty($authorID)) {
                $this->addError('author_id', 'author is required');
            }
        }
    }

    final protected function categoryID(){
        if (array_key_exists('category_id', $this->data)) {
            $categoryID = trim($this->data['category_id']);
            if (empty($categoryID)) {
                $this->addError('category_id', 'Category is required');
            }
        }
    }


    final protected function categories(){
        if (empty('categories')) {
            $categories = trim($this->data['categories']);
            if (empty($categories)) {
                $this->addError('categories', 'Category is required');
            }
        }
    }

    // add error keys
    protected function addError($key, $val){
        $this->errors[$key] = $val;
    }
}
