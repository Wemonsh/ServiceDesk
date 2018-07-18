<h1 class="display-4">Сброс пароля</h1>
<p class="lead">Добро пожаловать на страницу сброса пароля, для сброса пароля укажите в поле Email ваш адрес электронной
почты который вы указали при регистрации аккаунта в системе. После чего вам на почту придет новый временный пароль который
необходимо будет изменить в настрока аккаунта.</p>
<form action="/account/reset" method="post">
    <div class="form-row justify-content-center">
        <div class="col-4">
            <div class="form-group">
                <label for="exampleInputEmail1">Email</label>
                <input type="email" name="email" class="form-control" id="exampleInputEmail1">
            </div>
            <button type="submit" class="btn btn-success">Сбросить</button>
        </div>
    </div>
</form>