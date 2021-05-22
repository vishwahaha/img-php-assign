<?php
    session_start();
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    require_once "../config.php";
    require_once "get_chat.php";
    $to_user = $_REQUEST["to"];
    $from_user = $_SESSION["username"];
    echo get_chat($from_user, $to_user, $conn);
?>