{{--
このform.blade.phpは、授業登録と、授業編集の両方で利用します。
最初にform.blade.phpが登録で利用されているのか、編集で利用されているのか判定し、
<input>にどのような値をあてはめるか決めていく。
--}}

@php
    // CurriculumControllerから渡された$curriculumがnullの場合は、『登録』とみなす。
    $is_edit = $curriculum != null;

    // 共通の変数に、登録の場合と編集の場合で異なる値をいれていく。
    if ($is_edit) {
        $title = $curriculum->title;
        $video_url = $curriculum->video_url;
        $description = $curriculum->description;
        $always_delivery = $curriculum->always_delivery_flg ? 'checked' : '';

        $action = route('curriculums.update', [ 'id' => $curriculum->id ]);
        $method = 'PUT';
    } else {
        $title = '';
        $video_url = '';
        $description = '';
        $always_delivery = '';

        $action = route('curriculums.store');
        $method = 'POST';
    }
@endphp

<!DOCTYPE html>
<html lang="ja" translate="no">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/curriculums/form.css') }}">
    <link rel="stylesheet" href="{{ asset('css/reset.css') }}">
    <title>授業設定</title>
</head>
<body>
    @include('admin_header') <!-- 共通ヘッダーをインクルード -->

    <div class="wrapper">

        <div class="header">
            <!-- 戻るボタンを押すと管理-授業一覧へ戻る形にしたい -->
            <a class="header__back" href="{{ route('curriculums.list.default') }}">←戻る</a>
            <h1 class="header__title">授業設定</h1>
        </div>

        <div class="content">

            <!-- 授業の詳細を書き込んでいくためのフォーム -->
            <form action="{{ $action }}" method="POST" enctype="multipart/form-data" class="curriculum-form">
                @csrf
                @if ($is_edit) {{-- 編集の場合は、@method('PUT')を指定--}}
                    @method('PUT')
                @endif

                <!-- サムネイル変更のための箇所。プレビュー画面と、ファイル選択の<input>フィールドを用意 -->
                <div class="curriculum-form__thumbnail-editor">
                    <div class="preview-area">
                        <img id="thumbnail-preview" src="{{ $is_edit ? $curriculum->getThumbnailUrl() : asset('img/noimage.jpg') }}" alt="no image" width="100%">
                    </div>
                    <div class="curriculum-form__field curriculum-form__field--thumbnail">
                        <label for="thumbnail_image">サムネイル</label>
                        <input type="file" name="thumbnail_image" id="thumbnail_image" accept="image/*">
                    </div>
                </div>

                <!-- 学年のセレクトボックス -->
                <div class="curriculum-form__field">
                    <label for="grade_id">学年</label>
                    <select name="grade_id" id="grade_id" class="border">
                        @foreach ($grades as $grade)
                            {{-- 編集の場合は、$curriculumに現在指定されている学年を初期値とする --}}
                            <option value="{{ $grade->id }}" {{ $is_edit && $curriculum->grade_id == $grade->id ? 'selected' : '' }}>
                                {{ $grade->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- 授業のテキストボックス -->
                <div class="curriculum-form__field">
                    <label for="title">授業名</label>
                    <input type="text" id="title" name="title" class="border" value="{{ $title }}"> <!-- form.blade.phpでセットした値を初期値にする。登録の場合と、編集の場合で変わる -->
                </div>

                <!-- 動画URLのテキストボックス -->
                <div class="curriculum-form__field">
                    <label for="video_url">動画URL</label>
                    <input type="text" id="video_url" name="video_url" class="border" value="{{ $video_url }}">
                </div>

                <!-- 授業概要のテキストエリア -->
                <div class="curriculum-form__field">
                    <label for="description">授業概要</label>
                    <textarea id="description" name="description" rows="10" cols="50" class="border">{{ $description }}</textarea>
                </div>

                <!-- 常時公開のチェックボックス -->
                <div class="curriculum-form__field curriculum-form__field--always-delivery">
                    <input type="checkbox" id="always_delivery_flg" name="always_delivery_flg" value="1" {{ $always_delivery }}>
                    <label for="always_delivery_flg">常時公開</label>
                </div>

                <!-- 登録ボタン -->
                <input type="submit" value="登録" class="form__register-btn bg-btn-secondary">
            </form>
        </div>
    </div>
</body>

<script type="module">
    import { previewOnUpload } from "{{ asset('js/curriculums/form.js') }}";

    // ファイルを選択したら、画像をプレビューするように、イベントリスナーをセット
    previewOnUpload('#thumbnail-preview', 'input[name="thumbnail_image"]');
</script>
</html>
