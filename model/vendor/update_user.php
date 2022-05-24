<?php
    session_start();
    require_once "../config/connect.php";

    $action = $_POST['action'];
    $idUser = $_POST['id_user'];
    $firstName = $_POST['first_name'];
    $lastName = $_POST['last_name'];
    $patronomic = $_POST['patronomic'];
    $typeUser = $_POST['type_user'];
    echo $typeUser;

    if (isset($_POST['group'])) {
        $group = $_POST['group'];
    }

    if ($action == 'update') {
        if ($typeUser == 'Студент') {
            $db->updateStudent($idUser, $firstName, $lastName, $patronomic, $group);
        }
        if ($typeUser == 'Преподаватель') {
            $db->updateTeacher($idUser, $firstName, $lastName, $patronomic);
        }
        echo "<script>history.go(-1);</script>";
    }

    if ($action == 'delete') {
        if ($typeUser == 'Студент') {
            $db->deleteStudent($idUser);
        }
        if ($typeUser == 'Преподаватель') {
            $db->deleteTeacher($idUser);
        }

        echo "<script>history.go(-2);</script>";
    }


//
//    $singin = false;
//
//    if(!empty($login)) {
//        if(!empty($password)) {
//            $password = hash('sha256', $password);
//            $data = $db->signIn($login, $password);
//
//            if ($data != NULL) {
//                $fk_student = $data[0]['fk_student'];
//                $fk_teacher = $data[0]['fk_teacher'];
//                $fk_department_head = $data[0]['fk_department_head'];
//
//                if ($fk_student != null) {
//                    $_SESSION['id_user'] = $fk_student;
//                    $_SESSION['type_user']  = 'student';
//                    header("Location: ../../page/navigation_student.php");
//                }
//
//                if ($fk_teacher != null) {
//                    $_SESSION['id_user'] = $fk_teacher;
//                    $_SESSION['type_user']  = 'teacher';
//                    header("Location: ../../page/navigation_teacher.php");
//                }
//
//                if ($fk_department_head != null) {
//                    $_SESSION['id_user'] = $fk_department_head;
//                    $_SESSION['type_user']  = 'department_head';
//                    header("Location: ../../page/admin.php");
//                }
//                $singin = true;
//            } else {
//                $_SESSION['error-message'] = "Неправильный логин или пароль";
//            }
//        } else {
//            $_SESSION['error-message'] = "Введите пароль";
//        }
//    } else {
//        $_SESSION['error-message'] = "Введите логин";
//    }
//
//    if (!$singin) {
//        header("Location: /");
//    }
?>