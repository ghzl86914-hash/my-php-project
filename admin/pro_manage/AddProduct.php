<?php
session_start();

require "../../config/db.php";
require "../../classes/product_manager.php";

$ProductManage = new  Product($pdo);

if (!isset($_SESSION['Login'])) {
    header("Location: login.php");
    exit();
}


$Errors = [];
$Success = false;

try{
    $Categories = $ProductManage->listCB('category');
    $Brands = $ProductManage->listCB('brand');
}
catch(Exception $e){
    $Errors[] = "خطا در دریافت لیست دسته بندی و برند".$e->getmessage();
}

if (isset($_POST['btnAddProduct'])) {

    $Title = trim($_POST['ProductTitle']);
    $Price = trim($_POST['PriceProduct']);
    $ImageName = '';
    $ColorProduct = trim($_POST['ColorProduct']);
    $CategoryProduct = trim($_POST['CategoryProduct']);
    $ScoreProduct = trim($_POST['ScoreProduct']);
    $StockProduct = trim($_POST['StockProduct']);
    $Description = trim($_POST['Description']);
    $Add_Date = trim($_POST['Add_Date']);
    $BrandProduct = trim($_POST['BrandProduct']);

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
            $UploadPath = '../../uploads/products' . $ImageName;

            if (!move_uploaded_file($_FILES['ProductImage']['tmp_name'], $UploadPath)) {
                $Errors[] = "خطا در آپلود عکس";
                $ImageName = '';
            }
        }
    }
    // اگر خطایی نبود، ذخیره کن
    if (count($Errors) == 0) {

        
           $resultadd = $ProductManage->AddProduct($Title, $Price, $ImageName, $ColorProduct, $CategoryProduct, $ScoreProduct, $StockProduct, $Description, $Add_Date, $BrandProduct);
    }else{
        $Errors[] = "خطا در ذخیره محصول: ";
    }
            
        
    }
?>
<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>افزودن محصول جدید</title>
    <link href="https://cdn.jsdelivr.net/gh/rastikerdar/vazirmatn@v33.003/Vazirmatn-font-face.css" rel="stylesheet" type="text/css" />
    <style>
        :root {
            --primary: #4f46e5;
            --primary-hover: #4338ca;
            --bg: #f8fafc;
            --card-bg: #ffffff;
            --border: #e2e8f0;
            --border-focus: #6366f1;
            --text-main: #0f172a;
            --text-muted: #64748b;
        }

        * {
            box-sizing: border-box;
        }

        body {
            font-family: 'Vazirmatn', -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
            background-color: var(--bg);
            color: var(--text-main);
            margin: 0;
            padding: 40px 20px;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .box {
            width: 100%;
            max-width: 680px;
            background: var(--card-bg);
            padding: 36px;
            border-radius: 20px;
            border: 1px solid var(--border);
            box-shadow: 0 10px 30px -10px rgba(0, 0, 0, 0.05);
        }

        .header-area {
            text-align: center;
            margin-bottom: 28px;
        }

        h2 {
            margin: 0 0 6px 0;
            font-size: 22px;
            font-weight: 700;
        }

        .subtitle {
            margin: 0;
            font-size: 13px;
            color: var(--text-muted);
        }

        .form-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 16px;
        }

        .form-group {
            display: flex;
            flex-direction: column;
        }

        .form-group.full-width {
            grid-column: span 2;
        }

        .form-group label {
            margin-bottom: 7px;
            font-size: 13px;
            font-weight: 600;
            color: #334155;
        }

        input[type="text"],
        input[type="number"],
        input[type="file"],
        select,
        textarea {
            width: 100%;
            padding: 10px 14px;
            border: 1.5px solid var(--border);
            border-radius: 10px;
            font-size: 14px;
            font-family: inherit;
            color: var(--text-main);
            background-color: #fdfdfd;
            transition: all 0.2s ease;
            outline: none;
        }

        input:focus,
        select:focus,
        textarea:focus {
            border-color: var(--border-focus);
            background-color: #fff;
            box-shadow: 0 0 0 4px rgba(99, 102, 241, 0.1);
        }

        /* استایل اختصاصی پالت رنگ */
        .color-picker-wrapper {
            display: flex;
            align-items: center;
            gap: 12px;
            border: 1.5px solid var(--border);
            border-radius: 10px;
            padding: 6px 12px;
            background-color: #fdfdfd;
        }

        input[type="color"] {
            -webkit-appearance: none;
            border: none;
            width: 34px;
            height: 34px;
            border-radius: 8px;
            cursor: pointer;
            background: none;
            padding: 0;
        }

        input[type="color"]::-webkit-color-swatch-wrapper {
            padding: 0;
        }

        input[type="color"]::-webkit-color-swatch {
            border: 1px solid rgba(0, 0, 0, 0.15);
            border-radius: 6px;
        }

        .color-picker-label {
            font-size: 13px;
            color: var(--text-muted);
        }

        textarea {
            min-height: 110px;
            resize: vertical;
            line-height: 1.6;
        }

        select {
            cursor: pointer;
        }

        .hint {
            font-size: 12px;
            color: var(--text-muted);
            margin-top: 5px;
        }

        .btn {
            grid-column: span 2;
            padding: 12px;
            background-color: var(--primary);
            color: white;
            border: none;
            border-radius: 10px;
            cursor: pointer;
            font-size: 15px;
            font-weight: 600;
            font-family: inherit;
            transition: background-color 0.2s ease, transform 0.05s ease;
            margin-top: 8px;
        }

        .btn:hover {
            background-color: var(--primary-hover);
        }

        .btn:active {
            transform: scale(0.99);
        }

        .error {
            background-color: #fef2f2;
            color: #dc2626;
            padding: 12px 16px;
            border-radius: 10px;
            margin-bottom: 20px;
            font-size: 13.5px;
            border: 1px solid #fee2e2;
        }

        .success {
            background-color: #f0fdf4;
            color: #16a34a;
            padding: 12px 16px;
            border-radius: 10px;
            text-align: center;
            margin-bottom: 20px;
            font-size: 14px;
            border: 1px solid #dcfce7;
        }

        .back-link {
            display: inline-block;
            text-align: center;
            margin-top: 22px;
            color: var(--text-muted);
            font-size: 13.5px;
            text-decoration: none;
            width: 100%;
            transition: color 0.2s ease;
        }

        .back-link:hover {
            color: var(--primary);
        }

        @media (max-width: 580px) {
            .box {
                padding: 24px 18px;
            }
            .form-grid {
                grid-template-columns: 1fr;
            }
            .form-group.full-width,
            .btn {
                grid-column: span 1;
            }
        }
    </style>
</head>

<body>
    <div class="box">
        <div class="header-area">
            <h2>افزودن محصول جدید</h2>
            <p class="subtitle">اطلاعات کالا را با دقت وارد فرمایید</p>
        </div>

        <?php if (!empty($Errors)): ?>
            <div class="error">
                <?php foreach ($Errors as $error): ?>
                    <div><?php echo $error; ?></div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <?php if (!empty($Success)): ?>
            <div class="success">
                محصول با موفقیت اضافه شد!
            </div>
        <?php endif; ?>

        <form method="post" enctype="multipart/form-data">
            <div class="form-grid">
                
                <div class="form-group full-width">
                    <label for="ProductTitle">عنوان محصول</label>
                    <input type="text" id="ProductTitle" name="ProductTitle" placeholder="مثلاً: گوشی موبایل سامسونگ مدل A54" required>
                </div>

                <div class="form-group">
                    <label for="PriceProduct">قیمت (تومان)</label>
                    <input type="number" id="PriceProduct" name="PriceProduct" placeholder="مثلاً: 18500000" required>
                </div>

                <div class="form-group">
                    <label for="StockProduct">موجودی در انبار</label>
                    <input type="number" id="StockProduct" name="StockProduct" min="0" placeholder="تعداد موجودی" required>
                </div>

                <div class="form-group">
                    <label for="CategoryProduct">دسته‌بندی</label>
                    <select id="CategoryProduct" name="CategoryProduct" required>
                        <option value="" disabled selected>انتخاب دسته‌بندی...</option>
                        <!-- حلقه PHP دسته‌بندی‌ها اینجا قرار می‌گیرد -->
                        <?php if (!empty($Categories)): ?>
                            <?php foreach ($Categories as $cat): ?>
                                <option value="<?php echo $cat['CategoryID']; ?>"><?php echo $cat['CategoryName']; ?></option>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="BrandProduct">نوع برند</label>
                    <select id="BrandProduct" name="BrandProduct" required>
                        <option value="" disabled selected>انتخاب برند...</option>
                        <!-- حلقه PHP برندها اینجا قرار می‌گیرد -->
                        <?php if (!empty($Brands)): ?>
                            <?php foreach ($Brands as $brand): ?>
                                <option value="<?php echo $brand['BrandID']; ?>"><?php echo $brand['Name']; ?></option>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="ColorProduct">رنگ شاخص</label>
                    <div class="color-picker-wrapper">
                        <input type="color" id="ColorProduct" name="ColorProduct" value="#3b82f6">
                        <span class="color-picker-label">برای تغییر رنگ کلیک کنید</span>
                    </div>
                </div>

                <div class="form-group">
                    <label for="ScoreProduct">امتیاز محصول (۱ تا ۵)</label>
                    <input type="number" id="ScoreProduct" name="ScoreProduct" min="1" max="5" step="0.1" placeholder="مثلاً: 4.5">
                </div>

                <div class="form-group full-width">
                    <label for="ProductImage">عکس محصول</label>
                    <input type="file" id="ProductImage" name="ProductImage" accept="image/jpeg,image/png,image/webp">
                    <div class="hint">فرمت‌های مجاز: JPG, PNG, WEBP — حداکثر ۲ مگابایت</div>
                </div>

                <div class="form-group full-width">
                    <label for="Description">توضیحات و مشخصات کالا</label>
                    <textarea id="Description" name="Description" placeholder="ویژگی‌ها، اقلام همراه، و جزئیات تکمیلی..."></textarea>
                </div>

                <button type="submit" name="btnAddProduct" class="btn">ثبت نهایی محصول</button>
            </div>
        </form>

        <a href="../admin_panel.php" class="back-link">← بازگشت به پنل مدیریت</a>
    </div>
</body>

</html>