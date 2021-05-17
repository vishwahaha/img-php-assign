<?php
    session_start();
    require_once "config.php";
 
    $register_user = $conn->prepare("INSERT INTO user_data (username, fullname, age, gender, email, ph_number, password) VALUES (?,?,?,?,?,?,?)");

    if ($register_user != false){

        $register_user->bind_param("ssissss", $username, $fullname, $age, $gender, $email, $phnumber, $password);

        function checkInput($data){
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }
        if($_SERVER["REQUEST_METHOD"] == "POST") {
            $username = checkInput($_POST["username"]);
            $fullname = checkInput($_POST["fullname"]);
            $age = checkInput($_POST["age"]);
            $gender = checkInput($_POST["gender"]);
            $email = checkInput($_POST["email"]);
            $phnumber = checkInput($_POST["phnumber"]);
            $password = password_hash(checkInput($_POST["cpassword"]), PASSWORD_DEFAULT);
            $register_user->execute();
                session_start();
                $_SESSION["loggedin"] = true;
                $_SESSION["username"] = $username;
                header("location: finish_profile.php");
        }
    }
    if ( $register_user = false )
        echo "some error occured. please try again."
    
?>
