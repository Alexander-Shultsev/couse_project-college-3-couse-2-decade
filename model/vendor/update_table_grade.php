<?php
    require_once '../config/connect.php';
    session_start();

    $id = $_POST['id'];
    $currentGrade = $_POST['currentGrade'];
    $lastGrade = $_POST['lastGrade'];
    $currentDateName = $_POST['currentDateName'];
    $currentUserId = $_POST['currentUserId'];
    $currentGap = $_POST['currentGap'];

    // обновление оценки
    if ($lastGrade != "" and $currentGrade != "") {
        $db->updateTableGrade($id, $currentGrade);
    }

    // добавление оценки
    if ($lastGrade == "" and $currentGrade != "") {
        if ($currentGap != "") {
            $db->updateTableGrade($id, $currentGrade);
        } else {
            $db->insertTableGrade($_SESSION['id_discepline'], $currentUserId, $currentGrade, $currentDateName);
        }
    }

    // удаление оценки
    if ($lastGrade != "" and $currentGrade == "") {
        if ($currentGap != "") {
            $db->updateTableGrade($id, 'NULL');
        } else {
            $db->deleteGradeGapRow($id);
        }
    }

    $data['response']  = $id;
    echo json_encode($data);