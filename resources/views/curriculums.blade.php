@include('user_header')



<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="{{ asset('css/css.css')  }}">
  <title>curriculums</title> 
</head>



<body>
    <div class="container">
        <div class="content">
          <!--動画-->
          <div class="thumbnail">
            <a href="{{ $curriculum->video_url }}">
              <img src="{{ asset('storage/' .$curriculum->thumbnail) }}" alt="thumbnail" class="thumbnail-img">
            </a>
            @if($curriculum->is_in_delivery_period)
               @if($curriculum->enrolled)
                 <button class="enroll-button disabled" disabled>受講済み</button>
                @else
                 <button class="enroll-button" data-course-id="{{ $curriculum->id }}">受講しました</button>
               @endif
             @else
               <button class="enroll-button disabled" disabled>配信期間外</button>
           @endif
    </div>


          <!--カリキュラム情報-->
          <div class="curriculum-info">
             <!--学年表示-->
             <div class="grade">{{ $curriculum->grade_id}}</div>
              
              <!--講義について(タイトル、内容)-->
              <div>
                  <!--講義タイトル-->
                  <div class="title"><h3>{{ $curriculum->title }}</h3></div>
                  <!--講義内容-->
                  <div class="course-description">{{ $curriculum->description }}</div>
              </div>
               
          </div>
        </div>
    </div>



    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // 全ての受講ボタンにクリックイベントを追加
        document.querySelectorAll('.enroll-button').forEach(button => {
            button.addEventListener('click', function() {
                handleEnrollClick(this);
            });
        });
    });

    // ボタンがクリックされたときの処理
    function handleEnrollClick(button) {
        const courseId = button.getAttribute('data-course-id');

        axios.post('/curriculums/enroll', { courseId: courseId })
            .then(response => {
                // 成功した場合の処理
                button.textContent = '受講済み';
                button.classList.add('disabled');
                button.disabled = true;
            })
            .catch(error => {
                // エラー処理
                console.error('Error enrolling in course:', error);
            });
    }
    </script>



  </body>
</html>

