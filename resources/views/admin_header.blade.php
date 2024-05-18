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
    </head>
    <body>
        @yield('content')
        <div class="header">
            <ul>
                <li><a href="{{ route('curriculum.management') }}">授業管理</a></li>
                <li><a href="{{ route('admin.notice') }}">お知らせ管理</a></li>
                <li><a href="{{ route('banner.management') }}">バナー管理</a></li>
            </ul>
            <ul class="status">
                <!-- if文でログインかログアウト状態かで表示を変える -->
                <li><a href="{{ route('admin.login') }}">ログアウト</a></li>
            </ul>
        </div>
    </body>
</html>