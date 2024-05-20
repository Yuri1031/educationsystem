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
                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('ログアウト') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                
                
            </ul>
            
            
        </div>
    </body>
</html>