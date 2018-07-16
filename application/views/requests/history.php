<h1 class="display-4">История</h1>
<table class="table table-bordered">
    <thead>
        <tr>
            <th>Заявка</th>
            <th>Дата и время</th>
            <th>Действие</th>
            <th>Оператор</th>
        </tr>
    </thead>
    <tbody>
    <? foreach ($log as $value):?>
        <tr>
            <td style="width: 120px"><a href="/requests/request/<?=$value['id_request']?>">Заявка №<?=$value['id_request']?></a></td>
            <td style="width: 180px"></tdstyle> <?=$value['date']?></td>
            <td><?=$value['text']?></td>
            <td style="width: 150px">
                <a href="/account/profile/<?=$value['id']?>"><?=$value['last_name'].' '.substr($value['first_name'], 0, 2).'.'.substr($value['middle_name'], 0, 2).'.'?></a>
            </td>
        </tr>
    <? endforeach;?>
    </tbody>
</table>

<?= $pagination?>