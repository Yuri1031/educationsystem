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
    <h1>こんにちは、ここは新規授業登録ページです。</h1>
    <h2>授業フォーム</h2>
    <form action="{{ route('curriculum_store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="thumbnail_image">サムネイル画像:</label>
            <input type="file" name="thumbnail_image" id="thumbnail_image" accept="image/*">
        </div>
        <br>
        <label for="grade_id">学年:</label>
        <select name="grade_id" id="grade_id">
            @foreach ($grades as $grade)
                <option value="{{ $grade->id }}" {{ request('grade_id') == $grade->id ? 'selected' : '' }}>
                    {{ $grade->name }}
                </option>
            @endforeach
        </select>
        <br>
        <label for="title">授業名:</label>
        <input type="text" id="title" name="title">
        <label for="video_url">動画URL:</label>
        <input type="text" id="video_url" name="video_url">
        <label for="description">授業概要:</label>
        <textarea id="description" name="description" rows="4" cols="50"></textarea>
        <label for="alway_delivery_flg">常時公開:</label>
        <input type="checkbox" id="alway_delivery_flg" name="alway_delivery_flg" value="1">
        <input type="submit" value="登録">
    </form>
    <br>
    <br>
    <br>
    <br>
    <br>
    <p>これは、DBから取得した値です。</p>
    <div class="links">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>name</th>
                </tr>
            </thead>
            <tbody>
            @foreach ($grades as $grade)
                <tr>
                    <td>{{ $grade->id }}</td>
                    <td>{{ $grade->name }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>



    
</body>
</html>