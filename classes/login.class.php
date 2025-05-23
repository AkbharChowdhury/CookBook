<?php

class Login extends Database
{

    private string $errorMessage = '';
    private static ?Login $instance = null;

    private function __construct()
    {
    }


    public static function getInstance()
    {
        return self::$instance === null ? self::$instance = new Login() : self::$instance;
    }


    public function getAuthorID()
    {
        $sql = "SELECT `author_id` FROM `Author` WHERE `email` = :email";
        $stmt = $this->getConnection()->prepare($sql);
        $stmt->bindParam(':email', $_SESSION['email']);
        $stmt->execute();
        return $stmt->fetchColumn();
    }

    public function getAuthorRecipeID($authorID)
    {
        $sql = "SELECT `recipe_id` FROM `Recipes` WHERE `author_id` = :authorID";
        $stmt = $this->getConnection()->prepare($sql);
        $stmt->bindParam(':authorID', $authorID);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function databaseContainsAuthor($email, $password)
    {
        $sql = "SELECT COUNT(*) AS `author_found` FROM `Author` WHERE `email` = :email AND `password` = :password";
        $stmt = $this->getConnection()->prepare($sql);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $password);
        $stmt->execute();
        $row = $stmt->fetch();
        $this->errorMessage = !$row['author_found'] > 0 ? 'incorrect email/password' : '';
        return $row['author_found'] > 0;
    }

    // check if author role has permission to access restricted area
    public function userHasRole($role)
    {
        $sql = "SELECT COUNT(*) AS `role_found`
        FROM
            `Author` a
        JOIN `AuthorRole` ar ON
            a.`author_id` = ar.`author_id`
        JOIN `Role` r ON
            r.`role_id` = ar.`role_id`
        WHERE
            a.`email` = :email AND r.`role_id` = :roleID";
        $stmt = $this->getConnection()->prepare($sql);
        $stmt->bindValue(':email', $_SESSION['email']);
        $stmt->bindValue(':roleID', $role);
        $stmt->execute();
        $row = $stmt->fetch();
        return $row['role_found'] > 0;
    }

    public function getErrorMessage(): string
    {
        return $this->errorMessage;
    }
}
