<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

session_start();
require_once "./session_vars.php";
 
$message = ""; 
if ($_SERVER["REQUEST_METHOD"] == "POST"){
if (isset($_POST["uploadBtn"]) && $_POST["uploadBtn"] == "Upload image"){

  if (isset($_FILES["user_avatar"]) && $_FILES["user_avatar"]["error"] === UPLOAD_ERR_OK)
  {

    $fileTmpPath = $_FILES["user_avatar"]["tmp_name"];
    $fileName = $_FILES["user_avatar"]["name"];
    $fileSize = $_FILES["user_avatar"]["size"];
    $fileType = $_FILES["user_avatar"]["type"];
    $fileNameCmps = explode(".", $fileName);
    $fileExtension = strtolower(end($fileNameCmps));
 
    $newFileName = $username . "_avatar.". $fileExtension;
 
    $allowedfileExtensions = array("jpg", "jpeg", "png", "svg", "bmp");
 
    if (in_array($fileExtension, $allowedfileExtensions))
    {
      $uploadFileDir = "./avatars/";
      $dest_path = $uploadFileDir . $newFileName;
 
      if(move_uploaded_file($fileTmpPath, $dest_path)) 
      {
        $set_path_query = "UPDATE user_data SET profile_complete= 'yes', avatar=? WHERE username = ?";
        $set_path = $conn->prepare($set_path_query);
        $set_path->bind_param("ss", $dest_path , $username);
        $set_path->execute();
        echo "File is successfully uploaded.";
        header("location: chat_list.php");
      }
      else
      {
        echo "There was some error moving the file to upload directory.";
      }
    }
    else
    {
      echo "Upload failed. Allowed file types: " . implode(',', $allowedfileExtensions);
    }
  }
  else
  {
    $message = "There is some error in the file upload. Please check the following error.<br>";
    $message .= "Error:" . $_FILES["user_avatar"]["error"];
    echo $message;
  }
}
elseif (isset($_POST["no_avatar"]) && $_POST["no_avatar"] == "Continue without uploading"){
  $default_pic = "./avatars/default_avatar.png";
  $renamed_pic = "./avatars/". $username . "_avatar.png";
  if(copy($default_pic, $renamed_pic)){
  $set_path_query = "UPDATE user_data SET profile_complete= 'yes', avatar=? WHERE username = ?";
  $set_path = $conn->prepare($set_path_query);
  $set_path->bind_param("ss", $avatar_p , $username);
  $avatar_p = "./avatars/". $username . "_avatar.png";
  $set_path->execute();
  header("location: chat_list.php");
  }
  else{
    echo "Some error occured. Please try again";
  }
}
}
?>