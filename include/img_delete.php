<?php
    if (isset($_GET["fid"])) {
        $fid = $_GET["fid"];
        $imgname = "";

        include_once 'db_connection.php';

        if (!$con) {
                die("Connection failed: " . mysqli_connect_error());
        } 
        else {
            $sql = "SELECT * FROM gallery WHERE fid = '$fid'";
            $result = $con->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $imgname = $row["imgname"];
                }
                
                unlink("../". $imgname);
                $sql = "DELETE FROM gallery WHERE fid='$fid'";

                if ($con->query($sql) == true) {
                    echo "<script>alert('Image Deleted');</script>";
                    $_GET["fid"] = null;
                    
                    echo 'You Will Be Redirected To Manage Gallery Page Shortly.';
                    header('Refresh: 0; url=../manage_gallery.php?Delete_Succeed');
                } 
                else {
                    echo "<script>alert('Error: " . $con->error."');</script>";
                }
            }
            $con->close();
        }
    }
?>