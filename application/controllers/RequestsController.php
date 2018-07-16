<?php
namespace application\controllers;

use application\core\Controller;
use application\lib\Pagination;

class RequestsController extends Controller
{
    public function createAction () {

        if (!empty($_POST)) {

            $title = $_POST['title'];
            $category = $_POST['category'];
            $priority = $_POST['priority'];
            $description = $_POST['description'];
            $user = $_SESSION['user']['id'];
            $ip = $_SERVER['REMOTE_ADDR'];
            $id_operator = null;
            $date_of_planned = null;

            if (!empty($title)) {
                $dir = 'files/requests/'.uniqid();
                if (!empty($_FILES['file']['name'])) {
                    mkdir($dir, 0700);
                    $ext = pathinfo($_FILES['file']['name']);
                    $file = $dir.'/'.$_FILES['file']['name'];
                    move_uploaded_file($_FILES['file']['tmp_name'], iconv("utf-8", "cp1251", $file));
                }
                else {
                    $file = null;
                }

                if (isset($_POST['id_operator'])) {
                    $id_operator = $_POST['id_operator'];
                    $date_of_planned = $_POST['date_of_planned'];
                    $result = $this->model->addRequestPlus($title, $category, $priority, $description, $file, $user, $ip, $id_operator, $date_of_planned);
                } else {
                    $result = $this->model->addRequest($title, $category, $priority, $description, $file, $user, $ip);
                }
            } else {
                $this->view->message('1','gfdsg');
            }
            $this->view->location('/requests/my');
        }

        $category = $this->model->getRequestCategory();
        $operators = $this->model->getOperators();
        $user = $this->model->getInfoUser($_SESSION['user']['id']);
        $vars = [
            'user' => $user,
            'category' => $category,
            'operators' => $operators
        ];
        $this->view->render('Создание заявки', $vars);
    }

    public function historyAction () {
        $pagination = new Pagination($this->route, $this->model->log_count(), 10);
        $vars = [
            'log' => $this->model->log_show($this->route),
            'log_count' => $this->model->log_count(),
            'pagination' => $pagination->get()
        ];
        $this->view->render('Новости', $vars);
    }

    public function myAction () {
        $result = $this->model->getRequestById($_SESSION['user']['id']);
        $vars = [
            'requests' => $result
        ];
        $this->view->render('Мои заявки', $vars);
    }



    public function allAction () {
        $pagination = new Pagination($this->route, $this->model->getRequestAllCount(), 10);

        $vars = [
            'requests' => $this->model->getRequestAll($this->route),
            'requests_count' => $this->model->getRequestAllCount(),
            'pagination' => $pagination->get(),
            'operators' => $this->model->getOperators()
        ];
        $this->view->render('Все заявки', $vars);
    }

    public function openAction () {
        $pagination = new Pagination($this->route, $this->model->getRequestOpenCount(), 10);

        $vars = [
            'requests' => $this->model->getRequestOpen($this->route),
            'requests_count' => $this->model->getRequestOpenCount(),
            'pagination' => $pagination->get()
        ];
        $this->view->render('Все заявки', $vars);
    }

    public function inworkAction () {
        $pagination = new Pagination($this->route, $this->model->getRequestInWorkCount(), 10);

        $vars = [
            'requests' => $this->model->getRequestInWork($this->route),
            'requests_count' => $this->model->getRequestInWorkCount(),
            'pagination' => $pagination->get()
        ];
        $this->view->render('Заявки в работе', $vars);
    }

    public function closedAction () {
        $result = $this->model->getRequestClosed();
        $vars = [
            'requests' => $result,
            'requests_count' => $this->model->getRequestClosedCount()
        ];
        $this->view->render('Закрытые заявки', $vars);
    }

    public function frozenAction () {
        $result = $this->model->getRequestFrozen();
        $vars = [
            'requests' => $result,
            'requests_count' => $this->model->getRequestFrozenCount()
        ];
        $this->view->render('Все заявки', $vars);
    }

    public function my_in_workAction () {
        $pagination = new Pagination($this->route, $this->model->MyRequestInWorkCount(($_SESSION['user']['id'])), 10);
        $result = $this->model->getMyRequestInWork($_SESSION['user']['id']);
        $vars = [
            'requests' => $result,
            'requests_count' => $this->model->MyRequestInWorkCount($_SESSION['user']['id']),
            'pagination' => $pagination->get()
        ];

        $this->view->render('Все заявки', $vars);
    }

    public function my_frozenAction () {
        $pagination = new Pagination($this->route, $this->model->MyRequestFrozenCount($_SESSION['user']['id']), 10);
        $result = $this->model->getMyRequestFrozen($_SESSION['user']['id']);
        $vars = [
            'requests' => $result,
            'requests_count' => $this->model->MyRequestFrozenCount($_SESSION['user']['id']),
            'pagination' => $pagination->get()
        ];

        $this->view->render('Все заявки', $vars);
    }

    public function my_closedAction () {
        $pagination = new Pagination($this->route, $this->model->MyRequestClosedCount($_SESSION['user']['id']), 10);
        $result = $this->model->getMyRequestClosed($_SESSION['user']['id']);
        $vars = [
            'requests' => $result,
            'requests_count' => $this->model->MyRequestClosedCount($_SESSION['user']['id']),
            'pagination' => $pagination->get()
        ];

        $this->view->render('Все заявки', $vars);
    }

    public function requestAction () {

        $vars = [
            'request' => $this->model->get_request_for_id($this->route['id']),
            'log' => $this->model->show_request_log($this->route['id'])
        ];
        $this->view->render('Заявка №'.$this->route['id'], $vars);
    }

    public function statisticsAction () {
        $this->view->render('Заявка №');
    }

    public function getAction () {
        if (!empty($_POST)) {
            $this->model->log($this->route['id'], $_SESSION['user']['id'], 'Заявка была передана в работу оператором технической поддержки, статус заявки "в работе".');
            $this->model->RequestInWork($this->route['id'], $_POST['id_operator']);
            $this->view->redirect('/requests/all');
        } else {
            $this->model->log($this->route['id'], $_SESSION['user']['id'], 'Заявка была принята в работу оператором технической поддержки, статус заявки "в работе".');
            $this->model->RequestInWork($this->route['id'], $_SESSION['user']['id']);
            $this->view->redirect('/requests/all');
        }
    }

    public function frozeAction () {
        $this->model->log($this->route['id'], $_SESSION['user']['id'], 'Статус заявки изменен на "заморожена" оператором технической поддержки.');
        $this->model->RequestFrozen($this->route['id']);
        $this->view->redirect('/requests/my_in_work');
    }

    public function closeAction () {
        $this->model->log($this->route['id'], $_SESSION['user']['id'], 'Заявка была закрыта в связи с решением проблемы оператором технической поддержки.');
        $this->model->RequestClose($this->route['id'], date("Y-m-d H:i:s"));
        $this->view->redirect('/requests/my_in_work');
    }

    public function backAction () {
        $this->model->log($this->route['id'], $_SESSION['user']['id'], 'Заявка была возвращена оператором технической поддержки, статус заявки "открыта".');
        $this->model->RequestBack($this->route['id']);
        $this->view->redirect('/requests/my_in_work');
    }

    public function defrostingAction () {
        $this->model->log($this->route['id'], $_SESSION['user']['id'], 'Заявка была возвращена в работу оператором технической поддержки, статус заявки "в работе".');
        $this->model->RequestDefrosting($this->route['id'], $_SESSION['user']['id']);
        $this->view->redirect('/requests/my_frozen');
    }

    public function sendAction () {
        $request = $this->route['id'];
        $this->model->send_message($request, $_POST['message']);
        $this->model->log($this->route['id'], $_SESSION['user']['id'], 'Заявка была закрыта в связи с решением проблемы оператором технической поддержки.');
        $this->model->RequestClose($this->route['id'], date("Y-m-d H:i:s"));
        $this->view->redirect('/requests/request/'.$request);
    }
}