@php
    $is_edit = $curriculum != null;
    if ($is_edit) {
        $title = $curriculum->title;
        $video_url = $curriculum->video_url;
        $description = $curriculum->description;
        $always_delivery = $curriculum->always_delivery_flg ? 'checked' : '';

        $button_label = '保存';
    } else {
        $title = '';
        $video_url = '';
        $description = '';
        $always_delivery = '';

        $button_label = '登録';
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

            <form method="POST" enctype="multipart/form-data" class="curriculum-form">
                @csrf
                <div class="curriculum-form__thumbnail-editor">
                    <div class="preview-area">
                        <img id="thumbnail-preview" src="{{ $is_edit ? $curriculum->getThumbnailUrl() : asset('img/noimage.jpg') }}" alt="no image" width="100%">
                    </div>
                    <div class="curriculum-form__field curriculum-form__field--thumbnail">
                        <label for="thumbnail_image">サムネイル</label>
                        <input type="file" name="thumbnail_image" id="thumbnail_image" accept="image/*">
                    </div>
                </div>

                <div class="curriculum-form__field">
                    <label for="grade_id">学年</label>
                    <select name="grade_id" id="grade_id" class="border">
                        @foreach ($grades as $grade)
                            <option value="{{ $grade->id }}" {{ request('grade_id') == $grade->id ? 'selected' : '' }}>
                                {{ $grade->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="curriculum-form__field">
                    <label for="title">授業名</label>
                    <input type="text" id="title" name="title" class="border" value="{{ $title }}">
                </div>

                <div class="curriculum-form__field">
                    <label for="video_url">動画URL</label>
                    <input type="text" id="video_url" name="video_url" class="border" value="{{ $video_url }}">
                </div>

                <div class="curriculum-form__field">
                    <label for="description">授業概要</label>
                    <textarea id="description" name="description" rows="10" cols="50" class="border">{{ $description }}</textarea>
                </div>

                <div class="curriculum-form__field curriculum-form__field--always-delivery">
                    <input type="checkbox" id="always_delivery_flg" name="always_delivery_flg" value="true" {{ $always_delivery }}>
                    <label for="always_delivery_flg">常時公開</label>
                </div>

                <input type="submit" value="{{ $button_label }}" class="curriculum-form__save-btn bg-btn-secondary">
            </form>
        </div>
    </div>
</body>

<script type="module">
    import { previewOnUpload } from "{{ asset('js/curriculums/form.js') }}";

    previewOnUpload('#thumbnail-preview', 'input[name="thumbnail_image"]');
</script>
</html>