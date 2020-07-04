<?php
class TodoList {
  private $con;
  private $user = 'RootBeeJee';
  private $pass = '~0jrpusWTWdP*8q}';
  private $db_name = 'xel4ek';
  private $list = [];
  private $order = 'user';
  private $direct = true;
  private $page = 0;
  private $message = null;
  private $todo_count = 0;
  private $login = 0;
  private $current_page = 0;
  public function __construct() {
    $this->con = new mysqli('localhost', $this->user, $this->pass, $this->db_name);
    $sql = "CREATE TABLE IF NOT EXISTS `xel4ek`.`todolist` (
      `id` INT NOT NULL AUTO_INCREMENT ,
      `email` VARCHAR(128) NOT NULL ,
      `user` VARCHAR(128) NOT NULL,
      `task` TEXT NOT NULL ,
      `update` BOOLEAN NOT NULL DEFAULT FALSE,
      `status` BOOLEAN NOT NULL DEFAULT FALSE ,
      PRIMARY KEY (`id`)) ENGINE = InnoDB";
    $this->con->query($sql);
    $sql = "SELECT COUNT(`id`) FROM `xel4ek`.`todolist`";
    $result = $this->con->query($sql);
    $this->todo_count =  +$result->fetch_row()[0];
    $this->page = intval(ceil($this->todo_count / 3));
    $this->con->close();
  }
  private function init(){}

  private function connect () {
    $this->con = new mysqli('localhost', $this->user, $this->pass,'xel4ek');
  }
  public function add_todo($todo) {
    $mes = $this->validate_form($todo);
    if(!empty($mes)) {
      $this->message = ['status' => 'error', 'message' => 'Необходим заполнить:' . join(', ', $mes)];
      return;
    }
    $task = $this->con->real_escape_string($todo['task']);
    $user = $this->con->real_escape_string($todo['user']);
    $email = $this->con->real_escape_string($todo['email']);
    $sql = "INSERT INTO `todolist` (`email`, `user`, `task`)
    VALUES ('$email','$user','$task')";
    $this->connect();
    $this->con->query($sql);
    if( $this->con->error) {
      $this->message = ['status' => 'error', 'message' => "Ошибка базы данных"];
    } else {
      $this->message = ['status' => 'ok', 'message' => 'Задача Добавлениа'];
      $this->todo_count++;
      $this->page = intval(ceil($this->todo_count / 3));
      $this->con->close();
      $this->get_todo();
    }
  }
  public function edit_todo($data) {
    $this->connect();
    $updated = $this->task_update($data);
    $status = isset($data['status']) ? '1': '0';
    $task = $this->con->real_escape_string($data['task']);
    $sql = "UPDATE `todolist`
    SET `task` = '$task', `status` = '$status', `update` = '$updated' WHERE `id`= '{$data['id']}'";
    $this->con->query($sql);
    if ($this->con->error){
      $this->message = ['status' => 'error', 'message' => 'Ошибка базы данных'];
    } else {
      $this->message = ['status' => 'ok', 'message' => 'Задача Сохранена'];
    }
  }
  public function get_todo() {
    $this->connect();
    $direct = $this->direct ? 'DESC' : 'ASC';
    $sql = "SELECT `email`, `user`, `task`, `status`, `id`, `update`
    FROM `xel4ek`.`todolist`
    ORDER BY `".$this->order."` " . $direct ."
    LIMIT " . $this->current_page * 3 .", 3";
    $result = $this->con->query($sql);
    if ($this->con->error){
      $this->message = ['status' => 'error', 'message' => 'Ошибка базы данных'];
    } else {
      $this->list = $result->fetch_all(MYSQLI_ASSOC);
    }
    $this->con->close();
  }
  public function todo_list() {
    include('./view/list.php');
  }
  public function __get($name) {
    if ($name === 'login' ||
    $name === 'page' ||
    $name === 'current_page' ||
    $name === 'direct' ||
    $name === 'order' ||
    $name === 'message') {
      return $this->$name;
    } else {
      return null;
    }
  }
  public function controller($get){
    foreach($get as $action => $value) {
      if(isset($this->$action)){
        if($action === 'direct') {
          $this->direct = !$this->direct;
        } else {
        $this->$action = $value;
        }
      }
    }
    $this->get_todo();
  }
  public function set_message($mes) {
    $this->message = $mes;
  }
  public function set_page($page) {
    $this->current_page = $page;
  }
  private function task_update($data) {
    $task = null;
    $updated = '0';
    foreach($this->list as $index => $entry) {
      if ($entry['id'] === $data['id']){
        $task = $entry['task'];
        $updated = $entry['update'];
      }
    }
    if ($data['task'] === $task && $updated === '0'){
      return 0;
    }
  return 1;
  }
  private function validate_form($data){
    $mix = [];
    if ('' === trim($data['user'])){
      $mix[] = 'Имя пользователя';
    }
    if ('' === trim($data['email'])){
      $mix[] =  'Email';
    }
    if ('' === trim($data['task'])){
      $mix[] =  'Поле задачи';
    }
    return $mix;
  }
  public function auth($input){
    if(trim($input['login']) && trim($input['password'])) {
      $con = new mysqli('localhost', $this->user, $this->pass, 'xel4ek');
      $sql = "SELECT `user_pass`
      FROM `xel4ek`.`users`
      WHERE `user_name`='" . $input["login"]. "'";
      $pass = $con->query($sql);
      if ($pass && $pass->fetch_row()[0] === $input["password"]) {
        $this->message =  ['status'=> 'ok', 'message'=> 'Вы Вошли'];
        return true;
      } else {
        $this->message = ['status'=> 'error', 'message' => 'Неверный пароль или имя пользователя'];
      }
    }
    return false;
  }
}
