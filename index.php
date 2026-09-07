<!doctype html>
<html lang="fa" dir="rtl" data-bs-theme="auto">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>خوش آمدید · صفحه اصلی</title>
    
    <!-- فایل‌های استایل بوت‌استرپ -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" />
    <script src="assets/js/ColorModes.js"></script>

    <style>
      body {
        min-height: 100vh;
      }
      .welcome-card {
        max-width: 460px;
        border-radius: 1rem;
      }
      .btn-bd-primary {
        --bd-violet-bg: #712cf9;
        --bd-violet-rgb: 112.520718, 44.062154, 249.437846;
        --bs-btn-font-weight: 600;
        --bs-btn-color: var(--bs-white);
        --bs-btn-bg: var(--bd-violet-bg);
        --bs-btn-border-color: var(--bd-violet-bg);
        --bs-btn-hover-color: var(--bs-white);
        --bs-btn-hover-bg: #6528e0;
        --bs-btn-hover-border-color: #6528e0;
      }
      .bd-mode-toggle {
        z-index: 1500;
      }
    </style>
  </head>
  <body class="d-flex align-items-center justify-content-center py-5 bg-body-tertiary">

    <!-- آیکون‌های SVG سوئیچ تم -->
    <svg xmlns="http://www.w3.org/2000/svg" class="d-none">
      <symbol id="check2" viewBox="0 0 16 16">
        <path d="M13.854 3.646a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L6.5 10.293l6.646-6.647a.5.5 0 0 1 .708 0z"></path>
      </symbol>
      <symbol id="circle-half" viewBox="0 0 16 16">
        <path d="M8 15A7 7 0 1 0 8 1v14zm0 1A8 8 0 1 1 8 0a8 8 0 0 1 0 16z"></path>
      </symbol>
      <symbol id="moon-stars-fill" viewBox="0 0 16 16">
        <path d="M6 .278a.768.768 0 0 1 .08.858 7.208 7.208 0 0 0-.878 3.46c0 4.021 3.278 7.277 7.318 7.277.527 0 1.04-.055 1.533-.16a.787.787 0 0 1 .81.316.733.733 0 0 1-.031.893A8.349 8.349 0 0 1 8.344 16C3.734 16 0 12.286 0 7.71 0 4.266 2.114 1.312 5.124.06A.752.752 0 0 1 6 .278z"></path>
      </symbol>
      <symbol id="sun-fill" viewBox="0 0 16 16">
        <path d="M8 12a4 4 0 1 0 0-8 4 4 0 0 0 0 8zM8 0a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 0zm0 13a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 13zm8-5a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1h2a.5.5 0 0 1 .5.5zM3 8a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1h2A.5.5 0 0 1 3 8zm10.657-5.657a.5.5 0 0 1 0 .707l-1.414 1.415a.5.5 0 1 1-.707-.708l1.414-1.414a.5.5 0 0 1 .707 0zm-9.193 9.193a.5.5 0 0 1 0 .707L3.05 13.657a.5.5 0 0 1-.707-.707l1.414-1.414a.5.5 0 0 1 .707 0zm9.193 2.121a.5.5 0 0 1-.707 0l-1.414-1.414a.5.5 0 0 1 .707-.707l1.414 1.414a.5.5 0 0 1 0 .707zM4.464 4.465a.5.5 0 0 1-.707 0L2.343 3.05a.5.5 0 1 1 .707-.707l1.414 1.414a.5.5 0 0 1 0 .708z"></path>
      </symbol>
    </svg>

    <!-- دکمه سوییچ تم روشن/تاریک -->
    <div class="dropdown position-fixed bottom-0 end-0 mb-3 me-3 bd-mode-toggle">
      <button class="btn btn-bd-primary py-2 dropdown-toggle d-flex align-items-center" id="bd-theme" type="button" aria-expanded="false" data-bs-toggle="dropdown" aria-label="تغییر تم">
        <svg class="bi my-1 theme-icon-active" width="16" height="16" fill="currentColor"><use href="#circle-half"></use></svg>
        <span class="visually-hidden" id="bd-theme-text">تغییر تم</span>
      </button>
      <ul class="dropdown-menu dropdown-menu-end shadow" aria-labelledby="bd-theme-text">
        <li>
          <button type="button" class="dropdown-item d-flex align-items-center" data-bs-theme-value="light">
            <svg class="bi me-2 opacity-50" width="16" height="16"><use href="#sun-fill"></use></svg>
            روشن
          </button>
        </li>
        <li>
          <button type="button" class="dropdown-item d-flex align-items-center" data-bs-theme-value="dark">
            <svg class="bi me-2 opacity-50" width="16" height="16"><use href="#moon-stars-fill"></use></svg>
            تاریک
          </button>
        </li>
        <li>
          <button type="button" class="dropdown-item d-flex align-items-center active" data-bs-theme-value="auto">
            <svg class="bi me-2 opacity-50" width="16" height="16"><use href="#circle-half"></use></svg>
            خودکار
          </button>
        </li>
      </ul>
    </div>

    <!-- محتوای اصلی (Welcome + دکمه‌های ورود و ثبت‌نام) -->
    <main class="welcome-card w-100 p-4 p-sm-5 bg-body rounded shadow-sm text-center">
      <h1 class="display-5 fw-bold mb-3">Welcome</h1>
      <p class="text-body-secondary mb-4">به سامانه خوش آمدید. لطفاً برای ادامه وارد حساب خود شوید یا ثبت‌نام کنید.</p>

      <div class="d-grid gap-2">
        <a href="login.php" class="btn btn-primary btn-lg py-2">ورود به حساب</a>
        <a href="Register.php" class="btn btn-outline-secondary btn-lg py-2">ثبت نام</a>
      </div>

      <p class="mt-4 mb-0 text-body-secondary small">&copy; 2026 تمامی حقوق محفوظ است</p>
    </main>

    <!-- جاوااسکریپت بوت‌استرپ -->
    <script src="assets/js/bootstrap.bundle.min.js"></script>
  </body>
</html>