 <?php
    if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["logout_btn"])){
        session_start();
        setcookie("remember_me", "", time()-60, "/", "", 0);
        $_SESSION = array();
        session_destroy();
        header("location: login.php");
        exit;
    }
?>