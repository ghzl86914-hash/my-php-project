<?php
session_start();

require "db.php";

if (isset($_SESSION['Login'])) {

    $Username = $_SESSION['Login'];

    $stmt = $pdo->prepare("DELETE FROM tblusers WHERE UserName = :username");

    $stmt->execute([
        'username' => $Username
    ]);
    session_unset();
    session_destroy();

}



echo "<script>
alert('حساب کاربری با موفقیت حذف شد.');
window.location='index.php';
</script>";

exit();