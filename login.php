<?php
require_once('./TodoList.class.php');
session_start();
$input = json_decode(file_get_contents('php://input'));
if ($input->logout) {
  session_destroy();
  echo json_encode(['status'=> 'ok', 'message'=> 'Вы вышли']);
  exit;
}
if ($input->login && $input->password) {
$user = 'root';
$pass = "VBH!%^104vbh";
$con = new mysqli('localhost', $user, $pass, 'beejee');
$sql = "SELECT `user_pass`
FROM `beejee`.`users`
WHERE `user_name`='" . $input->login. "'";

$pass = $con->query($sql);
if ($pass && $pass->fetch_row()[0] === $input->password) {
  $_SESSION['auth'] = true;
  $mes =  ['status'=> 'ok', 'message'=> 'Вы Вошли'];
} else {
  $mes = ['status'=> 'error', 'message' => 'Неверный пароль или имя пользователя'];
}
echo json_encode($mes);
}
