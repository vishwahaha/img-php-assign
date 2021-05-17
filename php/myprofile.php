<?php
session_start();
require_once "session_vars.php";
?>
<!DOCTYPE html>
<html>

<head>
    <title>My profile</title>
    <!-- Bootstrap css -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/chat_list.css" type="text/css">
</head>
<body>
    <h1><?php echo "Hi " . $fullname; ?></h1>
    <a href="chat_list.php">Back to chat list</a>
</body>

</html>