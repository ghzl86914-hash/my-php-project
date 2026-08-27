<?php

session_start();

$host = 'localhost';
$dbname = 'dbpanel';
$dbuser = 'root';
$dbpass = '';

try{
    $dsn = "mysql:host=$host;dbname=$dbname;charset=utf8mb4";

    $options = [
        PDO::ATTR_ERRMODE =>
        PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE =>
        PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false,
    ];



$pdo = new PDO(
    $dsn,$dbuser,$dbpass,$options
);

//print("connected to database successfully");

}

catch(PDOException $e)
{
    error_log("database error ...".
    $e->getmessage());
    die("database connection field");
}
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
