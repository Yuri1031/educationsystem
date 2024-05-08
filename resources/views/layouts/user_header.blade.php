<!DOCTYPE HTML>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>管理</title>
    
    <!-- cssをインポート -->
    <link rel="stylesheet" href="{{ asset('css/user_header.css') }}">
    
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    <!-- <script src="{{ asset('js/app.js') }}" defer></script> -->
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="{{ asset('js/class_list.js') }}"></script>
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

</head>
<body>
    <div class="header">
        @if(Auth::check())
        <ul>
            <li><a href="{{ route('user.curriculums') }}">時間割</a></li>
            <li><a href="">授業進捗</a></li>
            <li><a href="">プロフィール設定</a></li>
        </ul>
        @endif
    <div class="ms-auto">
        <ul class="status">
        <!-- ログアウト時の表示 -->
        @guest
            @if (Route::has('login'))
                <li>
                    <a href="{{ route('login') }}">{{ __('ログイン') }}</a>
                </li>
            @endif
            @if (Route::has('register'))
                <li>
                    <a href="{{ route('register') }}">{{ __('新規登録') }}</a>
                </li>
            @endif
        @endguest
        <!-- ログイン時の表示 -->
        @if(Auth::check())
            <li>
                <a>{{ Auth::user()->name }}</a>
            </li>
            <li>
            <a href="{{ route('logout') }}"
            onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
                {{ __('ログアウト') }}
            </a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
            </li>
        @endif
        </ul>
    </div>
    </div>
    
    <!-- コンテンツの間にスペースを追加 -->
    <div class="mt-4"></div>
    
    @yield('content')
</body>
</html>