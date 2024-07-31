<?php
require_once("conn.php");


$page = isset($_GET["page"]) ? (int)$_GET["page"] : 1; //頁數
$perPage = 10; //分頁資料筆數
$pageStart = $perPage * ($page - 1); //改變分頁起始資料


$cid = isset($_GET["cid"]) ? (int)$_GET["cid"] : 0;

if ($cid === 0) {
    $cateSQL = "";
} else {
    $cateSQL = "`category` = $cid AND";
}


$sql = "SELECT * FROM `msgs` WHERE $cateSQL `endTime` is NULL OR `endTime` > NOW() LIMIT $pageStart, $perPage"; //LIMIT 限制單次顯示的資料筆數
$sqlAll = "SELECT * FROM `msgs` WHERE $cateSQL `endTime` is NULL OR `endTime` > NOW()";
$sql2 = "SELECT * FROM `category`";

try {
    $result = $conn->query($sql);
    $result2 = $conn->query($sql2);
    $resultAll = $conn->query($sqlAll);
    $msgCount = $resultAll->num_rows; //取用 resultAll 讓顯示筆數不受分頁筆數影響
    $rows = $result->fetch_all(MYSQLI_ASSOC); //使用 fetch_all 取出資料，變成關聯式陣列
    $categoryRows = $result2->fetch_all(MYSQLI_ASSOC);
    $totalPage = ceil($msgCount / $perPage); //資料總數除以每頁筆數，得出分頁數
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

        .ctrls {
            width: 100px;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>訊息列表</h1>
        <h2>22222222222</h2>
        <div class="my-2 d-flex">
            <span class="me-auto">目前共 <?= $msgCount ?> 筆資料</span>
            <a class="btn btn-primary btn-sm" href="./testForm02.php">增加資料</a> <!-- 超連結導向 Form 頁面 -->
        </div>
        <!-- 標籤頁 -->
        <div class="nav nav-tabs">
            <a class="nav-link <?= $cid === 0 ? "active" : "" ?>" href="./pageMsgsList.php">全部</a>
            <? foreach ($categoryRows as $categoryRow) : ?>
                <a class="nav-link <?= $cid === (int)$categoryRow["id"] ? "active" : "" ?>" href="./pageMsgsList.php?cid=<?= $categoryRow["id"] ?>"><?= $categoryRow["name"] ?></a>
            <? endforeach ?>
        </div>
        <div class="msg text-bg-dark ps-1">
            <div class="id">#</div>
            <div class="name">Name</div>
            <div class="content">content</div>
            <div class="time d-none">time</div>
            <div class="ctrls">controls</div>
        </div>
        <? if ($msgCount >= 0) : ?>
            <? foreach ($rows as $index => $row) : ?>
                <!-- 取出所有資料並帶入變數 -->
                <div class="msg mb-1">
                    <div class="id"><?= $index + 1 ?></div>
                    <div class="name"><?= $row["name"] ?></div>
                    <div class="content"><?= $row["content"] ?></div>
                    <div class="time d-none"><?= $row["createTime"] ?></div>
                    <div class="ctrls">
                        <!-- <a class="btn btn-danger btn-sm" href="doDelete01.php?id=<?= $row["id"] ?>">刪除</a> -->
                        <a class="btn btn-danger btn-sm btn-del" idn="<?= $row["id"] ?>">刪除</a>
                        <a class="btn btn-primary btn-sm" href="pageMsg.php?id=<?= $row["id"] ?>">修改</a>
                    </div><!-- 連接至 Form 頁面修改內容 -->
                </div>
            <? endforeach; ?>
        <? endif; ?>
        <!-- 分頁頁數選擇 -->
        <div aria-label="...">
            <ul class="pagination pagination-sm">
                <? for ($i = 1; $i <= $totalPage; $i++) : ?>
                    <li class="page-item <?= $page === $i ? "active" : "" ?>" aria-current="page">
                        <a href="?page=<?= $i ?><?= $cid > 0 ? "&cid=$cid" : "" ?>" class="page-link"><?= $i ?></a>
                    </li>
                <? endfor; ?>
            </ul>
        </div>

    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script>
        const btnDels = document.querySelectorAll(".btn-del");
        //使用 arrow function 製作刪除前警語
        btnDels.forEach(btnDel => {
            btnDel.addEventListener("click", (e) => {
                let id = e.target.getAttribute("idn");
                if (confirm("確定要刪除嗎") === true) {
                    // window.location.href = `doDelete01.php?id=${id}`; //另一種寫法
                    window.location.href = "doDelete02.php?id=" + id;
                }
            })
        });
    </script>

</body>

</html>