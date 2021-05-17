<?php
session_start();
require_once "session_vars.php";
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
                <img src="<?php echo $avatar ?>" class="nav-avatar">
                <?php echo $fullname ?>
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
        <div class="card" style="width: 14rem;">
            <img src="avatars/test5_avatar.png" class="card-img-top">
            <div class="card-body">
                <h5 class="card-title">Card title</h5>
                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                <a href="#" class="btn btn-primary">Go somewhere</a>
            </div>
        </div>
    </div>
</body>

</html>