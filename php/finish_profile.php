<?php
session_start();
require_once "./session_vars.php";
?>
<!DOCTYPE html>
<html>

<head>
    <title>Finish your profile!</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://kit.fontawesome.com/0a964c491f.js" crossorigin="anonymous"></script>
    <!-- Bootstrap css -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/finish_profile.css" type="text/css">
</head>

<body>
    <nav class="navbar navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <img src="<?php echo $avatar ?>" class="nav-avatar">
                <?php echo $fullname ?>
            </a>
            <form method="POST" action="logout.php" class="d-flex">
                <button name="logout_btn" class="btn btn-outline-secondary" type="submit">Log out</button>
            </form>
        </div>
    </nav>
    <div class="card">
        <div class="card-header">
            <h1>Finish your profile</h1>
        </div>
        <div class="card-body">
            <form action="avatar_upload.php" method="post" enctype="multipart/form-data">
                <div class="avatar-upload">
                    <div class="avatar-edit">
                        <input type="file" name="user_avatar" id="imageUpload" accept=".png, .jpg, .jpeg .svg .bmp" />
                        <label for="imageUpload"><i class="fas fa-upload"></i></label>
                    </div>
                    <div class="avatar-preview">
                        <div id="imagePreview" style="background-image: url('./avatars/default_avatar.png')">
                        </div>
                    </div>
                </div>
                <input id="submitBtn" type="submit" value="Upload image" name="uploadBtn" class="btn btn-primary" >
                <input type="submit" value="Continue without uploading" name="no_avatar" class="btn btn-secondary">
            </form>
        </div>
    </div>
    <script>
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#imagePreview').css('background-image', 'url(' + e.target.result + ')');
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
        $("#submitBtn").attr("disabled", true);
        $("#imageUpload").change(function() {
            readURL(this);
            if ($(this).val()) {
                $("#submitBtn").attr("disabled", false);
            } 
        });
    </script>

</body>

</html>