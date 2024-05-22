<?php
/**
 * @author Akbhar Chowdhury
 * @since Date created 21/09/2020
 * Notes
 * abstract classes cannot be instantiated 
 * protected access modifier method can only be accessed within the class and by classes derived from that class
 */
 
 abstract class Database {

    protected $con;
    protected $data = array();


    private function loadENV(){
        require_once rootDirectory().'/vendor/autoload.php';
        $dotenv = Dotenv::createImmutable(rootDirectory());
        $dotenv->load();
    }


    public function getConnection() {
        $this->loadENV();
        
        $username = $_ENV['USERNAME'] ?? 'no username';
        $password = $_ENV['PASSWORD'] ?? 'no username';
        $host = $_ENV['HOST'] ?? 'no host';
        $databaseName = $_ENV['DB_NAME'];
        $charset = $_ENV['CHARSET'] ?? 'no CHARSET';

        $dsn = 'mysql:host=' . $host . ';dbname=' . $databaseName . ';' . $charset;
        $this->con = new PDO($dsn, $username, $password);
        $this->con->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        return $this->con;
    }

    final public function addData(string $key, $val){
        $this->data[$key] = $val;
        return $this;
    }

    final public function getData(string $key){
        if (array_key_exists($key, $this->data)) {
            return $this->data[$key];
        }
        throw new Exception($key . ' does not exists');

    }

    final public function resetData(){
        $this->data = array();
    }

}
