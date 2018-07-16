<?// if (isset($_SESSION['user'])):?>
<!--<h2 class="display-4">Статистика</h2>-->
<!--<p class="lead">Добро пожаловать <a href="/account/profile/">--><?//= $_SESSION['user']['last_name'].' '.$_SESSION['user']['first_name'].' '.$_SESSION['user']['middle_name']?><!--</a>-->
<!--    вы находитесь на главной странице внутреннего портала Госкомрегистра, тут вы можете воспользоваться-->
<!--внутренними сервисами а так же, <a href="/requests/create">создать заявку</a> в отдел информационных технологий,-->
<!--    ниже приведена общая статистика по кол-ву заявок от всех пользоваетелей.</p>-->
<?// endif;?>
<h2 class="display-4">Новости</h2>
<? if (isset($_SESSION['user']) && ($_SESSION['user']['id_permission'] == 1 || $_SESSION['user']['id_permission'] == 2)): ?>
    <a class="btn btn-primary mb-3" href="/news/add">Добавить новость</a>
<? endif; ?>

<div class="row">
    <div class="col-12">
        <?php foreach ($news as $value): ?>
        <div class="card mb-3">
            <div class="card-body">
                <div class="row">
                    <div class="col-8">
                        <div class="media">
                            <img class="rounded mr-3" style="width: 200px" src="<?=$value['photo']?>" alt="Generic placeholder image">
                            <div class="media-body">
                                <h5 class="card-title"><?= $value['title']?></h5>
                                <p class="card-text"><?=$value['description']?></p>
                                <a class="card-link" href="/news/post/<?= $value['id']?>">Читать далее</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-4">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item"><i class="far fa-eye"></i> Просмотры: <?= $value['views']?></li>
                            <li class="list-group-item"><i class="far fa-calendar-alt"></i> Дата: <?= $value['date']?></li>
                            <li class="list-group-item"><i class="far fa-user"></i> Автор: <a href="/account/profile/<?=$value['id_user']?>"><?=$value['last_name'].' '.substr($value['first_name'], 0, 2).'.'.substr($value['middle_name'], 0, 2).'.'?></a>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</div>
