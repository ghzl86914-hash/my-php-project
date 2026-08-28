<?php
session_start();

if (!isset($_SESSION['Login'])) {
    header("Location: login.php");
    exit();
}

$Username = $_SESSION['Username'];
?>

<!DOCTYPE html>
<html>

<head>

    <meta charset="UTF-8">

    <title>User Panel</title>

</head>

<body style="display:flex; justify-content:center; align-items:center; height:100vh;">

<div style="position:absolute; top:15px; right:20px;">

    <a href="Logout.php">خروج از حساب</a>

    /

    <a href="EditProfile.php">ویرایش پروفایل</a>

</div>

    <h1 style="font-size:50px;font-weight:bold;color:black;text-align:center;margin-top:250px;">

        Welcome

        <span style="color:blue;">
            <?php echo $Username; ?>
        </span>

    </h1>

</body>

</html>