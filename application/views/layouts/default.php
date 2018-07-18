<html>
<head>
    <meta charset="UTF-8">
    <title><?php echo $title; ?></title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">

    <script src="/public/scripts/jquery.js"></script>
    <script src="/public/scripts/maskedinput.js"></script>
    <script src="/public/scripts/form.js"></script>
    <link rel="stylesheet" href="/public/styles/fontawesome.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="/public/styles/style.css">


    <script>
        $(function () {
            $('[data-toggle="tooltip"]').tooltip()
        })
    </script>

</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
        <a class="navbar-brand" href="/">
            <img src="/public/images/logo.png" width="30" height="30" class="d-inline-block align-top" alt="">
            АСОЗ
        </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarText">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="far fa-file-alt"></i> Заявки</a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="/requests/create"><i class="fas fa-plus-square"></i> Новая заявка</a>
                    <a class="dropdown-item" href="/requests/my"><i class="fas fa-th-list"></i> Мои заявки</a>

                    <?php if (!empty($_SESSION['user']) && $_SESSION['user']['id_permission'] == 1): ?>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="/requests/all"><i class="fas fa-table"></i> Все заявки</a>
                        <a class="dropdown-item" href="/requests/my_in_work"><i class="fas fa-check-square"></i> Принятые</a>
                        <a class="dropdown-item" href="/requests/history"><i class="fas fa-history"></i> История</a>
                        <a class="dropdown-item" href="/requests/statistics"><i class="fas fa-chart-bar"></i> Статистика</a>
                    <?php endif; ?>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/account/phones"><i class="fas fa-mobile-alt"></i> Тел. справочник</a>
            </li>

            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-cogs"></i> Сервисы</a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
<!--                    <a class="dropdown-item" href="#">Поиск по базе данных ЕНОТ</a>-->
                    <a class="dropdown-item" href="/services/death">Поиск по БД умерших из ЗАГС'а</a>
<!--                    <a class="dropdown-item" href="#">Поиск по объектам из постановление 2085</a>-->
<!--                    <a class="dropdown-item" href="#">Поиск в 100 метровой зоне</a>-->
<!--                    <a class="dropdown-item" href="#">Список "Сигналы предупреждения"</a>-->
<!--                    <a class="dropdown-item" href="#">Поиск "Сигналы предупреждения"</a>-->
                </div>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="/information/list"><i class="fas fa-info"></i> Информация</a>
            </li>


<!--            <li class="nav-item">-->
<!--                <a class="nav-link" href="/account/login">Отделы</a>-->
<!--            </li>-->
<!--            <li class="nav-item">-->
<!--                <a class="nav-link" href="/account/login">Информация</a>-->
<!--            </li>-->
        </ul>
        <?php if (!empty($_SESSION['user'])): ?>
            <ul class="navbar-nav">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <?php echo $_SESSION['user']['last_name'].' '.$_SESSION['user']['first_name'].' '.$_SESSION['user']['middle_name'] ?>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="/account/profile"><i class="fas fa-user"></i> Профиль</a>
                        <a class="dropdown-item" href="/account/documents"><i class="fas fa-file-alt"></i> Документы</a>
                        <a class="dropdown-item" href="/account/settings"><i class="fas fa-cog"></i> Настройки</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="/account/logout"><i class="fas fa-sign-out-alt"></i> Выход</a>
                    </div>
                </li>
            </ul>
        <?php else: ?>
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="/account/login">Авторизация</a>
                </li>

<!--                <li class="nav-item">-->
<!--                    <a class="nav-link" href="/account/register">Регистрация</a>-->
<!--                </li>-->
            </ul>
        <?php endif; ?>
    </div>
    </div>
</nav>
<div class="container">
    <?php echo $content; ?>
</div>

<footer class="footer">
    <div class="container">
        <div class="row">
            <div class="col-6">
                <span class="text-muted">Дизайн и разработка - <a href="/account/profile/1">Семенов Олег Георгиевич</a></span>
            </div>
            <div class="col-6 text-right">
                <?php if (!empty($_SESSION['user']) && $_SESSION['user']['id_permission'] == 1): ?>
                    <a href="/admin">Панель управления</a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</footer>
</body>
</html>