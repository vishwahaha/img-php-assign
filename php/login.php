<?php
session_start();
if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
    header("location: onlogin.php");
    exit;
}
elseif(isset($_COOKIE["remember_me"]) && $_COOKIE["remember_me"] != ""){
    $_SESSION["loggedin"] = true;
    $_SESSION["username"] = $_COOKIE["remember_me"];
    header("location: onlogin.php");
    exit;
}
require_once "config.php";
$username = $password = $login_err = "";

function checkInput($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $username = checkInput($_POST["username"]);
    $password = checkInput($_POST["password"]);

    $query = "SELECT username, password FROM user_data WHERE username = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $username_param);
    $username_param = $username;
    if ($stmt->execute()) {
        $stmt->store_result();
        if ($stmt->num_rows == 1) {
            $stmt->bind_result($username, $hash_pass);
            if ($stmt->fetch()) {
                if (password_verify($password, $hash_pass)) {
                    session_start();
                    if($_POST["remember_me"] == "on"){
                        setcookie("remember_me", $username, time()+30*24*60*60, "/", "", 0);
                    }
                    else {
                        setcookie("remember_me", "", time()-60, "/", 0);
                    }
                    $_SESSION["loggedin"] = true;
                    $_SESSION["username"] = $username;
                    header("location: onlogin.php");
                } else {
                    $login_err = "Invalid username or password";
                }
            }
        } else {
            $login_err = "Invalid username or password";
        }
    } else {
        echo "Some error occurred. Please try again.";
    }
    $stmt->close();
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Log in form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="../css/login.css">
</head>

<body>
    <div class="login-form">
        <form id="login" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <h2 class="text-center">Log in</h2>
            <div class="form-group">
                <input type="text" name="username" class="form-control" placeholder="Username" id="usernamebox">
            </div>
            <div class="form-group">
                <input type="password" name="password" class="form-control" placeholder="Password" id="passwordbox">
            </div>

            <div class="form-check form-switch">
                <input class="form-check-input" name="remember_me" type="checkbox" id="rememberSwitch">
                <label class="form-check-label" for="rememberSwitch">Remember me</label>
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary btn-lg" id="submitButton">Log in</button>
            </div>
            <p>Do not have an account yet? <a href="../index.html">register here</a></p>

            <p class="error-msg">
                <?php
                if (!empty($login_err)) {
                    echo $login_err;
                    unset($login_err);
                }
                ?>
            </p>
        </form>

    </div>
    <script>
        if (window.history.replaceState) {
            window.history.replaceState(null, null, window.location.href);
        }
        var username = document.getElementById("usernamebox");
        var password = document.getElementById("passwordbox");
        var submitButton = document.getElementById("submitButton");
        window.onload = () => {
            submitButton.disabled = true;
        }
        username.addEventListener("input", () => {
            if (username.value.length == 0 || password.value.length == 0)
                submitButton.disabled = true;
            else if (username.value.length != 0 && password.value.length != 0)
                submitButton.disabled = false;
        });
        password.addEventListener("input", () => {
            if (username.value.length == 0 || password.value.length == 0)
                submitButton.disabled = true;
            else if (username.value.length != 0 && password.value.length != 0)
                submitButton.disabled = false;
        });
    </script>
    <!-- <script>

            var logForm = document.getElementById("login");
            var formData= {
                email: "",
                password: ""
            }

            logForm.addEventListener("change", () => {
                formData.email = document.getElementById("emailbox").value;
                formData.password = document.getElementById("passwordbox").value;
            });

            logForm.addEventListener("submit", () => {
                var xhr = new XMLHttpRequest();
                xhr.onreadystatechange = function(){
                    if(this.readyState == 4 && this.status == 200){
                        let data = JSON.parse(this.responseText);
                        console.log(data);
                        document.getElementById("error-msg").classList.remove("on-error");
                        document.write("<h1>You have been logged in!</h1>");
                    }   
                    if(this.readyState == 4 && this.status !== 200){
                        document.getElementById("error-msg").classList.add("on-error");
                    }  
                }
                xhr.open("POST", "https://reqres.in/api/login", true);
                xhr.setRequestHeader("Content-Type", "application/json;charset=UTF-8");
                xhr.send(JSON.stringify(formData));
            });

        </script> -->
</body>

</html>