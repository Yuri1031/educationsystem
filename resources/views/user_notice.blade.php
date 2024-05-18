<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>お知らせ画面</title>
  <link rel="stylesheet" href="{{ asset('css/reset.css') }}">
  <link rel="stylesheet" href="{{ asset('css/user_notice.css') }}">
</head>
<body>
  @include('user_header') <!-- 共通ヘッダーをインクルード -->
  <div class="container">
    <a href="{{ route('user') }}">←戻る</a>
    <div class="articleBox">
      <p>{{ date('20y年m月d日', strtotime($article->posted_date)) }}</p>
      <h2>{{ $article->title }}</h2>
      <p>{{ $article->article_contents }}</p>
    </div>
  </div>
</body>