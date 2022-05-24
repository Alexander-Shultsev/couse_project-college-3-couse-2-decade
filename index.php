<?php
    session_start();
    $_SESSION['current_page'] = "Журнал PRO";
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset = "utf-8">
    <title><?= $_SESSION['current_page'] ?></title>
    <link rel ="stylesheet" href ="assets/style/page.css">

    <!-- <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@500;700&display=swap" rel="stylesheet"> -->
</head>
<body>
    <section class="all">
        <aside class="about">
            <img src="assets/img/logo.png">
            <div class="text">
                <h1>Журнал PRO</h1>
            </div>
        </aside>
        <form class="autotization" action="model/vendor/sign_in.php" method="post">
            <h2>Авторизация</h2>

            <div class="textbox_area">  
                <input type="text" placeholder="Логин" name="login">
                <input type="password" placeholder="Пароль" name="password">
            </div>

            <? if (isset($_SESSION['error-message'])) { ?>
                <p class="error-message"><?= $_SESSION['error-message'] ?></p>
            <? } ?>
            
            <input class="sing-in center" type="submit" value="Войти"/>
        </form>
    </section>
</body>
</html>