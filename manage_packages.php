<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin | Manage Packages</title>
    <link rel="icon" type="image/png" href="images/logo.png">

    <!--Css file-->
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/media_query.css">

    <!--Box Icons-->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
    <?php include 'include/header-admin.php'; ?>

    <!--Manage Packages Start-->
    <section class="pkgmanage" id="pkgmanage">
        <h2>Manage <span>Packages</span></h2>
        <div class="card-container">
            <?php
                // Fetching package data from the db
                include_once 'include/db_connection.php';

                if (!$con) {
                    die("Connection Failed: " . mysqli_connect_error());
                } else {
                    $sql = "SELECT * FROM packages";
                    $result = $con->query($sql);

                    //assigning db data to variables
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            $pkg_id = $row["pkg_id"];
                            $heading1 = $row["heading1"];
                            $heading2 = $row["heading2"];
                            $pkgdesc = $row["pkgdesc"];
                            $price = $row["price"];

                            echo '
                            <div class="card">
                                <div class="content">
                                    <h3>'. $heading1 .'</h3>
                                    <h4>'. $heading2 .'</h4>
                                    <p>'. $pkgdesc .'</p>
                                    <h5>'. $price .'</h5>

                                    <a href="javascript:void(0);" class="update-btn" onclick="document.getElementById(\'updateForm_'.$pkg_id.'\').submit();">Update</a>
                                    <form id="updateForm_'.$pkg_id.'" action="package_update.php" method="GET" style="display:none;">
                                        <input type="hidden" value="'. $pkg_id .'" name="pkg_id">
                                    </form>

                                    <a href="javascript:void(0);" class="delete-btn" onclick="document.getElementById(\'deleteForm_'.$pkg_id.'\').submit();">Delete</a>
                                    <form id="deleteForm_'.$pkg_id.'" action="include/pkg_delete.php" method="GET" style="display:none;">
                                        <input type="hidden" value="'. $pkg_id .'" name="pkg_id">
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
    <!--Manage Packages End-->

    <!--Upload Section Start-->
    <section class="upload" id="upload">
        <div class="content">
            <h2>Upload <span>Package</span></h2>
            <form action="include/pkg_upload.php" method="POST" enctype="multipart/form-data">
                <input type="text" name="heading1" placeholder="Heading 1 (Limit: 1 Word)" required>
                <br>
                <input type="text" name="heading2" placeholder="Heading 2 (Limit: 4 Words)" required>
                <br>
                <textarea name="pkgdesc" placeholder="Package Description" required></textarea>
                <br>
                <input type="text" name="price" placeholder="Package Price" required>
                <br>

                <input type="submit" name="submit" value="Upload">
            </form>
        </div>
        <div class="img">
            <img src="images/Upload-pkg.png" alt="">
        </div>
    </section>
    <!--Upload Section End-->

    <!--Js-->
    <script src="js/script.js"></script>

    <!--Ionic icons-->
    <script src="https://unpkg.com/ionicons@latest/dist/ionicons.js"></script>
</body>
</html>