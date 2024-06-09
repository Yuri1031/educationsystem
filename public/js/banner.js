console.log("読み込み成功");

// フォームの追加・複数登録の非同期処理
$(document).ready(function() {
    var num = 1;
    var view_count = document.querySelectorAll("div[id^='view_']").length;

    function imgView(n) {
        var fileInput = document.getElementById('file_' + n);
        if (!fileInput) return;

        var reader = new FileReader();
        fileInput.onchange = function (e) {
            reader.addEventListener('load', function (e) {
                var viewElement = document.getElementById('view_' + n);
                if (viewElement) {
                    viewElement.innerHTML = '<img src="' + e.target.result + '" width="200px">';
                }
            });
            reader.readAsDataURL(this.files[0]);
        }
    }

    imgView(num);

    $('.add-image-btn').click(function () {
        if (view_count === 5) {
            $('#message').html('※ 追加フォームは' + view_count + '個までです。<br>');
        } else {
            num += 1;
            view_count += 1;

            var tr_form = '' +
                '<tr>' +
                '<td><div id="view_' + num + '"></div></td>' +
                '<td><div class="container mt-5"><div class="input-group mb-3"><input type="hidden" name="banner_id" value=""><input type="file" id="file_' + num + '" name="image[]" class="form-control"><button class="btn btn-danger remove-image-btn" type="button">-</button></div></div></td>' +
                '</tr>' +
                '<td></td>';
            $(tr_form).appendTo($('tbody#preView'));

            imgView(num);
        }
    });

    $(document).on('click', '.remove-image-btn', function() {
        $(this).closest('tr').remove();
        view_count -= 1;
    });

    $('#bannerForm').on('submit', function(e) {
        e.preventDefault();

        var form = $(this);
        var formData = new FormData(form[0]);

        $.ajax({
            url: form.attr('action'),
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                if (response.success) {
                    $('#message').html('<span class="text-success">' + response.success + '</span>');
                    
                    // 新しい画像リストの更新
                    $('#banner').html(response.html);
                    
                    // フォーム内のファイル入力とプレビューをリセット
                    $('input[type="file"]').val('');  
                    $('div[id^="view_"]').html('');

                    num = 1;
                    view_count = document.querySelectorAll("div[id^='view_']").length;

                    imgView(num);
                }
            },
            error: function(xhr, status, error) {
                $('#message').html('<span class="text-danger">画像の登録に失敗しました: ' + xhr.responseText + '</span>');
            }
        });
    });
});

// バナー変更の非同期処理
$(document).ready(function() {
    $('body').on('submit', '.update-banner-form', function(e) {
        e.preventDefault();

        var form = $(this);
        var formData = new FormData(form[0]);

        $.ajax({
            url: form.attr('action'),
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                if (response.imageUrl) {
                    var imageElement = form.closest('tr').find('img');
                    imageElement.attr('src', response.imageUrl);

                    // フォームのリセット
                    form.find('input[type="file"]').val('');  
                    form.find('input[name="banner_id"]').val(response.bannerId);
                }
            },
            error: function(xhr, status, error) {
                console.error('更新に失敗しました: ' + xhr.responseText);
            }
        });
    });
});


// 非同期削除
$(document).ready(function() {
    $('body').on('submit', '.delete-banner-form', function(e) {
        e.preventDefault();

        var form = $(this);

        if (confirm('このバナーを削除してもよろしいですか？')) {
            $.ajax({
                url: form.attr('action'),  // フォームのアクションURLを使用
                type: 'DELETE',  // DELETEメソッドを使用
                data: form.serialize(),  // フォームデータをシリアライズ
                success: function(response) {
                    if (response.html) {
                        $('#banner').html(response.html);  // 新しいHTMLで#bannerの内容を置き換え
                    } else {
                        $('#banner').html('<p>バナーが登録されていません。</p>');  // 何も表示しない
                    }
                },
                error: function(xhr, status, error) {
                    console.error('削除に失敗しました: ' + xhr.responseText);
                }
            });
        }
    });
});
