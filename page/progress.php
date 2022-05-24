<?php 
    session_start();
    $_SESSION['current_page'] = "Успеваемость";
    require_once '../model/config/connect.php';

    $group = array(
        "id" => $_POST['id_group'],
        "name" => $_POST['name_group']
    );

    $discepline = [
        "id" => $_POST['id_discepline'],
        "name" => $_POST['name_discepline']
    ];

    $_SESSION['id_discepline'] = $discepline['id'];

    $table = $db->getTableGradeGap($discepline['id']);
    if ($table != null) {
        $date = array_keys($table[0]);

        for($row = 0; $row < count($table); $row++) {
            for($column = 1; $column < count($table[0]); $column++) {
                $value = $table[$row][$date[$column]];
                if ($value == "") $table[$row][$date[$column]] = "...";
                $table[$row][$date[$column]] = explode('.', $table[$row][$date[$column]]);
            }
        }
    }
?>

<!-- Шапка -->
<?php require_once '../component/header.php' ?>

<svg style="display: none;">
<symbol id="left-arrow" viewBox="0 0 492 492">
  <g>
    <path d="M198.608,246.104L382.664,62.04c5.068-5.056,7.856-11.816,7.856-19.024c0-7.212-2.788-13.968-7.856-19.032l-16.128-16.12
            C361.476,2.792,354.712,0,347.504,0s-13.964,2.792-19.028,7.864L109.328,227.008c-5.084,5.08-7.868,11.868-7.848,19.084
            c-0.02,7.248,2.76,14.028,7.848,19.112l218.944,218.932c5.064,5.072,11.82,7.864,19.032,7.864c7.208,0,13.964-2.792,19.032-7.864
            l16.124-16.12c10.492-10.492,10.492-27.572,0-38.06L198.608,246.104z" />
  </g>
</symbol>
</svg>

<!-- Общая информация -->
<section class="container-progress">
  <section class="about__group">
    <?php if($_SESSION['type_user'] == 'student'): ?>
        <a class="back" href="navigation_student.php">
            <svg class="left-arrow">
                <use xlink:href="#left-arrow"></use>
            </svg>
        </a>
    <?php else: ?>
        <a class="back" href="navigation_teacher.php">
            <svg class="left-arrow">
                <use xlink:href="#left-arrow"></use>
            </svg>
        </a>
    <?php endif; ?>
    <div class="number__group">
        <p><?= $group['name'] ?></p>
    </div>
    <!-- <div class="number__group"> -->
        <p><?= $discepline['name'] ?></p>
    <!-- </div> -->
  </section>


  <!-- Таблица -->
  <?php if ($table != null): ?>
  <section class="container-progress progress-table">
    <table class="content">
      <thead>
        <tr>
          <th colspan="2" rowspan="2"></th>
            <?php for ($i = 2; $i < count($table[0]); $i++): ?>
                <th class="DATE_NAME"><?= $date[$i] ?></th>
            <?php endfor;  ?>
          <th class="average" rowspan="2">Ит<br>ог</th>
        </tr>
      </thead>

      <tbody>
        <?php $elem = -1; ?>
        <?php for ($row = 0; $row < count($table); $row++) { ?>
        <tr>
          <td><?= $row+1 ?></td>
          <td class="USER_NAME" id="<?= $table[$row]['id_student'] ?>"><?= $table[$row]['user_name'][0] ?></td>
          <?php $gradeAvg = 0; $count = 0; ?>
          <?php for ($column = 2; $column < count($table[0]); $column++) { ?>
              <?php
                $elem++;
                $idGradeGap = $table[$row][$date[$column]][0];
                $grade = $table[$row][$date[$column]][1];
                $gap = $table[$row][$date[$column]][2];
              ?>
             <td class="input">
               <p class="input__gap"><?= $gap ?></p>
		<?php if ($_SESSION['type_user'] == 'teacher'): ?>
               		<input type="text" class="input__mark" name="<?= $elem ?>" value="<?= $grade ?>" id="<?= $idGradeGap ?>" maxlength="4">
		<?php else: ?>
			<input readonly type="text" class="input__mark" name="<?= $elem ?>" value="<?= $grade ?>" id="<?= $idGradeGap ?>" maxlength="4">
		<?php endif; ?>
             </td>
          <?php } ?>
          <td class="GRADE_AVG"></td>
        </tr>
        <?php } ?>
      </tbody>
    </table>
  </section>
  <?php endif; ?>
</section>
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script type="text/javascript" src="../assets/script/main.js"></script>
</body>
</html>
