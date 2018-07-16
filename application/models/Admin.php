<?php

namespace application\models;

use application\core\Model;

class Admin extends Model
{
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
}