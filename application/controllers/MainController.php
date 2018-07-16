<?php

namespace application\controllers;

use application\core\Controller;
use application\lib\Db;

class MainController extends Controller
{
    public function indexAction () {
        $news = $this->model->getNews();
        $statistics = $this->model->getStatistics();
        $vars = [
            'news' => $news,
            'statistics' => $statistics
        ];
        $this->view->render('Главная страница', $vars);
    }
}