<h1 class="display-4">Настройки аккаунта</h1>
<p class="lead">Вы находитесь на странице настроек аккаунта, на этой странице вы можете изменить свой пароль, фамилию,
    номер телефона и адресс электронный почты для отправки уведомлений</p>
<div class="row">
    <div class="col-8">
<!--        <div class="card mt-3">-->
<!--            <div class="card-header">-->
<!--                Информация-->
<!--            </div>-->
<!--            <div class="card-body">-->
<!--                <p>Изменяя данные в соглашаетесь с тем что внесенные изменения являются достоверными и вы не предоставляете-->
<!--                    ложные данные, в случае если вы данное правило нарушите, ваш профиль будет принудительно заблокирован.</p>-->
<!--                <hr>-->
<!--                <p>В случае если ваш профиль заблокирован, вам необходимо обратится в отдел информационных технологий.</p>-->
<!--            </div>-->
<!--        </div>-->
        <div class="card mt-3">
            <div class="card-header">
                Изменение пароля
            </div>
            <div class="card-body">
                <p>Для изменения пароля на на внутреннем портале, вам необходимо заполнить поле "старый пароль" своим
                    текущим паролем, а так же ввести новый пароль в поле "новый пароль" и повторить его в поле
                    "повтор пароля". Пароль должен отвечать следующим требованиям содержать не менее 8 символов и состоять
                    из больших или маленьких букв латинского алфавита, а так же содержать минимум одну цифру.</p>
                <form class="ajax" action="/account/update-password" method="post">
                    <div class="form-group">
                        <label>Введите старый пароль</label>
                        <input type="password" name="old" class="form-control" placeholder="Старый пароль">
                    </div>
                    <div class="form-group">
                        <label>Введите новый пароль</label>
                        <input type="password" name="new" class="form-control" placeholder="Новый пароль">
                    </div>
                    <div class="form-group">
                        <label>Подтвердите новый пароль</label>
                        <input type="password" name="new2" class="form-control" placeholder="Подвердите пароль">
                    </div>
                    <button type="submit" class="btn btn-primary">Сохранить</button>
                </form>
            </div>
        </div>

        <div class="card mt-3">
            <div class="card-header">
                Изменение номера телефона
            </div>
            <div class="card-body">
                <p>Для изменения номера мобильного телефона, вам необходимо ввести в поле ниже новый номер и нажать на
                кнопку сохранить. Необходимо что бы номер телефона был всегда актуальный, он необходим для связи с вами
                при создании обращения в службу технической поддержки.</p>
                <form class="ajax" action="/account/update-phone" method="post">
                    <div class="form-group">
                        <label>Номер телефона</label>
                        <input type="text" name="phone" class="form-control" value="<?=$user['phone']?>">
                    </div>
                    <button type="submit" class="btn btn-primary">Сохранить</button>
                </form>
            </div>
        </div>

        <div class="card mt-3">
            <div class="card-header">
                Изменение E-mail адреса
            </div>
            <div class="card-body">
                <p>Для изменения E-mail адреса вам необходимо в поле "E-mail" ввести новый адрес электронной почты и
                    нажать кнопку обновить, после чего уведомления перестанут приходить на старый адрес электронной
                    почты и будут приходить на новый.</p>
                <form class="ajax" action="/account/update-email" method="post">
                    <div class="form-group">
                        <label>Адрес электронной почты</label>
                        <input type="email" name="email" class="form-control" value="<?=$user['email']?>">
                    </div>
                    <button type="submit" class="btn btn-primary">Сохранить</button>
                </form>
            </div>
        </div>
    </div>
    <div class="col-4">
        <div class="card mt-3">
            <div class="card-header">
                Изменение фотографии
            </div>
            <div class="card-body">
                <?php if ($user['photo']!=null): ?>
                    <img style="width: 200px" src="/<?=$user['photo'];?>" alt="..." class="img-thumbnail rounded mx-auto d-block">
                <?php else: ?>
                    <img style="width: 200px" src="/public/images/noavatar.png" alt="..." class="img-thumbnail rounded mx-auto d-block">
                <?php endif;?>
                <hr>
                <form action="/account/update-photo" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="exampleFormControlFile1">Выберите фото для загрузки</label>
                        <input type="file" name="file" class="form-control-file" id="exampleFormControlFile1">
                    </div>
                    <button type="submit" class="btn btn-primary">Загрузить</button>
                </form>
                <hr>
                <p>Обращаем ваше внимение на то что при загрузке фото необходимо выбирать фотографию делового стиля где
                    будет видно ваше лицо, загружать картинки и фото не связанные с вами не разрешается.</p>
            </div>
        </div>
    </div>
</div>

