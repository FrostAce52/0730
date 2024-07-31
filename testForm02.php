<?php
require_once("conn.php");

$sql = "SELECT * FROM `category`";

try {
    $result = $conn->query($sql);
    $msgCount = $result->num_rows;
    $rows = $result->fetch_all(MYSQLI_ASSOC); //使用 fetch_all 取出資料，變成關聯式陣列
} catch (mysqli_sql_exception $exception) {
    echo "資料讀取錯誤：" . $exception->getMessage();
    $msgCount = -1;
    //設定為-1是為了讓下方if判斷，並在錯誤時不顯示過多訊息
}

$conn->close();
?>


<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <div class="container mt-3">
        <!-- 表格中若要上傳圖片，一定要加 enctype="multipart/form-data" -->
        <form action="DoInsert02.php" method="post" enctype="multipart/form-data">
            <div class="content-area">
                <div class="input-group">
                    <span class="input-group-text">名稱</span>
                    <input name="name[]" type="text" class="form-control" placeholder="發文者名稱">
                </div>
                <div class="input-group mt-1 mb-1">
                    <span class="input-group-text">內容</span>
                    <textarea name="content[]" class="form-control"></textarea>
                </div>
                <div class="input-group mt-1 mb-1">
                    <span class="input-group-text">分類</span>
                    <select name="category[]" class="form-select">
                        <option value="XX" selected disabled>請選擇</option>
                        <? foreach ($rows as $row) : ?>
                            <option value="<?= $row["id"] ?>"><?= $row["name"] ?></option>
                        <? endforeach; ?>
                    </select>
                </div>
                <div class="input-group mb-3">
                    <input class="form-control" type="file" name="myFile[]" accept="image/*">
                </div>
            </div>
            <div class="mt-1 text-end">
                <button type="submit" class="btn btn-info">送出</button>
                <button type="submit" class="btn btn-info btn-add">增加一組</button>
                <a class="btn btn-primary btn-add" href="./pageMsgsList.php">資料列表</a>
            </div>
        </form>
        <!-- template 模板可利用下方 cloneNode 複製 -->
        <template id="inputs">
            <div class="input-group">
                <span class="input-group-text">名稱</span>
                <input name="name[]" type="text" class="form-control" placeholder="發文者名稱">
            </div>
            <div class="input-group mt-1 mb-1">
                <span class="input-group-text">內容</span>
                <textarea name="content[]" class="form-control"></textarea>
            </div>
            <div class="input-group mt-1 mb-1">
                <span class="input-group-text">分類</span>
                <select name="category[]" class="form-select">
                    <option value="XX" selected disabled>請選擇</option>
                    <? foreach ($rows as $row) : ?>
                        <option value="<?= $row["id"] ?>"><?= $row["name"] ?></option>
                    <? endforeach; ?>
                </select>
            </div>
            <div class="input-group mb-3">
                <input class="form-control" type="file" name="myFile[]" accept="image/*">
            </div>
        </template>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script>
        const btnAdd = document.querySelector(".btn-add");
        const contentArea = document.querySelector(".content-area");
        const template = document.querySelector("#inputs");
        btnAdd.addEventListener("click", e => {
            e.preventDefault();
            const node = template.content.cloneNode(true);
            contentArea.append(node);
        }); //cloneNode 可複製模板，加上 (true) 複製深層內容
    </script>
</body>

</html>