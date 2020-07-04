<?php
require_once('./TodoList.class.php');
session_start();
$todo = unserialize($_SESSION['user']);
$input = $_POST;
$_POST = [];
$mix = '?login=0';
if (isset($_GET['logout'])) {
  $mes =  ['status'=> 'ok', 'message'=> 'Вы Вышли'];
  session_destroy();
  session_start();
} else if ($input['login'] && $input['password']) {
  if ($todo->auth($input)){
    $_SESSION['auth'] = true;
    $mix = '';
  }
}
$todo->set_message($mes);
$_SESSION['user'] = serialize($todo);
header('Location: ./'. $mix);
