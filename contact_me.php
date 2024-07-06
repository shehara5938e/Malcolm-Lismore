<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Get in touch with Malcolm Lismore through the Contact Me page. Fill out the form to email Malcolm directly with your inquiries, messages, or feedback. Whether you have questions about services, want to discuss collaborations, or simply wish to say hello, Malcolm looks forward to hearing from you. Reach out now to start the conversation.">
    <title>Malcom Lismore | Contact Me</title>
    <link rel="icon" type="image/png" href="images/logo.png">

    <!--Css file-->
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/media_query.css">

    <!--Box Icons-->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
    <?php include 'include/header.php'; ?>

    <!--Contact Me Section Start-->
    <section class="contact_me" id="contact_me">
        <div class="content">
            <h2>Email <span>Me</span></h2>
            <form action="include/send_email.php" method="POST" enctype="multipart/form-data">
                <input type="text" name="name" placeholder="Name" required>
                <br>
                <input type="text" name="email" placeholder="Email Address" required>
                <br>
                <input type="text" name="subject" placeholder="Subject" required>
                <br>
                <textarea name="message" placeholder="Message" required></textarea>
                <br>

                <input type="submit" name="submit" value="Email">
            </form>
        </div>
        <div class="img">
            <img src="images/email.png" alt="">
        </div>
    </section>
    <!--Contact Me Section End-->

    <!--Js-->
    <script src="js/script.js"></script>

    <!--Ionic icons-->
    <script src="https://unpkg.com/ionicons@latest/dist/ionicons.js"></script>
</body>
</html>