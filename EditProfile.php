<?php
session_start();

require "db.php";
require "user_manager.php";

$UserManage = new  User($pdo);


if (!isset($_SESSION['Login'])) {
    header("Location: login.php");
    exit();
}



$CurrentUserName = $_SESSION['Login'];
$Errors = [];

$User = $UserManage->GetUser($CurrentUserName);

// گرفتن اطلاعات کاربر


if (!$User) {
    die("کاربر پیدا نشد");
}

// وقتی فرم ارسال شد
if (isset($_POST['btnUpdate'])) 
{

    $UserName = trim($_POST['UserName']);
    $FirstNameAndLastName = trim($_POST['FirstNameAndLastName']);
    $Email =  trim($_POST['Email']);
    $PhoneNumber = trim($_POST['PhoneNumber']);
    $Address = trim($_POST['Address']);
    $CurrentPassword = $_POST['CurrentPassword'] ?? '';
    $NewPassword = $_POST['NewPassword'] ?? '';

    // اعتبارسنجی ایمیل
    if (!filter_var($Email, FILTER_VALIDATE_EMAIL)) {
        $Errors[] = "ایمیل وارد شده معتبر نیست";
    }

    // اگر می‌خواد رمز عوض کنه
    if (!empty($NewPassword)) {
        if (empty($CurrentPassword)) {
            $Errors[] = "برای تغییر رمز، باید رمز فعلی را وارد کنید";
        } elseif (!password_verify($CurrentPassword, $User['Password'])) {
            $Errors[] = "رمز فعلی اشتباه است";
        }
    }

    // اگر خطایی نبود، آپدیت کن
    if (count($Errors) == 0) 
    {

        try{
                if (!empty($NewPassword)) 
                {
                    $HashedPassword = password_hash($NewPassword, PASSWORD_DEFAULT);

                    $resultadd = $UserManage->EditProfile($UserName,$FirstNameAndLastName,$Email,$PhoneNumber,$Address,$CurrentUserName,$HashedPassword);
                   
                } 
                else 
                {
                    $resultadd = $UserManage->EditProfile($UserName,$FirstNameAndLastName,$Email,$PhoneNumber,$Address,$CurrentUserName);

                if(!$resultadd === false)
                    {
                        $_SESSION['Login'] = $UserName;
                    echo "<script>alert('ویرایش با موفقیت انجام شد');</script>";
                    }
                   
                }
                
                    
                
        
            }
            catch(PDOException $e)
            {
                $Errors[] = "خطا در ذخیره اطلاعات: " . $e->getmessage();
            }
            // اطلاعات جدید رو دوباره بگیر
            // $Select = mysqli_query($Connection, "SELECT * FROM tblusers WHERE UserName = '$UserName'");
            // $User = mysqli_fetch_assoc($Select);
            // $CurrentUserName = $UserName;
    }     
}


?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>ویرایش پروفایل</title>
    <style>
        body {
            font-family: Tahoma, Arial, sans-serif;
            background-color: #f2f4f8;
            direction: rtl;
        }

        .profile-box {
            width: 450px;
            margin: 50px auto;
            background: white;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.15);
        }

        .profile-box h2 {
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

        .form-group input {
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

        .btn-update {
            width: 100%;
            padding: 12px;
            background-color: #4a90e2;
            color: white;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-size: 16px;
        }

        .btn-update:hover {
            background-color: #357abd;
        }

        .hint {
            font-size: 12px;
            color: #888;
            margin-top: 5px;
        }

        .error {
            background-color: #ffe0e0;
            color: #c00;
            padding: 12px;
            border-radius: 8px;
            margin-bottom: 20px;
            font-size: 14px;
        }
    </style>
</head>

<body>
    <div class="profile-box">
        <h2>ویرایش پروفایل</h2>

        <?php if (!empty($Errors)): ?>
            <div class="error">
                <?php foreach ($Errors as $error): ?>
                    <div><?php echo $error; ?></div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <form method="post">
            <div class="form-group">
                <label>نام کاربری:</label>
                <input type="text" name="UserName" value="<?php echo htmlspecialchars($User['UserName']); ?>">
            </div>

            <div class="form-group">
                <label>نام و نام خانوادگی:</label>
                <input type="text" name="FirstNameAndLastName" value="<?php echo htmlspecialchars($User['FirstNameAndLastName']); ?>">
            </div>

            <div class="form-group">
                <label>ایمیل:</label>
                <input type="email" name="Email" value="<?php echo htmlspecialchars($User['Email']); ?>">
            </div>

            <div class="form-group">
                <label>شماره تلفن:</label>
                <input type="text" name="PhoneNumber" value="<?php echo htmlspecialchars($User['PhoneNumber']); ?>">
            </div>

            <div class="form-group">
                <label>آدرس:</label>
                <input type="text" name="Address" value="<?php echo htmlspecialchars($User['Address']); ?>">
            </div>

            <div class="form-group">
                <label>رمز فعلی:</label>
                <input type="password" name="CurrentPassword" placeholder="فقط اگر می‌خواهید رمز را عوض کنید">
            </div>

            <div class="form-group">
                <label>رمز جدید:</label>
                <input type="password" name="NewPassword" placeholder="اگر خالی باشد، رمز تغییر نمی‌کند">
                <div class="hint">برای تغییر رمز، هم رمز فعلی و هم رمز جدید را وارد کنید</div>
            </div>

            <button class="btn-update" name="btnUpdate">ذخیره تغییرات</button>
            <a href="UserPanel.php" class="back-btn">بازگشت</a>

            <style>
                .back-btn {
                    display: inline-block;
                    background-color: #007bff;
                    color: white;
                    padding: 10px 25px;
                    border-radius: 5px;
                    text-decoration: none;
                    font-size: 16px;
                    margin-top: 15px;
                }

                .back-btn:hover {
                    background-color: #0056b3;
                }
            </style>
        </form>
    </div>
</body>

</html>