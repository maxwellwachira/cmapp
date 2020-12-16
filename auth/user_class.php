<?php

class User{
  
    // database connection and table name
    private $conn;
    private $table_name = "users";
  
    // object properties
    public $id;
    public $username;
    public $email;
    public $password;
    public $type;
    public $created_at;
    public $deleted = 0;
  
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }

    public function create(){
  
    // query to insert record
    $query = "INSERT INTO
                " . $this->table_name . "
            SET
                username=:username, email=:email, password=:password, type=:type, created_at=:created_at, deleted=:deleted";
  
    // prepare query
    $stmt = $this->conn->prepare($query);
  
    // sanitize
    $this->username=htmlspecialchars(strip_tags($this->username));
    $this->email=htmlspecialchars(strip_tags($this->email));
    $this->password=htmlspecialchars(strip_tags($this->password));
    $this->type=htmlspecialchars(strip_tags($this->type));
    $this->created_at=htmlspecialchars(strip_tags($this->created_at));
    $this->deleted=htmlspecialchars(strip_tags($this->deleted));
  
    // bind values
    $stmt->bindParam(":username", $this->username);
    $stmt->bindParam(":email", $this->email);
    $stmt->bindParam(":password", $this->password);
    $stmt->bindParam(":type", $this->type);
    $stmt->bindParam(":created_at", $this->created_at);
    $stmt->bindParam(":deleted", $this->deleted);
  
    // execute query
    if($stmt->execute()){
        return true;
    }
  
    return false;
      
    }

    public function readOne(){
  
    // query to read single record
    $query = "SELECT
                *
            FROM
                " . $this->table_name . " 
            WHERE
            	id = ?
                
            LIMIT 1";
  
    // prepare query statement
    $stmt = $this->conn->prepare( $query );
  
    // bind id of product to be updated
    $stmt->bindParam(1, $this->id);
  
    // execute query
    $stmt->execute();
  
    // get retrieved row
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
  
    // set values to object properties
    $this->username = $row['username'];
    $this->email = $row['email'];
    $this->password = $row['password'];
    $this->type = $row['type'];
    $this->created_at = $row['created_at'];
    }


    Public function read(){
  
	    // select all query
	    $query = "SELECT
	                *
	            FROM
	                " . $this->table_name . " 
	            ORDER BY
	                created_at DESC";
	  
	    // prepare query statement
	    $stmt = $this->conn->prepare($query);
	  
	    // execute query
	    $stmt->execute();
	  
	    return $stmt;
    }

    // update the product
	public function update(){
	  
	    // update query
	    $query = "UPDATE
	                " . $this->table_name . "
	            SET
	                username = :username,
	                email = :email,
	                password = :password,
	                type = :type
	            WHERE
	                id = :id";
	  
	    // prepare query statement
	    $stmt = $this->conn->prepare($query);
	  
	    // sanitize
	    $this->username=htmlspecialchars(strip_tags($this->username));
	    $this->email=htmlspecialchars(strip_tags($this->email));
	    $this->password=htmlspecialchars(strip_tags($this->password));
	    $this->type=htmlspecialchars(strip_tags($this->type));
	    $this->id=htmlspecialchars(strip_tags($this->id));

	    $this->password = password_hash($this->password, PASSWORD_DEFAULT);
	  
	    // bind new values
	    $stmt->bindParam(':username', $this->username);
	    $stmt->bindParam(':email', $this->email);
	    $stmt->bindParam(':password', $this->password);
	    $stmt->bindParam(':type', $this->type);
	    $stmt->bindParam(':id', $this->id);
	  
	    // execute the query
	    if($stmt->execute()){
	        return true;
	    }
	  
	    return false;
	}

	// delete the product
	public function delete(){
	  
	    // delete query
	    $query = "DELETE FROM " . $this->table_name . " WHERE id = ?";
	  
	    // prepare query
	    $stmt = $this->conn->prepare($query);
	  
	    // sanitize
	    $this->id=htmlspecialchars(strip_tags($this->id));
	  
	    // bind id of record to delete
	    $stmt->bindParam(1, $this->id);
	  
	    // execute query
	    if($stmt->execute()){
	        return true;
	    }
	  
	    return false;
	    }


	// search products
	public function search($keywords){
	  
	    // select all query
	    $query = "SELECT
	                *
	            FROM
	                " . $this->table_name . " 
	            WHERE
	                username LIKE ? OR email LIKE ?
	            ORDER BY
	                created_at DESC";
	  
	    // prepare query statement
	    $stmt = $this->conn->prepare($query);
	  
	    // sanitize
	    $keywords=htmlspecialchars(strip_tags($keywords));
	    $keywords = "%{$keywords}%";
	  
	    // bind
	    $stmt->bindParam(1, $keywords);
	    $stmt->bindParam(2, $keywords);
		  
	    // execute query
	    $stmt->execute();
	  
	    return $stmt;
	}
	
	public function count(){
	    $query = "SELECT COUNT(*) as total_rows FROM " . $this->table_name . "";
	  
	    $stmt = $this->conn->prepare( $query );
	    $stmt->execute();
	    $row = $stmt->fetch(PDO::FETCH_ASSOC);
	  
	    return $row['total_rows'];
	}

 }

?>