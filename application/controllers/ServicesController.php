<?php

namespace application\controllers;

use application\core\Controller;
use application\lib\Db;
use application\lib\Pagination;


class ServicesController extends Controller
{
    public function deathAction () {
        $count = $this->model->getZagsCount();
        $pagination = new Pagination($this->route, $count, 100);
        $zags = $this->model->getZagsInfo($this->route);
        $category = $this->model->getZagsCategory();
        $this->view->render('Главная страница', ['zags' => $zags, 'pagination' => $pagination->get(), 'category' => $category]);
    }

    public function d_searchAction () {
        if (!empty($_POST)) {
            if ($_POST['date'] != 0) {
                $zags = $this->model->getZagsSearchDate($_POST['fio'],$_POST['date']);
                $text = '"'.$_POST['fio'].'" - '.$_POST['date'];
                $this->view->render('Главная страница', ['zags' => $zags, 'text' => $text]);
            } else {
                $zags = $this->model->getZagsSearch($_POST['fio']);
                $text = '"'.$_POST['fio'].'"';
                $this->view->render('Главная страница', ['zags' => $zags, 'text' => $text]);
            }
        } else {
            $this->view->render('Главная страница');
        }
    }
}