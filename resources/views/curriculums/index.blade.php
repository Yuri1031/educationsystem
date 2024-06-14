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
    <!-- 共通ヘッダーをインクルード -->
    @include('admin_header')

    <!-- 授業一覧 -->
    <div class="content">
        <!-- 戻るボタンを押すと管理-授業一覧へ戻る形にしたい -->
        <a href="{{ route('curriculum_list') }}">←戻る</a>

        <div class="content-header">
            <h1>授業一覧</h1>
        </div>
    </div>
</body>
</html>
