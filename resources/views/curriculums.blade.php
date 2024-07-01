@include('user_header')

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="{{ asset('css/css.css') }}">
  <title>curriculums</title>
</head>
<body>
    <div class="container">
        @foreach ($curriculums as $curriculum)
        <div class="content">
          <!--動画-->
          @php
              $current_time = now();
              $delivery_times = $curriculum->delivery_times;
          @endphp

          @if ($curriculum->always_delivery_flg || ($curriculum->delivery_flg && $delivery_times && $current_time >= $delivery_times->delivery_from && $current_time <= $delivery_times->delivery_to))
              <a href="{{ asset('storage/' . $curriculum->video_url) }}">
                <img src="{{ asset('storage/' . $curriculum->thumbnail) }}" alt="thumbnail" class="thumbnail-img">
              </a>
              @if ($curriculum->enrolled)
                 <button class="enroll-button disabled" disabled>受講済み</button>
              @else
                 <button class="enroll-button" data-course-id="{{ $curriculum->id }}">受講する</button>
              @endif
          @else
              <img src="{{ asset('storage/' . $curriculum->thumbnail) }}" alt="thumbnail" class="thumbnail-img">
              <button class="enroll-button disabled" disabled>配信期間外</button>
          @endif

          <!--カリキュラム情報-->
          <div class="curriculum-info">
             <!--学年表示-->
             <div class="grade">{{ $curriculum->grade_id }}年</div>
              
              <!--講義について(タイトル、内容)-->
              <div>
                  <!--講義タイトル-->
                  <div class="title"><h3>{{ $curriculum->title }}</h3></div>
                  <!--講義内容-->
                  <div class="course-description">{{ $curriculum->description }}</div>
              </div>
          </div>
        </div>
        @endforeach
    </div>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.enroll-button').forEach(button => {
            button.addEventListener('click', function() {
                handleEnrollClick(this);
            });
        });
    });

    function handleEnrollClick(button) {
        const courseId = button.getAttribute('data-course-id');

        axios.post('/curriculums/enroll', { courseId: courseId })
            .then(response => {
                button.textContent = '受講済み';
                button.classList.add('disabled');
                button.disabled = true;
            })
            .catch(error => {
                console.error('Error enrolling in course:', error);
            });
    }
    </script>
</body>
</html>

