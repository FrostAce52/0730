<?php
$servername = "localhost";
$username = "admin";
$password = "a12345";
$dbname = "testphp";
$port = 3306;

try {
    $conn = new mysqli($servername, $username, $password, $dbname, $port);
} catch (mysqli_sql_exception $exception) {
    die("連線失敗：" . $exception->getMessage());
}
?>