<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>授業一覧</title>
    <link rel="stylesheet" href="{{ asset('css/reset.css') }}">
    <link rel="stylesheet" href="{{ asset('css\curriculums_list\curriculums_list2.css') }}">
</head>
<body>
    @include('admin_header') <!-- 共通ヘッダーをインクルード -->
    @section('content')
    <!-- 戻るボタンを押すと管理トップページへ戻る形にしたい -->
    <h2><a href="javascript:history.back()">←戻る</a></h2>
    <br>
    <br>
    <h1>授業一覧</h1>
    <div class="title_style">
        <div class="button-group">
            <a href="{{ route('curriculum_create') }}" class="register-button">新規登録</a>
        </div>
        <div id="p_title"></div>
    </div>


    <div class="container">
        @foreach($matchingGrades as $curriculum)
        <table>
            <tr>
                <td>
                    <div class="card">
                        <!-- <img src="#" alt="授業画像"> -->
                        <div class="card-content">
                            <h3>
                                {{$curriculum->title}}
                                {{$curriculum->id}}
                            </h3>
                            <p>ここに日時が３つほど入る</p>
                            <div class="button-group">
                                <a href="{{ route('curriculum_edit') }}" class="register-button">授業内容編集</a>

                                <a href="{{ route('delivery_show' ,['id' => $curriculum->id]) }}" class="button">配信日時編集</a>
                            </div>
                        </div>
                    </div>
                </td>
            </tr>
        </table>
        @endforeach
    </div>

    
    <script src="{{ asset('/js\curriculums_list\curriculums_list.js') }}"></script>

</body>
</html>