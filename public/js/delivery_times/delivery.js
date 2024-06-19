// このファイル内でしかアクセスできない変数。InputFieldsManagerのプライベート変数のように扱う。
let _target_selector;
let _client;
let _index = 0;
const _removed_indices = [];
const _indices_to_delivery_time_id = {}


// このファイル内でしかアクセスできない変数。InputFieldsManagerのプライベート関数のように扱う。
const _getValue = (index, name) => {
    return $(_target_selector)
        .children(`div[data-index="${index}"]`)
        .children(`input[name="${name}"]`)[0].value;
}


/**
 * DeliveryTimeのdelivery_from、delivery_toのための<input>要素を管理し、DeliveryTimeClientにデータを渡すプロトタイプ。
 * indexを用いて、inputのグループを管理する
 */
export default function InputFieldsManager(target_selector, delivery_time_client) {
    // <input>のグループを挿入すべき、要素のセレクタ
    _target_selector = target_selector;
    // DeliveryTimeClient(public/js/delivery_times/client.js)と組み合わせて利用する
    _client = delivery_time_client;


    // DeliveryTimeClientがリクエストを送信する前に実行するコールバックを指定する。
    // このコールバックで、リクエスト送信前に、<input>のグループからデータを取り出して、クライアントに蓄積させる
    _client.beforeRequest = function () {
        // indexごとに<input>グループが紐付いている。indexごとの<input>グループを調べて、前処理を行う
        for (let i = 0; i < _index; i++) {
            // _removed_indicesに含まれるindexと、紐付いた<input>グループはすでに削除されているので、スキップする。
            if (_removed_indices.includes(i)) {
                continue;
            }

            // _getValue()でindexと、<input>のnameを指定することで、値を取得できる。
            const date_from = _getValue(i, 'date_from');
            const time_from = _getValue(i, 'time_from');
            const time_to = _getValue(i, 'time_to');
            const date_to = _getValue(i, 'date_to');

            const delivery_time_id = _indices_to_delivery_time_id[i];
            if (delivery_time_id) { // _indices_to_delivery_time_idにindexと紐付いたidがある場合は、このindexと紐付いた<input>グループは、DeliveryTimeの更新に使われるとみなす。
                _client.update(delivery_time_id, date_from, time_from, date_to, time_to);
            } else { // _indices_to_delivery_time_idにindexと紐付いたidがない場合は、DeliveryTimeの作成に利用されるとみなす。
                _client.create(date_from, time_from, date_to, time_to);
            }
        }
    }
}

// <input>のグループを挿入する。
InputFieldsManager.prototype.appendFields = function(delivery_time_id = '',
                                                     date_from = '', time_from = '',
                                                     date_to = '', time_to = '') {
    // _indexをコピーしたidxを利用しないと、削除ボタンを実行しようとしたときに不具合がでる
    const idx = _index;

    // <input>グループを追加
    $(_target_selector).append(`
<div id="group-0" class="delivery-time-form__fields" data-index="${idx}" data-delivery_time_id="${delivery_time_id}">
  <input type="text" name="date_from" placeholder="例: 20230713" value="${date_from}">
  <input type="text" name="time_from" placeholder="例: 1230" value="${time_from}">
  <span> ~ </span>
  <input type="text" name="date_to" placeholder="例: 20230714" value="${date_to}">
  <input type="text" name="time_to" placeholder="例: 1230" value="${time_to}">
  <button type="button" class="delivery-time-form__delete-btn border" data-index="${idx}">
    <i class="fa-sharp fa-solid fa-minus"></i>
  </button>
</div>`);

    // 削除ボタンに、<input>グループを削除する処理を持つイベントリスナーを登録。
    $(_target_selector).find(`button.delivery-time-form__delete-btn[data-index="${idx}"]`)
        .click((e) => {
            const last_input_fields = $('.delivery-time-form__fields').length === 1;
            e.currentTarget.parentElement.remove();
            _removed_indices.push(idx);

            if (last_input_fields) this.appendFields(); // <input>グループが、最後の１つのときは、<input>グループを一つ追加する

            if (delivery_time_id !== '') { // delivery_time_idが空文字でないときは、対象のDeliveryTimeがあるとみなす。削除ボタンによって、対象のDeliveryTimeも削除する。
                _client.delete(delivery_time_id);
            }
        });


    if (delivery_time_id !== '') { // delivery_time_idが空文字でないときは、対象のDeliveryTimeがあるとみなす。このappendFieldsで追加された<input>群は、対象のDeliveryTimeを更新するために用いられる。
        _indices_to_delivery_time_id[idx] = delivery_time_id;　// 後に利用するために、indexとdelivery_time_idを紐付けて保存しておく。
    }

    _index++;
}
