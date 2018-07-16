<html>
<head>
    <meta charset="UTF-8">
    <title><?php echo $title; ?></title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">

    <script src="/public/scripts/jquery.js"></script>
    <script src="/public/scripts/maskedinput.js"></script>
<!--    <script src="/public/scripts/form.js"></script>-->

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">


    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="/public/styles/style.css">

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
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="far fa-file-alt"></i> Документы</a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="/requests/create">Заключения "о прохождении обучения работы со СКЗИ"</a>
                </div>
            </li>
        </ul>
        <?php if (!empty($_SESSION['user'])): ?>
            <ul class="navbar-nav">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <?php echo $_SESSION['user']['last_name'].' '.$_SESSION['user']['first_name'].' '.$_SESSION['user']['middle_name'] ?>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="/account/profile">Профиль</a>
                        <a class="dropdown-item" href="/account/settings">Настройки</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="/account/logout">Выход</a>
                    </div>
                </li>
            </ul>
        <?php else: ?>
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="/account/login">Вход</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/account/register">Регистрация</a>
                </li>
            </ul>
        <?php endif; ?>
    </div>
    </div>
</nav>
<div class="container">
    <div class="row">
        <div class="col-12"><?php echo $content; ?></div>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <span class="text-muted">Дизайн и разработка - <a href="#">Семенов Олег Георгиевич</a></span>
    </div>
</footer>
</body>
</html>