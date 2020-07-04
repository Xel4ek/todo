<?php
require_once('./TodoList.class.php');
session_start();
$todo = unserialize($_SESSION['user']);
$input = array_merge($_POST, $_GET);
$_POST = [];
if($_SESSION['auth']) {
  $todo->edit_todo($input);
  $_SESSION['user'] = serialize($todo);
  header('Location: ./');
} else {
  header('Location: ./?login=1');
}

