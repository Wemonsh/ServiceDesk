<h1 class="display-4">Информация</h1>

<p class="lead">Добро пожаловать на страницу информации, тут вы можете ознакомиться с методическими материалами, найти
    необходимые документы воспользовавшись поиском, а так же просмотреть доступные <a href="#">видеоуроки</a> по интересующей вас теме,
    так же в разделе <a href="#">софт</a> находятся актуальные версии програмного обеспечения. Кол-во документов в системе - <strong><?=$count?></strong>.</p>

<? if (isset($_SESSION['user']) && ($_SESSION['user']['id_permission'] == 1 || $_SESSION['user']['id_permission'] == 2)): ?>
    <div class="btn-group">
        <a class="btn btn-primary mb-3" href="/information/add"><i class="far fa-plus-square"></i> Добавить</a>
        <a class="btn btn-primary mb-3" href="/information/add"><i class="far fa-edit"></i> Редактировать</a>
    </div>
<? endif; ?>

<div class="row">
    <div class="col-12">

        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Категории</h5>
                <ol class="category">
                <? foreach ($category as $value):?>
                    <li><?=$value['name']?> <span class="badge badge-secondary"><?=$value['count']?></span></li>
                <? endforeach; ?>
                </ol>
                <hr>
                <form action="/information/search" method="post">
                    <div class="row">
                        <div class="col-6">
                                <input type="text" name="text" class="form-control" id="formGroupExampleInput">
                        </div>
                        <div class="col-4">
                            <select name="id" class="custom-select mr-sm-2" id="inlineFormCustomSelect">
                                <?php foreach ($category as $value): ?>
                                    <option value="<?php echo $value['id_category']?>"><?php echo $value['name']?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-2">
                            <button type="submit" class="btn btn-primary btn-block">Поиск</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
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
            <td><?=$value['title']?>
                <hr>
                <p><strong>Категория:</strong> <?=$value['category'].' - '.$value['subcategory']?></p>
                <p><strong>Файл:</strong> <a href="/<?=$value['file']?>"><?=mb_strimwidth($value['file_name'],0,100, "...")?></a></p>
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
    </div>
</div>

<?= $pagination?>






