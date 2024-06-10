<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>授業一覧</title>
    <link rel="stylesheet" href="{{ asset('css/reset.css') }}">
    <link rel="stylesheet" href="{{ asset('css\curriculums_list\curriculums_list2.css') }}">
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

    <br>

    <form action="{{ route('checkGrade') }}" method="POST" class="form-group">
        @csrf
        <label for="grade">学年を選択してください:</label>
        <br>
        <button class="grade-button"type="submit" name="grade" value="1">小学校1年生</button>
        <button class="grade-button"type="submit" name="grade" value="2">小学校2年生</button>
        <button class="grade-button"type="submit" name="grade" value="3">小学校3年生</button>
        <button class="grade-button"type="submit" name="grade" value="4">小学校4年生</button>
        <button class="grade-button"type="submit" name="grade" value="5">小学校5年生</button>
        <button class="grade-button"type="submit" name="grade" value="6">小学校6年生</button>
        <button class="grade-button"type="submit" name="grade" value="7">中学校1年生</button>
        <button class="grade-button"type="submit" name="grade" value="8">中学校2年生</button>
        <button class="grade-button"type="submit" name="grade" value="9">中学校3年生</button>
        <button class="grade-button"type="submit" name="grade" value="10">高校1年生</button>
        <button class="grade-button"type="submit" name="grade" value="11">高校2年生</button>
        <button class="grade-button"type="submit" name="grade" value="12">高校3年生</button>
    </form>


    <br>
    <script src="{{ asset('/js\curriculums_list\curriculums_list.js') }}"></script>
</body>
</html>