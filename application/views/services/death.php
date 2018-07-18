<h1 class="display-4">Поиск по БД умерших из ЗАГС'а</h1>
<p class="lead">Добро пожаловать на страницу сервиса поиска информации по базе данных загса об умерших гражданнах
    Российской Федерации, для поиска введите в поле ФИО данные человека и нажмите кнопку поиск, так же вы можете указать
    период загрузки данных в сервис.</p>

<div class="card">
    <div class="card-body">
        <form action="/services/death/search" method="post">
            <div class="row">
                <div class="col-6">
                    <div class="form-group">
                        <label for="inputEmail4">Фамилия, Имя, Отчество</label>
                        <input type="text" name="fio" class="form-control" id="formGroupExampleInput">
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-group">
                        <label for="inputEmail4">Дата загрузки</label>
                        <select name="date" class="custom-select mr-sm-2" id="inlineFormCustomSelect">
                                <option value="0" selected>Не выбрана</option>
                            <?php foreach ($category as $value): ?>
                                <option><?php echo $value['date_of_receiving']?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="col-2">
                    <div class="form-group" style="margin-top: 32px">
                        <button type="submit" class="btn btn-primary btn-block">Поиск</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<table class="table table-bordered">
    <thead>
    <tr>
        <th scope="col">#</th>
        <th scope="col">ФИО</th>
        <th scope="col">Пол</th>
        <th scope="col">Дата рождения</th>
        <th scope="col">Дата смерти</th>
        <th scope="col">Адрес</th>
    </tr>
    </thead>
    <tbody>
    <? foreach ($zags as $value):?>
        <tr>
            <td><?=$value['id']?></td>
            <td>
                <p><strong>Фамилия:</strong> <?=$value['last_name']?></p>
                <p><strong>Имя:</strong> <?=$value['first_name']?></p>
                <p><strong>Отчество:</strong> <?=$value['middle_name']?></p>
            </td>
            <td>
                <p><strong>Пол:</strong> <? if ($value['gender'] == 1){ echo "Муж";} else { echo "Жен";}?></p>
            </td>
            <td><p><?=$value['date_of_birth']?></p></td>
            <td><p><?=$value['date_of_death']?></p></td>
            <td width="350px">
                <p><? if (!empty($value['state'])){ echo "<strong>Страна: </strong>".$value['state'];}?></p>
                <p><? if (!empty($value['region'])){ echo "<strong>Регион: </strong>".$value['region'];}?></p>
                <p><? if (!empty($value['district'])){ echo "<strong>Округ: </strong>".$value['district'];}?></p>
                <p><? if (!empty($value['city'])){ echo "<strong>Город: </strong>".$value['city'];}?></p>
                <p><? if (!empty($value['locality'])){ echo "<strong>Поселок: </strong>".$value['locality'];}?></p>
                <p><? if (!empty($value['type'])){ echo "<strong>Тип: </strong>".$value['type'];}?></p>
            </td>
        </tr>
        <p></p>
    <? endforeach;?>
    </tbody>
</table>


<?=$pagination?>

