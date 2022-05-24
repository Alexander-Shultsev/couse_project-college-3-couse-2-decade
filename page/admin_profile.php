<?php
session_start();
$_SESSION['current_page'] = "Изменение данных пользователя";

$id_user = $_GET['id_user'];
$type_user = $_GET['type_user'];

require_once '../model/config/connect.php';
?>

<div class="header_no_margin">
    <!-- Шапка -->
    <?php require_once '../component/header.php' ?>

    <main class="change-user grid w100">
        <section class="main_info flex fl-d-c ai-c c_main_light">
            <form action="../model/vendor/update_user.php" method="post">
                <p class="title">Основная информация</p>
                <?php if($type_user == 'Студент'): ?>
                    <?php $user = $db->getStudent($id_user)[0]; ?>
                <?php else: ?>
                    <?php $user = $db->getTeacher($id_user)[0]; ?>
                <?php endif; ?>
                <input type="hidden" name="id_user" value="<?=$id_user?>">
                <input type="hidden" name="type_user" value="<?=$type_user?>">
                <div class="change-user__elem">
                    <p>Фамилия</p>
                    <input name="last_name" value="<?=$user['last_name']?>" type="text">
                </div>
                <div class="change-user__elem">
                    <p>Имя</p>
                    <input name="first_name" value="<?=$user['first_name']?>" type="text">
                </div>
                <div class="change-user__elem">
                    <p>Отчество</p>
                    <input name="patronomic" value="<?=$user['patronomic']?>" type="text">
                </div>
                <?php if($type_user == 'Студент'): ?>
                    <div class="change-user__elem">
                        <p>Группа</p>
                        <select name="group">
                            <?php $group = $db->getGroup(); ?>
                            <?php foreach ($group as $group_item): ?>
                                <?php if ($user['name_group'] == $group_item['name_group']): ?>
                                    <option selected name="" value="<?= $group_item['id_group'] ?>"><?= $group_item['name_group'] ?></option>
                                <?php else: ?>
                                    <option value="<?= $group_item['id_group'] ?>"><?= $group_item['name_group'] ?></option>
                                <?php endif; ?>
                            <?php endforeach ?>
                        </select>
                    </div>
                <?php endif; ?>
                <span class="main_info_m"></span>
                <button class="admin-button c_main" type="submit" name="action" value="update">Сохранить</button>
                <button class="admin-button c_red" type="submit" name="action" value="delete">Удалить</button>
            </form>
        </section>

        <section class="additional_info">
            <p class="title">Карточка студента</p>
            <?php if($type_user == 'Преподаватель'): ?>
            <form action="" method="">
                <div class="additional_info__name flex">
                    <p class="title">Группы и дисциплины</p>
                    <span class="button-add c_green">Добавить</span>
                </div>
                <div class="flex">
                    <select name="group_name">
                        <option value="student">9901</option>
                        <option value="teacher">9903</option>
                    </select>
                    <select name="discepline_name">
                        <option value="student">Технология разработки и защиты баз данных</option>
                        <option value="teacher">Технология разработки и защиты баз данных</option>
                    </select>
                </div>
                <div class="flex">
                    <select name="group_name">
                        <option value="student">9901</option>
                        <option value="teacher">9903</option>
                    </select>
                    <select name="discepline_name">
                        <option value="student">Технология разработки и защиты баз данных</option>
                        <option value="teacher">Технология разработки и защиты баз данных</option>
                    </select>
                </div>
                <input class="admin-button c_main" type="submit" value="Сохранить">
            </form>
            <?php endif; ?>
        </section>
    </main>

</div>
</body>
</html>