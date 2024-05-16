<!DOCTYPE html>
<!DOCTYPE HTML>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>user共通ヘッダー</title>
        <link rel="stylesheet" href="{{ asset('css/user_header.css') }}">
    </head>
    <body>
        @yield('content')
        <div class="header">
            <ul>
                <li><a href="{{ route('timetable') }}">時間割</a></li>
                <li><a href="{{ route('curriculum_progress') }}">授業進捗</a></li>
                <li><a href="{{ route('profile.update.show') }}">プロフィール設定</a></li>
            </ul>
            <ul class="status">
                <li><a href="{{ route('user.login') }}">ログアウト</a></li>
            </ul>

        </div>
    </body>
</html>