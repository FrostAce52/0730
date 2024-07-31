<!DOCTYPE html>
<html lang="zh-hant-TW">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>test upload</title>
    <style>
        form div:nth-child(3) {
            display: flex;
            justify-content: flex-end;
        }
    </style>
</head>

<body>
    <div class="container">
        <form action="./doUpload01.php" method="post" enctype="multipart/form-data">
            <div>
                <label for="">名稱</label>
                <input type="text" name="name">
            </div>
            <div>
                <input type="file" name="myFile" accept="image/*">
            </div>
            <div>
                <button>送出</button>
            </div>
        </form>
    </div>
</body>

</html>