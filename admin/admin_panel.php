<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>پنل مدیریت | گالری اکسسوری</title>
    <!-- Bootstrap 5 RTL CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/dist/css/bootstrap.rtl.min.css">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <!-- فونت وزیرمتن -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/rastikerdar/vazirmatn@v33.003/Vazirmatn-font-face.css">

    <style>
        :root {
            --primary-accent: #c49b63; /* رنگ رزگلد/طلایی شیک مناسب اکسسوری */
            --primary-hover: #b08751;
            --bg-body: #fbfbfb;
            --card-bg: #ffffff;
            --text-main: #2b2d42;
            --text-muted: #8d99ae;
        }

        body {
            font-family: 'Vazirmatn', sans-serif;
            background-color: var(--bg-body);
            color: var(--text-main);
            min-height: 100vh;
        }

        /* کارت‌ها و المان‌های مینیمال */
        .card-custom {
            border: 1px solid rgba(0, 0, 0, 0.05);
            border-radius: 16px;
            background: var(--card-bg);
            transition: all 0.25s ease-in-out;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.02);
        }

        .card-custom:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.05);
        }

        .btn-accent {
            background-color: var(--primary-accent);
            color: #fff;
            border: none;
            border-radius: 10px;
            padding: 9px 18px;
            font-weight: 500;
            transition: 0.2s;
        }

        .btn-accent:hover {
            background-color: var(--primary-hover);
            color: #fff;
        }

        /* دکمه‌های ناوبری سریع */
        .quick-action-card {
            display: flex;
            align-items: center;
            padding: 16px;
            text-decoration: none;
            color: var(--text-main);
            border-radius: 14px;
            border: 1px solid rgba(0, 0, 0, 0.04);
            background: #fff;
            transition: all 0.2s ease;
        }

        .quick-action-card:hover {
            background: #faf7f2;
            border-color: rgba(196, 155, 99, 0.2);
            color: var(--primary-accent);
        }

        .icon-box {
            width: 44px;
            height: 44px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.3rem;
            margin-left: 12px;
            background: #f8f8f8;
            color: var(--primary-accent);
        }

        /* برچسب‌های وضعیت */
        .badge-soft-warning {
            background-color: #fff8eb;
            color: #d97706;
        }

        .badge-soft-success {
            background-color: #ecfdf5;
            color: #059669;
        }
    </style>
</head>
<body>

    <!-- نوبار بالا -->
    <nav class="navbar navbar-expand-lg bg-white border-bottom border-light sticky-top py-3">
        <div class="container-fluid px-lg-5">
            <a class="navbar-brand fw-bold d-flex align-items-center gap-2" href="#">
                <i class="bi bi-gem text-warning fs-4"></i>
                <span class="fs-5 tracking-wide">مدیریت گالری اکسسوری</span>
            </a>
            <div class="d-flex align-items-center gap-3">
                <span class="text-muted small d-none d-sm-inline">تاریخ امروز: <?= date('Y/m/d') ?></span>
                <a href="logout.php" class="btn btn-sm btn-outline-danger rounded-pill px-3">
                    <i class="bi bi-box-arrow-right me-1"></i> خروج
                </a>
            </div>
        </div>
    </nav>

    <div class="container-fluid px-lg-5 py-4">

        <!-- بنر خوش‌آمدگویی -->
        <div class="card-custom p-4 mb-4 bg-white border-0">
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3">
                <div>
                    <h3 class="fw-bold mb-1">خوش آمدید، مدیر گرامی 👋</h3>
                    <p class="text-muted mb-0">گزارش وضعیت فروشگاه اکسسوری، سفارشات اخیر و کنترل انبار در یک نگاه.</p>
                </div>
                <div class="d-flex gap-2">
                    <a href="AddProduct.php" class="btn btn-accent d-flex align-items-center gap-2">
                        <i class="bi bi-plus-lg"></i>
                        <span>محصول جدید</span>
                    </a>
                </div>
            </div>
        </div>

        <!-- کارت‌های آمار سریع کلیدی -->
        <div class="row g-3 mb-4">
            <div class="col-6 col-md-3">
                <div class="card-custom p-3 h-100">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <span class="text-muted small">سفارشات جدید</span>
                        <span class="badge badge-soft-warning px-2 py-1 rounded-pill">امروز</span>
                    </div>
                    <h4 class="fw-bold mb-0">۱۸ سفارش</h4>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="card-custom p-3 h-100">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <span class="text-muted small">فروش ماه جاری</span>
                        <span class="badge badge-soft-success px-2 py-1 rounded-pill">+۱۲٪</span>
                    </div>
                    <h4 class="fw-bold mb-0">۴۸,۵۰۰,۰۰۰ <small class="fs-6 fw-normal text-muted">تومان</small></h4>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="card-custom p-3 h-100">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <span class="text-muted small">کسری موجودی</span>
                        <span class="badge bg-danger-subtle text-danger px-2 py-1 rounded-pill">هشدار</span>
                    </div>
                    <h4 class="fw-bold mb-0">۴ قلم کالا</h4>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="card-custom p-3 h-100">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <span class="text-muted small">تیکت‌های باز</span>
                        <span class="badge bg-secondary-subtle text-secondary px-2 py-1 rounded-pill">پشتیبانی</span>
                    </div>
                    <h4 class="fw-bold mb-0">۳ تیکت</h4>
                </div>
            </div>
        </div>

        <!-- منو و دسترسی‌های سریع -->
        <div class="mb-4">
            <h6 class="text-muted fw-bold mb-3">دسترسی‌های سریع</h6>
            <div class="row g-3">
                <!-- مدیریت کاربران -->
                <div class="col-6 col-md-4 col-lg-2">
                    <a href="manage_user.php" class="quick-action-card">
                        <div class="icon-box"><i class="bi bi-people"></i></div>
                        <div>
                            <div class="fw-bold">کاربران</div>
                            <small class="text-muted">مشاهده و دسترسی</small>
                        </div>
                    </a>
                </div>

                <!-- مدیریت محصولات -->
                <div class="col-6 col-md-4 col-lg-2">
                    <a href="AddProduct.php" class="quick-action-card">
                        <div class="icon-box"><i class="bi bi-box-seam"></i></div>
                        <div>
                            <div class="fw-bold">محصولات</div>
                            <small class="text-muted">افزودن و ویرایش</small>
                        </div>
                    </a>
                </div>

                <!-- آمار و گزارشات -->
                <div class="col-6 col-md-4 col-lg-2">
                    <a href="reports.php" class="quick-action-card">
                        <div class="icon-box"><i class="bi bi-graph-up-arrow"></i></div>
                        <div>
                            <div class="fw-bold">آمار</div>
                            <small class="text-muted">تحلیل فروش و رشد</small>
                        </div>
                    </a>
                </div>

                <!-- امور مالی -->
                <div class="col-6 col-md-4 col-lg-2">
                    <a href="finance.php" class="quick-action-card">
                        <div class="icon-box"><i class="bi bi-wallet2"></i></div>
                        <div>
                            <div class="fw-bold">امور مالی</div>
                            <small class="text-muted">تراکنش‌ها و تسویه</small>
                        </div>
                    </a>
                </div>

                <!-- پشتیبانی و تیکت -->
                <div class="col-6 col-md-4 col-lg-2">
                    <a href="tickets.php" class="quick-action-card">
                        <div class="icon-box"><i class="bi bi-chat-left-dots"></i></div>
                        <div>
                            <div class="fw-bold">پشتیبانی</div>
                            <small class="text-muted">تیکت و پیام‌ها</small>
                        </div>
                    </a>
                </div>

                <!-- تخفیف‌ها و کوپن (مهم برای اکسسوری) -->
                <div class="col-6 col-md-4 col-lg-2">
                    <a href="discounts.php" class="quick-action-card">
                        <div class="icon-box"><i class="bi bi-percent"></i></div>
                        <div>
                            <div class="fw-bold">کد تخفیف</div>
                            <small class="text-muted">کمپین‌های فروش</small>
                        </div>
                    </a>
                </div>
            </div>
        </div>

        <!-- جدول سفارشات اخیر و هشدار انبار زیورآلات -->
        <div class="row g-4">
            <!-- سفارشات اخیر -->
            <div class="col-lg-8">
                <div class="card-custom p-4">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h6 class="fw-bold mb-0">آخرین سفارش‌های ثبت‌شده</h6>
                        <a href="orders.php" class="text-decoration-none small text-muted">مشاهده همه <i class="bi bi-chevron-left"></i></a>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="table-light text-muted small">
                                <tr>
                                    <th>شناسه</th>
                                    <th>نام مشتری</th>
                                    <th>اقلام خرید</th>
                                    <th>مبلغ</th>
                                    <th>وضعیت</th>
                                    <th>عملیات</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>#1042</td>
                                    <td>سارا مرادی</td>
                                    <td>دستبند کارتیه طلا، انگشتر مینیمال</td>
                                    <td>۱,۸۵۰,۰۰۰ تومان</td>
                                    <td><span class="badge badge-soft-warning rounded-pill">در انتظار ارسال</span></td>
                                    <td><button class="btn btn-sm btn-light"><i class="bi bi-eye"></i></button></td>
                                </tr>
                                <tr>
                                    <td>#1041</td>
                                    <td>علی حسینی</td>
                                    <td>ساعت کلاسیک چرمی مشکی</td>
                                    <td>۳,۴۰۰,۰۰۰ تومان</td>
                                    <td><span class="badge badge-soft-success rounded-pill">تکمیل شده</span></td>
                                    <td><button class="btn btn-sm btn-light"><i class="bi bi-eye"></i></button></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- هشدارهای موجودی زیورآلات / اکسسوری -->
            <div class="col-lg-4">
                <div class="card-custom p-4">
                    <h6 class="fw-bold mb-3">کنترل موجودی انبار اکسسوری</h6>
                    <div class="d-flex flex-column gap-3">
                        <div class="d-flex justify-content-between align-items-center border-bottom pb-2">
                            <div>
                                <p class="mb-0 fw-medium small">گردنبند نقره طرح ماه</p>
                                <span class="text-danger small">تنها ۲ عدد باقی مانده</span>
                            </div>
                            <a href="AddProduct.php?id=12" class="btn btn-sm btn-outline-secondary">شارژ</a>
                        </div>
                        <div class="d-flex justify-content-between align-items-center border-bottom pb-2">
                            <div>
                                <p class="mb-0 fw-medium small">گوشواره مرواریدی پروانه</p>
                                <span class="text-danger small">اتمام موجودی</span>
                            </div>
                            <a href="AddProduct.php?id=18" class="btn btn-sm btn-outline-secondary">شارژ</a>
                        </div>
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <p class="mb-0 fw-medium small">باکس کادویی مخمل لوکس</p>
                                <span class="text-warning small">تنها ۳ عدد باقی مانده</span>
                            </div>
                            <a href="AddProduct.php?id=25" class="btn btn-sm btn-outline-secondary">شارژ</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Bootstrap 5 JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>