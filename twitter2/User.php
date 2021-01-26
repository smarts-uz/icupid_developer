<?php
class User {
	private $dbHost     = "localhost";
    private $dbUsername = "root";
    private $dbPassword = "";
    private $dbName     = "codexworld";
    private $userTbl    = 'users';
	
	function __construct(){
        /*if(!isset($this->db)){
            // Connect to the database
            $conn = new mysqli($this->dbHost, $this->dbUsername, $this->dbPassword, $this->dbName);
            if($conn->connect_error){
                die("Failed to connect with MySQL: " . $conn->connect_error);
            }else{
                $this->db = $conn;
            }
        }*/
    }
	
	function checkUser($userData = array()){
        
        echo "<pre>";
        print_r($userData);
        echo "</pre>";
    }
}
?>