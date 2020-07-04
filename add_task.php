<?php
require('./utils/init.php');
$todo = unserialize($_SESSION['user']);
$input = $_POST;
$_POST = [];
if (isset($input['task']) && isset($input['user']) && isset($input['email'])) {
  $todo->add_todo($input);
  $_SESSION['user'] = serialize($todo);
}
header('Location: ./');
