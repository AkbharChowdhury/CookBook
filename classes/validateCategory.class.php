<?php

class ValidateCategory extends Validation
{

    private static $instance = null;

    public static function getInstance($postData)
    {

        return self::$instance === null ? self::$instance = new ValidateCategory($postData) : self::$instance;

    }

    private function __construct($postData)
    {
        $this->data = $postData;
    }

    public function validateForm()
    {
        //$this->categoryName();
        return $this->errors;
    }

}
