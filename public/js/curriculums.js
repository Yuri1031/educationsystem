console.log("読み込み成功");

document.addEventListener('DOMContentLoaded', function() {
    const gradeButtons = document.querySelectorAll('.grade-button');
    const selectedGradeButton = document.getElementById('selected-grade');
    const gradeIdInput = document.getElementById('grade-id-input');
    const yearInput = document.getElementById('current-year-input');
    const monthInput = document.getElementById('current-month-input');

    gradeButtons.forEach(button => {
        button.addEventListener('click', function() {
            const gradeId = this.getAttribute('data-grade-id');
            const gradeName = this.innerText;

            selectedGradeButton.innerText = gradeName;
            gradeIdInput.value = gradeId;

            fetchCurriculums(gradeId, yearInput.value, monthInput.value);
        });
    });

    document.addEventListener('click', function(e) {
        if (e.target.classList.contains('month-change-link')) {
            e.preventDefault();
            const year = e.target.getAttribute('data-year');
            const month = e.target.getAttribute('data-month');
            fetchMonth(year, month, gradeIdInput.value);
        }
    });

    function fetchMonth(year, month, gradeId) {
        const url = new URL(window.location.origin + '/user/curriculums');
        url.searchParams.set('year', year);
        url.searchParams.set('month', month);
        url.searchParams.set('grade_id', gradeId);

        fetch(url.toString(), {
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(response => response.json())
        .then(data => {
            document.querySelector('#curriculums-container').innerHTML = data.html;
            document.querySelector('#pagination-links').innerHTML = data.links;
            document.querySelector('.current-month').innerHTML = `
                <a href="#" class="month-change-link" data-year="${data.previousMonth.year}" data-month="${data.previousMonth.month}">◀</a>
                ${data.currentYear}年${data.currentMonth}月スケジュール
                <a href="#" class="month-change-link" data-year="${data.nextMonth.year}" data-month="${data.nextMonth.month}">▶</a>
            `;

            // フォームの値を更新
            yearInput.value = data.currentYear;
            monthInput.value = data.currentMonth;

            // 学年が選択されていた場合、その情報を保持
            if (data.gradeName) {
                selectedGradeButton.innerText = data.gradeName;
            }
        })
        .catch(error => console.error('Error fetching month:', error));
    }

    function fetchCurriculums(gradeId, year, month) {
        const url = new URL(window.location.href);
        url.searchParams.set('grade_id', gradeId);
        url.searchParams.set('year', year);
        url.searchParams.set('month', month);

        fetch(url.toString(), {
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(response => response.json())
        .then(data => {
            document.querySelector('#curriculums-container').innerHTML = data.html;
            document.querySelector('#pagination-links').innerHTML = data.links;
            selectedGradeButton.innerText = data.gradeName;
        })
        .catch(error => console.error('Error fetching curriculums:', error));
    }
});

// ページネーションの非同期化
document.addEventListener('DOMContentLoaded', function () {
    const links = document.querySelector('#pagination-links');

    links.addEventListener('click', function (e) {
        if (e.target.tagName === 'A') {
            e.preventDefault();
            fetchPage(e.target.href);
        }
    });

    function fetchPage(url) {
        fetch(url, {
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(response => response.json())
        .then(data => {
            document.querySelector('#curriculums-container').innerHTML = data.html;
            document.querySelector('#pagination-links').innerHTML = data.links;
        })
        .catch(error => console.error('Error fetching page:', error));
    }
});
