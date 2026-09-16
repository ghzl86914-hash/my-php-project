<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>پنل مدیریت اکسسوری</title>
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
            --text-dark: #212529;
            --text-muted: #6c757d;
            --border-color: #eee;
        }

        body {
            font-family: 'Vazirmatn', -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
            background-color: var(--bg-body);
            color: var(--text-dark);
            line-height: 1.5;
            direction: rtl;
        }

        /* کانتینر و ناوبری */
        .container {
            max-width: 1280px;
            margin: 0 auto;
            padding: 20px 24px;
        }

        .navbar {
            background: #fff;
            border-bottom: 1px solid var(--border-color);
            padding: 16px 24px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .brand {
            font-weight: 700;
            font-size: 1.15rem;
            color: var(--text-dark);
            display: flex;
            align-items: center;
            gap: 10px;
            text-decoration: none;
        }

        .brand i {
            color: var(--primary);
            font-size: 1.3rem;
        }

        .btn-exit {
            color: #dc3545;
            border: 1px solid #f8d7da;
            background: #fff;
            padding: 6px 14px;
            border-radius: 8px;
            font-size: 0.85rem;
            text-decoration: none;
            transition: 0.2s;
        }

        .btn-exit:hover {
            background: #dc3545;
            color: #fff;
        }

        /* بخش خوش‌آمدگویی */
        .welcome-card {
            background: #fff;
            border-radius: 16px;
            padding: 24px;
            border: 1px solid var(--border-color);
            margin-bottom: 24px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 16px;
        }

        .btn-add-product {
            background: var(--primary);
            color: #fff;
            padding: 10px 20px;
            border-radius: 10px;
            text-decoration: none;
            font-size: 0.95rem;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            font-weight: 500;
            transition: 0.2s;
        }

        .btn-add-product:hover {
            background: var(--primary-hover);
        }

        /* گرید کارت‌های آمار */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(230px, 1fr));
            gap: 16px;
            margin-bottom: 28px;
        }

        .stat-card {
            background: #fff;
            padding: 20px;
            border-radius: 14px;
            border: 1px solid var(--border-color);
        }

        .stat-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 12px;
            color: var(--text-muted);
            font-size: 0.9rem;
        }

        .badge {
            font-size: 0.75rem;
            padding: 3px 8px;
            border-radius: 6px;
            font-weight: 500;
        }

        .badge-warning { background: #fff8eb; color: #b45309; }
        .badge-success { background: #ecfdf5; color: #047857; }
        .badge-danger { background: #fef2f2; color: #b91c1c; }
        .badge-muted { background: #f3f4f6; color: #4b5563; }

        .stat-card h3 {
            font-size: 1.4rem;
            font-weight: 700;
        }

        /* دسترسی‌های سریع */
        .section-title {
            font-size: 0.95rem;
            font-weight: 700;
            color: var(--text-muted);
            margin-bottom: 14px;
        }

        .quick-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
            gap: 14px;
            margin-bottom: 28px;
        }

        .quick-item {
            background: #fff;
            padding: 16px;
            border-radius: 14px;
            border: 1px solid var(--border-color);
            display: flex;
            align-items: center;
            gap: 14px;
            text-decoration: none;
            color: var(--text-dark);
            transition: all 0.2s ease;
        }

        .quick-item:hover {
            transform: translateY(-2px);
            border-color: var(--primary);
            box-shadow: 0 4px 12px rgba(0,0,0,0.03);
        }

        .icon-box {
            width: 44px;
            height: 44px;
            border-radius: 10px;
            background: #faf7f2;
            color: var(--primary);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.25rem;
            flex-shrink: 0;
        }

        .quick-item h4 {
            font-size: 0.95rem;
            margin-bottom: 2px;
            font-weight: 600;
        }

        .quick-item span {
            font-size: 0.8rem;
            color: var(--text-muted);
        }

        /* دو ستون پایین */
        .bottom-grid {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 20px;
        }

        .content-card {
            background: #fff;
            border-radius: 16px;
            border: 1px solid var(--border-color);
            padding: 22px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 0.9rem;
            margin-top: 14px;
        }

        th {
            text-align: right;
            padding: 10px 12px;
            color: var(--text-muted);
            border-bottom: 1px solid var(--border-color);
            font-weight: 500;
        }

        td {
            padding: 14px 12px;
            border-bottom: 1px solid #f9f9f9;
        }

        .alert-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 12px 0;
            border-bottom: 1px solid #f5f5f5;
        }

        .alert-item:last-child {
            border-bottom: none;
        }

        @media (max-width: 900px) {
            .bottom-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>

    <!-- نوار ناوبری -->
    <nav class="navbar">
        <a href="#" class="brand">
            <i class="bi bi-gem"></i>
            <span>پنل مدیریت گالری اکسسوری</span>
        </a>
        <div style="display: flex; align-items: center; gap: 16px;">
            <span style="font-size: 0.85rem; color: var(--text-muted);">امروز: <?= date('Y/m/d') ?></span>
            <a href="logout.php" class="btn-exit"><i class="bi bi-box-arrow-right"></i> خروج</a>
        </div>
    </nav>

    <div class="container">

        <!-- خوش‌آمدگویی -->
        <div class="welcome-card">
            <div>
                <h2 style="font-size: 1.4rem; font-weight: 800; margin-bottom: 6px;">خوش آمدید، مدیر گرامی 👋</h2>
                <p style="color: var(--text-muted); font-size: 0.9rem;">گزارش وضعیت فروشگاه اکسسوری، سفارشات اخیر و کنترل انبار در یک نگاه.</p>
            </div>
            <a href="AddProduct.php" class="btn-add-product">
                <i class="bi bi-plus-lg"></i>
                <span>محصول جدید</span>
            </a>
        </div>

        <!-- کارت‌های آمار -->
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-header">
                    <span>سفارشات جدید</span>
                    <span class="badge badge-warning">امروز</span>
                </div>
                <h3>۱۸ سفارش</h3>
            </div>

            <div class="stat-card">
                <div class="stat-header">
                    <span>فروش ماه جاری</span>
                    <span class="badge badge-success">+۱۲٪</span>
                </div>
                <h3>۴۸,۵۰۰,۰۰۰ <small style="font-size: 0.85rem; font-weight: normal; color: var(--text-muted);">تومان</small></h3>
            </div>

            <div class="stat-card">
                <div class="stat-header">
                    <span>کسری موجودی</span>
                    <span class="badge badge-danger">هشدار انبار</span>
                </div>
                <h3>۴ قلم کالا</h3>
            </div>

            <div class="stat-card">
                <div class="stat-header">
                    <span>تیکت‌های باز</span>
                    <span class="badge badge-muted">پشتیبانی</span>
                </div>
                <h3>۳ تیکت</h3>
            </div>
        </div>

        <!-- دسترسی‌های سریع -->
        <div class="section-title">دسترسی‌های سریع</div>
        <div class="quick-grid">
            <a href="manage_user.php" class="quick-item">
                <div class="icon-box"><i class="bi bi-people"></i></div>
                <div>
                    <h4>کاربران</h4>
                    <span>مشاهده و ویرایش</span>
                </div>
            </a>

            <a href="ProList.php" class="quick-item">
                <div class="icon-box"><i class="bi bi-box-seam"></i></div>
                <div>
                    <h4>محصولات</h4>
                    <span>ثبت و مدیریت</span>
                </div>
            </a>

            <a href="reports.php" class="quick-item">
                <div class="icon-box"><i class="bi bi-graph-up-arrow"></i></div>
                <div>
                    <h4>آمار و تحلیل</h4>
                    <span>گزارشات فروش</span>
                </div>
            </a>

            <a href="finance.php" class="quick-item">
                <div class="icon-box"><i class="bi bi-wallet2"></i></div>
                <div>
                    <h4>امور مالی</h4>
                    <span>تراکنش‌ها و حساب</span>
                </div>
            </a>

            <a href="tickets.php" class="quick-item">
                <div class="icon-box"><i class="bi bi-chat-left-dots"></i></div>
                <div>
                    <h4>پشتیبانی</h4>
                    <span>پاسخ به تیکت‌ها</span>
                </div>
            </a>

            <a href="discounts.php" class="quick-item">
                <div class="icon-box"><i class="bi bi-percent"></i></div>
                <div>
                    <h4>کد تخفیف</h4>
                    <span>کمپین و جشنواره</span>
                </div>
            </a>
        </div>

        <!-- بخش پایینی: سفارش‌ها و انبار -->
        <div class="bottom-grid">
            <div class="content-card">
                <div style="display: flex; justify-content: space-between; align-items: center;">
                    <h4 style="font-size: 1rem; font-weight: 700;">سفارش‌های ثبت شده اخیر</h4>
                    <a href="orders.php" style="color: var(--primary); text-decoration: none; font-size: 0.85rem;">مشاهده همه</a>
                </div>
                <div style="overflow-x: auto;">
                    <table>
                        <thead>
                            <tr>
                                <th>شناسه</th>
                                <th>مشتری</th>
                                <th>اقلام</th>
                                <th>مبلغ</th>
                                <th>وضعیت</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>#۱۰۴۲</td>
                                <td>سارا مرادی</td>
                                <td>دستبند کارتیه، انگشتر مینیمال</td>
                                <td>۱,۸۵۰,۰۰۰ تومان</td>
                                <td><span class="badge badge-warning">در انتظار ارسال</span></td>
                            </tr>
                            <tr>
                                <td>#۱۰۴۱</td>
                                <td>علی حسینی</td>
                                <td>ساعت کلاسیک چرمی مشکی</td>
                                <td>۳,۴۰۰,۰۰۰ تومان</td>
                                <td><span class="badge badge-success">ارسال شده</span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="content-card">
                <h4 style="font-size: 1rem; font-weight: 700; margin-bottom: 16px;">موجودی رو به اتمام</h4>
                <div class="alert-item">
                    <div>
                        <div style="font-size: 0.9rem; font-weight: 600;">گردنبند نقره طرح ماه</div>
                        <span style="font-size: 0.8rem; color: #dc3545;">تنها ۲ عدد باقی مانده</span>
                    </div>
                    <a href="AddProduct.php?id=12" style="font-size: 0.8rem; color: var(--primary); text-decoration: none; border: 1px solid var(--border-color); padding: 4px 10px; border-radius: 6px;">شارژ</a>
                </div>
                <div class="alert-item">
                    <div>
                        <div style="font-size: 0.9rem; font-weight: 600;">گوشواره مرواریدی</div>
                        <span style="font-size: 0.8rem; color: #dc3545;">اتمام موجودی</span>
                    </div>
                    <a href="AddProduct.php?id=18" style="font-size: 0.8rem; color: var(--primary); text-decoration: none; border: 1px solid var(--border-color); padding: 4px 10px; border-radius: 6px;">شارژ</a>
                </div>
            </div>
        </div>

    </div>

</body>
</html>