<?php

class DB
{
    private $db;

    function __construct(string $host, string $username, string $password, string $database)
    {
        $this->db = new mysqli($host, $username, $password, $database);
    }


    // Общие //
    // выполнение запроса с возвращением результата
    function execute(string $sql)
    {
        $result = $this->db->query($sql)->fetch_all(MYSQLI_ASSOC);
        $this->db->next_result();
        return $result;
    }

    // выполнение запроса без результата
    function executeNull(string $sql)
    {
        $this->db->query($sql);
        $this->db->next_result();
    }


    // Авторизация //
    function signIn(string $login, string $password)
    {
        return $this->execute("call signIn('$login', '$password')");
    }


    //  Навигация по группам / дисцеплинам //
    // получить информацию о дисциплинах и группах преподавателя
    function getTeacherGroup(int $id_teacher)
    {
        return $this->execute("call getTeacherGroup($id_teacher)");
    }

    // получить информацию о группе студента
    function getStudentGroup(int $id_student)
    {
        return $this->execute("call getStudentGroup($id_student)");
    }

    // получить информацию о дисциплинах студента
    function getStudentDiscepline(int $id_student)
    {
        return $this->execute("call getStudentDiscepline($id_student)");
    }


    // Вывод даных в таблицу //
    // получить информацию о студентах группы
    function getGroupStudent(int $id_group)
    {
        return $this->execute("call getGroupStudent($id_group)");
    }

    // получить данные таблицы
    function getTableGradeGap(int $id_group)
    {
        return $this->execute("call getTableGradeGap($id_group)");
    }


    // Изменение оценки //
    // обновить оценку
    function updateTableGrade(string $id_grade_gap, string $grade)
    {
        if ($grade == 'NULL') {
            $this->executeNull("call updateTableGrade($id_grade_gap, NULL)");
        } else {
            $this->executeNull("call updateTableGrade($id_grade_gap, '$grade')");
        }
    }

    // добавить оценку
    function insertTableGrade(string $id_discepline, string $id_student, string $grade, string $date)
    {
        $this->executeNull("call insertTableGrade($id_discepline, $id_student, '$grade', '$date')");
    }

    // удалить оценку или пропуск
    function deleteGradeGapRow(int $id_grade_gap)
    {
        $this->executeNull("call deleteGradeGapRow($id_grade_gap)");
    }

        
    // Изменение пропуска //
    // обновить пропуск
    function updateTableGap(string $id_grade_gap, string $gap)
    {
        $this->executeNull("call updateTableGap($id_grade_gap, $gap)");
    }

    // добавить пропуск
    function insertTableGap(string $id_discepline, string $id_student, string $fkGap, string $date)
    {
        $this->executeNull("call insertTableGap($id_discepline, $id_student, $fkGap, '$date')");
    }


    // Вывод данных в таблицу админимстратора //
    // Получить всех студентов и преподавателей
    function getStudentAndTeacher()
    {
        return $this->execute("call getStudentAndTeacher()");
    }

    // Получить все группы
    function getGroup()
    {
        return $this->execute("call getGroup()");
    }

    // Получить все дисциплины
    function getDiscepline()
    {
        return $this->execute("call getDiscepline()");
    }

    // Получить все типы пропусков
    function getGap()
    {
        return $this->execute("call getGap()");
    }

    // Страница изменения профиля студента
    // Получить инфорацию о студенте
    function getStudent(string $id_student)
    {
        return $this->execute("call getStudent($id_student)");
    }

    // Изменить информацию о студенте
    function updateStudent(string $id_student, string $first_name, string $last_name, string $patronomic, string $fk_group)
    {
        $this->executeNull("call updateStudent($id_student, '$first_name', '$last_name', '$patronomic', $fk_group)");
    }

    // Удалить студента
    function deleteStudent(string $id_student)
    {
        $this->executeNull("call deleteStudent($id_student)");
    }

    // Получить информацию о преподавателе
    function getTeacher(string $id_teacher)
    {
        return $this->execute("call getTeacher($id_teacher)");
    }

    // Обновить информацию о студентах
    function updateTeacher(string $id_teacher, string $first_name, string $last_name, string $patronomic)
    {
        $this->executeNull("call updateTeacher($id_teacher, '$first_name', '$last_name', '$patronomic')");
    }

    // Удалить преподавателя
    function deleteTeacher(string $id_teacher)
    {
        $this->executeNull("call deleteTeacher($id_teacher)");
    }
}