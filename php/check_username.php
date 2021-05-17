<?php
    $q = $_REQUEST["q"];
    require_once "config.php";

    $all_names = array();

    $query = $conn->query("SELECT username FROM user_data");
    while($result = $query->fetch_assoc()){
        $all_names[] = $result["username"];
    }
    $is_available = "yes";
    foreach($all_names as $val){
        if($q == $val){
            $is_available = "no";
            break;
        }
    }
    echo $is_available;
?>
