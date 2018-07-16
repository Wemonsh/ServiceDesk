<?php

namespace application\controllers;

use application\core\Controller;
use application\lib\Translit;


class AdminController extends Controller
{
    public function __construct($route)
    {
        parent::__construct($route);
        $this->view->layout = 'admin';
    }

    public function dashboardAction () {
        $this->view->render('Панель приборов');
    }

    public function mainAction () {
        $this->view->render('Панель приборов');
    }

    public function conclusionAction () {
        $this->view->render('Панель приборов');
    }

    public function orderAction () {
        $this->view->render('Добавление приказа');
    }

    public function import_usersAction() {
        if (!empty($_FILES['file'])) {
            $t = new Translit();
            $row = 0;
            $result = array();
            if (($handle = fopen($_FILES['file']['tmp_name'], 'r')) !== false) {
                while (($data = fgetcsv($handle, 1000, ";")) !== false) {
                    if ($row != 0) {
                        $result[$row] = array(
                            'first_name' => iconv("CP1251", "UTF-8", $data[0]),
                            'last_name' => iconv("CP1251", "UTF-8", $data[1]),
                            'middle_name' => iconv("CP1251", "UTF-8", $data[2]),
                            'sex' => $data[3],
                            'phone' => $data[4],
                            'organization' => $data[5],
                            'departments' => $data[6],
                            'positions' => $data[7],
                            'date_of_birth' => $data[8],
                            'email' => $data[9],
                        );
                    }
                    $row++;
                }
                fclose($handle);
            }
            for ($i = 1; $i < $row; $i++) {
                $fn = substr($result[$i]['first_name'], 0, 2);
                $ln = $result[$i]['last_name'];
                $mn = substr($result[$i]['middle_name'], 0, 2);
                $login = $t->translit($ln.$fn.$mn);
                $result[$i]['login'] = $login;
                $result[$i]['password'] = $t->generate_password(10);
            }
            foreach ($result as $value) {
                $this->model->addUser($value['first_name'], $value['last_name'], $value['middle_name'], $value['sex'], $value['email'], $value['login'], md5($value['password']), $value['phone'],
                    $value['date_of_birth'], $value['organization'], $value['departments'], $value['positions'], null);
            }
        }
        $this->view->render('Панель приборов', ['users' => $result, 'count' => $row]);
    }

}