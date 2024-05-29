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