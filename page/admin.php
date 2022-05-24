<?php
session_start();
$_SESSION['current_page'] = "Админ панель";
require_once '../model/config/connect.php';
?>

<!-- Шапка -->
<?php require_once '../component/header.php' ?>

<div class="admin">
    <div class="container-admin">

        <!-- Навигация по таблицам -->
        <section class="nav">
            <a href="#user" class="nav__tab active" >Пользователи</a>
            <a href="#group" class="nav__tab" >Группы</a>
            <a href="#discepline" class="nav__tab" >Дисциплины</a>
            <a href="#gapType" class="nav__tab">Типы пропусков</a>
        </section>

        <!-- Таблицы -->
        <!-- Пользователи -->
        <section class="table-content active" id="user">
            <div class="grid grid-col-user row-title">
                <p>ФИО</p>
                <p>Тип</p>
                <p>Группа</p>
            </div>
            <?php $userData = $db->getStudentAndTeacher(); ?>
            <?php foreach ($userData as $user): ?>
                <div class="grid grid-col-user">
                    <a href="admin_profile.php?type_user=<?=$user['type_user']?>&id_user=<?=$user['id_user']?>"><?= $user['name_user'] ?></a>
                    <p class="user-type"><?= $user['type_user'] ?></p>
                    <p><?= $user['name_group'] ?></p>
                </div>
            <?php endforeach; ?>
        </section>

        <!-- Группы -->
        <section class="table-content" id="group">
            <div class="grid grid-col-1 row-title">
                <p>Номер группы</p>
            </div>

            <?php $groupData = $db->getGroup(); ?>
            <?php foreach ($groupData as $group): ?>
                <div class="grid grid-col-1">
                    <p ><?= $group['name_group'] ?></p>
                </div>
            <?php endforeach; ?>
        </section>

        <!-- Дисциплины -->
        <section class="table-content" id="discepline">
            <div class="grid grid-col-1 row-title">
                <p>Название дисциплины</p>
            </div>

            <?php $disceplineData = $db->getDiscepline(); ?>
            <?php foreach ($disceplineData as $discepline): ?>
                <div class="grid grid-col-1">
                    <p ><?= $discepline['name_discepline'] ?></p>
                </div>
            <?php endforeach; ?>
        </section>

        <!-- Тип пропуска -->
        <section class="table-content" id="gapType">
            <div class="grid grid-col-1 row-title">
                <p>Тип пропуска</p>
            </div>

            <?php $gapData = $db->getGap(); ?>
            <?php foreach ($gapData as $gap): ?>
                <div class="grid grid-col-1 col-">
                    <p ><?= $gap['name_gap'] ?></p>
                </div>
            <?php endforeach; ?>
        </section>
    </div>
</div>

<script src="../assets/script/main.js"></script>

</body>
</html>
