<?php
class User {
    private $conn;
    private $table_name = "users";
  
    public $id;
    public $name;
    public $password;
    public $created;
  
    public function __construct($db){
        $this->conn = $db;
    }

    // read products
    function read() {
    
        // select all query
        $query = "SELECT
                    p.id, p.name, p.created
                FROM
                    " . $this->table_name . " p
                ORDER BY
                    p.created DESC";
    
        // prepare query statement
        $stmt = $this->conn->prepare($query);
    
        // execute query
        $stmt->execute();
    
        return $stmt;
    }
}
?>