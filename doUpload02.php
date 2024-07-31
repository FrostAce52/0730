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
$fileCount = count($_FILES["myFile"]["name"]);
echo $fileCount;

$timestamp = time(); //檔名上加時間戳記
for ($i = 0; $i < $fileCount; $i++) {
    // ["error"] === 0 確認沒有錯誤再上傳
    if ($_FILES["myFile"]["error"][$i] === 0) {
        $ext = pathinfo($_FILES["myFile"]["name"][$i], PATHINFO_EXTENSION); //加上副檔名
        $from = $_FILES["myFile"]["tmp_name"][$i]; //上傳的檔案
        $to = "./upload/" . ($timestamp + $i) . "." . $ext; //新檔名，($timestamp + $i) 避免處理時間太快導致時間戳記相同
        if (move_uploaded_file($from, $to)) {
            echo "<img src=\"$to\">";
        } else {
            echo "上傳失敗";
        }
    }
}
