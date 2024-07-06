<?php
if (isset($_POST["submit"])) {
    $fid = $_POST["fid"];
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
        $sql = "SELECT * From gallery where fid!='" . $fid . "' AND imgtitle='" . $imgtitle . "'";
        $result = $con->query($sql);

        //Duplicate Prevention Title
        if ($result->num_rows > 0) {
            echo '
               <script>alert("A Image From This Title Already Exists. Please Use A Different Title");</script>
            ';

            $_POST["submit"] = null;

            echo 'You Will Be Redirected To Manage Packages Page Shortly.';
            header("Refresh: 0; url=" . $_SERVER['HTTP_REFERER']);
            exit();
        }
        else {
            if (isset($_FILES["imgname"]) && $_FILES["imgname"]["error"] == 0) {
                $extensions = array("jpg" => "image/jpg", "jpeg" => "image/jpeg", "png" => "image/png");
    
                // Verify file extension
                $extension = pathinfo($imgname, PATHINFO_EXTENSION);
                if (!array_key_exists($extension, $extensions)) {
                    die("Unsupported File Format.");
                }
    
                // Verify file size
                $maxsize = 20 * 1024 * 1024; //20 MB
                if ($imgsize > $maxsize) {
                    die("Files larger than ". $maxsize / 1024 / 1024 ."MB are not allowed.");
                }
    
                // Verify file type
                if (!in_array($imgtype, $extensions)) {
                    die("An unexpected error occurred. Please try again.");
                }

                //Duplicate Prevention image
                if (file_exists("../images/gallery/" . $imgname)) {
                    echo '
                    <script>alert("('. $imgname .') This Image Already Exists. Please Upload A Different File");</script>
                    ';
                    header("Refresh: 0; url=" . $_SERVER['HTTP_REFERER']);
                    exit;
                }

                else {
                    // Delete old image if exists
                    $sql_select = "SELECT imgname FROM gallery WHERE fid = ?";
                    $stmt_select = $con->prepare($sql_select);
                    $stmt_select->bind_param("i", $fid);
                    $stmt_select->execute();
                    $stmt_select->bind_result($old_imgname);
                    $stmt_select->fetch();
                    $stmt_select->close();
    
                    if ($old_imgname) {
                        unlink("../" . $old_imgname);
                    }
    
                    // Move uploaded file
                    if (move_uploaded_file($_FILES["imgname"]["tmp_name"], "../images/gallery/" . $imgname)) {
                        $imgname1 = "images/gallery/" . $imgname;
                    } else {
                        echo "Error uploading the file. Please try again.";
                    }
                }
                
            }
            else {
                // If no file uploaded, retain old image name
                $sql_select = "SELECT imgname FROM gallery WHERE fid = ?";
                $stmt_select = $con->prepare($sql_select);
                $stmt_select->bind_param("i", $fid);
                $stmt_select->execute();
                $stmt_select->bind_result($imgname1);
                $stmt_select->fetch();
                $stmt_select->close();
            }
    
            // Check if any changes were made
            $sql_check_changes = "SELECT * FROM gallery WHERE fid = ?";
            $stmt_check_changes = $con->prepare($sql_check_changes);
            $stmt_check_changes->bind_param("i", $fid);
            $stmt_check_changes->execute();
            $result_check_changes = $stmt_check_changes->get_result();
            $row_check_changes = $result_check_changes->fetch_assoc();
            $stmt_check_changes->close();
    
            if ($imgtitle == $row_check_changes['imgtitle'] && $imgdesc == $row_check_changes['imgdesc'] && $imgcat == $row_check_changes['imgcat'] && $imgname1 == $row_check_changes['imgname']) {
                echo "<script>alert('No Changes To Update. Redirecting To The Manage Gallery Page');</script>";
                header('Refresh: 0; url=../manage_gallery.php?No_Changes');
                exit;
            }
    
            // Update database
            $sql = "UPDATE gallery SET imgtitle = ?, imgdesc = ?, imgname = ?, imgcat = ? WHERE fid = ?";
            $stmt = $con->prepare($sql);
            $stmt->bind_param("ssssi", $imgtitle, $imgdesc, $imgname1, $imgcat, $fid);
    
            if ($stmt->execute()) {
                echo "<script>alert('Image Data Updated');</script>";
                echo 'You will be redirected to the Manage Gallery page shortly.';
                header('Refresh: 0; url=../manage_gallery.php?Update_Succeed');
            } 
            else {
                echo "<script>alert('Error: " . $stmt->error . "');</script>";
            }
            $stmt->close();
    
            $con->close();
        }
    }
}
?>
