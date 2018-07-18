<?php

namespace application\models;

use application\core\Model;

class Services extends Model
{

    public function getZagsInfo($route) {
        $max = 100;
        $params = [
            'max' => $max,
            'start' => (($route['page'] ?? 1) - 1) * $max,
        ];
        $result = $this->db->row('SELECT * FROM service_zags LIMIT :start, :max', $params);
        return $result;
    }

    public function getZagsCount() {
        $result = $this->db->column('SELECT COUNT(id) FROM service_zags');
        return $result;
    }

    public function getZagsCategory() {
        $result = $this->db->row('SELECT DISTINCT date_of_receiving FROM service_zags ORDER BY date_of_receiving DESC');
        return $result;
    }

    public function getZagsSearchDate($fio, $date) {
        $result = $this->db->row("SELECT * FROM service_zags WHERE CONCAT(last_name,' ',first_name,' ',middle_name) LIKE :fio AND date_of_receiving = :d",['fio' => '%'.$fio.'%', 'd' => $date]);
        return $result;
    }

    public function getZagsSearch($fio) {
        $result = $this->db->row("SELECT * FROM service_zags WHERE CONCAT(last_name,' ',first_name,' ',middle_name) LIKE :fio",['fio' => '%'.$fio.'%']);
        return $result;
    }

}