<?php
    require_once "config.php";
    
    $username = "";
    if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
        $username = $_SESSION["username"];
    }

    $query = "SELECT username, fullname, age, gender, email, ph_number, password, profile_complete, avatar FROM user_data WHERE username = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $username_param);
    $username_param = $username;
    if($stmt->execute()){
        $stmt->store_result();
        $stmt->bind_result($username, $fullname, $age, $gender, $email, $ph_number, $hashed_pass, $profile_complete, $avatar);
        if($stmt->num_rows == 1){
        $stmt->fetch();
        }
    }   
    else {
        echo "Some error occured. Please try again.";
    }
    $stmt->close();
?>