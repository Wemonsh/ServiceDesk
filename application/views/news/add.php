<h1>Добавить новость</h1>

<form class="ajax" action="/news/add" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="exampleFormControlInput1">Название</label>
        <input type="text" name="title" class="form-control" id="exampleFormControlInput1" >
    </div>
    <div class="form-group">
        <label for="exampleFormControlTextarea1">Краткое описание</label>
        <textarea class="form-control" name="description" id="exampleFormControlTextarea1" rows="3"></textarea>
        <small class="form-text text-muted">Краткое описание новости отображается только на главной странице, длина краткого описания не должна привышать 300 символов.</small>
    </div>
    <div class="form-group">
        <label for="exampleFormControlTextarea1">Полный текст новости</label>
        <textarea class="form-control" name="text" id="exampleFormControlTextarea1" rows="3"></textarea>
    </div>
    <div class="form-group">
        <label for="exampleFormControlFile1">Фото новости</label>
        <input type="file" name="photo" class="form-control-file" id="exampleFormControlFile1">
        <small class="form-text text-muted">Если хотите добавить новость со стандартным изображением оставьте это поле пустым.</small>
    </div>
    <hr>
    <div class="row">
        <div class="col-6">
            <div class="form-group">
                <label for="exampleFormControlInput1">Название первого файла</label>
                <input type="text" name="file_one_name" class="form-control" id="exampleFormControlInput1" >
                <small class="form-text text-muted">Для того что бы ссылка на просмотр файла была с текстом необходимо заполнить поле слева, в противном случае файл будет назван автоматически.</small>
            </div>
        </div>
        <div class="col-6">
            <div class="form-group">
                <label for="exampleFormControlFile1">Загрузить</label>
                <input type="file" name="file_one" class="form-control-file" id="exampleFormControlFile1">
                <small class="form-text text-muted">Доступные форматы файла для загрузки ".doc, .xls, .pdf, .ods, .zip", так же файл не должен привышать размер в 30 мб.</small>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-6">
            <div class="form-group">
                <label for="exampleFormControlInput1">Название второго файла</label>
                <input type="text" name="file_two_name" class="form-control" id="exampleFormControlInput1" >
                <small class="form-text text-muted">Для того что бы ссылка на просмотр файла была с текстом необходимо заполнить поле слева, в противном случае файл будет назван автоматически.</small>
            </div>
        </div>
        <div class="col-6">
            <div class="form-group">
                <label for="exampleFormControlFile1">Загрузить</label>
                <input type="file" name="file_two" class="form-control-file" id="exampleFormControlFile1">
                <small class="form-text text-muted">Доступные форматы файла для загрузки ".doc, .xls, .pdf, .ods, .zip", так же файл не должен привышать размер в 30 мб.</small>
            </div>
        </div>
    </div>
    <button type="submit" class="btn btn-primary">Сохранить</button>
</form>