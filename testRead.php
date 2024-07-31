<?php
require_once("conn.php");
$sql = "SELECT * FROM `msgs`";
try {
    $result = $conn->query($sql);
} catch (mysqli_sql_exception $exception) {
    echo "資料讀取錯誤：" . $exception->getMessage();
}
echo "資料讀取成功 <br>";
echo "<pre>";
var_dump($result);
echo "</pre>";

$msgCount = $result->num_rows;
echo $msgCount . "<br>"; //印出資料筆數

// $row = $result->fetch_assoc(); //取出第一筆資料
// echo "<pre>";
// var_dump($row);
// echo "<pre>";

while ($row = $result->fetch_assoc()) :
    echo "<pre>";
    var_dump($row);
    echo "</pre>";
endwhile;
