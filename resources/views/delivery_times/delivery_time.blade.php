<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>管理-配信日時設定</title>
        <link rel="stylesheet" href="{{ asset('css/reset.css') }}">
        <link rel="stylesheet" href="{{ asset('css\delivery_times\delvery_times.css') }}">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
        <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
        <script src="{{ asset('/js\delivery_times\delvery.js') }}"></script>
    </head>
    <body>
        @include('admin_header') <!-- 共通ヘッダーをインクルード -->
        @section('content')
        <div class="container">
            @method('PUT')
            <a href="{{ route('curriculum_list') }}">←戻る</a>

            <h1 class="main_title">配信日時設定</h1>
                <h2 class="#">
                    授業タイトル
                </h2>
            <!-- ここから入力フォーム -->
            <h2>配信日時設定</h2>
            <form action="#" method="POST" enctype="multipart/form-data">
                <div id="input-groups">
                    <!-- 初期の入力グループ -->
                    <div class="input-group" id="group-0">
                        <label for="start_date0">開始日1</label>
                        <input type="text" name="start_date[]" id="start_date0" placeholder="例: 20230713">
                        <label for="start_time0">開始時間1</label>
                        <input type="text" name="start_time[]" id="start_time0" placeholder="例: 1230">
                        <label for="end_date0">終了日1</label>
                        <input type="text" name="end_date[]" id="end_date0" placeholder="例: 20230714">
                        <label for="end_time0">終了時間1</label>
                        <input type="text" name="end_time[]" id="end_time0" placeholder="例: 1230">
                        <button type="button" class="remove-button" onclick="removeInputGroup(0)">削除</button>
                    </div>
                </div>
                <button type="button" class="add-button" onclick="addInputGroup()">追加</button>
                <div class="button-group">
                    <button type="submit">登録</button>
                </div>
            </form>
        </div>
    </body>
</html>