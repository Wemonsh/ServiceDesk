<h1>Добавить информация</h1>

<form class="ajax" action="/information/add" method="post">
    <div class="row">
        <div class="col-12">
            <div class="form-group">
                <label for="exampleFormControlInput1">Название</label>
                <input name="title" type="text" class="form-control" id="exampleFormControlInput1">
                <small class="form-text text-muted">Название будет отображаться в общем списке информации, оно не должно привышать более 255 символов</small>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-6">
            <div class="form-group">
                <label for="exampleFormControlSelect1">Категория</label>
                <select name="category" class="form-control" id="category">
                    <? foreach ($category as $value):?>
                        <option value="<?=$value['id']?>"><?=$value['name']?></option>
                    <? endforeach;?>
                </select>
                <small class="form-text text-muted">При загрузке информации необходимо указать категорию и подкатегорию к которой относится файл</small>
            </div>
        </div>
        <div class="col-6">
            <div class="form-group">
                <label for="exampleFormControlSelect1">Подкатегория</label>
                <select name="subcategory" class="form-control" id="subcategory">
                </select>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-6">
            <div class="form-group">
                <label for="exampleFormControlInput1">Название файла</label>
                <input type="text" name="file_name" class="form-control" id="exampleFormControlInput1" >
                <small class="form-text text-muted">Для того что бы ссылка на просмотр файла была с текстом необходимо заполнить поле слева, в противном случае файл будет назван автоматически.</small>
            </div>
        </div>
        <div class="col-6">
            <div class="form-group">
                <label for="exampleFormControlFile1">Загрузить</label>
                <input type="file" name="file" class="form-control-file" id="exampleFormControlFile1">
                <small class="form-text text-muted">Доступные форматы файла для загрузки ".doc, .xls, .pdf, .ods, .zip", так же файл не должен привышать размер в 30 мб.</small>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <button type="submit" class="btn btn-primary">Сохранить</button>
        </div>
    </div>
</form>

<script>
    var years = ['2014', '2015', '2016', '2017', '2018', '2019'];
    var type = ['Кадастровый учет', 'Регистрация права'];
    var soft = ['ПК ПВД', 'АИС ГКН', 'АИС Юстиция', 'ФГИС ЕГРН', 'СЭД Диалог', 'АСОГ', 'СУФД'];

    $( document ).ready(function() {
        for (var i = 0; i< years.length; i++) {
            $("#subcategory").append( $('<option>'+ years[i] +'</option>'));
        }
    });

    $( "#category" ).change(function() {
        $( "#category option:selected" ).each(function() {
            if ($(this).val() == 1 || $(this).val() == 2 || $(this).val() == 3 || $(this).val() == 5 || $(this).val() == 6) {
                $("#subcategory").empty();
                for (var i = 0; i< years.length; i++) {
                    $("#subcategory").append( $('<option>'+ years[i] +'</option>'));
                }
            } else if ($(this).val() == 4) {
                $("#subcategory").empty();
                for (var i = 0; i< type.length; i++) {
                    $("#subcategory").append( $('<option>'+ type[i] +'</option>'));
                }
            } else if ($(this).val() == 7 || $(this).val() == 8) {
                $("#subcategory").empty();
                for (var i = 0; i< soft.length; i++) {
                    $("#subcategory").append( $('<option>'+ soft[i] +'</option>'));
                }
            }
        });

    });
</script>



<!--<h1>Добавить информацию</h1>-->
<!--<form>-->
<!--    <div class="row">-->
<!--        <div class="col-12">-->

<!--            <div class="form-group">-->
<!--                <label for="exampleFormControlSelect1">Категория</label>-->
<!--                <select class="form-control" id="exampleFormControlSelect1">-->
<!--                    <option>1</option>-->
<!--                    <option>2</option>-->
<!--                </select>-->
<!--            </div>-->
<!--        </div>-->
<!--        <div class="col-6">-->
<!--            <div class="form-group">-->
<!--                <label for="exampleFormControlSelect1"></label>-->
<!--                <select class="form-control" id="exampleFormControlSelect1">-->
<!--                    <option>1</option>-->
<!--                    <option>2</option>-->
<!--                </select>-->
<!--            </div>-->
<!--        </div>-->
<!--        </div>-->
<!--        <div class="col-6">-->
<!--            <div class="form-group">-->
<!--                <label for="exampleFormControlSelect1">Категория</label>-->
<!--                <select class="form-control" id="exampleFormControlSelect1">-->
<!--                    <option>1</option>-->
<!--                    <option>2</option>-->
<!--                </select>-->
<!--            </div>-->
<!--        </div>-->
<!--        </div>-->
<!--    </div>-->

<!--
<!--</form>-->