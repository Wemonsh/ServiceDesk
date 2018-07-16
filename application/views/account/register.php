<script>
    $(function() {
        $("#InputTell").mask("+7(999)-999-99-99", {placeholder: " " });
    });
</script>

<h1 class="display-4">Регистрация</h1>
<p class="lead">Добро пожаловать на страницу регистрации, тут вы можете создать аккаунт если вы посетили данный
    сервис впервые, в случае если забыли пароль от учетной записи вы можете его сбросить на странице
    <a href="#">сброса пароля</a>.</p>

<form action="/account/register" method="post" enctype="multipart/form-data">
    <div class="form-row justify-content-center">
        <div class="col-4">
            <div class="form-group">
                <label for="exampleInputEmail1">Имя</label>
                <input type="text" name="first_name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Фамилия</label>
                <input type="text" name="last_name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Отчество</label>
                <input type="text" name="middle_name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
            </div>
            <div class="form-group">
                <label for="inlineFormCustomSelect">Пол</label>
                <select name="gender" class="custom-select mr-sm-2" id="inlineFormCustomSelect">
                    <option selected value="1">Мужчина</option>
                    <option value="2">Женщина</option>
                </select>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Номер телефона</label>
                <input name="phone" type="text" class="form-control" id="InputTell" aria-describedby="emailHelp" placeholder="+7(978)-000-00-00">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Дата рождения</label>
                <input name="date_of_birth" type="date" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
            </div>
            <div class="form-group">
                <label for="exampleFormControlFile1">Фотография</label>
                <input name="photo" type="file" class="form-control-file" id="exampleFormControlFile1">
            </div>
        </div>
        <div class="col-4">
            <div class="form-group">
                <label for="exampleInputEmail1">Email</label>
                <input name="email" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Логин</label>
                <input name="login" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Пароль</label>
                <input name="password" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
            </div>
            <div class="form-group">
                <label for="inlineFormCustomSelect">Организация</label>
                <select name="id_organization" class="custom-select mr-sm-2" id="inlineFormCustomSelect">
                    <?php foreach ($organization as $value): ?>
                        <option value="<?php echo $value['id']?>"><?php echo $value['name']?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <label for="inlineFormCustomSelect">Структурное подразделение</label>
                <select name="id_departments" class="custom-select mr-sm-2" id="inlineFormCustomSelect">
                    <?php foreach ($departments as $value): ?>
                        <option value="<?php echo $value['id']?>"><?php echo $value['name']?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <label for="inlineFormCustomSelect">Должность</label>
                <select name="id_positions" class="custom-select mr-sm-2" id="inlineFormCustomSelect">
                    <?php foreach ($positions as $value): ?>
                        <option value="<?php echo $value['id']?>"><?php echo $value['name']?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>
    </div>
    <div class="form-row justify-content-center">
        <div class="col-8">
            <div class="form-group">
                <div class="form-check">
                    <input name="license" class="form-check-input" type="checkbox" id="gridCheck">
                    <label class="form-check-label" for="gridCheck">
                        Нажимая кнопку "Зарегистрироваться", я принимаю условия <a href="#">Пользовательского соглашения</a>
                        и даю свое согласие Госкомрегистру на обработку моих персональных данных, в соответсвии с Федеральным законом
                        от 27.07.2006 г. №152-ФЗ "О персональных данных", на условиях и для целей, опреденных
                        <a href="#">Политикой конфиденциальности.</a>
                    </label>
                </div>
            </div>
        </div>
    </div>
    <div class="form-row justify-content-center">
        <div class="col-4">
            <button type="submit" class="btn btn-success">Зарегистрироваться</button>
            <button type="reset" class="btn btn-secondary">Очистить</button>
        </div>
        <div class="col-4"></div>
    </div>
</form>