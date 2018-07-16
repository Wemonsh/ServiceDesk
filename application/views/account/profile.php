<div class="card mt-3">
    <div class="card-header">
        <?=$user['first_name'].' '.$user['last_name'].' '.$user['middle_name']; ?>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-sm-12 col-md-4">
                <?php if ($user['photo']!=null): ?>
                    <img style="width: 200px" src="/<?=$user['photo'];?>" alt="..." class="img-thumbnail rounded mx-auto d-block">
                <?php else: ?>
                    <img style="width: 200px" src="/public/images/noavatar.png" alt="..." class="img-thumbnail rounded mx-auto d-block">
                <?php endif;?>

            </div>
            <div class="col-sm-12 col-md-8">
                <table class="table">

                    <tbody>
                    <tr>
                        <td>Email:</td>
                        <td><?=$user['email'];?></td>
                    </tr>
                    <tr>
                        <td>Логин:</td>
                        <td><?=$user['login'];?></td>
                    </tr>
                    <tr>
                        <td>Пол:</td>
                        <td><?php if ($user['gender']==1): ?>Мужчина<?php else: ?>Женщина<?php endif;?></td>
                    </tr>
                    <tr>
                        <td>Телефон:</td>
                        <td><a href="tel:<?=$user['phone'];?>"><?=$user['phone'];?></a></td>
                    </tr>
                    <tr>
                        <td>Организация:</td>
                        <td><?=$user['organization'];?></td>
                    </tr>
                    <tr>
                        <td>Отдел:</td>
                        <td><?=$user['departments'];?></td>
                    </tr>
                    <tr>
                        <td>Должность:</td>
                        <td><?=$user['positions'];?></td>
                    </tr>
                    <tr>
                        <td>Дата рождения:</td>
                        <td><?=$user['date_of_birth'];?></td>
                    </tr>
                    <tr>
                        <td>Дата регистрации:</td>
                        <td><?=$user['date_of_registration'];?></td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-4">
        <div class="card mt-3">
            <div class="card-header">
                Статистика пользователя
            </div>
            <div class="card-body">

            </div>
        </div>
    </div>
    <div class="col-8">
        <div class="card mt-3">
            <div class="card-header">
                История авторизаций
            </div>
            <div class="card-body">
                <table class="table table-sm">
                    <tbody>
                    <? foreach ($logs as $value):?>
                        <tr>
                            <td><?=$value['text']?></td>
                            <td><?=$value['date']?></td>
                            <td><?=$value['ip']?></td>
                        </tr>
                    <? endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>