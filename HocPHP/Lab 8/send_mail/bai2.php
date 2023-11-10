<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<style>
    form {
        width: 600px;
        margin: 0 auto;
        padding: 30px;
        border: 1px solid #ddd;
        border-radius: 5px;
        box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }

    input, textarea {
        width: 100%;
        margin-bottom: 20px;
        padding: 10px;
        border: 1px solid #ddd;
        border-radius: 3px;
    }

    textarea {
        height: 150px;
    }

    input[type="submit"] {
        width: auto;
        background: #3498db;
        color: #fff;
        padding: 10px 20px;
        border: none;
        border-radius: 3px;
        cursor: pointer;
    }

    input[type="submit"]:hover {
        background: #2980b9;
    }

</style>
<body>
    <form action="mail.php" enctype="multipart/form-data" method="POST">
        <input type="text" class="form-control" name="email" placeholder="Email">
        <input type="text" class="form-control" name="tieude" placeholder="tieu de">
        <textarea name="content" id="editor" class="form-control"></textarea>
        <input type="file" class="form-control" name="file"  >
        <button type="submit" class="btn btn-primary">Gửi</button>
    </from>
</body>
</html>