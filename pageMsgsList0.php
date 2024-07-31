<?php
require_once("conn.php");
$sql = "SELECT * FROM `msgs`";
try {
    $result = $conn->query($sql);
    $msgCount = $result->num_rows;
} catch (mysqli_sql_exception $exception) {
    echo "資料讀取錯誤：" . $exception->getMessage();
    $msgCount = -1;
    //設定為-1是為了讓下方if判斷，並在錯誤時不顯示過多訊息
}
$conn->close();
?>
<!doctype html>
<html lang="en">
<!-- 留言板管理系統 -->

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>留言板管理系統</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        .msg {
            display: flex;
        }

        .id {
            width: 30px;
        }

        .name {
            width: 100px;
        }

        .content {
            flex: 1;
        }

        .time {
            width: 180px;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>訊息列表</h1>
        <div class="my-2">
            目前共 <?= $msgCount ?> 筆資料
        </div>

        <div class="msg text-bg-dark ps-1">
            <div class="id">id</div>
            <div class="name">Name</div>
            <div class="content">content</div>
            <div class="time">time</div>
        </div>
        <? if ($msgCount >= 0) : ?>
            <? while ($row = $result->fetch_assoc()) : ?>
                <!-- 取出所有資料並帶入變數 -->
                <div class="msg">
                    <div class="id"><?= $row["id"] ?></div>
                    <div class="name"><?= $row["name"] ?></div>
                    <div class="content"><?= $row["content"] ?></div>
                    <div class="time"><?= $row["createTime"] ?></div>
                </div>
            <? endwhile; ?>
        <? endif; ?>

    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>