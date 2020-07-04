<?php
require_once('./TodoList.class.php');
session_start();
require('./utils/init.php');
require('./login.php');
$todo = unserialize($_SESSION['user']);
$todo->controller($_GET);
$_SESSION['user']= serialize($todo);
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>To do or not to do</title>
    <link
      rel="stylesheet"
      href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"
      integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk"
      crossorigin="anonymous"
    />
    <link rel="stylesheet" href="./index.css?t=87979" />
  </head>
  <body>
    <div class="wrapper"> <div class="todo__list">
      <?php include ('./view/header.php');
        $todo->todo_list();
        include('./add_form.php');
        include('./pagination.php')
      ?>
      </div>
      <?php $todo = unserialize($_SESSION['user']);
      if($todo->message) :?>
        <div class="message <?php echo $todo->message['status'] === 'ok' ? 'green' : 'red'; ?>">
          <?php echo $todo->message['message'] ?></div>
      <?php endif;
      $todo->set_message(null);
      $_SESSION['user'] = serialize($todo);
      ?>
<?php
  if ($todo->login === '1' && !isset($_SESSION['auth'])) {
    include('./view/login.php');
    }?>
  </body>
</html>
