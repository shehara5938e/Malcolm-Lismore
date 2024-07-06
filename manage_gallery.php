<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin | Manage Gallery</title>
    <link rel="icon" type="image/png" href="images/logo.png">

    <!--Css file-->
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/media_query.css">

    <!--Box Icons-->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
    <?php include 'include/header-admin.php'; ?>

    <!--Manage Gallery Start-->
    <section class="imgmanage" id="imgmanage">
        <h2>Manage <span>Gallery</span></h2>
        <div class="card-container">
            <?php
                // Fetching image data from the database
                include_once 'include/db_connection.php';

                if (!$con) {
                    die("Connection Failed: " . mysqli_connect_error());
                } else {
                    $sql = "SELECT * FROM gallery";
                    $result = $con->query($sql);

                    //assigning db data to variables
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            $fid = $row["fid"];
                            $imgtitle = $row["imgtitle"];
                            $imgdesc = $row["imgdesc"];
                            $imgname = $row["imgname"];
                            $imgcat = $row["imgcat"];

                            echo '
                            <div class="card">
                                <img src="'. $imgname .'" alt="">
                                <div class="content">
                                    <h3>'. $imgtitle .'</h3>
                                    <h4>'. $imgcat .'</h4>
                                    <p>
                                        '. $imgdesc .'
                                    </p>

                                    <a href="javascript:void(0);" class="update-btn" onclick="document.getElementById(\'updateForm_'.$fid.'\').submit();">Update</a>
                                    <form id="updateForm_'.$fid.'" action="gallery_update.php" method="GET" style="display:none;">
                                        <input type="hidden" value="'. $fid .'" name="fid">
                                    </form>

                                    <a href="javascript:void(0);" class="delete-btn" onclick="document.getElementById(\'deleteForm_'.$fid.'\').submit();">Delete</a>
                                    <form id="deleteForm_'.$fid.'" action="include/img_delete.php" method="GET" style="display:none;">
                                        <input type="hidden" value="'. $fid .'" name="fid">
                                    </form>
                                </div>
                            </div>
                            ';
                        }
                    }
                    $con->close();
                }
            ?>
        </div>
    </section>
    <!--Gallery Manage End-->

    <!--Upload Section Start-->
    <section class="upload" id="upload">
        <div class="content">
            <h2>Upload <span>Image</span></h2>
            <form action="include/img_upload.php" method="POST" enctype="multipart/form-data">
                <input type="text" name="imgtitle" placeholder="Image Title" required>
                <br>
                <textarea name="imgdesc" placeholder="Image Description" required></textarea>
                <br>
                <input type="file" name="imgname" placeholder="Image" accept=".jpg, .jpeg, .png">
                <br>
                <select name="imgcat" required>
                    <option value="">Select Catagory</option>
                    <option value="Natures_Whispers">Nature's Whispers</option>
                    <option value="Wildlife_Chronicles">Wildlife Chronicles</option>
                    <option value="Weddings_&_Beyond">Weddings & Beyond</option>
                </select>
                <br>

                <input type="submit" name="submit" value="Upload">
            </form>
        </div>
        <div class="img">
            <img src="images/upload.png" alt="">
        </div>
    </section>
    <!--Upload Section End-->

    <!--Js-->
    <script src="js/script.js"></script>

    <!--Ionic icons-->
    <script src="https://unpkg.com/ionicons@latest/dist/ionicons.js"></script>
</body>
</html>