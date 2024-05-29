<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/reset.css') }}">
    <link rel="stylesheet" href="{{ asset('css\curriculums\curriculums.css') }}">
    <title>授業設定</title>
</head>
<body>
    @include('admin_header') <!-- 共通ヘッダーをインクルード -->
    @section('content')
    <!-- 戻るボタンを押すと管理-授業一覧へ戻る形にしたい -->
    <a href="{{ route('curriculum_list') }}">←戻る</a>
    <br>
    <br>
    <h1>こんにちは、ここは授業編集ページです。</h1>
    <h2>授業フォーム</h2>
    <form action="submit.php" method="post">
        <label for="grade_ID">クラスID:</label>
        <input type="text" id="grade_ID" name="grade_ID">
        <label for="subject">授業名:</label>
        <input type="text" id="subject" name="subject">
        <label for="video_url">動画URL:</label>
        <input type="text" id="video_url" name="video_url">
        <label for="description">授業概要:</label>
        <textarea id="description" name="description" rows="4" cols="50"></textarea>
        <label for="public">常時公開:</label>
        <input type="checkbox" id="public" name="public" value="1">
        <input type="submit" value="送信">
    </form>
    <br>
    <br>
    <br>
    <br>
    <br>
    <p>ここはテストの領域です。</p>


    
</body>
</html>