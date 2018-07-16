<?php

namespace application\controllers;

use application\core\Controller;
use application\lib\Translit;
use application\lib\Pagination;


class InformationController extends Controller
{
    public function listAction () {
        $count = $this->model->getInformationCount();
        $pagination = new Pagination($this->route, $count, 10);
        $information = $this->model->getInformation($this->route);
        $category = $this->model->getCategoryStatistic();
        $this->view->render('Информация ('.$count.')', ['information' => $information, 'category' => $category, 'pagination' => $pagination->get(), 'count' => $count]);
    }

    public function searchAction() {
        if (!empty($_POST)) {
            $information = $this->model->getInformationBySearch($_POST['text'], $_POST['id']);
            $text = $_POST['text'];
            $this->view->render('Информация', ['information' => $information, 'text' => $text]);
        }

    }

    public function addAction () {
        if (!empty($_POST)) {
            $title = $_POST['title'];
            $id_category = $_POST['category'];
            $subcategory = $_POST['subcategory'];
            $file = null;
            $file_name = $_POST['file_name'];
            $id_user = $_SESSION['user']['id'];

            if(isset($_FILES['file']['name']) && !empty($_FILES['file']['name'])) {
                $dir = 'files/information/';
                $ext = pathinfo($_FILES['file']['name']);
                $file = $dir.uniqid().'.'.$ext['extension'];
                move_uploaded_file($_FILES['file']['tmp_name'], $file);
                $file = $file;
                if (!empty($_POST['file_one_name'])) {
                    $file_name = $_POST['file_name'];
                }
            }
            $this->model->addInformation($title, $id_category, $subcategory, $file, $file_name, $id_user);

            $this->view->location('/information/list');
        }

        $category = $this->model->getCategory();
        $this->view->render('Добавление информации', ['category' => $category]);
    }
}