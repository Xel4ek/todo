<form method="POST" action="./add_task.php" id="new__todo" class="new__task">
  <div class="task__info">
    <input
      required
      type="text"
      name="user"
      class="task__name"
      placeholder="Имя"
      autocomplete="disabled"
      maxlength="36"

    />
    <input
      required
      type="email"
      name="email"
      class="task__email"
      placeholder="Email"
      autocomplete="disabled"
      maxlength="36"
    />
  </div>
  <textarea required class="textarea" name="task"></textarea>
  <button class="button add__todo" type="submit">Добавить задачу</button>
</form>
