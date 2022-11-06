<?php

class ValidateContact extends validation {

    private static $instance = null;

    public static function getInstance($postData) {
        
        return self::$instance === null ? self::$instance = new ValidateContact($postData) : self::$instance;

    }

    private function __construct($postData) {
        $this->data = $postData;
    }

    public function validateForm() {
       
        $this->firstName();
        $this->lastName();
        $this->email();
        $this->subject();
        $this->message();

        return $this->errors;
    }

    

   
}
       