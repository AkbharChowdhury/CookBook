<?php

// validate category 
class ValidateCategory extends Validation {

    private static $fields = array(
        'category_name'
    );
    // Hold the class instance.
    private static $instance = null;

    public static function getInstance($postData) {
       
        return self::$instance === null ? self::$instance = new ValidateCategory($postData) : self::$instance;

    }

    private function __construct($postData) {
        $this->data = $postData;
    }

    public function validateForm() {
        foreach (self::$fields as $field) {
            if (!array_key_exists($field, $this->data)) {
                trigger_error("$field is not present in data");
                return;
            }
        }

        //$this->categoryName();

        return $this->errors;
    }

}
