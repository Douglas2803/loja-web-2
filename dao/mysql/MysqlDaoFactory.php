<?php

include_once('../DaoFactory.php');
include_once('MysqlUsuarioDao.php');

class MysqlDaofactory extends DaoFactory {

    // specify your own database credentials
    private $host = "localhost";
    private $db_name = "php_tutorial";
    private $port = "3306";
    private $username = "root";
    private $password = "";
    public $conn;
  
    // get the database connection
    public function getConnection(){
  
        $this->conn = null;
        $dsn="mysql:host=" . $this->host . ";port=" . $this->port . ";dbname=" . $this->db_name;
  
        try{
            $this->conn = new PDO($dsn, $this->username, $this->password);
            //$this->conn = new PDO("pgsql:host=localhost;port=5432;dbname=PHP_tutorial", $this->username, $this->password);
    
      }catch(PDOException $exception){
            echo "Connection error: " . $exception->getMessage() . "\n";
            echo "DSN = " . $dsn;
        }
        return $this->conn;
    }

    public function getUsuarioDao() {

        return new MysqlUsuarioDao($this->getConnection());

    }
}
?>
