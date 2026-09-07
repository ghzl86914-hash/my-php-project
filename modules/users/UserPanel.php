<?php
session_start();

if (!isset($_SESSION['Login'])) {
    header("Location: login.php");
    exit();
}

$Username = $_SESSION['Login'];
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>پنل کاربری</title>
    <style>
        body {
            font-family: Tahoma, Arial, sans-serif;
            background-color: #f2f4f8;
            direction: rtl;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 600px;
            margin: 80px auto;
            background: white;
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        h1 {
            font-size: 32px;
            margin-bottom: 30px;
            color: #333;
        }

        h1 span {
            color: #4a90e2;
        }

        .menu {
            display: flex;
            flex-direction: column;
            gap: 15px;
            margin-top: 30px;
        }

        .menu a {
            display: block;
            padding: 14px;
            background-color: #4a90e2;
            color: white;
            text-decoration: none;
            border-radius: 8px;
            font-size: 16px;
            transition: background 0.3s;
        }

        .menu a:hover {
            background-color: #357abd;
        }

        .menu a.logout {
            background-color: #e74c3c;
        }

        .menu a.logout:hover {
            background-color: #c0392b;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>
            خوش آمدید
            <span><?php echo htmlspecialchars($Username); ?></span>
        </h1>

        <div class="menu">
            <a href="AddProduct.php">افزودن محصول جدید</a>
            <a href="EditProfile.php">ویرایش پروفایل</a>
            <a href="Logout.php" class="logout">خروج از حساب</a>
        </div>
    </div>
</body>

</html>