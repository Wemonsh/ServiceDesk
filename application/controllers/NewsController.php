<?php

namespace application\controllers;

use application\core\Controller;

class NewsController extends Controller
{
    public function showAction () {
        $this->view->render('Новости');
    }

    public function postAction () {
        $news = $this->model->getNewsId($this->route['id']);
        $this->model->addView($this->route['id'], $news['views']+1);
        $this->view->render('Пост', ['news' => $news]);
    }

    public function addAction () {
        if (!empty($_POST)) {
            if (!empty($_POST['title'])) {
                if (!empty($_POST['description'])) {
                    if (!empty($_POST['text'])) {
                        $title = $_POST['title'];
                        $description = $_POST['description'];
                        $text = $_POST['text'];
                        $photo = null;
                        $file_one = null;
                        $file_one_name = null;
                        $file_two = null;
                        $file_two_name = null;
                        $author = $_SESSION['user']['id'];

                        if(isset($_FILES['photo']['name']) && !empty($_FILES['photo']['name'])) {
                            $dir = 'files/news/photo/';
                            $ext = pathinfo($_FILES['photo']['name']);
                            $file = $dir.uniqid().'.'.$ext['extension'];
                            move_uploaded_file($_FILES['photo']['tmp_name'], $file);
                            $photo = $file;
                        }
                        if(isset($_FILES['file_one']['name']) && !empty($_FILES['file_one']['name'])) {
                            $dir = 'files/news/files/';
                            $ext = pathinfo($_FILES['file_one']['name']);
                            $file = $dir.uniqid().'.'.$ext['extension'];
                            move_uploaded_file($_FILES['file_one']['tmp_name'], $file);
                            $file_one = $file;
                            if (!empty($_POST['file_one_name'])) {
                                $file_one_name = $_POST['file_one_name'];
                            }
                        }
                        if(isset($_FILES['file_two']['name']) && !empty($_FILES['file_two']['name'])) {
                            $dir = 'files/news/files/';
                            $ext = pathinfo($_FILES['file_two']['name']);
                            $file = $dir.uniqid().'.'.$ext['extension'];
                            move_uploaded_file($_FILES['file_two']['tmp_name'], $file);
                            $file_two = $file;
                            if (!empty($_POST['file_two_name'])) {
                                $file_two_name = $_POST['file_two_name'];
                            }
                        }

                        $this->model->addNews($title, $description, $text, $photo, $file_one, $file_one_name, $file_two, $file_two_name, $author);
                        $this->view->location('/');
                    } else {
                        $this->view->message('Ошибка', 'Поле полный текст новости не заполнено');
                    }
                } else {
                    $this->view->message('Ошибка', 'Поле краткое описание новости не заполнено');
                }
            } else {
                $this->view->message('Ошибка', 'Поле название новости не заполнено');
            }
        }
        $this->view->render('Новости');
    }
}