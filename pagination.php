<?php
require_once('./TodoList.class.php');
session_start();
$todo = unserialize($_SESSION['user']); ?>
<div class="pagination">
  <?php for($i = 0; $i < $todo->page; ++$i):
    $active = +$todo->current_page === $i?>
    <a href="<?php echo $active ? "#":"./?current_page=". $i;?>">
    <div class="page<?php echo $active ? ' active' : '';?>">
    <?php echo $i + 1; ?>
  </div>
  </a>
  <?php endfor; ?>
</div>
