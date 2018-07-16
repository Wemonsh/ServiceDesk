<?php
/**
 * Created by PhpStorm.
 * User: wemonsh
 * Date: 28.04.2018
 * Time: 12:23
 */

namespace application\models;

use application\core\Model;

class Account extends Model
{
    public function getPositions() {
        $result = $this->db->row('SELECT * FROM positions');
        return $result;
    }
    public function getOrganization() {
        $result = $this->db->row('SELECT * FROM organization');
        return $result;
    }




    public function getDepartments() {
        $result = $this->db->row('SELECT * FROM departments');
        return $result;
    }

    public function checkUser ($login, $password){
        $result = $this->db->row('SELECT * FROM users WHERE login = :login AND password = :password', $vars = ['login' => $login,'password' => $password]);
        return $result;
    }

//    Изменение пароля пользователя
    public function updatePassword ($id, $password){
        $result = $this->db->row('UPDATE users SET password=:password WHERE id=:id', ['id' => $id,'password' => $password]);
        return $result;
    }

//    Изменение email адреса пользователя
    public function updateEmail ($id, $email){
        $result = $this->db->row('UPDATE users SET email=:email WHERE id=:id', ['id' => $id,'email' => $email]);
        return $result;
    }

//    Изменение email адреса пользователя
    public function updatePhone ($id, $phone){
        $result = $this->db->row('UPDATE users SET phone=:phone WHERE id=:id', ['id' => $id,'phone' => $phone]);
        return $result;
    }

    public function updatePhoto ($id, $photo){
        $result = $this->db->row('UPDATE users SET photo=:photo WHERE id=:id', ['id' => $id,'photo' => $photo]);
        return $result;
    }

    public function getInfoUser ($id){
        $result = $this->db->row('SELECT users.id, first_name, last_name, middle_name, email, login, gender, phone, date_of_birth, date_of_registration, photo, d.name AS departments, p.name AS positions, o.name AS organization FROM users JOIN departments AS d ON users.id_departments = d.id JOIN positions AS p ON users.id_positions = p.id JOIN organization AS o ON users.id_organization = o.id WHERE users.id = :id;', $vars = ['id' => $id]);
        if (isset($result[0])) {
            return $result[0];
        } else {
            return null;
        }
    }

    public function addUser($first_name, $last_name, $middle_name, $gender, $email, $login, $password, $phone,
                            $date_of_birth, $id_organization, $id_departments, $id_positions, $photo) {
        $vars = [
            'first_name' => $first_name,
            'last_name' => $last_name,
            'middle_name' => $middle_name,
            'gender' => $gender,
            'email' => $email,
            'login' => $login,
            'password' => $password,
            'phone' => $phone,
            'date_of_birth' => $date_of_birth,
            'id_organization' => $id_organization,
            'id_departments' => $id_departments,
            'id_positions' => $id_positions,
            'photo' => $photo
        ];

        $result = $this->db->row('INSERT INTO users(first_name, last_name, middle_name, email, login, password, gender, phone, date_of_birth, id_organization, id_departments, id_positions, photo) VALUES (:first_name, :last_name, :middle_name, :email, :login, :password, :gender, :phone, :date_of_birth, :id_organization, :id_departments, :id_positions, :photo)', $vars);
        return $result;
    }

    public function getListUsers() {
        $result = $this->db->row('SELECT users.id, first_name, last_name, middle_name, photo, d.name AS departments, p.name AS positions, o.name AS organization FROM users JOIN departments AS d ON users.id_departments = d.id JOIN positions AS p ON users.id_positions = p.id JOIN organization AS o ON users.id_organization = o.id');
        return $result;
    }

    public function getPhoneUsers ($fio, $id) {
        return $this->db->row("SELECT users.id,users.first_name,users.last_name,users.middle_name, p.name AS positions, users.phone 
FROM users LEFT JOIN positions AS p ON users.id_positions = p.id
WHERE CONCAT(last_name,' ',first_name,' ', middle_name) LIKE :fio AND id_departments = :id", ['fio' => '%'.$fio.'%', 'id' => $id]);
    }

    public function getPhoneDepartments($id) {
        return $this->db->row("SELECT users.id,users.first_name,users.last_name,users.middle_name, p.name AS positions,users.phone 
FROM users LEFT JOIN positions AS p ON users.id_positions = p.id WHERE users.id_departments = :id", [ 'id' => $id]);
    }

    public function log ($text, $ip, $id_user) {
        $this->db->row('INSERT INTO users_log (text, ip, id_user) VALUES (:text, :ip, :id_user)', ['text' => $text, 'ip' => $ip, 'id_user' => $id_user]);
    }

    public function show_log ($id_user) {
        return $this->db->row('SELECT * FROM users_log WHERE id_user=:id_user LIMIT 5', ['id_user' => $id_user]);
    }
}