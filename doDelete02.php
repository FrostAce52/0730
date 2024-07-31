<?php
require_once("conn.php");
require_once("./utilities.php");

if (!isset($_GET["id"])) {
    echo "網址參數不存在";
    exit;
}
$id = (int)$_GET["id"];

// $sql = "UPDATE `msgs` SET `isValid` = '0' WHERE `msgs`.`id` = $id;";
$sql = "UPDATE `msgs` SET `endTime` = CURRENT_TIMESTAMP WHERE `msgs`.`id` = $id;";

try {
    $conn->multi_query($sql);
} catch (mysqli_sql_exception $e) {
    echo "修改資料錯誤" . $e->getMessage();
    exit;
}
alertAndGoTo("刪除資料成功", "./pageMsgsList.php");

$conn->close();
