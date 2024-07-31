<?php
require_once("conn.php");
if (!isset($_GET["id"])) {
    echo "網址參數不存在";
    exit;
} //此id請於網址列修改
$id = $_GET["id"];
$sql = "SELECT * FROM `msgs` WHERE `id` = $id";
$sql2 = "SELECT * FROM `category`";
$sqlImgs = "SELECT * FROM `imgs` WHERE `msgID` = $id;";

try {
    $result = $conn->query($sql);
    $result2 = $conn->query($sql2);
    $resultImgs = $conn->query($sqlImgs);
} catch (mysqli_sql_exception $exception) {
    echo "資料讀取錯誤：" . $exception->getMessage();
    exit;
}
$count = $result->num_rows;
$row = $result->fetch_assoc();
$categoryRows = $result2->fetch_all(MYSQLI_ASSOC);
$imgRows = $resultImgs->fetch_all(MYSQLI_ASSOC);
$conn->close();
?>
<!doctype html>
<html lang="en">


<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        .img150 {
            width: 150px;
            height: 150px;
            object-fit: cover;
        }
    </style>
</head>

<body>
    <div class="container mt-3">
        <? if ($count === 0) : ?>
            <h1>資料不存在</h1>
            <a class="btn btn-primary btn-add" href="./pageMsgsList.php">資料列表</a>
        <? else : ?>
            <form action="doUpdate01.php" method="post" enctype="multipart/form-data">
                <div class="content-area">
                    <div class="input-group">
                        <span class="input-group-text">名稱</span>
                        <input name="name" type="text" class="form-control" placeholder="發文者名稱" value="<?= $row["name"] ?>">
                    </div>
                    <div class="input-group mt-1 mb-1">
                        <span class="input-group-text">內容</span>
                        <textarea name="content" class="form-control"><?= $row["content"] ?></textarea>
                    </div>
                    <div class="input-group mt-1 mb-1">
                        <span class="input-group-text">分類</span>
                        <select name="category" class="form-select">
                            <option value="XX" selected disabled>請選擇</option>
                            <? foreach ($categoryRows as $categoryRow) : ?>
                                <option <?= $categoryRow["id"] === $row["category"] ? "selected" : "" ?> value="<?= $categoryRow["id"] ?>"><?= $categoryRow["name"] ?></option>
                            <? endforeach; ?>
                        </select>
                    </div>
                    <div class="input-group mb-3">
                        <input class="form-control" type="file" name="myFile" accept="image/*">
                    </div>
                    <input name="id" type="hidden" value="<?= $row["id"] ?>">
                    <input name="img" type="hidden" value="<?= $row["img"] ?>">
                </div>
                <div class="mt-1 text-end">
                    <button type="submit" class="btn btn-info">送出</button>
                    <a class="btn btn-primary btn-add" href="./pageMsgsList.php">取消</a>
                </div>
            </form>
            <!-- 當圖片欄位不是空字串，且不是 null 時才會顯示圖片，避免破圖圖示出現 -->
            <? if ($row["img"] != "" && $row["img"] != NULL) : ?>
                <img class="img150" src="./upload/<?= $row["img"] ?>" alt="">
            <? endif; ?>
            <!-- 上傳多張照片 -->
            <form action="./doUpload03.php" method="post" enctype="multipart/form-data">
                <div class="input-group mt-3">
                    <input class="form-control" type="file" name="myFile[]" accept="image/*" multiple>
                    <button class="btn btn-secondary input-group-text">送出</button>
                </div>
                <input name="id" type="hidden" value="<?= $row["id"] ?>">
            </form>
            <? foreach ($imgRows as $imgRow) : ?>
                <img class="img150" src="./upload2/<?= $imgRow["file"] ?>" alt="">
            <? endforeach; ?>

        <? endif; ?>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>