<?php
if (isset($_GET["fid"])) {
    $fid = $_GET["fid"];
    $imgtitle = "";
    $imgdesc = "";
    $imgname = "";
    $imgcat = "";

    include_once 'include/db_connection.php';

    if (!$con) {
        die("Connection failed: " . mysqli_connect_error());
    } 
    else {
        // Sanitize the fid parameter
        $fid = mysqli_real_escape_string($con, $fid);
        
        $sql = "SELECT * FROM gallery WHERE fid = '$fid'";
        $result = $con->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $imgtitle = $row["imgtitle"];
                $imgdesc = $row["imgdesc"];
                $imgname = $row["imgname"];
                $imgcat = $row["imgcat"];
            }
        }
        else {
            echo "No image found with the specified fid.";
        }
        $con->close();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin | Update Image</title>
    <link rel="icon" type="image/png" href="images/logo.png">

    <!--Css file-->
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/media_query.css">

    <!--Box Icons-->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
    <section class="update" id="update">
        <div class="img">
            <img class="img1" src="images/update.png" alt="">
        </div>
        <div class="content">
            <h2>Update <span>Image</span></h2>
            <form action="include/img_update.php" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="fid" value="<?php echo isset($fid) ? $fid : ''; ?>">
                <input type="text" name="imgtitle" placeholder="Image Title" value="<?php echo isset($imgtitle) ? $imgtitle : ''; ?>" required>
                <br>
                <textarea name="imgdesc" placeholder="Image Description" required><?php echo isset($imgdesc) ? $imgdesc : ''; ?></textarea>
                <br>
                <img src="<?php echo $imgname; ?>" alt="Current Image">
                <br>
                <input type="file" name="imgname" value="<?php echo $imgname; ?>" accept=".jpg, .jpeg, .png">
                <br>
                <select name="imgcat" required>
                    <option value="">Select Category</option>
                    <option value="Natures_Whispers" <?php echo ($imgcat == "Natures_Whispers") ? 'selected' : ''; ?>>Nature's Whispers</option>
                    <option value="Wildlife_Chronicles" <?php echo ($imgcat == "Wildlife_Chronicles") ? 'selected' : ''; ?>>Wildlife Chronicles</option>
                    <option value="Weddings_&_Beyond" <?php echo ($imgcat == "Weddings_&_Beyond") ? 'selected' : ''; ?>>Weddings & Beyond</option>
                </select>
                <br>
                <input type="submit" name="submit" value="Update">
            </form>
        </div>
    </section>
    <!--Js-->
    <script src="js/script.js"></script>

    <!--Ionic icons-->
    <script src="https://unpkg.com/ionicons@latest/dist/ionicons.js"></script>
</body>
</html>