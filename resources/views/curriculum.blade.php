@include('user_header')
<a href="/">戻る</a>

<head>
  <link rel="stylesheet" href="{{ asset('css/app.css') }}">
  <title>{{ $curriculum->title }}</title> 
</head>



<body>
  <!--動画-->
  <div>
    <a href="{{ $curriculum->video_url }}">{{ $curriculum->thumbnail }}</a>
  </div>


  <!--受講ボタン-->
  <div><a href="{{ route('enroll', ['curriculumId' => $curriculum->id]) }}" class="btn btn-primary">受講する</a></div>


  <!--学年表示-->
  <div>{{ $curriculum->grade_id}}</div>


  <!--講義について(タイトル、内容)-->
  <div>
    <!--講義タイトル-->
    <div>
      <h4>{{ $curriculum->title }}</h4>
    </div>

    <!--講義内容-->
    <div>{{ $curriculum->description }}</div>
  </div>
</body>

