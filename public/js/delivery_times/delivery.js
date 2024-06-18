function onRemoveBtnClicked(e) {
    if ($('.delivery-time-form__fields').length === 1) { /// 最後の１つのときは、消さずにinputの値だけ取り除く
        for (const elem of e.currentTarget.parentElement.children) {
            if (elem.tagName === 'INPUT' && elem.type === 'text') {
                elem.value = '';
            }
        }
    } else {
        // e.targetではなく、e.currentTargetにする。e.targetの場合、<i>要素のアイコンをクリックしたときに、<button>が削除される不具合が生じる
        e.currentTarget.parentElement.remove();
    }
}

function appendFields(targetSelector,
                      dateFrom = '', timeFrom = '',
                      dateTo = '', timeTo = '') {
    $(targetSelector).append(`
<div id="group-0" class="delivery-time-form__fields">
  <input type="text" name="start_date[]" id="start_date0" placeholder="例: 20230713" value="${dateFrom}">
  <input type="text" name="start_time[]" id="start_time0" placeholder="例: 1230" value="${timeFrom}">
  <span> ~ </span>
  <input type="text" name="end_date[]" id="end_date0" placeholder="例: 20230714" value="${dateTo}">
  <input type="text" name="end_time[]" id="end_time0" placeholder="例: 1230" value="${timeTo}">
  <button type="button" class="remove-button delivery-time-form__delete-btn border" onclick="onRemoveBtnClicked(event)">
    <i class="fa-sharp fa-solid fa-minus"></i>
  </button>
</div>`);
}

/*
function addInputGroup() {
    const container = document.getElementById('input-groups');
    const index = container.children.length;

    const inputGroup = document.createElement('div');
    inputGroup.className = 'input-group';
    inputGroup.id = `group-${index}`;

    inputGroup.innerHTML = `
        <label for="start_date${index}">開始日${index + 1}</label>
        <input type="text" name="start_date[]" id="start_date${index}" placeholder="例: 20230713">
        <label for="start_time${index}">開始時間${index + 1}</label>
        <input type="text" name="start_time[]" id="start_time${index}" placeholder="例: 1230">
        <label for="end_date${index}">終了日${index + 1}</label>
        <input type="text" name="end_date[]" id="end_date${index}" placeholder="例: 20230714">
        <label for="end_time${index}">終了時間${index + 1}</label>
        <input type="text" name="end_time[]" id="end_time${index}" placeholder="例: 1230">
        <button type="button" class="remove-button" onclick="removeInputGroup(${index})">削除</button>
    `;

    container.appendChild(inputGroup);
}

function removeInputGroup(index) {
    const inputGroup = document.getElementById(`group-${index}`);
    inputGroup.remove();
}
*/
