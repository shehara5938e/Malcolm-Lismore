<?php
if (isset($_GET["pkg_id"])) {
    $pkg_id = $_GET["pkg_id"];
    $heading1 = "";
    $heading2 = "";
    $pkgdesc = "";
    $price = "";                            

    include_once 'include/db_connection.php';

    if (!$con) {
        die("Connection failed: " . mysqli_connect_error());
    } 
    else {
        // Sanitize the fid parameter
        $pkg_id = mysqli_real_escape_string($con, $pkg_id);
        
        $sql = "SELECT * FROM packages WHERE pkg_id = '$pkg_id'";
        $result = $con->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $pkg_id = $row["pkg_id"];
                $heading1 = $row["heading1"];
                $heading2 = $row["heading2"];
                $pkgdesc = $row["pkgdesc"];
                $price = $row["price"];
            }
        }
        else {
            echo "No Package found with the specified fid.";
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
    <title>Admin | Update Package</title>
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
            <img class="img1" src="images/update-pkg.png" alt="">
        </div>
        <div class="content">
            <h2>Update <span>Package</span></h2>
            <form action="include/pkg_update.php" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="pkg_id" value="<?php echo isset($pkg_id) ? $pkg_id : ''; ?>">
                <input type="text" name="heading1" placeholder="Heading 1 (Limit: 1 Word)" value="<?php echo isset($heading1) ? $heading1 : ''; ?>" required>
                <br>
                <input type="text" name="heading2" placeholder="Heading 2 (Limit: 4 Words)" value="<?php echo isset($heading2) ? $heading2 : ''; ?>" required>
                <br>
                <textarea name="pkgdesc" placeholder="Package Description" required><?php echo isset($pkgdesc) ? $pkgdesc : ''; ?></textarea>
                <br>
                <input type="text" name="price" placeholder="Package Price" value="<?php echo isset($price) ? $price : ''; ?>" required>
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