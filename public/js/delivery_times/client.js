// このファイル内でしかアクセスできない変数。DeliveryTimesClientのプライベート変数のように扱う
let _create_url;
let _base_update_url;
let _base_delete_url;
const _deleted_ids = [];
const _update_data = [];
const _create_data = [];
let _curriculums_id;


/**
 * Laravelで設定されたAPIを呼び出して、DeliveryTimeの作成、編集、削除を行うプロトタイプ。
 * delete、update、createでリクエストのデータを蓄積し、sendRequest()で一斉にリクエストを送信する
 */
export default function DeliveryTimesClient({target_curriculums_id, create_url, base_update_url, base_delete_url}) {
    // 対象のCurriculumのid
    _curriculums_id = target_curriculums_id;
    _create_url = create_url;
    _base_update_url = base_update_url;
    _base_delete_url = base_delete_url;
}

// sendRequest()の前に実行されるコールバック。デフォルトでは何も実行しない。
DeliveryTimesClient.prototype.beforeRequest = function() {}

// 削除するDeliveryTimeのidを蓄積する
DeliveryTimesClient.prototype.delete = function(id) {
    _deleted_ids.push(id);
}

// 更新対象のDeliveryTimeのidと、delivery_from、delivery_toのデータを蓄積する
DeliveryTimesClient.prototype.update = function(id, date_from, time_from, date_to, time_to) {
    _update_data.push({
        'id': id, 'date_from': date_from, 'time_from': time_from, 'date_to': date_to, 'time_to': time_to,
    })
}

// DeliveryTimeを作成するための、delivery_from、delivery_toのデータを蓄積する
DeliveryTimesClient.prototype.create = function(date_from, time_from, date_to, time_to) {
    _create_data.push({
        'curriculums_id': _curriculums_id,
        'date_from': date_from, 'time_from': time_from,
        'date_to': date_to, 'time_to': time_to,
    });
}

// _deleted_ids、_update_data、_create_dataに蓄積されたデータを用いて、一斉にリクエストを送信する
DeliveryTimesClient.prototype.sendRequest = function() {
    // リクエスト送信前に、コールバックの呼び出し
    if (this.beforeRequest) this.beforeRequest();

    //　全てのリクエストの完了を待つために、Promiseを格納する
    const promises = [];

    console.log('create: ' + _create_url);
    console.log('update: ' + _base_update_url);
    console.log('delete: ' + _base_delete_url);

    // 削除を実行
    for (const id of _deleted_ids) {
        const url = _base_delete_url.replace(':id', `${id}`)
        // Promiseを作成して、リクエストの完了を捕捉する
        promises.push(new Promise((resolve, reject) => {
            $.ajax({
                url: url, // APIのエンドポイント。routes/api.phpを参照。
                type: 'DELETE',
                data: {
                },
                success: function(res) {
                    resolve(res);　// Promiseを解決
                },
                error: function(xhr) {
                    reject(xhr.responseJSON);
                }
            })
        }));
    }

    // 更新を実行
    for (const data of _update_data) {
        const url = _base_update_url.replace(':id', `${data['id']}`);
        // Promiseを作成して、リクエストの完了を捕捉する
        promises.push(new Promise((resolve, reject) => {
            $.ajax({
                url: url, // APIのエンドポイント
                type: 'PUT',
                data: data,
                success: function(res) {
                    resolve(res); // Promiseを解決
                },
                error: function(xhr) {
                    reject(xhr.responseJSON);
                }
            })
        }));
    }

    // 作成を実行
    for (const data of _create_data) {
        // Promiseを作成して、リクエストの完了を捕捉する
        promises.push(new Promise((resolve, reject) => {
            $.ajax({
                url: _create_url, // APIのエンドポイント
                type: 'POST',
                data: data,
                success: function(res) {
                    resolve(res);　// Promiseを解決
                },
                error: function(xhr) {
                    reject(xhr.responseJSON);
                }
            })
        }));
    }

    // Promise.allは、全てのリクエストが完了したとき（promisesないの全てのPromiseが解決されたとき）に解決される。
    return Promise.all(promises);
}
