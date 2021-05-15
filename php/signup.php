<?php
    $username = $fullname = $age = $gender = $email = $phnumber = $password = "";
    function checkInput($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    if( $_SERVER["REQUEST_METHOD"] == "POST") {
        $username = checkInput($_POST["username"]);
        $fullname = checkInput($_POST["fullname"]);
        $age = checkInput($_POST["age"]);
        $gender = checkInput($_POST["gender"]);
        $email = checkInput($_POST["email"]);
        $phnumber = checkInput($_POST["phnumber"]);
        $password = checkInput($_POST["cpassword"]);
    }
    $link = mysqli_connect("localhost", "first_year", "first_pass", "php_assignment");
 

    if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
    }
 
    echo "Connect Successfully. Host info: " . mysqli_get_host_info($link);
?>