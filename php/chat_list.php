<?php
session_start();
require_once "session_vars.php";
$all_data = array();
$get_data = $conn->query("SELECT username, fullname, age, gender, email, avatar FROM user_data");
while($result = $get_data->fetch_assoc()){
    $all_data[] = $result;
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Chat list</title>
    <!-- Bootstrap css -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/chat_list.css" type="text/css">
</head>

<body>
    <nav class="navbar navbar-light bg-light ml-auto">
        <div class="container-fluid inner-navbar">
        <div class="navbar-brand navbar-text" href="#" style="color: black;">
                <div class="nav-image">
                    <img src="<?php echo $avatar ?>" class="nav-avatar">
                </div>
                <div class="navbar-info">
                    <?php echo $fullname ?><br>
                    <div class="nav-username"><?php echo $username ?></div>
                </div>
            </div>

            <div class="nav-right-buttons">
                <div class="nav-item">
                    <button type="button" class="btn btn-info">
                        <a href="myprofile.php" style="color: white; text-decoration: none;">My profile</a>
                    </button>
                </div>
                <div class="nav-item">
                    <form method="POST" action="logout.php">
                        <button name="logout_btn" class="btn btn-outline-secondary" type="submit">Log out</button>
                    </form>
                </div>
            </div>
        </div>
    </nav>
    <h1>All users of this website :</h1>
    <div class="user-list">
    <?php 
        foreach($all_data as $val){
            if( $val["username"] != $username )
            echo
            '<div class="card">
                <div class="card-img" style="background-image: url(' . $val["avatar"] . ')"></div>
                <div class="card-body">
                    <h5 class="card-title">'. $val["fullname"] .'</h5>
                    <p class="card-text">
                    ' . $val["age"] . '<br>
                    ' . $val["email"] . '
                    </p>
                    <div style="text-align: center;">
                        <a href="#" class="btn btn-primary">Chat</a>
                    </div>
                </div>
            </div>';
        }
    ?>
    </div>
</body>

</html>
