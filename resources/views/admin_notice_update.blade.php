<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>お知らせ画面</title>
  <link rel="stylesheet" href="{{ asset('css/reset.css') }}">
  <link rel="stylesheet" href="{{ asset('css/admin_notice_update.css') }}">
</head>
<body>
  @include('admin_header') <!-- 共通ヘッダーをインクルード -->
  <div class="container">
    <a href="{{ route('admin.notice') }}">←戻る</a>
    <div class="messageBox">
        <p>{{ session('message') }}</p>
      </div>
    <form action="{{ route('admin.notice.update',  ['id' => $article->id]) }}" method="POST">
      @csrf
      <dl>
        <dd>投稿日時</dd>
        <dt><input type="date" name="posted_date"></dt>
        <div class="errorBox">
          @error('posted_date')
            <span class="errorText">{{ $message }}</span>
          @enderror
        </div>
      </dl>
      <dl>
        <dd>タイトル</dd>
        <dt><input type="text" value="{{ $article->title }}" name="title"></dt>
        <div class="errorBox">
          @error('title')
            <span class="errorText">{{ $message }}</span>
          @enderror
        </div>
      </dl>
      <dl>
        <dd>本文</dd>
        <dt><textarea cols="20" rows="10" name="article_contents">{{ $article->article_contents }}</textarea></dt>
        <div class="errorBox">
          @error('article_contents')
            <span class="errorText">{{ $message }}</span>
          @enderror
        </div>
      </dl>
      <button type="submit" class="btn">登録</button>
    </form>
  </div>
</body>
</html>
