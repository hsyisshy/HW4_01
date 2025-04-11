<!-- resources/views/messages/create.blade.php -->
<!DOCTYPE html>
<html lang="zh-Hant">
<head>
    <meta charset="UTF-8">
    <title>新增留言</title>
</head>
<body>
    <h1>新增留言</h1>
    <form method="POST" action="/messages">
        @csrf
        <label for="author">作者：</label>
        <input type="text" name="author" id="author" required><br><br>

        <label for="content">留言內容：</label>
        <textarea name="content" id="content" required></textarea><br><br>

        <button type="submit">送出</button>
    </form>
</body>
</html>
