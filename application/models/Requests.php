<?php

namespace application\models;

use application\core\Model;

class Requests extends Model
{
    public function getInfoUser ($id){
        $result = $this->db->row('SELECT users.id, first_name, last_name, middle_name, email, login, gender, phone, date_of_birth, date_of_registration, photo, d.name AS departments, p.name AS positions, o.name AS organization FROM users JOIN departments AS d ON users.id_departments = d.id JOIN positions AS p ON users.id_positions = p.id JOIN organization AS o ON users.id_organization = o.id WHERE users.id = :id;', $vars = ['id' => $id]);
        return $result[0];
    }

    public function getOperators (){
        $result = $this->db->row('SELECT id, first_name, last_name, middle_name FROM users WHERE id_departments=4 GROUP BY last_name ASC');
        return $result;
    }

    public function addRequest($title, $id_category, $priority, $description, $file, $id_user, $ip) {
        $vars = [
            'title' => $title,
            'id_category' => $id_category,
            'priority' => $priority,
            'description' => $description,
            'file' => $file,
            'id_user' => $id_user,
            'ip' => $ip,
        ];
        $result = $this->db->row('INSERT INTO requests(title, id_category, priority, description, file, id_user, ip) VALUES (:title, :id_category, :priority, :description, :file, :id_user, :ip)', $vars);
        return $result;
    }

    public function addRequestPlus($title, $id_category, $priority, $description, $file, $id_user, $ip, $id_operator, $date_of_planned) {
        $vars = [
            'title' => $title,
            'id_category' => $id_category,
            'priority' => $priority,
            'description' => $description,
            'file' => $file,
            'id_user' => $id_user,
            'ip' => $ip,
            'id_operator' => $id_operator,
            'id_statuses' => 3,
            'date_of_planned' => $date_of_planned
        ];
        $result = $this->db->row('INSERT INTO requests(title, id_category, priority, description, file, id_user, ip, id_operator, id_statuses, date_of_planned) VALUES (:title, :id_category, :priority, :description, :file, :id_user, :ip, :id_operator, :id_statuses, :date_of_planned)', $vars);
        return $result;
    }

    public function getRequestCategory() {
        $result = $this->db->row('SELECT * FROM requests_category');
        return $result;
    }


    public function getRequestById($id) {
        $vars = [
            'id' => $id
        ];
        $result = $this->db->row('SELECT requests.id, requests.title, requests.description, requests.comment, requests.id_statuses, requests.ip, requests.priority, requests.file, requests.date_of_creation, requests.date_of_closing, c.name, u.id AS user_id, u.first_name, u.last_name, u.middle_name, u.phone, o.name AS organization, d.name AS department, p.name AS position FROM requests 
JOIN requests_category AS c ON requests.id_category = c.id 
JOIN users AS u ON requests.id_user = u.id 
JOIN organization AS o ON u.id_organization = o.id
JOIN departments AS d ON u.id_departments = d.id 
JOIN positions AS p ON u.id_positions = p.id 
WHERE id_user = :id ORDER BY requests.date_of_creation DESC', $vars);
        return $result;
    }

    public function getRequestAll($route) {
        $max = 10;
        $params = [
            'max' => $max,
            'start' => (($route['page'] ?? 1) - 1) * $max,
        ];
        $result = $this->db->row('SELECT requests.id, requests.title, rc.name, requests.ip, requests.date_of_creation, requests.date_of_closing, requests.id_statuses, requests.priority,
u.id AS u_id, u.first_name AS user_first_name, u.last_name AS user_last_name, u.middle_name AS user_middle_name,
uo.id AS uo_id, uo.first_name AS operator_first_name, uo.last_name AS operator_last_name, uo.middle_name AS operator_middle_name
FROM requests 
LEFT JOIN users AS u ON requests.id_user = u.id LEFT JOIN users AS uo ON requests.id_operator = uo.id
LEFT JOIN requests_category AS rc ON requests.id_category = rc.id
ORDER BY requests.date_of_creation DESC LIMIT :start, :max', $params);
        return $result;
    }

    public function getRequestAllCount() {
        $result = $this->db->column('SELECT COUNT(id) FROM requests');
        return $result;
    }

    public function getRequestInWork($route) {
        $max = 10;
        $params = [
            'max' => 10,
            'start' => (($route['page'] ?? 1) - 1) * $max,
        ];
        $result = $this->db->row('SELECT requests.id, requests.title, rc.name, requests.ip, requests.date_of_creation, requests.date_of_closing, requests.id_statuses, requests.priority,
u.id AS u_id, u.first_name AS user_first_name, u.last_name AS user_last_name, u.middle_name AS user_middle_name,
uo.id AS uo_id, uo.first_name AS operator_first_name, uo.last_name AS operator_last_name, uo.middle_name AS operator_middle_name
FROM requests 
LEFT JOIN users AS u ON requests.id_user = u.id LEFT JOIN users AS uo ON requests.id_operator = uo.id
LEFT JOIN requests_category AS rc ON requests.id_category = rc.id
WHERE id_statuses = 3
ORDER BY requests.date_of_creation DESC LIMIT :start, :max', $params);
        return $result;
    }

    public function getRequestInWorkCount() {
        $result = $this->db->column('SELECT COUNT(id) FROM requests WHERE id_statuses = 3');
        return $result;
    }

    public function getMyRequestInWork($id) {
        $result = $this->db->row('SELECT requests.id, requests.title, rc.name, requests.ip, requests.date_of_creation, requests.date_of_closing, requests.id_statuses, requests.priority,
u.id AS u_id, u.first_name AS user_first_name, u.last_name AS user_last_name, u.middle_name AS user_middle_name,
uo.id AS uo_id, uo.first_name AS operator_first_name, uo.last_name AS operator_last_name, uo.middle_name AS operator_middle_name
FROM requests 
LEFT JOIN users AS u ON requests.id_user = u.id LEFT JOIN users AS uo ON requests.id_operator = uo.id
LEFT JOIN requests_category AS rc ON requests.id_category = rc.id
WHERE id_statuses = 3 AND uo.id = :id
ORDER BY requests.date_of_creation DESC', ['id' => $id]);
        return $result;
    }

    public function MyRequestInWorkCount($id_operator) {
        return $this->db->column('SELECT COUNT(id) FROM requests WHERE id_operator = :id_operator AND id_statuses = 3', ['id_operator' => $id_operator]);
    }

    public function getRequestOpen($route) {
        $max = 10;
        $params = [
            'max' => 10,
            'start' => (($route['page'] ?? 1) - 1) * $max,
        ];

        $result = $this->db->row('SELECT requests.id, requests.title, rc.name, requests.ip, requests.date_of_creation, requests.date_of_closing, requests.id_statuses, requests.priority,
u.id AS u_id, u.first_name AS user_first_name, u.last_name AS user_last_name, u.middle_name AS user_middle_name,
uo.id AS uo_id, uo.first_name AS operator_first_name, uo.last_name AS operator_last_name, uo.middle_name AS operator_middle_name
FROM requests 
LEFT JOIN users AS u ON requests.id_user = u.id LEFT JOIN users AS uo ON requests.id_operator = uo.id
LEFT JOIN requests_category AS rc ON requests.id_category = rc.id
WHERE id_statuses = 1
ORDER BY requests.date_of_creation DESC LIMIT :start, :max', $params);
        return $result;
    }



    public function getRequestOpenCount() {
        $result = $this->db->column('SELECT COUNT(id) FROM requests WHERE id_statuses = 1');
        return $result;
    }

    public function getRequestClosed() {
        $result = $this->db->row('SELECT requests.id, requests.title, rc.name, requests.ip, requests.date_of_creation, requests.date_of_closing, requests.id_statuses, requests.priority,
u.id AS u_id, u.first_name AS user_first_name, u.last_name AS user_last_name, u.middle_name AS user_middle_name,
uo.id AS uo_id, uo.first_name AS operator_first_name, uo.last_name AS operator_last_name, uo.middle_name AS operator_middle_name
FROM requests 
LEFT JOIN users AS u ON requests.id_user = u.id LEFT JOIN users AS uo ON requests.id_operator = uo.id
LEFT JOIN requests_category AS rc ON requests.id_category = rc.id
WHERE id_statuses = 2
ORDER BY requests.date_of_creation DESC');
        return $result;
    }

    public function getMyRequestClosed($id) {
        $result = $this->db->row('SELECT requests.id, requests.title, rc.name, requests.ip, requests.date_of_creation, requests.date_of_closing, requests.id_statuses, requests.priority,
u.id AS u_id, u.first_name AS user_first_name, u.last_name AS user_last_name, u.middle_name AS user_middle_name,
uo.id AS uo_id, uo.first_name AS operator_first_name, uo.last_name AS operator_last_name, uo.middle_name AS operator_middle_name
FROM requests 
LEFT JOIN users AS u ON requests.id_user = u.id LEFT JOIN users AS uo ON requests.id_operator = uo.id
LEFT JOIN requests_category AS rc ON requests.id_category = rc.id
WHERE id_statuses = 2 AND uo.id = :id
ORDER BY requests.date_of_creation DESC', ['id' => $id]);
        return $result;
    }

    public function MyRequestClosedCount($id_operator) {
        return $this->db->column('SELECT COUNT(id) FROM requests WHERE id_operator = :id_operator AND id_statuses = 2', ['id_operator' => $id_operator]);
    }

    public function getRequestClosedCount() {
        $result = $this->db->column('SELECT COUNT(id) FROM requests WHERE id_statuses = 2');
        return $result;
    }

    public function getRequestFrozen() {
        $result = $this->db->row('SELECT requests.id, requests.title, rc.name, requests.ip, requests.date_of_creation, requests.date_of_closing, requests.id_statuses, requests.priority,
u.id AS u_id, u.first_name AS user_first_name, u.last_name AS user_last_name, u.middle_name AS user_middle_name,
uo.id AS uo_id, uo.first_name AS operator_first_name, uo.last_name AS operator_last_name, uo.middle_name AS operator_middle_name
FROM requests 
LEFT JOIN users AS u ON requests.id_user = u.id LEFT JOIN users AS uo ON requests.id_operator = uo.id
LEFT JOIN requests_category AS rc ON requests.id_category = rc.id
WHERE id_statuses = 4
ORDER BY requests.date_of_creation DESC');
        return $result;
    }

    public function getMyRequestFrozen($id) {
        $result = $this->db->row('SELECT requests.id, requests.title, rc.name, requests.ip, requests.date_of_creation, requests.date_of_closing, requests.id_statuses, requests.priority,
u.id AS u_id, u.first_name AS user_first_name, u.last_name AS user_last_name, u.middle_name AS user_middle_name,
uo.id AS uo_id, uo.first_name AS operator_first_name, uo.last_name AS operator_last_name, uo.middle_name AS operator_middle_name
FROM requests 
LEFT JOIN users AS u ON requests.id_user = u.id LEFT JOIN users AS uo ON requests.id_operator = uo.id
LEFT JOIN requests_category AS rc ON requests.id_category = rc.id
WHERE id_statuses = 4 AND uo.id = :id
ORDER BY requests.date_of_creation DESC', ['id' => $id]);
        return $result;
    }

    public function MyRequestFrozenCount($id_operator) {
        return $this->db->column('SELECT COUNT(id) FROM requests WHERE id_operator = :id_operator AND id_statuses = 4', ['id_operator' => $id_operator]);
    }

    public function getRequestFrozenCount() {
        $result = $this->db->column('SELECT COUNT(id) FROM requests WHERE id_statuses = 4');
        return $result;
    }

    public function get_request_for_id($id) {
        $result = $this->db->row('SELECT requests.id, requests.title, requests.description, requests.file, requests.comment, rc.name AS category, requests.ip, requests.date_of_creation, requests.date_of_closing, requests.id_statuses, requests.priority,
u.id AS u_id, u.first_name AS user_first_name, u.last_name AS user_last_name, u.middle_name AS user_middle_name, u.phone,
uo.id AS uo_id, uo.first_name AS operator_first_name, uo.last_name AS operator_last_name, uo.middle_name AS operator_middle_name,
org.name AS organization, dep.name AS department, pos.name AS positions, orgo.name AS operator_organization, depo.name AS operator_department, poso.name AS operator_positions
FROM requests
LEFT JOIN users AS u ON requests.id_user = u.id LEFT JOIN users AS uo ON requests.id_operator = uo.id
LEFT JOIN requests_category AS rc ON requests.id_category = rc.id
LEFT JOIN departments AS dep ON u.id_departments = dep.id LEFT JOIN departments AS depo ON uo.id_departments = depo.id
LEFT JOIN organization AS org ON u.id_organization = org.id LEFT JOIN organization AS orgo ON uo.id_organization = orgo.id
LEFT JOIN positions AS pos ON u.id_positions = pos.id LEFT JOIN positions AS poso ON uo.id_positions = poso.id
WHERE requests.id = :id', ['id' => $id]);
        return $result[0];
    }

    //SELECT requests.id, requests.title, u.id, u.first_name, uo.first_name FROM requests LEFT JOIN users u ON requests.id_user = u.id LEFT JOIN users uo ON requests.id_operator = uo.id

    public function RequestDefrosting($id_requests, $id_operator) {
        $this->db->row('UPDATE requests SET id_statuses = 3, id_operator = :id_operator WHERE id = :id_requests', ['id_operator' => $id_operator, 'id_requests' => $id_requests]);
    }

    public function RequestInWork($id_requests, $id_operator) {
        $this->db->row('UPDATE requests SET id_statuses = 3, id_operator = :id_operator WHERE id = :id_requests', ['id_operator' => $id_operator, 'id_requests' => $id_requests]);
    }

    public function RequestBack($id_requests) {
        $this->db->row('UPDATE requests SET id_statuses = 1, id_operator = null WHERE id = :id_requests', ['id_requests' => $id_requests]);
    }

    public function RequestFrozen($id_requests) {
        $this->db->row('UPDATE requests SET id_statuses = 4 WHERE id = :id_requests', ['id_requests' => $id_requests]);
    }

    public function RequestClose($id_requests, $today) {
        $this->db->row('UPDATE requests SET id_statuses = 2, date_of_closing = :today WHERE id = :id_requests', ['id_requests' => $id_requests, 'today' => $today]);
    }

    public function log ($id_request, $id_user, $text) {
        $this->db->row('INSERT INTO requests_log (text, id_user, id_request) VALUES (:text, :id_user, :id_request)', ['text' => $text, 'id_user' => $id_user, 'id_request' => $id_request]);
    }

    public function show_request_log ($id_request) {
        $result = $this->db->row('SELECT requests_log.text, requests_log.date, u.id, u.first_name, u.last_name, u.middle_name FROM requests_log
 LEFT JOIN users AS u ON requests_log.id_user = u.id
 WHERE id_request = :id_request', ['id_request' => $id_request]);
        return $result;
    }

    public function log_show ($route) {
        $max = 10;
        $params = [
            'max' => 10,
            'start' => (($route['page'] ?? 1) - 1) * $max,
        ];

        $result = $this->db->row('SELECT requests_log.id_request, requests_log.text, requests_log.date, u.id, u.first_name, u.last_name, u.middle_name FROM requests_log
 LEFT JOIN users AS u ON requests_log.id_user = u.id ORDER BY requests_log.date DESC LIMIT :start, :max', $params);
        return $result;
    }

    public function log_count () {
        return $this->db->column('SELECT COUNT(id) FROM requests_log');
    }

    public function send_message($id, $comment) {
        $vars = [
            'id' => $id,
            'comment' => $comment
        ];
        $this->db->row('UPDATE requests SET comment = :comment WHERE id = :id',  $vars);
    }
}