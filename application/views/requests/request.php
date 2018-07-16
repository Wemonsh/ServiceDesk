<h1 class="display-4">Заявка #<?=$request['id']?></h1>
<div class="card mt-3">
    <div class="card-body">
        <div class="row">
            <div class="col-6">
                <h2>Информация</h2>
                <p>Категория: <?=$request['category']?></p>
                <p>Статус:
                    <? if ($request['id_statuses'] == 1):?>
                        <span class="badge badge-success">Открыта</span>
                    <? elseif ($request['id_statuses'] == 2):?>
                        <span class="badge badge-danger">Закрыта</span>
                    <? elseif ($request['id_statuses'] == 3):?>
                        <span class="badge badge-warning">В работе</span>
                    <? elseif ($request['id_statuses'] == 4):?>
                        <span class="badge badge-secondary">Заморожена</span>
                    <? endif;?>
                </p>
                <p>Приоритет:
                    <? if ($request['priority'] == 1):?>
                        <span class="badge badge-danger">Высокий</span>
                    <? elseif ($request['priority'] == 2):?>
                        <span class="badge badge-warning">Обычный</span>
                    <? elseif ($request['priority'] == 3):?>
                        <span class="badge badge-primary">Низкий</span>
                    <? endif;?>
                </p>
                <p>Тема: <?=$request['title']?></p>
                <p>Описание: <?=$request['description']?></p>
                <p>Дата открытия: <?=$request['date_of_creation']?></p>
                <p>Дата закрытия: <?=$request['date_of_closing']?></p>
                <?if(isset($request['file'])):?>
                    <? $file = explode('/', $request['file'])?>
                    <p>Загруженный файл:
                        <a download href="/<?=$request['file']?>">
                            <?if(isset($file[3])):?>
                                <?=$file[3]?>
                            <?else:?>
                                <?=$file[2]?>
                            <?endif;?>
                        </a>
                    </p>
                <?endif;?>
                
            </div>

            <div class="col-3">
                <h2>Сотрудник</h2>
                <p>ФИО: <a href="/account/profile/<?=$request['u_id']?>"><?=$request['user_last_name'].' '.$request['user_first_name'].' '.$request['user_middle_name']?></a></p>
                <p>Организация: <?=$request['organization']?></p>
                <p>Отдел: <?=$request['department']?></p>
                <p>Должность: <?=$request['positions']?></p>
                <p>Телефон: <?=$request['phone']?></p>
                <p>IP адрес: <?=$request['ip']?></p>
            </div>
            <div class="col-3">
                <h2>Оператор</h2>
                <p>ФИО: <a href="/account/profile/<?=$request['uo_id']?>"><?=$request['operator_last_name'].' '.$request['operator_first_name'].' '.$request['operator_middle_name']?></a></p>
                <p>Организация: <?=$request['operator_organization']?></p>
                <p>Отдел: <?=$request['operator_department']?></p>
                <p>Должность: <?=$request['operator_positions']?></p>
            </div>

        <? if (!empty($log)):?>
            <div class="col-12">
                <h2>История заявки</h2>

                <table class="table table-bordered">
                    <tbody>
                    <? foreach ($log as $value):?>
                        <tr>
                            <td><?=$value['date']?></td>
                            <td><?=$value['text']?></td>
                            <td style="width: 150px">
                                <a href="/account/profile/<?=$value['id']?>"><?=$value['last_name'].' '.substr($value['first_name'], 0, 2).'.'.substr($value['middle_name'], 0, 2).'.'?></a>
                            </td>
                        </tr>
                    <? endforeach;?>
                    </tbody>
                </table>
            </div>
        <? endif; ?>
            <div class="col-12">

            <? if ($request['comment'] != null):?>
                <h2>Комментарий</h2>
                <div class="card mt-3">
                    <div class="card-body">
                        <p><?=$request['comment']?></p>
                    </div>
                </div>
            <? endif;?>

            <? if ($request['id_statuses'] == 3 && $request['uo_id'] == $_SESSION['user']['id']):?>
                <div class="card mt-3">
                    <div class="card-body">
                        <form action="/requests/send/<?=$request['id']?>" method="post" style="margin: 0px;">
                            <div class="form-group">
                                <label for="exampleFormControlTextarea1">Оставить комментарий</label>
                                <textarea class="form-control" name="message" id="exampleFormControlTextarea1" rows="6"></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary mb-2">Завершить заявку</button>
                        </form>
                    </div>
                </div>
            <?endif;?>
            </div>


        </div>
    </div>
</div>

