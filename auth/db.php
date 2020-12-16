<?php
class Database{
  
    // specify your own database credentials
    private $host = "localhost";
    private $db_name = "cmapp_web";
    private $username = "root";
    private $password = "Db@maxwell";
    public $conn;
  
    // get the database connection
    public function getConnection_pdo(){
  
        $this->conn = null;
  
        try{
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            $this->conn->exec("set names utf8");
        }catch(PDOException $exception){
            echo "Connection error: " . $exception->getMessage();
        }
  
        return $this->conn;
    }
    public function getConnection_mysqli(){
        $this->conn = null;
         try{
            $this->conn = new mysqli($this->host, $this->username, $this->password, $this->db_name);
            
        }catch(PDOException $exception){
            echo "Connection error: " . $exception->getMessage();
        }
         return $this->conn;

    }
}
