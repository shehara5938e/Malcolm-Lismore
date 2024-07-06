<?php
    if (isset($_POST["submit"])) {
        $name = $_POST["name"];
        $email = $_POST["email"];
        $subject = $_POST["subject"];
        $message = $_POST["message"];

        //SMTP server............

        echo '<script>alert("This Feature Is Currently Under Development.");</script>';
        header("Refresh: 0; url=" . $_SERVER['HTTP_REFERER']);
        exit();
    }
?>