<!DOCTYPE html>
<!DOCTYPE HTML>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>user共通ヘッダー</title>
        <!-- cssをインポート -->
        <link rel="stylesheet" href="{{ asset('css/admin_header.css') }}">

        <!-- jqueryをロード -->
        <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    </head>
    <body>
        @yield('content')
        <div class="header">
            <ul>
                <li><a href="">授業管理</a></li>
                <li><a href="">お知らせ管理</a></li>
                <li><a href="">バナー管理</a></li>
            </ul>
            <ul class="status">
                <!-- if文でログインかログアウト状態かで表示を変える -->
                <li><a href="">ログイン</a></li>
                <li>/</li>
                <li><a href="">ログアウト</a></li>
            </ul>
        </div>
    </body>
</html>
