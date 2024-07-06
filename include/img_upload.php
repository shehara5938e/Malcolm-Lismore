<?php
    if (isset($_POST["submit"])) {
        $imgtitle = $_POST["imgtitle"];
        $imgdesc = $_POST["imgdesc"];
        $imgcat = $_POST["imgcat"];  
        $imgname1 = "";   

        $imgname = $_FILES["imgname"]["name"];
        $imgtype = $_FILES["imgname"]["type"];
        $imgsize = $_FILES["imgname"]["size"];

        include_once 'db_connection.php';
        
        if (!$con) {
            die("Connection failed: " . mysqli_connect_error());
        } 
        else {

            $sql = "SELECT * From gallery where imgtitle='" . $imgtitle . "'";
            $result = $con->query($sql);

            //Duplicate Prevention
            if ($result->num_rows > 0) {
                echo '
                    <script>alert("An Image From This Title Already Exists. Please Use A Different Title");</script>
                ';

                $_POST["submit"] = null;

                echo 'You Will Be Redirected To Manage Gallery Page Shortly.';
                header("Refresh: 0; url=" . $_SERVER['HTTP_REFERER']);
                exit();
            } 
            else {
                //Error Checking
                if (isset($_FILES["imgname"]) && $_FILES["imgname"]["error"] == 0) {
                    $extensions = array("jpg" => "image/jpg", "jpeg" => "image/jpeg", "png" => "image/png");

                    // Verify extension
                    $extention = pathinfo($imgname, PATHINFO_EXTENSION);
                    if (!array_key_exists($extention, $extensions)) {
                        die("Unsupported File Format.");
                    }

                    // Verify file size
                    $maxsize = 20 * 1024 * 1024;
                    if ($imgsize > $maxsize) {
                        die("Files That Larger Than ". $maxsize / 1024 / 1024 ."MB Are Not Allowed.");
                    }

                    // Verify File type of the file
                    if (in_array($imgtype, $extensions)) {

                        //Duplicate Prevention
                        if (file_exists("../images/gallery/" . $imgname)) {
                            echo '
                            <script>alert("('. $imgname .') This Image Already Exists. Please Upload A Different File");</script>
                            ';
                            header("Refresh: 0; url=" . $_SERVER['HTTP_REFERER']);
                            exit();
                        } 
                        else {
                            move_uploaded_file($_FILES["imgname"]["tmp_name"], "../images/gallery/" . $imgname);
                            $imgname1 = "images/gallery/" . $imgname;
                        }
                    } 
                    else {
                        echo "An Unexpected Error Occured. Please Try Again";
                    }
                } 
                else {
                    echo "Error: " . $_FILES["imgname"]["error"];
                }

                //Image Uploading
                if (!$con) {
                    die("SQL Connection failed: " . mysqli_connect_error());
                } 
                else {

                    $sql = "INSERT INTO gallery (imgtitle, imgdesc, imgname, imgcat) VALUES ('" . $imgtitle . "', '" . $imgdesc . "', '" . $imgname1 . "', '" . $imgcat . "')";

                    if ($con->query($sql) === TRUE) {
                        echo "<script>alert('Image Uploaded');</script>";
                        $_POST["imgname"] = null;

                        echo 'You Will Be Redirected To Manage Gallery Page Shortly.';
                        header('Refresh: 0; url=../manage_gallery.php?Upload_Succeed');
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