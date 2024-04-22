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
      <div class="articleTitle">
        <h2>
          <span>投稿日：{{ date('20y年m月d日', strtotime($article->posted_date)) }}</span>
          {{ $article->title }}
        </h2>
      </div>
      <div class="articleText">
        <p>{{ $article->article_contents }}</p>
      </div>
    </div>
  </div>
</body>
</html>
