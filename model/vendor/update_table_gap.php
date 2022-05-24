<?php
    require_once '../config/connect.php';
    session_start();

    $id = $_POST['id'];
    $currentGap = $_POST['currentGap'];
    $lastGap = $_POST['lastGap'];
    $currentDateName = $_POST['currentDateName'];
    $currentUserId = $_POST['currentUserId'];
    $currentGrade = $_POST['currentGrade'];

    $data['response'] = $currentGrade;



    switch ($currentGap) {
        case 'у':
            $currentGap = 1;
            break;
        case 'н':
            $currentGap = 2;
            break;
        case 'б':
            $currentGap = 3;
            break;
    }

    if ($lastGap != "" and $currentGap != "") {
        $db->updateTableGap($id, $currentGap);
    }

    if ($lastGap == "" and $currentGap != "") {
        if ($currentGrade != "") {
            $db->updateTableGap($id, $currentGap);
        } else {
            $db->insertTableGap($_SESSION['id_discepline'], $currentUserId, $currentGap, $currentDateName);
        }
    }

    if ($lastGap != "" and $currentGap == "") {
        if ($currentGrade != "") {
            $db->updateTableGap($id, 'NULL');
        } else {
            $db->deleteGradeGapRow($id);
        }
    }


    echo json_encode($data);
