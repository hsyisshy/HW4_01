<!-- resources/views/messages/index.blade.php -->
<!DOCTYPE html>
<html lang="zh-Hant">
<head>
    <meta charset="UTF-8">
    <title>留言板</title>
</head>
<body>
    <h1>留言板首頁</h1>

    <ul>
        @foreach ($messages as $message)
            <li>{{ $message['content'] }} - {{ $message['author'] }}</li>
        @endforeach
    </ul>

    <a href="{{ route('messages.create') }}">新增留言</a>
</body>
</html>
