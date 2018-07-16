<h1 class="display-4">Поиск</h1>

<p class="lead">Добро пожаловать на страницу поиска вы осуществили поиск по запросу <strong><?=$text?></strong>. Так же вы можете
    изменить данные поиска вернувшись на страницу <a href="/information/list">поиска</a> информации</p>


<table class="table table-bordered mt-3">
    <thead>
    <tr>
        <th>#</th>
        <th>Название / Категория</th>
        <th>Пользователь</th>
    </tr>
    </thead>
    <tbody>
    <?foreach ($information as $value):?>
        <tr>
            <td><?=$value['id']?></td>
            <td><?=str_replace($text, '<mark>'.$text.'</mark>', $value['title'])?>
                <hr>
                <p><strong>Категория:</strong> <?=$value['category'].' - '.$value['subcategory']?></p>
                <p><strong>Файл:</strong> <a href="/<?=$value['file']?>"><?=$str = substr($value['file_name'],0,200)?></a></p>
            </td>
            <td style="width: 150px">
                <a href="/account/profile/<?=$value['id_user']?>"><?=$value['last_name'].' '.substr($value['first_name'], 0, 2).'. '.substr($value['middle_name'], 0, 2).'.'?></a>
                <hr>
                <?=$value['date']?>
            </td>
        </tr>
    <?endforeach;?>

    </tbody>
</table>