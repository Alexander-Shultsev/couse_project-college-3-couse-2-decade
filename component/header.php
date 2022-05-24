<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?= $_SESSION['current_page'] ?></title>
  <link rel="stylesheet" href="../assets/style/page.css">
</head>
<body>

<header>
    <div class="header__inner container-progress">
        <div class="header__logo">
            <img src="../assets/img/logo.png" alt="">
            <h1>Журнал PRO</h1>
        </div>

        <h2><?= $_SESSION['current_page'] ?></h2>
    </div>
</header>
