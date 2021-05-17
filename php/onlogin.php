<?php
    session_start();
    $user = $_SESSION["username"];
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Chat list</title>
    </head>
    <body>
    <h1>Hi <?php echo $user; ?>!</h1>
        <form method="POST" action="logout.php">
            <input type="submit" name="logout_btn" value="Log out">
        </form>
    </body>
</html>