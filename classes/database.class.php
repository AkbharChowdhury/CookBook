<?php
/**
 * @author Akbhar Chowdhury
 * @since Date created 21/09/2020
 */

use Dotenv\Dotenv as Dotenv;
 abstract class Database {

    protected $con;
    protected $data = [];
    
    private function loadENV(){
        $rootDir = Helper::rootDirectory(__FILE__);
        require_once $rootDir .'/vendor/autoload.php';
        $dotenv = Dotenv::createImmutable($rootDir);
        $dotenv->load();
    }


    public function getConnection() {
        $this->loadENV();
        $host = $_ENV['HOST'] ?? '';
        $user = $_ENV['USERNAME'] ?? '';
        $pass = $_ENV['PASSWORD'] ?? '';
        $charset = 'utf8mb4';
        $db   =  $_ENV['DB_NAME'] ?? '';
        $dsn = "mysql:host=$host;dbname=$db;charset=$charset"; 
        $this->con = new PDO($dsn, $user, $pass);
        $this->con->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        return $this->con;
    }

    final public function addData(string $key, $val){
        $this->data[$key] = $val;
        return $this;
    }

     /**
      * @throws Exception
      */
     final public function getData(string $key){
        if (array_key_exists($key, $this->data)) {
            return $this->data[$key];
        }
        throw new Exception($key . ' does not exists');

    }

    final public function resetData(){
        $this->data = [];
    }

}
