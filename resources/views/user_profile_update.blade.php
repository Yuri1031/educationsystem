<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>授業進捗画面</title>
  <link rel="stylesheet" href="{{ asset('css/reset.css') }}">
  <link rel="stylesheet" href="{{ asset('css/user_password_update.css') }}">
</head>
<body>
  @include('user_header') <!-- 共通ヘッダーをインクルード -->
  <div class="container">
    <a href="{{ route('user') }}">←戻る</a>
    <h2>プロフィール設定</h2>
    <div class="updateBox">
      <div class="messageBox">
        <p>{{ session('message') }}</p>
      </div>
      <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="profile">
          <dl class="profileImage">
          <dd>
            <h3>プロフィール画像</h3>
              <img src="{{ asset($user->profile_image) }}" alt="プロフィール画像です。" accept="image/jpeg, image/png, image/jpg, image/gif">
            </dd>
            <dt>
              <input type="file" name="profile_image">
            </dt>
          </dl>
          <dl>
            <dd>ユーザーネーム</dd>
            <dt><input type="text" name="user_name" value="{{ $user->name }}"></dt>
            <div class="errorBox">
              @error('user_name')
                <span class="errorText">{{ $message }}</span>
              @enderror
            </div>
          </dl>
          <dl>
            <dd>ユーザーネーム（カナ）</dd>
            <dt><input type="text" name="user_name_kana" value="{{ $user->name_kana }}"></dt>
            <div class="errorBox">
              @error('user_name_kana')
                <span class="errorText">{{ $message }}</span>
              @enderror
            </div>
          </dl>
          <dl>
            <dd>メールアドレス</dd>
            <dt><input type="text" name="email" value="{{ $user->email }}"></dt>
            <div class="errorBox">
              @error('email')
                <span class="errorText">{{ $message }}</span>
              @enderror
            </div>
          </dl>
          <dl class="passwordUpdate">
            <dd>パスワード</dd>
            <dt><a href="{{ route('password.update.show') }}">パスワードを変更する</a></dt>
          </dl>
        </div>
        <button type="submit" class="btn">登録</button>
      </form>
    </div>
  </div>
</body>
</html>
