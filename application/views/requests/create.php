<h1 class="display-4">Создание заявки</h1>
<p class="lead">Добро пожаловать на страницу создания заявки, тут вы можете создать заявку отделу информационных технологий,
    для решения следующих категорий вопросов указанных в информации о сервисе. Так же перед созданием заявки рекомендуем вам
    посмотреть раздел <a href="#">информация</a> где описаны решения частых проблем.</p>
<form class="ajax" method="post" enctype="multipart/form-data" action="/requests/create">
    <div class="row">
        <div class="col-8">
            <div class="form-group">
                <label for="inputEmail4">Тема</label>
                <input type="text" name="title" class="form-control" id="inputEmail4">
            </div>
            <div class="row">
                <div class="col-6">
                    <label for="exampleFormControlSelect1">Категория</label>
                    <select class="form-control" name="category" id="exampleFormControlSelect1">
                        <?foreach ($category as $value):?>
                            <option value="<?=$value['id']?>"><?=$value['name']?></option>
                        <?endforeach;?>
                    </select>
                </div>
                <div class="col-6">
                    <label for="exampleFormControlSelect1">Приоритет</label>
                    <select class="form-control" name="priority" id="exampleFormControlSelect1">
                        <option value="1">Высокий</option>
                        <option value="2" selected="selected">Обычный</option>
                        <option value="3">Низкий</option>
                    </select>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-12">
                    <div class="form-group">
                        <label for="exampleFormControlTextarea1">Описание</label>
                        <textarea class="form-control" name="description" id="exampleFormControlTextarea1" rows="3"></textarea>
                    </div>
                </div>
                <?php if (!empty($_SESSION['user']) && $_SESSION['user']['id_permission'] == 1): ?>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="exampleFormControlSelect1">Ответственный</label>
                            <select class="form-control" name="id_operator" id="exampleFormControlSelect1">
                                <?foreach ($operators as $value):?>
                                    <option value="<?=$value['id']?>"><?=$value['last_name'].' '.$value['first_name'].' '.$value['middle_name']?></option>
                                <?endforeach;?>
                            </select>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="inputEmail4">Срок</label>
                            <input type="date" name="date_of_planned" class="form-control" id="inputEmail4">
                        </div>
                    </div>
                <?php endif; ?>
                <div class="col-12">
                    <div class="form-group">
                        <label for="exampleFormControlFile1">Добавить файл</label>
                        <input type="file" name="file" class="form-control-file" id="exampleFormControlFile1">
                    </div>
                    <button type="submit" class="btn btn-primary">Создать</button>
                </div>
            </div>
        </div>


        <div class="col-4">
            <div class="form-group">
                <label for="inputEmail4">ID</label>
                <input type="text" name="user" class="form-control" value="<?=$user['id']; ?>" id="inputEmail4" disabled>
            </div>
            <div class="form-group">
                <label for="inputEmail4">Телефон</label>
                <input type="text" class="form-control" value="<?=$user['phone'];?>" disabled>
            </div>
            <div class="form-group">
                <label for="inputEmail4">Организация</label>
                <input type="text" class="form-control" value="<?=$user['organization'];?>" disabled>
            </div>
            <div class="form-group">
                <label for="inputEmail4">Отдел</label>
                <input type="text" class="form-control" value="<?=$user['departments'];?>" disabled>
            </div>
            <div class="form-group">
                <label for="inputEmail4">Должность</label>
                <input type="text" class="form-control" value="<?=$user['positions'];?>" disabled>
            </div>
        </div>
    </div>
</form>