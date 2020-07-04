<?php
session_start();
$todo = unserialize($_SESSION['user']);
?>
<div class="order">
  <a href="?order=user">
    <div class="radio__label <?php if ($todo->order === 'user') echo "active";?>">
    Имя
    </div>
  </a>
  <a href="?order=email">
    <div class="radio__label <?php if ($todo->order === 'email') echo "active";?>">
    Email
    </div>
  </a>
  <a href="?order=status">
    <div class="radio__label <?php if ($todo->order === 'status') echo "active";?>">
    Выполнена
    </div>
  </a>
  <a href="?direct=update">
    <div class="radio__label sort__order">
      <?php if($todo->direct) {
        echo "По убыванию";
      } else {
        echo "По возрастанию";
      } ?>
      </div>
  </a>
  <div class="log">
    <?php if(!isset($_SESSION['auth'])):?>
      <a href="?login=1">
    <div class="auth">Войти</div>
    </a>
    <?php else:?>
      <a href="./auth.php?logout">
    <div class="auth">Выйти</div>
    </a>
    <?php endif;?>
  </div>
</div>
