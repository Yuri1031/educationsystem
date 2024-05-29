<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>授業一覧</title>
    <link rel="stylesheet" href="{{ asset('css/reset.css') }}">
    <link rel="stylesheet" href="{{ asset('css\curriculums_list\curriculums_list.css') }}">
</head>
<body>
    @include('admin_header') <!-- 共通ヘッダーをインクルード -->
    @section('content')
    <!-- 戻るボタンを押すと管理トップページへ戻る形にしたい -->
    <h2><a href="javascript:history.back()">←戻る</a></h2>
    <br>
    <br>
    <h1>授業一覧</h1>
    <div class="title_style">
        <div class="button-group">
            <a href="{{ route('curriculum_create') }}" class="register-button">新規登録</a>
        </div>
        <div id="p_title"></div>
    </div>


    <div class="container">
        <div class="buttons">
            <button onclick="showSubjects('grade1')">小学校1年生</button>
            <button onclick="showSubjects('grade2')">小学校2年生</button>
            <button onclick="showSubjects('grade3')">小学校3年生</button>
            <button onclick="showSubjects('grade4')">小学校4年生</button>
            <button onclick="showSubjects('grade5')">小学校5年生</button>
            <button onclick="showSubjects('grade6')">小学校6年生</button>
            <button onclick="showSubjects('grade7')">中学校1年生</button>
            <button onclick="showSubjects('grade8')">中学校2年生</button>
            <button onclick="showSubjects('grade9')">中学校3年生</button>
            <button onclick="showSubjects('grade10')">高校1年生</button>
            <button onclick="showSubjects('grade11')">高校2年生</button>
            <button onclick="showSubjects('grade12')">高校3年生</button>
        </div>
        
        <div id="subjects-container">
            <!-- 科目リストがここに表示されます -->
        </div>
        
    </div>
    
    <script src="{{ asset('/js\curriculums_list\curriculums_list.js') }}"></script>



    <div class="button-group">
        <a href="{{ route('curriculum_edit') }}" class="register-button">授業編集</a>
        <a href="{{ route('delivery') }}" class="button">配信日時設定</a>
    </div>
</body>
</html>