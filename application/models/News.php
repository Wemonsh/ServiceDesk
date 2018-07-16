<?php

namespace application\models;

use application\core\Model;

class News extends Model
{
    public function getNewsId($id) {
        $result = $this->db->row('SELECT news.id, news.title, news.text, news.photo, news.views, news.date, news.file1, news.file1_name, news.file2, news.file2_name, u.id AS user_id, u.first_name, u.last_name, u.middle_name FROM news 
JOIN users AS u ON news.author = u.id WHERE news.id = :id', ['id' => $id]);
        return $result[0];
    }


    public function addView($id, $views) {
        $this->db->row('UPDATE news SET views = :views WHERE id = :id', ['id' => $id, 'views' => $views]);
    }

    public function addNews($title, $description, $text, $photo, $file_one, $file_one_name, $file_two, $file_two_name, $author) {
        $vars = [
            'title' => $title ,
            'description' => $description,
            'text' => $text,
            'photo' => $photo,
            'file1' => $file_one,
            'file1_name' => $file_one_name,
            'file2' => $file_two,
            'file2_name' => $file_two_name,
            'author' => $author
        ];


        $this->db->row('INSERT INTO news(title, description, text, photo, file1, file1_name, file2, file2_name, author) VALUES 
(:title, :description, :text, :photo, :file1, :file1_name, :file2, :file2_name, :author)', $vars);
    }

}