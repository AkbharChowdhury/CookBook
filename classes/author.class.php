<?php

declare(strict_types=1);

class Author extends Database {

    private static $instance = null;
    private $authorID;

    private function __construct(){}


    public static function getInstance() {
        return self::$instance === null ? self::$instance = new Author() : self::$instance;
    }

    public function getAuthorName(){
        if(array_key_exists("firstname",$this->data) && array_key_exists("lastname",$this->data)){
            return $this->data['firstname']. ' '.$this->data['lastname'];
        }
        return false;
    }

    // register functionality
    public function checkEmailExists() {
        $sql = "SELECT COUNT(*) AS `email_found` FROM `Author` WHERE  `email` = :email";
        $stmt = $this->getConnection()->prepare($sql);
        $stmt->execute($this->data);
        $row = $stmt->fetch();
        return $row['email_found'] > 0 ? true : false;
    }
    
    public function updatePassword(){
        $sql = "UPDATE `Author` SET `password` = MD5(:password) WHERE `email` = :email";
        return $this->getConnection()->prepare($sql)->execute($this->data);

    }


    public function showAuthor(){

        $sql = "SELECT
                a.*,
                CONCAT(a.`firstname`, ' ', a.`lastname`) AS `author_name`,
                COUNT(DISTINCT(r.`recipe_id`)) AS `total_recipe`
            FROM
                `Author` a
            LEFT JOIN `Recipes` r ON
                r.`author_id` = a.`author_id`
            GROUP BY
                a.`author_id`";

        return $this->getConnection()->query($sql)->fetchAll();
    }

    public function getTotalAuthors() {
        $sql = "SELECT COUNT(*) FROM `Author`";
        return $this->getConnection()->query($sql)->fetchColumn();
        
    }
    
    public function getAuthorID() {
        // query to select retrieve a single author 
        $sql = "SELECT * FROM `Author` WHERE `author_id` = :author_id ";
        $stmt = $this->getConnection()->prepare($sql);
        $stmt->execute($this->data);
        return $stmt->fetchAll();
    }

    public function getAuthorEmail($authorID) {
        // query to select retrieve a single author email
        $sql = "SELECT `email` FROM `Author` WHERE `author_id` = :author_id ";
        $stmt = $this->getConnection()->prepare($sql);
        $stmt->bindParam(':author_id', $authorID);
        $stmt->execute();
        return $stmt->fetchColumn();
    }

    public function addAuthor() {

        $sql = "INSERT INTO `Author` SET `firstname` = :firstname, `lastname` = :lastname, `email` = :email, `password` = MD5(:password)";
        $this->getConnection()->prepare($sql)->execute($this->data);
        $this->authorID = $this->con->lastInsertId();
        return true;

    }
    /*
    * Assigns a given role to an author
    function setDefaultAuthorRole(){
        $sql = "SELECT `author_id` FROM  `Author`";
        $stmt = $this->getConnection()->prepare($sql);
        $stmt->execute();
        $rows = $stmt->fetchAll();

        if($rows){
            foreach ($rows as $row) {
                $sql = "INSERT INTO `AuthorRole` SET `author_id` = :authorID, `role_id` = :roleID";
                $stmt = $this->getConnection()->prepare($sql);
                $stmt->bindValue(':authorID',$row['author_id']);
                $stmt->bindValue(':roleID','Site Administrator');
                $stmt->execute();
    
            }
        } else {
            throw new Exception('All authors are already assigned a content editor role');
        }
    }*/

    // Assign an author role during registration process
    public function addAuthorRole(){
        $roles = array('Content Editor', 'Account Administrator');
        foreach($roles as $role){
            $sql = "INSERT INTO `AuthorRole` SET `author_id` = :authorID, `role_id` = :roleID";
            $stmt = $this->getConnection()->prepare($sql);
            $stmt->bindValue(':authorID',$this->authorID);
            $stmt->bindValue(':roleID', $role);
            $stmt->execute();
        }
        return true;
    }

    public function updateAuthor() {

        $sql = "UPDATE `Author` SET `firstname` = :firstname, `lastname` = :lastname, `email` = :email WHERE `author_id` = :author_id";
        return $this->getConnection()->prepare($sql)->execute($this->data);
    }

    public function deleteAuthor() {

        $sql = "DELETE FROM `Author` WHERE `author_id` = :author_id";
        return $this->getConnection()->prepare($sql)->execute($this->data);

    }

}
