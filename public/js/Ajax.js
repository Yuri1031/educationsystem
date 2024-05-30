$(document).ready(function () 
{
  // 削除機能（非同期処理）
  $('.deleteBtn').click(function() {
    let result =  window.confirm('削除しますか？');
    if(result){
      let dataId = $(this).data('id'); // 押したボタンの data-id を取得
      let row = $(this).closest('tr'); // 削除する行を取得

      $.ajax({
        method: 'DELETE',
        type: 'DELETE',
        url: '/educationsystem/public/admin/notice_delete/'+dataId+'',
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(){
          row.remove();
          alert('削除しました。');
        },
        error: function() {
          alert('エラー');
        }
      });
    }
    else{
      alert('キャンセルしました。');
      return false;
    }
  })

});