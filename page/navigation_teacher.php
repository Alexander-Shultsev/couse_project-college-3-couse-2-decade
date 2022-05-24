<?php 
  session_start();
  $_SESSION['current_page'] = "Выбор группы";
  require_once '../model/config/connect.php';
?>

<!-- Шапка -->
<?php require_once '../component/header.php' ?>

<!-- Преподаватель -->
<div class="navigation teacher">

  <?php
    $group = $db->getTeacherGroup($_SESSION['id_user']);

    $discepline_data = [];

    for ($i=0; $i < count($group); $i++) { 
      for ($j=0; $j < count($discepline_data); $j++) { 
        if ($group[$i]["name_discepline"] == $discepline_data[$j]["name_discepline"]) {
          goto a;
        }
      }
      $discepline_data[] = $group[$i];
      a:
    }
  ?>
  
  <?php foreach($discepline_data as $discepline_item) { ?>
    <section class="disceplines">
      <div class="container-progress">
        <p class="disceplines__title"><?= $discepline_item['name_discepline'] ?></p>

        <div class="group">
          <?php foreach($group as $group_item) { ?>
            <?php if ($group_item['id_discepline'] == $discepline_item['id_discepline']) { ?>
              <form action="progress.php" method="post">
                <input class="hide" name="id_discepline" value="<?= $discepline_item['id_discepline'] ?>" type="hidden">
                <input class="hide" name="name_discepline" value="<?= $discepline_item['name_discepline'] ?>" type="hidden">

                <input class="hide" name="id_group" value="<?= $group_item['id_group'] ?>" type="hidden">
                <input class="hide" name="name_group" value="<?= $group_item['name_group'] ?>" type="hidden">
                <input class="group__item" value="<?= $group_item['name_group'] ?>" type="submit">
              </form>
            <?php } ?>
          <?php } ?>
        </div>
      </div>
    </section>
  <?php } ?>
</div>

</body>
</html>
