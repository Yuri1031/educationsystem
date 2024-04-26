<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>お知らせ画面</title>
  <link rel="stylesheet" href="{{ asset('css/reset.css') }}">
  <link rel="stylesheet" href="{{ asset('css/admin_notice.css') }}">
</head>
<body>
  @include('admin_header') <!-- 共通ヘッダーをインクルード -->
  <div class="container">
    <a href="{{ route('user') }}">←戻る</a>
    <div class="articleBox">
    <div class="messageBox">
        <p>{{ session('message') }}</p>
      </div>
      <div class="articleTitle">
        <table>
          <tr class="tableHeader">
            <th>投稿日時</th>
            <th>タイトル</th>
          </tr>
          @foreach($articles as $article)
          <tr>
            <td>{{ date('20y年m月d日', strtotime($article->posted_date)) }}</td>
            <td>{{ $article->title }}</td>
            <td class="btn"><a href="{{ route('notice.update.show', $article->id) }}" class="showBtn">編集</a></td>
            <td class="btn">
              <form method="POST" action="{{ route('notice.delete', ['id' => $article->id]) }}" class="deleteForm">
                @csrf
                <button type="submit" class="deleteBtn">削除</button>
            </td>
          </tr>
          @endforeach
        </table>
      </div>
    </div>
  </div>
</body>
</html>
