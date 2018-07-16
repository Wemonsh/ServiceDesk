<h1 class="display-4">Завершенные заявки</h1>
<ul class="nav nav-tabs">
    <li class="nav-item">
        <a class="nav-link" href="/requests/all">Все заявки </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="/requests/open">Открытые</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="/requests/inwork">В работе</a>
    </li>
    <li class="nav-item">
        <a class="nav-link active" href="/requests/closed">Завершенные <span class="badge badge-secondary"><?=$requests_count?></span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="/requests/frozen">Замороженные</a>
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
        <th class="align-middle text-center" scope="col">Ответственный</th>
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
            <td class=" text-center" style="width: 50px">
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
            <td class="align-middle text-center" style="width: 30px">
                <? if($value['uo_id'] != null):?>
                    <a href="/account/profile/<?=$value['uo_id']?>"><?=$value['operator_last_name'].' '.substr($value['operator_first_name'], 0, 2).'. '.substr($value['operator_middle_name'], 0, 2).'.'?></a>
                <? else: ?>
                    <p>Не назначен</p><p><a href="/requests/get/<?=$value['id']?>"><i class="fas fa-briefcase"></i> В работу</a></p>
                <? endif;?>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
