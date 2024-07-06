<?php
 if (isset($_POST["submit"])) {
    $username = $_POST["username"];
    $password = $_POST["password"];

    if ($username == "Admin" && $password == "Admin") {
        header('Refresh: 0; url=../manage_gallery.php');
    }
    else {
        echo "<script>alert('Invalid Username or Password');</script>";
        header("Refresh: 0; url=" . $_SERVER['HTTP_REFERER']);
    }
 }
?>