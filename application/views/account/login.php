<h1 class="display-4">Авторизация</h1>
<p class="lead">Добро пожаловать на страницу авторизации, тут вы можете осуществить вход в свой аккаунт, в случае если вы посетили данный
    сервис впервые вам необходимо пройти регистрацию, в случае если забыли пароль от учетной записи вы можете его сбросить на странице
    <a href="/account/reset">сброса пароля</a>.</p>

<form class="ajax" action="/account/login" method="post">
    <div class="form-row justify-content-center">
        <div class="col-4">
            <div class="form-group">
                <label for="exampleInputEmail1">Логин</label>
                <input type="text" name="login" class="form-control" id="exampleInputEmail1">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Пароль</label>
                <input type="password" name="password" class="form-control" id="exampleInputPassword1">
            </div>
            <div class="form-group">
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="exampleCheck1">
                    <label class="form-check-label" for="exampleCheck1">Запомнить меня</label>
                </div>
            </div>
            <button type="submit" class="btn btn-success">Вход</button>
            <button type="reset" class="btn btn-secondary">Очистить</button>
        </div>
    </div>
</form>

