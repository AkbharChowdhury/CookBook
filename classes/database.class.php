<?php
/**
 * @author Akbhar Chowdhury
 * @since Date created 21/09/2020
 * Notes
 * abstract classes cannot be instantiated 
 * protected access modifier method can only be accessed within the class and by classes derived from that class
 */

abstract class Database {

    private $host = 'mysql.cms.gre.ac.uk';
    private $username = 'mc8852u';
    private $password = 'mc8852u';
    private $databaseName = 'mdb_mc8852u';
    private $charset = 'charset=utf8';
    protected $con;
    protected $data = array();

    final protected function getConnection() {

        $dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->databaseName . ';' . $this->charset;
        $this->con = new PDO($dsn, $this->username, $this->password);
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

