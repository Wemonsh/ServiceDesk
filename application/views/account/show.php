<h1 class="display-4">Список пользователей</h1>
<p class="lead">Добро пожаловать на страницу пользоваетелей, на этой странице вы можете посмотреть профили зарегистрированных
    пользователей, а так же посмотреть есть ли у вас учетная запись на портале или нет.</p>
<table class="table table-hover mt-3">
    <thead>
    <tr>
        <th scope="col" colspan="2">Пользователь</th>
        <th scope="col">Организация</th>
        <th scope="col">Отдел</th>
        <th scope="col">Должность</th>
    </tr>
    </thead>
    <tbody>

<?php foreach ($users as $item):?>
    <tr>
        <th scope="row">
            <?php if ($item['photo']!=null): ?>
                <img style="width: 40px" src="/<?=$item['photo'];?>" alt="..." class="rounded mx-auto d-block">
            <?php else: ?>
                <img style="width: 40px" src="/public/images/noavatar.png" alt="..." class="rounded mx-auto d-block">
            <?php endif;?>
        </th>
        <td><a href="/account/profile/<?=$item['id'];?>"><?=$item['first_name'].' '.$item['last_name'].' '.$item['middle_name'];?></a></td>
        <td><?=$item['organization'];?></td>
        <td><?=$item['departments'];?></td>
        <td><?=$item['positions'];?></td>
    </tr>
<?php endforeach; ?>

    </tbody>
</table>