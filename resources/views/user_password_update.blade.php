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
    <a href="{{ route('profile.update.show') }}">←戻る</a>
    <h2>パスワード変更</h2>
    <div class="updateBox">
      <div class="messageBox">
        <p>{{ session('message') }}</p>
      </div>
      <form action="{{ route('password.update') }}" method="POST">
        @csrf
        <div class="password ">
          <dl>
            <dd>旧パスワード</dd>
            <dt><input type="password" name="old_password"></dt>
            <div class="errorBox">
              @error('old_password')
                <span class="errorText">{{ $message }}</span>
              @enderror
            </div>
          </dl>
        </div>
        
        <div class="password newPassword">
          <dl>
            <dd>新パスワード</dd>
            <dt><input type="password" name="new_password"></dt>
            <div class="errorBox">
              @error('new_password')
                <span class="errorText">{{ $message }}</span>
              @enderror
            </div>
          </dl>
        </div>
        
        <div class="password newPassword">
          <dl>
            <dd>新パスワード確認</dd>
            <dt><input type="password" name="new_password_check"></dt>
            <div class="errorBox">
              @error('new_password_check')
                <span class="errorText">{{ $message }}</span>
              @enderror
            </div>
          </dl>
        </div>
        <button type="submit" class="btn">登録</button>
      </form>
    </div>
  </div>
  
</body>
</html>
