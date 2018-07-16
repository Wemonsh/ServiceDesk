<h1 class="display-4">Телефонный справочник</h1>
<p class="lead">Добро пожаловать на страницу телефонного справочника, на этой странице вы можете найти номера телефонов сотрудников
    для этого вам необходимо в полях ниже ввести ФИО человека (можно не полностью), выбрать отдел и нажать кнопку поиск.</p>
<div class="card mt-3">
    <div class="card-header">
        Телефонный справочник
    </div>
    <div class="card-body">
        <form action="/account/phones" method="post">
            <div class="row">
                <div class="col-6">
                    <input type="text" name="fio" class="form-control" id="formGroupExampleInput" placeholder="Иванов Иван Иванович">
                </div>
                <div class="col-4">
                    <select name="id" class="custom-select mr-sm-2" id="inlineFormCustomSelect">
                        <?php foreach ($departments as $value): ?>
                            <option value="<?php echo $value['id']?>"><?php echo $value['name']?></option>
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

<? if(isset($users) && !empty($users)):?>
    <table class="table table-bordered mt-3">
        <thead>
            <tr>
                <th>ID</th>
                <th>ФИО</th>
                <th>Должность</th>
                <th>Телефон</th>
            </tr>
        </thead>
        <tbody>
            <?foreach ($users as $value):?>
                <tr>
                    <td><?=$value['id']?></td>
                    <td><a href="/account/profile/<?=$value['id']?>"><?=$value['last_name'].' '.$value['first_name'].' '.$value['middle_name']?></a></td>
                    <td><?=$value['positions']?></td>
                    <td><a href="tel:<?=$value['phone'];?>"><?=$value['phone'];?></a></td>
                </tr>
            <?endforeach;?>
        </tbody>
    </table>
<?elseif(isset($users) && empty($users)):?>

    <div class="alert alert-info mt-3" role="alert">
        По вашему запросу в телефонном справочнике не найден не один сотрудник, можете выбрать поиск по отделу или ввести ФИО другого сотрудника,
        либо пользователь еще не прошел регистрацию на внутреннем портале.
    </div>

<? endif;?>
