<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
session_start();
require_once "../config.php";
require_once "get_chat.php";
    $to_user = $_REQUEST["to"];
    $msg = $_REQUEST["msg"];
    $from_user = $_SESSION["username"];
    $query = "INSERT INTO vishwa_chat (to_user, from_user, msg) VALUES (?,?,?)";
    $insert_msg = $conn->prepare($query);
    $insert_msg->bind_param("sss", $to_user, $from_user, $msg);
    if($insert_msg->execute()){
        echo get_chat($from_user, $to_user, $conn);
    }
?>