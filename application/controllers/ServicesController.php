<?php

namespace application\controllers;

use application\core\Controller;
use application\lib\Db;

class ServicesController extends Controller
{
    public function deathAction () {
        $this->view->render('Главная страница');
    }
}