<h1 class="display-4">Принятые заявки</h1>
<ul class="nav nav-tabs">
    <li class="nav-item">
        <a class="nav-link active" href="/requests/my_in_work">В работе <span class="badge badge-secondary"><?=$requests_count?></span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="/requests/my_frozen">Замороженные</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="/requests/my_closed">Завершенные</a>
    </li>
</ul>

<table class="table table-bordered table-sm mt-3">
    <thead>
    <tr>
        <th class="align-middle text-center" scope="col">#</th>
        <th class="align-middle text-center" scope="col">Обращение</th>
        <th class="align-middle text-center" scope="col">Пользователь</th>
        <th class="align-middle text-center" scope="col">Дата открытия /<br> закрытия заявки</th>
        <th class="align-middle text-center" scope="col">Статус</th>
        <th class="align-middle text-center" scope="col">Приоритет</th>
        <th class="align-middle text-center" scope="col">Действия</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($requests as $value): ?>
        <tr>
            <td class="text-center" style="width: 50px"><p><a href="/requests/request/<?=$value['id']?>"><?=$value['id']?></a></p></td>
            <td style="width: 250px"><p>Тема: <?=$value['title']?></p> <p>Категория: <?=$value['name']?></p></td>
            <td class="text-center">
                <p><a href="/account/profile/<?=$value['u_id']?>"><?=$value['user_last_name'].' '.substr($value['user_first_name'], 0, 2).'. '.substr($value['user_middle_name'], 0, 2).'.'?></a></p>
                <p><?=$value['ip']?></p>
            </td>
            <td class=" text-center">
                <p><?=$value['date_of_creation']?></p>
                <?if($value['date_of_closing'] != null):?><p><?=$value['date_of_closing']?></p><?else:?><p></p>-</p><?endif;?>
            </td>
            <td class="align-middle text-center" style="width: 50px">
                <? if ($value['id_statuses'] == 1):?>
                    <span class="badge badge-success">Открыта</span>
                <? elseif ($value['id_statuses'] == 2):?>
                    <span class="badge badge-danger">Закрыта</span>
                <? elseif ($value['id_statuses'] == 3):?>
                    <span class="badge badge-warning">В работе</span>
                <? elseif ($value['id_statuses'] == 4):?>
                    <span class="badge badge-secondary">Заморожена</span>
                <? endif;?>
            </td>
            <td class="align-middle text-center">
                <? if ($value['priority'] == 1):?>
                    <span class="badge badge-danger">Высокий</span>
                <? elseif ($value['priority'] == 2):?>
                    <span class="badge badge-warning">Обычный</span>
                <? elseif ($value['priority'] == 3):?>
                    <span class="badge badge-primary">Низкий</span>
                <? endif;?>
            </td>
            <td class="align-middle text-center" style="width: 50px">
                <p><a href="/requests/back/<?=$value['id']?>"><i data-toggle="tooltip" data-placement="top" title="Вернуть" style="font-size: 30px" class="fas fa-arrow-circle-left"></i></a>
                    <a href="/requests/froze/<?=$value['id']?>"><i data-toggle="tooltip" data-placement="top" title="Заморозить" style="font-size: 30px" class="fas fa-pause-circle text-secondary"></i></a>
                    <a href="/requests/request/<?=$value['id']?>"><i data-toggle="tooltip" data-placement="top" title="Завершить" style="font-size: 30px" class="fas fa-times-circle text-danger"></i></a></p>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>

<?= $pagination?>