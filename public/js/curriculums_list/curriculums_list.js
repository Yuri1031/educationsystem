const subjects = ['国語', '数学', '社会', '理科', '英語', '体育'];

function showSubjects(grade) {
    const subjectsContainer = document.getElementById('subjects-container');
    subjectsContainer.innerHTML = '';

    // const gradeTitle = document.createElement('h2');
    // gradeTitle.textContent = gradeToTitle(grade);
    // subjectsContainer.appendChild(gradeTitle);

    const subjectsList = document.createElement('ul');
    subjectsList.className = 'subjects';

    subjects.forEach(subject => {
        const listItem = document.createElement('li');
        listItem.textContent = subject;
        subjectsList.appendChild(listItem);
    });

    subjectsContainer.appendChild(subjectsList);

    const p_title_id = document.getElementById('p_title');
    p_title_id.innerHTML = '';
    const p_title = document.createElement('p');
    p_title.textContent = gradeToTitle(grade);
    p_title_id.appendChild(p_title);
    p_title.classList.add('p_style');
}




function gradeToTitle(grade) {
    const titles = {
        grade1: '小学校1年生',
        grade2: '小学校2年生',
        grade3: '小学校3年生',
        grade4: '小学校4年生',
        grade5: '小学校5年生',
        grade6: '小学校6年生',
        grade7: '中学校1年生',
        grade8: '中学校2年生',
        grade9: '中学校3年生',
        grade10: '高校1年生',
        grade11: '高校2年生',
        grade12: '高校3年生',
    };
    return titles[grade];
}
