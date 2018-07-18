<?php
/**
 * Created by PhpStorm.
 * User: wemonsh
 * Date: 28.04.2018
 * Time: 12:23
 */

namespace application\models;

use application\core\Model;

class Information extends Model
{
    public function getCategory () {
        $result = $this->db->row('SELECT * FROM information_category');
        return $result;
    }

    public function getCategoryStatistic() {
        return $this->db->row('SELECT COUNT(information.id) AS count, information.id_category, ic.name FROM `information` 
LEFT JOIN information_category AS ic ON information.id_category = ic.id GROUP BY id_category');
    }

    public function getInformation ($route) {
        $max = 100;
        $params = [
            'max' => $max,
            'start' => (($route['page'] ?? 1) - 1) * $max,
        ];
        $result = $this->db->row('SELECT information.id, information.title, ic.name AS category, information.subcategory, information.file, information.file_name, information.id_user,
u.last_name, u.first_name, u.middle_name, information.date 
FROM information
LEFT JOIN information_category AS ic ON information.id_category = ic.id
LEFT JOIN users AS u ON information.id_user = u.id ORDER BY information.id DESC LIMIT :start, :max', $params);
        return $result;
    }

    public function getInformationCount() {
        $result = $this->db->column('SELECT COUNT(id) FROM information');
        return $result;
    }

    public function getInformationBySearch ($text, $id) {
        $result = $this->db->row('SELECT information.id, information.title, ic.name AS category, information.subcategory, information.file, information.file_name, information.id_user,
u.last_name, u.first_name, u.middle_name, information.date
FROM information
LEFT JOIN information_category AS ic ON information.id_category = ic.id
LEFT JOIN users AS u ON information.id_user = u.id
WHERE information.title LIKE :text AND information.id_category = :id
ORDER BY information.id DESC', ['text' => '%'.$text.'%', 'id' => $id]);
        return $result;
    }


    public function addInformation($title, $id_category, $subcategory, $file, $file_name, $id_user ) {
        $vars = [
            'title' => $title,
            'file' => $file,
            'file_name' => $file_name,
            'id_category' => $id_category,
            'subcategory' => $subcategory,
            'id_user' => $id_user
        ];

        $this->db->row('INSERT INTO information (title, file, file_name, id_category, subcategory, id_user) VALUES 
(:title, :file, :file_name, :id_category, :subcategory, :id_user)', $vars);
    }
}