console.log("成功");

// プレビューとフォームの追加
$(function () {
    var num = 1;
    var view_count = document.querySelectorAll("div[id]").length;

    function imgView(n) {
        var reader = new FileReader();
        document.getElementById('file_' + n).onchange = function (e) {
            reader.addEventListener('load', function (e) {
                $('#view_' + n).html('<img src="' + e.target.result + '" / width="200px">');
            });
            reader.readAsDataURL(this.files[0]);
        }

    }

    imgView(num);

    $('.add-image-btn').click(function () {

      if(view_count ===5 ){
          $('#message').html('※ 追加フォームは' + view_count + '個までです。<br>');
        }else{

        num = num + 1;
        view_count = view_count + 1;

          var tr_form = '' +
              '<tr>' +
              '<td><div  id="view_' + num + '"></div></td>' +
              '<td><div class="container mt-5"><div class="input-group mb-3"><input type="hidden" name="banner_id" value=""><input type="file" id="file_' + num + '" name="image[]" class="form-control"><button class="btn btn-danger remove-image-btn" type="button">-</button></div></div></td>' +
              '</tr>' +
              '<td></td>';
          $(tr_form).appendTo($('tbody#preView'));

          imgView(num);
      }
    });

    $(document).on('click', '.remove-image-btn', function() {
        $(this).closest('.input-group').remove();
        view_count = view_count - 1;
    });
});