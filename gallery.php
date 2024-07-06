<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Explore the breathtaking photo gallery of Malcolm Lismore, featuring captivating images of nature's whispers, wildlife chronicles, and weddings & beyond. Immerse yourself in the untamed beauty of Scotland's North West coast through Malcolm's lens. Contact Malcolm Lismore for inquiries and bookings.">
    <title>Malcom Lismore | Gallery</title>
    <link rel="icon" type="image/png" href="images/logo.png">

    <!--Css file-->
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/media_query.css">

    <!--Box Icons-->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
    <?php include 'include/header.php'; ?>

    <!--Gallery Start-->
    <section class="GnP-sections">
        <h2>Photo Gallery</h2>
        <h3>Nature's <span>Whispers</span></h3>
        <div class="container">
            <div class="img-container">
                <!--img display php-->
                <?php
                    include_once 'include/db_connection.php';

                    if (!$con) {
                        die("Connection Failed: " . mysqli_connect_error());
                    }
                    else {
                        $imgcat = "Natures_Whispers";

                        $sql = "SELECT * FROM gallery WHERE imgcat = '$imgcat'";
                        $result = $con->query($sql);

                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                $fid = $row["fid"];
                                $imgtitle = $row["imgtitle"];
                                $imgdesc = $row["imgdesc"];
                                $imgname = $row["imgname"];
                                $imgcat = $row["imgcat"];

                                //display img
                                echo '
                                <img src="'. $imgname .'">
                                ';
                                //display img
                            }
                        }
                    }
                ?>
            </div>
        </div>

        <h3>Wildlife <span>Chronicles</span></h3>
        <div class="container">
            <div class="img-container">
                <?php
                    include_once 'include/db_connection.php';

                    if (!$con) {
                        die("Connection Failed: " . mysqli_connect_error());
                    }
                    else {
                        $imgcat = "Wildlife_Chronicles";

                        $sql = "SELECT * FROM gallery WHERE imgcat = '$imgcat'";
                        $result = $con->query($sql);

                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                $fid = $row["fid"];
                                $imgtitle = $row["imgtitle"];
                                $imgdesc = $row["imgdesc"];
                                $imgname = $row["imgname"];
                                $imgcat = $row["imgcat"];

                                //display img
                                echo '
                                <img src="'. $imgname .'">
                                ';
                                //display img
                            }
                        }
                    }
                ?>
            </div>
        </div>

        <h3>Weddings <span>And Beyond</span></h3>
        <div class="container">
            <div class="img-container">
                    <?php
                        include_once 'include/db_connection.php';

                        if (!$con) {
                            die("Connection Failed: " . mysqli_connect_error());
                        }
                        else {
                            $imgcat = "Weddings_&_Beyond";

                            $sql = "SELECT * FROM gallery WHERE imgcat = '$imgcat'";
                            $result = $con->query($sql);

                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    $fid = $row["fid"];
                                    $imgtitle = $row["imgtitle"];
                                    $imgdesc = $row["imgdesc"];
                                    $imgname = $row["imgname"];
                                    $imgcat = $row["imgcat"];

                                    //display img
                                    echo '
                                    <img src="'. $imgname .'">
                                    ';
                                    //display img
                                }
                            }
                        }
                    ?>
                </div> 
        </div>
    </section>
    <!--Gallery End-->
    
    <!--Js-->
    <script src="js/script.js"></script>

    <!--Ionic icons-->
    <script src="https://unpkg.com/ionicons@latest/dist/ionicons.js"></script>
</body>
</html>