<?php
require_once('./TodoList.class.php');
session_start();

if(!isset($_SESSION['user'])) {
  $todo = new TodoList();
  $todo->get_todo();
  $_SESSION['user'] = serialize($todo);
} else {
  $todo = unserialize($_SESSION['user']);
}
