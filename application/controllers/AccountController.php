<?php

namespace application\controllers;

use application\core\Controller;
use application\core\View;

class AccountController extends Controller
{
    public function loginAction () {
        if(!empty($_POST['login']) AND !empty($_POST['password'])) {
            $result = $this->model->checkUser($_POST['login'], md5($_POST['password']));
            if (!empty($result)) {
                $_SESSION['user'] = $result[0];
                $this->model->log('Пользователь авторизован', $_SERVER['REMOTE_ADDR'], $_SESSION['user']['id']);
                $this->view->location('/account/profile');
            }
            $this->view->message('Ошибка', 'Неправильный логин или пароль, либо пользователь не зарегистрирован');
        }
        $this->view->render('Авторизация');
    }

    public function logoutAction() {
        $this->model->log('Пользователь деавторизован', $_SERVER['REMOTE_ADDR'], $_SESSION['user']['id']);
        $_SESSION = array();
        session_destroy();
        $this->view->redirect('/');
    }

    public function registerAction() {
        if(!empty($_POST['first_name']) and !empty($_POST['last_name']) and !empty($_POST['middle_name']) and
            !empty($_POST['phone']) and !empty($_POST['date_of_birth']) and !empty($_POST['login']) and !empty($_POST['password']))
        {
            $dir = 'files/user_photo/';
            $first_name = $_POST['first_name'];
            $last_name = $_POST['last_name'];
            $middle_name = $_POST['middle_name'];
            $gender = $_POST['gender'];
            $email = $_POST['email'];
            $login = $_POST['login'];
            $password = md5($_POST['password']);
            $phone = $_POST['phone'];
            $date_of_birth = $_POST['date_of_birth'];
            $id_organization = $_POST['id_organization'];
            $id_departments = $_POST['id_departments'];
            $id_positions = $_POST['id_positions'];

            $result = $this->model->checkUser($login, $password);
            if (empty($result)) {

                if (!empty($_FILES['photo']['name'])) {
                    $photo = $dir.date('y-m-d').'_'.$login.'.jpg';
                    move_uploaded_file($_FILES['photo']['tmp_name'], $photo);
                }
                else {
                    $photo = null;
                }

                $result = $this->model->addUser($first_name, $last_name, $middle_name, $gender, $email, $login, $password, $phone,
                    $date_of_birth, $id_organization, $id_departments, $id_positions, $photo);
//                $this->view->location('/account/login');
                $this->view->redirect('/account/login');
            } else {
                $this->view->message('Ошибка', 'Пользователь с таким логином или email существует');
            }
        } else if (!empty($_POST)) {
            $this->view->message('Ошибка', 'Обязательные поля не заполнены');
        }

        $positions = $this->model->GetPositions();
        $organization = $this->model->GetOrganization();
        $departments = $this->model->GetDepartments ();
        $vars = [
            'positions' => $positions,
            'organization' => $organization,
            'departments' => $departments
        ];
        $this->view->render('Регистрация', $vars);
    }

    public function profileAction() {
        if (isset($this->route['id'])) {
            $result = $this->model->getInfoUser($this->route['id']);
            $logs = $this->model->show_log($this->route['id']);
        } else {
            $result = $this->model->getInfoUser($_SESSION['user']['id']);
            $logs = $this->model->show_log($_SESSION['user']['id']);
        }
        if($result != null) {
            $vars = [
                'user' => $result,
                'logs' => $logs
            ];
            $this->view->render('Профиль',$vars);
        } else {
            view::errorCode(404);
        }

    }

    public function phonesAction() {
        $departments = $this->model->GetDepartments ();
        if (!empty($_POST['id'])) {
            if(!empty($_POST['fio'])) {
                $vars = [
                    'departments' => $departments,
                    'users' => $this->model->getPhoneUsers($_POST['fio'],$_POST['id'])
                ];
                $this->view->render('Телефонный справочник', $vars);
            } else {
                $vars = [
                    'departments' => $departments,
                    'users' => $this->model->getPhoneDepartments($_POST['id'])
                ];
                $this->view->render('Телефонный справочник', $vars);
            }
        } else {
            $vars = [
                'departments' => $departments
            ];
            $this->view->render('Телефонный справочник', $vars);
        }
    }

//    Функция изменения пароля пользователя
    public function update_passwordAction() {
        if (!empty($_POST['old']) AND !empty($_POST['new']) AND !empty($_POST['new2'])) {
            if ($_SESSION['user']['password'] == md5($_POST['old'])) {
                if (md5($_POST['new']) == md5($_POST['new2'])) {
                    if (md5($_POST['new']) != $_SESSION['user']['password']) {
                        $this->model->updatePassword($_SESSION['user']['id'],md5($_POST['new']));
                        $_SESSION['user']['password'] = md5($_POST['new']);
                        $this->view->message('1','Ваш пароль изменен на новый');
                    }
                    else {
                        $this->view->message('1','Ваш введенный новый пароль не должен совпадать со старым');
                    }
                } else {
                    $this->view->message('1','Введенные вами пароли не совпадают');
                }
            } else {
                $this->view->message('1','Вы ввели неправильный старый пароль');
            }
        } else {
            $this->view->message('1','Вы не заполнили все необходимые поля для смены пароля');
        }
    }

//    Функция изменения email адреса пользователя
    public function update_emailAction() {
        if (!empty($_POST['email'])) {
            if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
                $this->model->updateEmail($_SESSION['user']['id'], $_POST['email']);
                $_SESSION['user']['email'] = $_POST['email'];
                $this->view->message('1','Ваш адрес электронной почты изменен на новый');
            } else {
                $this->view->message('1','Адресс электронной почты указан не верно');
            }
        } else {
            $this->view->message('1','Поле электронный адрес не заполнено');
        }
    }

//    Функция изменения телефона пользователя
    public function update_phoneAction() {
        if (!empty($_POST['phone'])) {
            $this->model->updatePhone($_SESSION['user']['id'], $_POST['phone']);
            $_SESSION['user']['phone'] = $_POST['phone'];
            $this->view->message('1','Ваш номер телефона изменен на новый');
        } else {
            $this->view->message('1','Поле телефон не заполнено');
        }
    }

    public function update_photoAction() {
        if (!empty($_FILES['file']['name'])) {
            $file = null;
            $dir = 'files/photo/';
            $ext = pathinfo($_FILES['file']['name']);
            $file = $dir.uniqid().'.'.$ext['extension'];
            move_uploaded_file($_FILES['file']['tmp_name'], $file);
            $this->model->updatePhoto($_SESSION['user']['id'], $file);
            $this->view->redirect('/account/settings');
        } else {
            $this->view->redirect('/account/settings');
        }
    }

    public function showAction() {
        $users = $this->model->GetListUsers ();
        $vars = [
            'users' => $users,
        ];
        $this->view->render('Телефонный справочник', $vars);
    }

    public function documentsAction() {
        $this->view->render('Документы');
    }

    public function resetAction() {
//        mail("gkreg_ip@rk.gov.ru", "the subject", 'test',
//            "From: gkreg_ip@rk.gov.ru\r\n"
//            ."Reply-To: gkreg_ip@rk.gov.ru\r\n"
//            ."X-Mailer: PHP/" . phpversion());

        $this->view->render('Документы');
    }

    public function settingsAction() {
        $result = $this->model->getInfoUser($_SESSION['user']['id']);
        $vars = [
            'user' => $result
        ];
        $this->view->render('Настройки', $vars);
    }

}