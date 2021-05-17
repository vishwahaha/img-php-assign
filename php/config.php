<?php
define("DB_SERVER", "localhost");
define("DB_USERNAME", "first_year");
define("DB_PASSWORD", "first_pass");
define("DB_NAME", "php_assignment");

$conn = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
 
 if($conn->connect_error){
 die("ERROR: Could not connect. " . $conn->connect_error);
 }
?>