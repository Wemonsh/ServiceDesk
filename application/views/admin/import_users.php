<h1 class="display-4">Импорт пользователей из CVC файла</h1>
<p class="lead">Добро пожаловать на страницу результата импорта, добавлено <?=$count-1?> пользователей, данную страницу необходимо
    распечатать и передать пользователям, пароли в открытом виде доступны только на этой странице, в базе пароли хранятся в зашифрованном виде.</p>
<table class="table table-bordered">
    <thead>
    <tr>
        <th>Пользователь</th>
        <th>Логин</th>
        <th>Пароль</th>
        <th>Телефон</th>
    </tr>
    </thead>
    <tbody>
    <?foreach ($users as $value):?>
        <tr>
            <td><?=$value['last_name'].' '.$value['first_name'].' '.$value['middle_name']?></td>
            <td><?=$value['login']?></td>
            <td><?=$value['password']?></td>
            <td><?=$value['phone']?></td>
        </tr>
    <?endforeach;?>
    </tbody>
</table>