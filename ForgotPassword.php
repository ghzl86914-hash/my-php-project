<?php
session_start();

require "db.php";
require "user_manager.php";

$UserManage = new  User($pdo);

$Errors = [];
$Success = false;
$Step = 1; // مرحله ۱: وارد کردن ایمیل | مرحله ۲: وارد کردن رمز جدید
$Email = '';

if (isset($_POST['checkEmail'])) {
    $Email = trim($_POST['Email']);

    if (empty($Email)) {
        $Errors[] = "ایمیل نمی‌تواند خالی باشد";
    } elseif (!filter_var($Email, FILTER_VALIDATE_EMAIL)) {
        $Errors[] = "ایمیل وارد شده معتبر نیست";
    } else {

        

            $resultadd = $UserManage->GetEmailUser($Email);
            if(!$resultadd === false)
                {
                   $_SESSION['reset_email'] = $Email;
                    $Step = 2;
                }
            // ایمیل پیدا شد → برو مرحله بعد
            else{
                $Errors[] = "هیچ کاربری با این ایمیل پیدا نشد" ;
            }
    

        }

        }
    

// مرحله دوم: ثبت رمز جدید
if (isset($_POST['resetPassword'])) {
    $Email = $_SESSION['reset_email'] ?? '';
    $NewPassword = $_POST['NewPassword'] ?? '';
    $ConfirmPassword = $_POST['ConfirmPassword'] ?? '';

    if (empty($NewPassword) || empty($ConfirmPassword)) {
        $Errors[] = "هر دو فیلد رمز باید پر شوند";
        $Step = 2;
    } elseif ($NewPassword !== $ConfirmPassword) {
        $Errors[] = "رمز جدید و تکرار آن یکسان نیستند";
        $Step = 2;
    } elseif (strlen($NewPassword) < 6) {
        $Errors[] = "رمز عبور باید حداقل ۶ کاراکتر باشد";
        $Step = 2;
    } else {
        $HashedPassword = password_hash($NewPassword, PASSWORD_DEFAULT);
      

        $resultadd = $UserManage->ForgotPassword($Email,$HashedPassword);

        if(!$resultadd === false)
            {
                unset($_SESSION['reset_email']);
                $Success = true;
                $Step = 3;
            }

        
    else
    {
        $Errors[] = "خطا در تغییر رمز عبور" ;

        $Step = 2;
    }
}
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>بازیابی رمز عبور</title>
    <style>
        body {
            font-family: Tahoma, Arial, sans-serif;
            background-color: #f2f4f8;
            direction: rtl;
        }

        .box {
            width: 420px;
            margin: 60px auto;
            background: white;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.15);
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
        }

        .form-group input {
            width: 100%;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-size: 14px;
            box-sizing: border-box;
        }

        .btn {
            width: 100%;
            padding: 12px;
            background-color: #4a90e2;
            color: white;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-size: 16px;
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
    </style>
</head>

<body>
    <div class="box">
        <h2>بازیابی رمز عبور</h2>

        <?php if (!empty($Errors)): ?>
            <div class="error">
                <?php foreach ($Errors as $error): ?>
                    <div><?php echo $error; ?></div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <?php if ($Success): ?>
            <div class="success">
                رمز عبور شما با موفقیت تغییر کرد.<br>
                حالا می‌توانید وارد شوید.
            </div>
            <a href="login.php" class="back-link">بازگشت به صفحه ورود</a>

        <?php elseif ($Step == 1): ?>
            <!-- مرحله ۱: وارد کردن ایمیل -->
            <form method="post">
                <div class="form-group">
                    <label>ایمیل حساب کاربری:</label>
                    <input type="email" name="Email" value="<?php echo htmlspecialchars($Email); ?>" placeholder="ایمیل خود را وارد کنید" required>
                </div>
                <button type="submit" name="checkEmail" class="btn">ادامه</button>
            </form>
            <a href="login.php" class="back-link">بازگشت به ورود</a>

        <?php elseif ($Step == 2): ?>
            <!-- مرحله ۲: وارد کردن رمز جدید -->
            <form method="post">
                <div class="form-group">
                    <label>رمز عبور جدید:</label>
                    <input type="password" name="NewPassword" placeholder="رمز جدید" required>
                </div>
                <div class="form-group">
                    <label>تکرار رمز عبور جدید:</label>
                    <input type="password" name="ConfirmPassword" placeholder="تکرار رمز جدید" required>
                </div>
                <button type="submit" name="resetPassword" class="btn">تغییر رمز عبور</button>
            </form>
            <a href="ForgotPassword.php" class="back-link">بازگشت</a>
        <?php endif; ?>
    </div>
</body>

</html>