@include('user_header')
<a href="/">戻る</a>

<head>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/css.css') }}">
</head>
<body>
    <!--バナー画像-->
    <div style="padding: 10px; margin-bottom: 10px; border: 1px dashed #333333;">
      <div class="banner">
         @if(isset($banners) && $banners->count() > 0)
         <ul class="slider">
             @foreach($banners as $banner)
                 <li class="slider-item">
                     <img src="{{ $banner->image }}" alt="Banner Image">
                 </li>
             @endforeach
         </ul>
            @else
                <p>No banners found.</p>
            @endif
      </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
    <!--自作のJS-->
    <script src="{{ asset('js/js.js') }}"></script>



    <!--お知らせ-->
    <h2>お知らせ</h2>
    <div style="padding: 10px; margin-bottom: 10px; border: 1px dashed #333333;">
      <div class="articles">
         @if(isset($articles) && $articles->count() > 0)
         <ul>
           @foreach($articles as $article)
             <li><span class="date">{{ $article->posted_date }}</span><a href="{{ route('article.show', $article->id) }}">{{ $article -> title }}</a></li>
           @endforeach
         </ul>
         @else
             <p>No articles found.</p>
         @endif
      </div>
    </div>

    

</body>

