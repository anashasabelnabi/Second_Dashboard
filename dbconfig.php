<?php
class dbconfig{
 public $conn ;
 public function __construct(){
 $this->conn = mysqli_connect("localhost", "root", "" ,"books");
 }
}
 $dbconfig = new dbconfig();

/*$servername = "localhost";
$username = "root";
$password = "";
$dbname =  "books";

// create connection
$db = mysqli_connect($servername, $username, $password ,$dbname);

// Check Connection
if (!$db) {
    die("Connection failed: " . mysqli_connect_error());
}*/
?>

