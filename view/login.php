<div class="login__wrapper">
        <div class="login__body">
          <div class="title">
            Login
          </div>
          <form action="./auth.php" id="login" method="POST">
            <div class="item">
              Login
              <input
                required
                type="text"
                name="login"
                size="25"
                maxlength="25"
                class="input"
              />
            </div>
            <div class="item">
              Password
              <input
                required
                type="password"
                name="password"
                size="25"
                class="input"
              />
            </div>
            <div class="button">
              <input type="submit" , value="Войти" />
            </div>
            <a href="./?login=0">
            <div class="button">
              Отмена
            </div>
            </a>
          </form>
        </div>
      </div>
    </div>
