<!DOCTYPE html>
<html lang="zh-hant-TW">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>test upload</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css
">

</head>

<body>
    <div class="container">
        <form action="./doUpload02.php" method="post" enctype="multipart/form-data">
            <div class="input-group mb-3">
                <span class="input-group-text" for="">名稱</span>
                <input class="form-control" type="text" name="name[]">
                <!-- name + [] 上傳複數檔案 -->
            </div>
            <div class="input-group mb-3">
                <input class="form-control" type="file" name="myFile[]" accept="image/*" multiple>
            </div>
            <div>
                <button class="btn btn-secondary">送出</button>
            </div>
        </form>
    </div>
</body>

</html>