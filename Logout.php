<?php
session_start();

$Connection = mysqli_connect("localhost", "root", "", "dbpanel");

if (isset($_SESSION['Login'])) {

    $Username = $_SESSION['Login'];

    mysqli_query(
        $Connection,
        "DELETE FROM tblusers WHERE UserName='$Username'"
    );

    session_unset();
    session_destroy();
}

mysqli_close($Connection);

echo "<script>
alert('حساب کاربری با موفقیت حذف شد.');
window.location='index.php';
</script>";

exit();
