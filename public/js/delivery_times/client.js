// このファイル内でしかアクセスできない変数。DeliveryTimesClientのプライベート変数のように扱う
const _deleted_ids = [];
const _update_data = [];
const _create_data = [];
let _curriculums_id;


/**
 * Laravelで設定されたAPIを呼び出して、DeliveryTimeの作成、編集、削除を行うプロトタイプ。
 * delete、update、createでリクエストのデータを蓄積し、sendRequest()で一斉にリクエストを送信する
 */
export default function DeliveryTimesClient(target_curriculums_id) {
    // 対象のCurriculumのid
    _curriculums_id = target_curriculums_id;
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

    // 削除を実行
    for (const id of _deleted_ids) {
        // Promiseを作成して、リクエストの完了を捕捉する
        promises.push(new Promise((resolve, reject) => {
            $.ajax({
                url: '/api/delivery_times/' + id, // APIのエンドポイント。routes/api.phpを参照。
                type: 'DELETE',
                data: {
                },
                success: function(res) {
                    resolve(res);　// Promiseを解決
                },
                error: function(xhr) {
                    alert('Delete failed!');
                }
            })
        }));
    }

    // 更新を実行
    for (const data of _update_data) {
        // Promiseを作成して、リクエストの完了を捕捉する
        promises.push(new Promise((resolve, reject) => {
            $.ajax({
                url: '/api/delivery_times/' + data['id'], // APIのエンドポイント
                type: 'PUT',
                data: data,
                success: function(res) {
                    resolve(res); // Promiseを解決
                },
                error: function(xhr) {
                    alert('Update failed!');
                }
            })
        }));
    }

    // 作成を実行
    for (const data of _create_data) {
        // Promiseを作成して、リクエストの完了を捕捉する
        promises.push(new Promise((resolve, reject) => {
            $.ajax({
                url: '/api/delivery_times', // APIのエンドポイント
                type: 'POST',
                data: data,
                success: function(res) {
                    resolve(res);　// Promiseを解決
                },
                error: function(xhr) {
                    // alert('Create failed!');
                }
            })
        }));
    }

    // Promise.allは、全てのリクエストが完了したとき（promisesないの全てのPromiseが解決されたとき）に解決される。
    return Promise.all([promises])
}
