<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Malcom Lismore | Login</title>
    <link rel="icon" type="image/png" href="images/logo.png">

    <!--Css file-->
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/media_query.css">

    <!--Box Icons-->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
    <?php include 'include/header.php'; ?>

    <!--Login Start-->
    <section class="login" id="login">
        <div class="content">
            <h2><span>Login</span></h2>
            <form action="include/login_verification.php" method="POST" enctype="multipart/form-data">
                <input type="text" name="username" placeholder="Username" required>
                <br>
                <input type="password" name="password" id="password" placeholder="Password" required>
                <br>
                <div class="show-btn">
                    <input type="checkbox" id="showPassword"><label for=""> Show Password</label>
                </div>
                <br>
                <input type="submit" name="submit" value="Login">
            </form>      
        </div>
    </section>
    <!--Login End-->

    <!--Js-->
    <script src="js/script.js"></script>

    <!--Ionic icons-->
    <script src="https://unpkg.com/ionicons@latest/dist/ionicons.js"></script>
</body>
</html>