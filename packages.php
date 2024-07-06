<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Discover our range of photography packages tailored to suit every occasion. From birthday parties to anniversaries, baby showers to family portraits, our packages are designed to capture life's special moments beautifully. Explore our affordable packages and preserve your cherished memories with Malcolm Lismore Photography.">
    <title>Malcom Lismore | Packages</title>
    <link rel="icon" type="image/png" href="images/logo.png">

    <!--Css file-->
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/media_query.css">

    <!--Box Icons-->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
    <?php include 'include/header.php'; ?>

    <!--Packages Start-->
    <section class="GnP-sections">
        <h2>Packages</h2>
        <div class="container">
            <div class="pkg-container">
                <!--img display php-->
                <?php
                    include_once 'include/db_connection.php';

                    if (!$con) {
                        die("Connection Failed: " . mysqli_connect_error());
                    }
                    else {
                        $sql = "SELECT * FROM packages";
                        $result = $con->query($sql);

                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                $pkg_id = $row["pkg_id"];
                                $heading1 = $row["heading1"];
                                $heading2 = $row["heading2"];
                                $pkgdesc = $row["pkgdesc"];
                                $price = $row["price"];

                                //display img
                                echo '
                                <div class="package">
                                    <h3>'. $heading1 .'</h3>
                                    <h4>'. $heading2 .'</h4>
                                    <p>'. $pkgdesc .'</p>
                                    <h5>'. $price .'</h5>
                                    <a href="contact_me.php" class="pkg-contact">Contact Me</a>
                                </div>
                                ';
                                //display img
                            }
                        }
                    }
                ?>
            </div>
        </div>
    </section>
    <!--Packages End-->
    
    <!--Js-->
    <script src="js/script.js"></script>

    <!--Ionic icons-->
    <script src="https://unpkg.com/ionicons@latest/dist/ionicons.js"></script>
</body>
</html>