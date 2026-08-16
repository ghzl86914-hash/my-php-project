<?php
session_start();

if (!isset($_SESSION['Login'])) {
    header("Location: login.php");
    exit();
}

$Connection = mysqli_connect("localhost", "root", "", "dbpanel");

if (!$Connection) {
    die("خطا در اتصال به دیتابیس");
}

$CurrentUserName = $_SESSION['Login'];
$Errors = [];
$Success = false;

if (isset($_POST['btnAddProduct'])) {

    $Title = mysqli_real_escape_string($Connection, trim($_POST['ProductTitle']));
    $Price = mysqli_real_escape_string($Connection, trim($_POST['PriceProduct']));
    $ImageName = '';

    // اعتبارسنجی
    if (empty($Title)) {
        $Errors[] = "عنوان محصول نمی‌تواند خالی باشد";
    }

    if (empty($Price) || !is_numeric($Price) || $Price < 0) {
        $Errors[] = "قیمت معتبر وارد کنید";
    }

    // آپلود عکس (اختیاری)
    if (isset($_FILES['ProductImage']) && $_FILES['ProductImage']['error'] == 0) {

        $AllowedTypes = ['image/jpeg', 'image/png', 'image/jpg', 'image/webp'];
        $FileType = $_FILES['ProductImage']['type'];
        $FileSize = $_FILES['ProductImage']['size'];

        if (!in_array($FileType, $AllowedTypes)) {
            $Errors[] = "فقط فایل‌های JPG، PNG و WEBP مجاز هستند";
        } elseif ($FileSize > 2 * 1024 * 1024) { // حداکثر ۲ مگابایت
            $Errors[] = "حجم عکس نباید بیشتر از ۲ مگابایت باشد";
        } else {
            $Extension = pathinfo($_FILES['ProductImage']['name'], PATHINFO_EXTENSION);
            $ImageName = time() . '_' . uniqid() . '.' . $Extension;
            $UploadPath = 'uploads/' . $ImageName;

            if (!move_uploaded_file($_FILES['ProductImage']['tmp_name'], $UploadPath)) {
                $Errors[] = "خطا در آپلود عکس";
                $ImageName = '';
            }
        }
    }

    // اگر خطایی نبود، ذخیره کن
    if (count($Errors) == 0) {

        $Insert = mysqli_query(
            $Connection,
            "INSERT INTO tblproducts (UserName, ProductTitle, PriceProduct, ProductImageName)
             VALUES ('$CurrentUserName', '$Title', '$Price', '$ImageName')"
        );

        if ($Insert) {
            $Success = true;
        } else {
            $Errors[] = "خطا در ذخیره محصول: " . mysqli_error($Connection);
        }
    }
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>افزودن محصول</title>
    <style>
        body {
            font-family: Tahoma, Arial, sans-serif;
            background-color: #f2f4f8;
            direction: rtl;
            margin: 0;
            padding: 0;
        }

        .box {
            width: 480px;
            margin: 50px auto;
            background: white;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.12);
        }

        h2 {
            text-align: center;
            margin-bottom: 25px;
            color: #333;
        }

        .form-group {
            margin-bottom: 18px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            color: #555;
            font-size: 15px;
        }

        .form-group input[type="text"],
        .form-group input[type="number"],
        .form-group input[type="file"] {
            width: 100%;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-size: 14px;
            box-sizing: border-box;
            outline: none;
        }

        .form-group input:focus {
            border-color: #4a90e2;
            box-shadow: 0 0 5px rgba(74, 144, 226, 0.3);
        }

        .btn {
            width: 100%;
            padding: 13px;
            background-color: #4a90e2;
            color: white;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-size: 16px;
            margin-top: 10px;
        }

        .btn:hover {
            background-color: #357abd;
        }

        .error {
            background-color: #ffe0e0;
            color: #c00;
            padding: 12px;
            border-radius: 8px;
            margin-bottom: 20px;
            font-size: 14px;
        }

        .success {
            background-color: #e0ffe0;
            color: #080;
            padding: 15px;
            border-radius: 8px;
            text-align: center;
            margin-bottom: 20px;
        }

        .back-link {
            display: block;
            text-align: center;
            margin-top: 20px;
            color: #4a90e2;
            text-decoration: none;
        }

        .hint {
            font-size: 12px;
            color: #888;
            margin-top: 5px;
        }
    </style>
</head>

<body>
    <div class="box">
        <h2>افزودن محصول جدید</h2>

        <?php if (!empty($Errors)): ?>
            <div class="error">
                <?php foreach ($Errors as $error): ?>
                    <div><?php echo $error; ?></div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <?php if ($Success): ?>
            <div class="success">
                محصول با موفقیت اضافه شد!
            </div>
        <?php endif; ?>

        <form method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label>عنوان محصول:</label>
                <input type="text" name="ProductTitle" placeholder="مثلاً: گوشی سامسونگ" required>
            </div>

            <div class="form-group">
                <label>قیمت (تومان):</label>
                <input type="number" name="PriceProduct" placeholder="مثلاً: 15000000" required>
            </div>

            <div class="form-group">
                <label>عکس محصول (اختیاری):</label>
                <input type="file" name="ProductImage" accept="image/*">
                <div class="hint">فرمت‌های مجاز: JPG, PNG, WEBP — حداکثر ۲ مگابایت</div>
            </div>

            <button type="submit" name="btnAddProduct" class="btn">ثبت محصول</button>
        </form>

        <a href="UserPanel.php" class="back-link">بازگشت به پنل کاربری</a>
    </div>
</body>

</html>