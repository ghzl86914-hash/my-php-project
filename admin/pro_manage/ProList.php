<?php
session_start();

require "../../config/db.php";
require "../../classes/product_manager.php";

$ProductManage = new  Product($pdo);

if (!isset($_SESSION['Login'])) {
    header("Location: login.php");
    exit();
}

$prolist = $ProductManage->ProList();

$Errors = [];


?>


<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>مدیریت محصولات | گالری اکسسوری</title>
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <!-- فونت وزیرمتن -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/rastikerdar/vazirmatn@v33.003/Vazirmatn-font-face.css">

    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        :root {
            --primary: #c49b63;
            --primary-hover: #b08751;
            --bg-body: #f8f9fa;
            --card-bg: #ffffff;
            --text-dark: #2b2d42;
            --text-muted: #8d99ae;
            --border: #edf0f2;
            --danger: #ef4444;
            --danger-bg: #fef2f2;
            --success: #10b981;
            --warning: #f59e0b;
        }

        body {
            font-family: 'Vazirmatn', sans-serif;
            background-color: var(--bg-body);
            color: var(--text-dark);
            direction: rtl;
            padding: 24px;
        }

        .container {
            max-width: 1400px;
            margin: 0 auto;
        }

        /* هدر صفحه */
        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 16px;
            margin-bottom: 24px;
        }

        .header-title h2 {
            font-size: 1.4rem;
            font-weight: 800;
            color: var(--text-dark);
        }

        .header-title p {
            color: var(--text-muted);
            font-size: 0.85rem;
            margin-top: 4px;
        }

        .actions-group {
            display: flex;
            gap: 12px;
            align-items: center;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 9px 16px;
            border-radius: 10px;
            font-size: 0.88rem;
            font-weight: 500;
            text-decoration: none;
            cursor: pointer;
            border: 1px solid transparent;
            transition: all 0.2s;
        }

        .btn-primary {
            background-color: var(--primary);
            color: #fff;
        }

        .btn-primary:hover {
            background-color: var(--primary-hover);
        }

        .btn-outline {
            background-color: #fff;
            border-color: var(--border);
            color: var(--text-dark);
        }

        .btn-outline:hover {
            background-color: #f1f3f5;
        }

        /* کارت اصلی جدول */
        .card-table {
            background: var(--card-bg);
            border-radius: 16px;
            border: 1px solid var(--border);
            box-shadow: 0 4px 20px rgba(0,0,0,0.02);
            overflow: hidden;
        }

        .table-responsive {
            width: 100%;
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            text-align: right;
            font-size: 0.88rem;
        }

        thead {
            background-color: #fafafc;
            border-bottom: 1px solid var(--border);
        }

        th {
            padding: 14px 16px;
            color: var(--text-muted);
            font-weight: 600;
            white-space: nowrap;
        }

        td {
            padding: 14px 16px;
            border-bottom: 1px solid var(--border);
            vertical-align: middle;
            white-space: nowrap;
        }

        tbody tr:hover {
            background-color: #fcfcfd;
        }

        /* ظاهر فیلدهای محصول */
        .pro-img {
            width: 46px;
            height: 46px;
            border-radius: 8px;
            object-fit: cover;
            border: 1px solid var(--border);
            background: #f9f9f9;
        }

        .pro-color-indicator {
            display: inline-block;
            width: 14px;
            height: 14px;
            border-radius: 50%;
            border: 1px solid rgba(0,0,0,0.1);
            vertical-align: middle;
            margin-left: 4px;
        }

        .badge-cat {
            background-color: #faf7f2;
            color: var(--primary-hover);
            padding: 4px 10px;
            border-radius: 6px;
            font-size: 0.78rem;
            font-weight: 600;
        }

        .rating-box {
            color: #f59e0b;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 4px;
        }

        .stock-badge {
            padding: 4px 8px;
            border-radius: 6px;
            font-size: 0.8rem;
            font-weight: 500;
        }

        .stock-in { background-color: #ecfdf5; color: var(--success); }
        .stock-low { background-color: #fffbeb; color: var(--warning); }
        .stock-out { background-color: var(--danger-bg); color: var(--danger); }

        /* دکمه‌های عملیات */
        .btn-action {
            width: 34px;
            height: 34px;
            border-radius: 8px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border: 1px solid var(--border);
            background: #fff;
            color: var(--text-dark);
            text-decoration: none;
            transition: 0.2s;
            cursor: pointer;
        }

        .btn-action.edit:hover {
            background-color: #e0f2fe;
            color: #0284c7;
            border-color: #bae6fd;
        }

        .btn-action.delete:hover {
            background-color: var(--danger-bg);
            color: var(--danger);
            border-color: #fecaca;
        }

        .btn-action.info:hover {
            background-color: #faf7f2;
            color: var(--primary);
            border-color: #f5ebd8;
        }

        /* پاپ‌آپ جزییات توضیحات */
        .modal {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.45);
            backdrop-filter: blur(3px);
            z-index: 1000;
            align-items: center;
            justify-content: center;
            padding: 16px;
        }

        .modal.active {
            display: flex;
        }

        .modal-content {
            background: #fff;
            width: 100%;
            max-width: 480px;
            border-radius: 16px;
            padding: 24px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            animation: modalFade 0.2s ease;
        }

        @keyframes modalFade {
            from { transform: translateY(10px); opacity: 0; }
            to { transform: translateY(0); opacity: 1; }
        }

        .modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 14px;
            border-bottom: 1px solid var(--border);
            padding-bottom: 10px;
        }
    </style>
</head>
<body>

    <div class="container">

        <!-- هدر صفحه -->
        <div class="page-header">
            <div class="header-title">
                <h2>مدیریت محصولات اکسسوری</h2>
                <p>لیست و کنترل تمام کالاهای موجود در گالری</p>
            </div>
            <div class="actions-group">
                <a href="../admin_panel.php" class="btn btn-outline">
                    <i class="bi bi-arrow-right"></i>
                    داشبورد
                </a>
                <a href="AddProduct.php" class="btn btn-primary">
                    <i class="bi bi-plus-lg"></i>
                    افزودن محصول جدید
                </a>
            </div>
        </div>

        <!-- جدول اطلاعات محصولات -->
        <div class="card-table">
            <div class="table-responsive">
                <table>
                    <thead>
                        <tr>
                            <th>شناسه</th>
                            <th>تصویر</th>
                            <th>نام محصول</th>
                            <th>دسته‌بندی</th>
                            <th>برند</th>
                            <th>رنگ</th>
                            <th>قیمت (تومان)</th>
                            <th>موجودی</th>
                            <th>امتیاز</th>
                            <th>تاریخ ثبت</th>
                            <th>توضیحات</th>
                            <th>عملیات</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- نمونه سطر ۱ (در پیاده‌سازی بک‌اند، این سطر داخل حلقه foreach قرار می‌گیرد) -->
                        <?php foreach($prolist as $pro):?>
                        
                        <tr>
                            <td><strong>#<? $pro['ProductID']?></strong></td>
                            <td>
                                <img src="https://via.placeholder.com/60" alt="انگشتر نقره" class="pro-img">
                            </td>
                            <td>
                                <div style="font-weight: 600;">انگشتر نقره مینیمال ماه</div>
                            </td>
                            <td><span class="badge-cat">انگشتر</span></td>
                            <td>برند 4</td>
                            <td>
                                <span class="pro-color-indicator" style="background: #e2e8f0;"></span>
                                نقره‌ای
                            </td>
                            <td style="font-weight: 700;">۴۵۰,۰۰۰</td>
                            <td><span class="stock-badge stock-in">۱۴ عدد</span></td>
                            <td>
                                <div class="rating-box">
                                    <i class="bi bi-star-fill"></i>
                                    <span>4.8</span>
                                </div>
                            </td>
                            <td style="color: var(--text-muted); font-size: 0.8rem;">1403/06/25</td>
                            <td>
                                <button type="button" class="btn-action info" 
                                        onclick="showDetails('انگشتر نقره مینیمال ماه', 'ساخته شده از نقره عیار ۹۲۵ با روکش رادیوم ضدحساسیت و بدون تغییر رنگ.')" 
                                        title="مشاهده توضیحات">
                                    <i class="bi bi-card-text"></i>
                                </button>
                            </td>
                            <td>
                                <div style="display: flex; gap: 6px;">
                                    <!-- لینک ویرایش به همراه آیدی -->
                                    <a href="EditPro.php?id=101" class="btn-action edit" title="ویرایش محصول">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <!-- دکمه حذف -->
                                    <a href="javascript:void(0)" onclick="confirmDelete(101)" class="btn-action delete" title="حذف محصول">
                                        <i class="bi bi-trash"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>

    </div>

    <!-- مودال توضیحات محصول -->
    <div class="modal" id="descModal">
        <div class="modal-content">
            <div class="modal-header">
                <h4 id="modalTitle" style="font-size: 1rem; font-weight: 700;"></h4>
                <i class="bi bi-x-lg" onclick="closeModal()" style="cursor: pointer; color: var(--text-muted);"></i>
            </div>
            <p id="modalDesc" style="font-size: 0.9rem; line-height: 1.8; color: var(--text-dark); margin-bottom: 20px;"></p>
            <button class="btn btn-outline" style="width: 100%; justify-content: center;" onclick="closeModal()">بستن</button>
        </div>
    </div>

    <script>
        // تاییدیه و ارسال دستور حذف
        function confirmDelete(productId) {
            if (confirm(`آیا از حذف محصول با شناسه #${productId} اطمینان دارید؟`)) {
                window.location.href = `deletepro.php?id=${productId}`;
            }
        }

        // مدیریت باز و بسته شدن مودال توضیحات
        const modal = document.getElementById('descModal');
        const modalTitle = document.getElementById('modalTitle');
        const modalDesc = document.getElementById('modalDesc');

        function showDetails(title, description) {
            modalTitle.textContent = title;
            modalDesc.textContent = description || 'توضیحاتی برای این محصول ثبت نشده است.';
            modal.classList.add('active');
        }

        function closeModal() {
            modal.classList.remove('active');
        }

        // بستن مودال با کلیک روی پس‌زمینه
        window.onclick = function(event) {
            if (event.target === modal) {
                closeModal();
            }
        }
    </script>

</body>
</html>