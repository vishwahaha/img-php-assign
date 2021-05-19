<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
require_once "session_vars.php";
$wrong_pass = "";
$wrong_pass_2 = "";
$pass_unmatch = "";
function checkInput($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["updateBtn"]) && $_POST["updateBtn"] == "Update profile") {
        $password = checkInput($_POST["password"]);
        if (password_verify($password, $hashed_pass)) {
            if (isset($_FILES["user_avatar"]) && $_FILES["user_avatar"]["error"] === UPLOAD_ERR_OK) {

                $new_fullname = checkInput($_POST["fullname"]);
                $new_email = checkInput($_POST["email"]);
                $new_phnumber = checkInput($_POST["phnumber"]);

                $fileTmpPath = $_FILES["user_avatar"]["tmp_name"];
                $fileName = $_FILES["user_avatar"]["name"];
                $fileSize = $_FILES["user_avatar"]["size"];
                $fileType = $_FILES["user_avatar"]["type"];
                $fileNameCmps = explode(".", $fileName);
                $fileExtension = strtolower(end($fileNameCmps));

                $newFileName = $username . "_avatar." . $fileExtension;

                $allowedfileExtensions = array("jpg", "jpeg", "png", "svg", "bmp");

                if (in_array($fileExtension, $allowedfileExtensions)) {
                    $uploadFileDir = "./avatars/";
                    $dest_path = $uploadFileDir . $newFileName;
                    if (move_uploaded_file($fileTmpPath, $dest_path)) {
                        unlink($avatar);
                        $update_query = "UPDATE user_data SET fullname = ?, email = ?, ph_number = ?, avatar = ? WHERE username = ?";
                        $update_profile = $conn->prepare($update_query);
                        $update_profile->bind_param("sssss", $new_fullname, $new_email, $new_phnumber, $dest_path, $username);
                        $update_profile->execute();
                        header("location: chat_list.php");
                    } else {
                        echo "There was some error moving the file to upload directory.";
                    }
                } else {
                    echo "Upload failed. Allowed file types: " . implode(',', $allowedfileExtensions);
                }
            } elseif (!file_exists($_FILES["user_avatar"]["tmp_name"]) || !is_uploaded_file($_FILES["user_avatar"]["tmp_name"])) {
                $new_fullname = checkInput($_POST["fullname"]);
                $new_email = checkInput($_POST["email"]);
                $new_phnumber = checkInput($_POST["phnumber"]);
                $update_query = "UPDATE user_data SET fullname = ?, email = ?, ph_number = ? WHERE username = ?";
                $update_profile = $conn->prepare($update_query);
                $update_profile->bind_param("ssss", $new_fullname, $new_email, $new_phnumber, $username);
                $update_profile->execute();
                header("location: chat_list.php");
            } else {
                $message = "There is some error in the file upload. Please check the following error.<br>";
                $message .= "Error:" . $_FILES["user_avatar"]["error"];
                echo $message;
            }
        } else {
            $wrong_pass = "wrong password";
        }
    } elseif (isset($_POST["changePass"]) && $_POST["changePass"] == "Change password") {
        $oldpass = checkInput($_POST["oldpassword"]);
        if (password_verify($oldpass, $hashed_pass)) {
            $newpassword = checkInput($_POST["newpassword"]);
            $cnewpassword = checkInput($_POST["cnewpassword"]);
            if ($newpassword == $cnewpassword) {
                $password_new = password_hash($newpassword, PASSWORD_DEFAULT);
                $pass_up_query = "UPDATE user_data SET password = ? WHERE username = ?";
                $update_pass = $conn->prepare($pass_up_query);
                $update_pass->bind_param("ss", $password_new, $username);
                if ($update_pass->execute()) {
                    header("location: chat_list.php");
                } else
                    echo "Some error occured, Please try again.";
            } else {
                $pass_unmatch = "passwords don't match";
            }
        } else
            $wrong_pass_2 = "wrong password";
    }
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>My profile</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://kit.fontawesome.com/0a964c491f.js" crossorigin="anonymous"></script>
    <!-- Bootstrap css -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/myprofile.css" type="text/css">
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
                        <a href="chat_list.php" style="color: white; text-decoration: none;">Back</a>
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
    <div class="card">
        <div class="card-header">
            <h1>Update your profile</h1>
        </div>
        <div class="card-body">
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" enctype="multipart/form-data">
                <div class="update-form-body">
                    <div class="avatar-upload">
                        <div class="avatar-edit">
                            <input type="file" name="user_avatar" id="imageUpload" accept=".png, .jpg, .jpeg .svg .bmp" />
                            <label for="imageUpload"><i class="fas fa-upload"></i></label>
                        </div>
                        <div class="avatar-preview">
                            <div id="imagePreview" style="background-image: url('<?php echo $avatar ?>')">
                            </div>
                        </div>
                    </div>
                    <div>
                        <div class="form-group">
                            <input type="text" name="fullname" class="form-control" placeholder="Full name" id="fullnamebox" value="<?php echo $fullname; ?>" required>
                            <span class="error-indicator" id="nameWarning"><i class="far fa-check-circle" style="color: green"></i></span>
                        </div>
                        <div class="form-group">
                            <input type="email" name="email" class="form-control" placeholder="Email" id="emailbox" value="<?php echo $email; ?>" required>
                            <span class="error-indicator" id="emailWarning"><i class="far fa-check-circle" style="color: green"></i></span>
                        </div>
                        <div class="form-group">
                            <input type="text" name="phnumber" class="form-control" placeholder="Mobile number" id="phnumberbox" value="<?php echo $ph_number; ?>" required>
                            <span class="error-indicator" id="phnumberWarning"><i class="far fa-check-circle" style="color: green"></i></span>
                        </div>
                        <div class="form-group">
                            <input type="password" name="password" class="form-control" placeholder="Password" id="passwordbox" required>
                            <span class="password-error"><?php if (!empty($wrong_pass)) {
                                                                echo $wrong_pass;
                                                                unset($wrong_pass);
                                                            } ?>
                            </span>
                        </div>
                    </div>
                </div>
                <input id="updateBtn" type="submit" value="Update profile" name="updateBtn" class="btn btn-primary" style="max-width: 200px;">
            </form>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h1>Change password</h1>
        </div>
        <div class="card-body">
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" id="pass-change-form">
                <div class="form-group">
                    <input type="password" name="newpassword" class="form-control" placeholder="New password" id="newpasswordbox" required>
                </div>
                <div class="form-group">
                    <input type="password" name="cnewpassword" class="form-control" placeholder="Confirm new password" id="cnewpasswordbox" required>
                    <span class="password-error"><?php if (!empty($pass_unmatch)) {
                                                        echo $pass_unmatch;
                                                        unset($pass_unmatch);
                                                    } ?></span>
                </div>
                <div class="form-group">
                    <input type="password" name="oldpassword" class="form-control" placeholder="Current password" id="oldpasswordbox" required>
                    <span class="password-error"><?php if (!empty($wrong_pass_2)) {
                                                        echo $wrong_pass_2;
                                                        unset($wrong_pass_2);
                                                    } ?></span>
                </div>
                <input id="changePass" type="submit" value="Change password" name="changePass" class="btn btn-primary" style="max-width: 200px;">
            </form>
        </div>
    </div>
    <script src="../js/myprofile.js"></script>
</body>

</html>