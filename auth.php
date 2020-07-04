<?php
require_once('./TodoList.class.php');
session_start();
$todo = unserialize($_SESSION['user']);
$input = $_POST;
$_POST = [];
$mix = '?login=0';
if (isset($_GET['logout'])) {
  $todo->set_message(['status'=> 'ok', 'message'=> 'Вы Вышли']);
  session_destroy();
  session_start();
} else if ($input['login'] && $input['password']) {
  if ($todo->auth($input)){
    $_SESSION['auth'] = true;
    $mix = '';
  }
}
$_SESSION['user'] = serialize($todo);
header('Location: ./'. $mix);
