<h1 class="display-4">Результаты поиска</h1>
<p class="lead">Добро пожаловать на страницу поиска вы осуществили поиск по запросу <strong><?=$text?></strong>. Так же вы можете
    изменить данные поиска вернувшись на страницу <a href="/services/death">поиска</a> информации</p>

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