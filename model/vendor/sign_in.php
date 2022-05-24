<?php
    session_start();
    require_once "../config/connect.php";

    $login = $_POST['login'];
    $password = $_POST['password'];

    $singin = false;

    if(!empty($login)) {
        if(!empty($password)) {
            $password = hash('sha256', $password);
            $data = $db->signIn($login, $password);

            if ($data != NULL) {
                $fk_student = $data[0]['fk_student'];
                $fk_teacher = $data[0]['fk_teacher'];
                $fk_department_head = $data[0]['fk_department_head'];
            
                if ($fk_student != null) {
                    $_SESSION['id_user'] = $fk_student;
                    $_SESSION['type_user']  = 'student';
                    header("Location: ../../page/navigation_student.php");
                }
            
                if ($fk_teacher != null) {
                    $_SESSION['id_user'] = $fk_teacher;
                    $_SESSION['type_user']  = 'teacher';
                    header("Location: ../../page/navigation_teacher.php");
                }
            
                if ($fk_department_head != null) {
                    $_SESSION['id_user'] = $fk_department_head;
                    $_SESSION['type_user']  = 'department_head';
                    header("Location: ../../page/admin.php");
                }
                $singin = true;
            } else {
                $_SESSION['error-message'] = "Неправильный логин или пароль";
            }
        } else {
            $_SESSION['error-message'] = "Введите пароль";
        }
    } else {
        $_SESSION['error-message'] = "Введите логин";
    }

    if (!$singin) {
        header("Location: /");
    }
?>