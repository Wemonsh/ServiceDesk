<h1 class="display-4">Мои заявки</h1>
<p class="lead">Добро пожаловать на страницу ваших зявок, на этой странице вы можете увидеть все свои открытые заявки на данный момент,
что бы создать заявку передите на страницу <a href="/requests/create">создания заявки</a>.</p>


<table class="table table-bordered table-hover">
    <thead>
        <tr>
            <th>Статус</th>
            <th>Содержимое заявки</th>
            <th>Пользователь</th>
            <th>Оператор</th>
        </tr>
    </thead>
    <tbody>
        <? foreach ($requests as $value):?>
        <tr>
            <td width="100px">
                <p><strong>ID:</strong> <span class="badge badge-info"><?= $value['id']?></span></p>
                <p>
                <? if ($value['id_statuses'] == 1):?>
                    <span class="badge badge-primary">Открыта</span>
                <? elseif ($value['id_statuses'] == 2):?>
                    <span class="badge badge-danger">Закрыта</span>
                <? elseif ($value['id_statuses'] == 3):?>
                    <span class="badge badge-warning">В работе</span>
                <? elseif ($value['id_statuses'] == 4):?>
                    <span class="badge badge-secondary">Заморожена</span>
                <? endif;?>
                </p>
            </td>
            <td>
                <p><strong>Тема:</strong> <?= $value['title']?></p>
                <p><strong>Описание:</strong> <?= $value['description']?></p>
                <p><strong>Категория:</strong> <?= $value['name']?></p>
                <?if(isset($value['file'])):?>
                    <? $file = explode('/', $value['file'])?>
                    <p><strong>Файл:</strong>
                        <a download href="/<?=$value['file']?>">
                            <?if(isset($file[3])):?>
                                <?=$file[3]?>
                            <?else:?>
                                <?=$file[2]?>
                            <?endif;?>
                        </a>
                    </p>
                <?endif;?>

                <?  if (!empty($value['comment'])):?>
                <hr>
                <p><strong>Комментарий:</strong><?=$value['comment']?></p>
                <? endif;?>
            </td>
            <td width="200px">
                <p><a href="/account/profile/<?=$value['user_id']?>"><?=$value['last_name'].' '.substr($value['first_name'], 0, 2).'.'.substr($value['middle_name'], 0, 2).'.'?></a></p>
                <p><?=$value['ip']?></p>
                <p><?=$value['phone']?></p>
            </td>
            <td width="200px"></td>
        </tr>
        <? endforeach;?>
    </tbody>
</table>

