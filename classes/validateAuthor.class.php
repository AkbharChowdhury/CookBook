<?php

// this class validate the author fields in the form
class ValidateAuthor extends Validation {
   
    // Hold the class instance.
    private static $instance = null;

    public static function getInstance($postData) {
        
        return self::$instance === null ? self::$instance = new ValidateAuthor($postData) : self::$instance;
    }

    private function __construct($postData) {
        $this->data = $postData;
    }

    public function validateForm() {
        
        $this->firstName();
        $this->lastName();
        $this->email();
        $this->password();
        $this->verificationCode();


        // returning errors array
        return $this->errors;
    }

}
