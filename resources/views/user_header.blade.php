<!DOCTYPE html>
<!DOCTYPE HTML>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>user共通ヘッダー</title>
        <!-- cssをインポート -->
        <link rel="stylesheet" href="{{ asset('css/user_header.css') }}">
    </head>
    <body>
        @yield('content')
        <div class="header">
            <ul>
                <li><a href="">時間割</a></li>
                <li><a href="">授業進捗</a></li>
                <li><a href="">プロフィール設定</a></li>
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