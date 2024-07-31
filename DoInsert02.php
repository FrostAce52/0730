<?php
require_once("conn.php");
require_once("./utilities.php");

if (!isset($_POST["name"])) {
    echo "請從正常管道進入";
    exit;
}


$namesAry = $_POST["name"];
$contentsAry = $_POST["content"];
$categoryAry = isset($_POST["category"]) ? $_POST["category"] : []; //判斷分類是否填寫
$length = count($namesAry);
$categoryLength = count($categoryAry);

//名字未填警語
$isNameEmpty = false;
for ($i = 0; $i < $length; $i++) {
    if ($namesAry[$i] === "") {
        $isNameEmpty = true;
    }
}

if ($isNameEmpty === true) {
    alertAndBack("名字沒填啦");
    exit;
}
//內容未填警語
$isContentEmpty = false;
for ($i = 0; $i < $length; $i++) {
    if ($contentsAry[$i] === "") {
        $isContentEmpty = true;
    }
}

if ($isContentEmpty === true) {
    alertAndBack("內容沒填啦");
    exit;
}
//分類未填警語，判斷分類數量與名字數量是否相同
if ($categoryLength != $length) {
    alertAndBack("分類沒填啦");
    exit;
}

$filesCount = count($_FILES["myFile"]["name"]);
$imgAry = [];
$timestamp = time();
for ($i = 0; $i < $filesCount; $i++) {
    if ($_FILES["myFile"]["error"][$i] === 0) {

        $ext = pathinfo($_FILES["myFile"]["name"][$i], PATHINFO_EXTENSION);
        $from = $_FILES["myFile"]["tmp_name"][$i];
        $to = "./upload/" . ($timestamp + $i) . "." . $ext;
        $newFile = ($timestamp + $i) . "." . $ext;
        if (move_uploaded_file($from, $to)) {
            array_push($imgAry, $newFile);
        } else {
            array_push($imgAry, NULL);
        }
    } else {
        array_push($imgAry, NULL);
    }
}




$sql = "";
for ($i = 0; $i < $length; $i++) {
    $name = $namesAry[$i];
    $content = $contentsAry[$i];
    $category = intval($categoryAry[$i]);
    $img = $imgAry[$i];
    $sql .= "INSERT INTO `msgs` 
    (`id`, `name`, `category`, `content`, `createTime`, `img`) VALUES 
    (NULL, '$name', $category, '$content', CURRENT_TIMESTAMP, '$img');";
}

try {
    $conn->multi_query($sql);
    echo "建立資料成功";
    echo '<script>
setTimeout(function() {
    window.location.href = "pageMsgsList.php";
}, 2000);
</script>'; //導入 Javasciprt 達成延遲跳轉，並顯示 echo 內容
} catch (mysqli_sql_exception $e) {
    echo "建立資料錯誤" . $e->getMessage();
    exit;
}


$conn->close();//關閉連線


// sleep(3); 使整個網頁停頓 3 秒再跳轉
// header("location: pageMsgsList.php");
