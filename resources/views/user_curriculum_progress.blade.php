<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>授業進捗画面</title>
  <link rel="stylesheet" href="{{ asset('css/reset.css') }}">
  <link rel="stylesheet" href="{{ asset('css/user_curriclum_progress.css') }}">
</head>
<body>
  @include('user_header') <!-- 共通ヘッダーをインクルード -->
  <div class="container">
    <a href="{{ route('user') }}">←戻る</a>
  
    <div class="profile">
      <div class="profileImage">
        <img src="{{ asset($user->profile_image) }}" alt="プロフィール画像です">
      </div>
      <div class="profileText">
        <h2>{{ $user->name }}さんの授業進捗</h2>
        <p>現在の学年 : <span>{{ $user->grade->name }}</span></p>
      </div>
    </div>
    
    <div class="curriculum">
      @foreach($curriculumsByGrade as $gradeName => $curriculums)
      <div class="curruculumBox">
        <h3>{{ $gradeName }}</h3>
        <ul>
          @foreach($curriculums as $curriculum)
          <li>
            @if($curriculum->alway_delivery_flg === 0)
            <span></span>
            @else
            <span>受講済</span>
            @endif
            <a href="{{ route('curriculum.show', $curriculum->id) }}">{{ $curriculum->title }}</a>
          </li>
          @endforeach
        </ul>
      </div>
      @endforeach
    </div>
  </div>
</body>
</html>
