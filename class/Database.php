<?php
class Database {    
    public function dbConnect() {        
        static $DBH = null;      
        if (is_null($DBH)) {              
            $connection = new mysqli(HOST, USER, PASSWORD, DATABASE);			
            if ($connection->connect_error) {
                die("Error: Failed to connect to MySQL - " . $connection->connect_error);
            } 
            $DBH = $connection;         
        }
        return $DBH;    
    }     
}
?>
