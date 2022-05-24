<?php 
  session_start();
  $_SESSION['current_page'] = "Выбор дисциплины";
  require_once '../model/config/connect.php';

  $group = $db->getStudentGroup($_SESSION['id_user']);
?>

<!-- Шапка -->
<?php require_once '../component/header.php' ?>

<!-- Студент -->
<div class="navigation student container-progress">
  <?php $discepline = $db->getStudentDiscepline($_SESSION['id_user']); ?>
  <?php foreach($discepline as $discepline_item): ?>
    <form action="progress.php" method="post">
      <input name="name_group" value="<?= $group[0]['name_group'] ?>" type="hidden">
      <input name="id_group" value="<?= $group[0]['id_group'] ?>" type="hidden">

      <input name="id_discepline" value="<?= $discepline_item['id_discepline'] ?>" type="hidden">
      <input name="name_discepline" value="<?= $discepline_item['name_discepline'] ?>" type="hidden">
      <input class="disceplines__item" value="<?= $discepline_item['name_discepline'] ?>" type="submit">
    </form>
  <?php endforeach; ?>
</div>

</body>
</html>
