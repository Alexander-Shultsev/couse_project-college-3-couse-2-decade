const inputTableGrade = document.getElementsByClassName("input__mark");
const inputTableGap = document.getElementsByClassName("input__gap");
const averageValue = document.getElementsByClassName('GRADE_AVG');
const users = document.getElementsByClassName('USER_NAME');
const dates = document.getElementsByClassName('DATE_NAME');

const inputTableGradeLenght = inputTableGrade.length;
let lastGrade;
let lastGap;
let gradeAvg = 0;
let gradeCount = 0;

init();
// функция, запускаемая при загрузки страницы
function init () {
    countAverageAll();
    startListeners();
}

// запуск слушателей
function startListeners() {
    for (let i = 0; i < inputTableGradeLenght; i++) {
        inputTableGrade[i].addEventListener('change', changeMark);
        inputTableGrade[i].addEventListener('keypress', checkInputValueInTable);
        inputTableGrade[i].addEventListener('focus', getCurrentValue);
    }
}

// Табы для страницы заведующего отделением
document.querySelectorAll('.nav__tab').forEach((item) =>
    item.addEventListener('click', function (e) {
        e.preventDefault();
        const id = e.target.getAttribute('href').replace('#', '');

        document.querySelectorAll('.nav__tab').forEach(
            (child) => child.classList.remove('active')
        );
        item.classList.add('active');

        document.querySelectorAll('.table-content').forEach(
            (child) => child.classList.remove('active')
        );
        document.getElementById(id).classList.add('active');
    })
);

// функция проверки отдельно вводимиго символа в поле для ввода оценки
function checkInputValueInTable (event) {
    // проверка ввода символа для формирования оценки
    const key = String.fromCharCode(event.keyCode);
    const keyRegexGrade = new RegExp('[0-9|,]');
    const keyMathRegexGrade = keyRegexGrade.test(key);

    if (!keyMathRegexGrade) {
        event.returnValue = false;
    }

    // проверка ввода символа для выставления пропуска
    const keyRegexGap = new RegExp('[унб-]');
    const keyMathRegexGap = keyRegexGap.test(key);

    if (keyMathRegexGap) {
        changeGap(key, this.name, this.id, this.value)
    }
}   

function changeGap(key, i, id, grade) {
    if (key === '-') {
        inputTableGap[i].innerHTML = "";
        key = "";
    } else {
        inputTableGap[i].innerHTML = key;
    }
    
    const column_number = i % dates.length;
    const row_number =  Math.trunc( i / dates.length);

    const currentDateName = dates[column_number].textContent;
    const currentUserId = users[row_number].id;

    $.ajax({
        url: '../../model/vendor/update_table_gap.php',
        method: 'POST',
        dataType: 'json',
        data: {
            id: id,
            currentGap: key,
            lastGap: lastGap,
            currentGrade: grade,
            currentDateName: currentDateName,
            currentUserId: currentUserId
        },
    })
    .done(function (data) {
        console.log(data.response)
        countAverage(row_number);
    })
    .fail(function (jqXHR, textStatus, errorThrown) {
        console.log(jqXHR.responseText);
    });
}

// проверка соответствия вводимой оценки шаблону
function changeMark() {
    const i = this.name;
    const id = this.id;
    const value = this.value;
    const gap = inputTableGap[i].outerText;

    const gradeRegex = new RegExp('\\d,(?=\\d{1,2})|^\\d$|^$');
    const valueMathRegex = gradeRegex.test(value);

    if (valueMathRegex) {
        if (parseFloat(value.replace(',', '.')) < 10 || value === "") {
            executeQuery(i, id, value,gap);
        }
    }
}

// отправка запроса на изменение оценки в базе данных
function executeQuery(i, id, value, gap) {
    const column_number = i % dates.length;
    const row_number =  Math.trunc( i / dates.length);

    const currentDateName = dates[column_number].textContent;
    const currentUserId = users[row_number].id;
    
    $.ajax({
        url: '../../model/vendor/update_table_grade.php',
        method: 'POST',
        dataType: 'json',
        data: {
            id: id,
            currentGrade: value,
            lastGrade: lastGrade,
            currentGap: gap,
            currentDateName: currentDateName,
            currentUserId: currentUserId
        },
    })
    .done(function () {
        countAverage(row_number);
    })
    .fail(function (jqXHR, textStatus, errorThrown) {
        console.log(jqXHR.responseText);
    });
}

// получение значение оценки до изменения
function getCurrentValue() {
    lastGrade = this.value;
    lastGap = inputTableGap[this.name].outerText.toLowerCase();
}

// расчёт среднего значения оценки у всех студентов
function countAverageAll() {    
    for (let row = 0; row < users.length; row++) {
        gradeAvg = 0;
        gradeCount = 0;
        for (let column = 0; column < dates.length; column++) {
            const currentValue = inputTableGrade[row * dates.length + column].value.replace(',', '.');
            
            if (currentValue !== "") {
                gradeAvg += parseFloat(currentValue);
                gradeCount++;
            }
        }
        if (gradeCount !== 0) {
            const result = gradeAvg / gradeCount;
            averageValue[row].innerHTML = (Math.round((result + Number.EPSILON) * 100) / 100).toString();
        } else {
            averageValue[row].innerHTML = "";
        }
    }
}

// расчёт среднего значения оценки у определённого студента
function countAverage(row_number) {
    gradeAvg = 0;
    gradeCount = 0;

    for (let i = row_number * dates.length; i < (row_number + 1) * dates.length ; i++) {
        const currentValue = inputTableGrade[i].value.replace(',', '.');

        if (currentValue !== "") {
            gradeAvg += parseFloat(currentValue);
            gradeCount++;
        }
    }

    if (gradeCount !== 0) {
        const result = gradeAvg / gradeCount;
        averageValue[row_number].innerHTML = (Math.round((result + Number.EPSILON) * 100) / 100).toString();
    } else {
        averageValue[row_number].innerHTML = "";
    }
}
