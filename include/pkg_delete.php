<?php
    if (isset($_GET["pkg_id"])) {
        $pkg_id = $_GET["pkg_id"];

        include_once 'db_connection.php';

        if (!$con) {
                die("Connection failed: " . mysqli_connect_error());
        } 
        else {
            $sql = "SELECT * FROM packages WHERE pkg_id = '$pkg_id'";
            $result = $con->query($sql);

            if ($result->num_rows > 0) {
                $sql = "DELETE FROM packages WHERE pkg_id='$pkg_id'";

                if ($con->query($sql) == true) {
                    echo "<script>alert('Package Deleted');</script>";
                    $_GET["fid"] = null;
                    
                    echo 'You Will Be Redirected To Manage Packages Page Shortly.';
                    header('Refresh: 0; url=../manage_packages.php?Delete_Succeed');
                } 
                else {
                    echo "<script>alert('Error: " . $con->error."');</script>";
                }
            }
            $con->close();
        }
    }
?>