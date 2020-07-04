<?php
session_start();
$auth = isset($_SESSION['auth']);
if ($auth) :?>
  <?php foreach($this->list as $task): ?>
    <form action="./edit_task.php?id=<?php echo $task['id']?>" method="POST" type="submit" class="form">
    <div class="list__item">
      <div class="task__info">
  <?php if($task['update']):?> <div class="comment">отредактировано администратором</div> <?php endif;?>
      <div class="task__name"><?php echo htmlspecialchars($task['user'])?></div>
        <div class="task__email"><?php echo htmlspecialchars($task['email'])?></div>
        <input name="status"type="checkbox" class="input__status" id="<?php echo $task['id']?>"
        <?php echo $task['status'] ? 'checked': '';?>/>
        <label for="<?php echo $task['id']?>" class="status" ></label>
      </div>
      <textarea name="task" required class="task__text"><?php echo htmlspecialchars($task['task']);?></textarea>
    </div>
    <input type="submit" value="Сохранить" class="save button">
  </form>
  <?php endforeach; else: ?>
  <?php foreach($this->list as $task): ?>
    <div class="list__item">
      <div class="task__info">
      <?php if($task['update']):?> <div class="comment">отредактировано администратором</div> <?php endif;?>
        <div class="task__name"><?php echo htmlspecialchars($task['user'])?></div>
        <div class="task__email"><?php echo htmlspecialchars($task['email'])?></div>
        <input disabled type="checkbox" class="input__status"id="<?php echo $task['id']?>"<?php echo $task['status'] ? 'checked': '';?>/>
        <label for="<?php echo $task['id']?>" class="status"></label>
      </div>
      <div class="task__text"> <?php echo htmlspecialchars($task['task'])?></div></div>
  <?php endforeach; endif; ?>

