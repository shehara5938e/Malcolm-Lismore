<?php
    if (isset($_POST["submit"])) {
        $heading1 = $_POST["heading1"];
        $heading2 = $_POST["heading2"];
        $pkgdesc = $_POST["pkgdesc"];
        $price = $_POST["price"];

        include_once 'db_connection.php';
        
        if (!$con) {
            die("Connection failed: " . mysqli_connect_error());
        } 
        else {

            $sql = "SELECT * From packages where heading1='" . $heading1 . "' AND heading2='" . $heading2 . "'";
            $result = $con->query($sql);

            //Duplicate Prevention
            if ($result->num_rows > 0) {
                echo '
                    <script>alert("A Package From These Headings Already Exists. Please Use Different Headings");</script>
                ';

                $_POST["submit"] = null;

                echo 'You Will Be Redirected To Manage Packages Page Shortly.';
                header("Refresh: 0; url=" . $_SERVER['HTTP_REFERER']);
                exit();
            } 
            else {
                if (!$con) {
                    die("SQL Connection failed: " . mysqli_connect_error());
                } 
                else {

                    $sql = "INSERT INTO packages (heading1, heading2, pkgdesc, price) VALUES ('" . $heading1 . "', '" . $heading2 . "', '" . $pkgdesc . "', '" . $price . "')";

                    if ($con->query($sql) === TRUE) {
                        echo "<script>alert('Package Uploaded Successfully');</script>";
                        $_POST["heading1"] = null;

                        echo 'You Will Be Redirected To Manage Packages Page Shortly.';
                        header('Refresh: 0; url=../manage_packages.php?Upload_Succeed');
                    } 
                    else {
                        echo "<script>alert('Error: " . $sql . "<br>" . $con->error . "');</script>";
                    }
                }
            }
            $con->close();
        }
    }
?>