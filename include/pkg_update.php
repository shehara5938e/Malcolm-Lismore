<?php
if (isset($_POST["submit"])) {
    $pkg_id = $_POST["pkg_id"];
    $heading1 = $_POST["heading1"];
    $heading2 = $_POST["heading2"];
    $pkgdesc = $_POST["pkgdesc"];
    $price = $_POST["price"];

    include_once 'db_connection.php';

    if (!$con) {
        die("Connection failed: " . mysqli_connect_error());
    } 
    else {   
        $sql = "SELECT * From packages where pkg_id!='" . $pkg_id . "' AND heading1='" . $heading1 . "' AND heading2='" . $heading2 . "'";
        $result = $con->query($sql);

        //Duplicate Prevention
        if ($result->num_rows > 0) {
            echo '
                <script>alert("A Package From These Headings Already Exists. Please Use Different Headings");</script>
            ';

            $_POST["submit"] = null;

            echo 'You Will Be Redirected To Manage Packages Page Shortly.';
            header("Refresh: 0; url=" . $_SERVER['HTTP_REFERER']);
            exit();
        }
        else {
            // Check if any changes were made
            $sql_check_changes = "SELECT * FROM packages WHERE pkg_id = ?";
            $stmt_check_changes = $con->prepare($sql_check_changes);
            $stmt_check_changes->bind_param("i", $pkg_id);
            $stmt_check_changes->execute();
            $result_check_changes = $stmt_check_changes->get_result();
            $row_check_changes = $result_check_changes->fetch_assoc();
            $stmt_check_changes->close();

            if ($heading1 == $row_check_changes['heading1'] && $heading2 == $row_check_changes['heading2'] && $pkgdesc == $row_check_changes['pkgdesc'] && $price == $row_check_changes['price']) {
                echo "<script>alert('No Changes To Update. Redirecting To The Manage Packages Page');</script>";
                header('Refresh: 0; url=../manage_packages.php?No_Changes');
                exit;
            }

            // Update database
            $sql = "UPDATE packages SET heading1 = ?, heading2 = ?, pkgdesc = ?, price = ? WHERE pkg_id = ?";
            $stmt = $con->prepare($sql);
            $stmt->bind_param("ssssi", $heading1, $heading2, $pkgdesc, $price, $pkg_id);

            if ($stmt->execute()) {
                echo "<script>alert('Package Data Updated');</script>";
                echo 'You will be redirected to the Manage Packages page shortly.';
                header('Refresh: 0; url=../manage_packages.php?Update_Succeed');
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
