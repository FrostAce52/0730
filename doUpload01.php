<?php
if (!isset($_POST["name"])) {
    echo "請從正常管道進入";
    exit;
}
echo "<pre>";
var_dump($_POST["name"]);
echo "</pre>";
echo "<pre>";
var_dump($_FILES["myFile"]);
echo "</pre>";

// ["error"] === 0 確認沒有錯誤再上傳
if ($_FILES["myFile"]["error"] === 0) {
    $timestamp = time(); //檔名上加時間戳記
    $ext = pathinfo($_FILES["myFile"]["name"], PATHINFO_EXTENSION); //加上副檔名
    $from = $_FILES["myFile"]["tmp_name"]; //上傳的檔案
    $to = "./upload/" .$timestamp . "." . $ext; //檔案存放位置
    if (move_uploaded_file($from, $to)) {
        echo "<img src=\"$to\">";
    } else {
        echo "上傳失敗";
    }
}
