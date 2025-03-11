<?php
//Trong class Author
namespace App\Models;

class Publisher {
    public static function getPublisherName(int $publisherId, $db) {
        $sql = "SELECT name FROM publishers WHERE id = ?";
        $params = [$publisherId];
        $publisher = $db->fetch($sql, $params);
        return $publisher ? $publisher['name'] : 'Unknown Publisher'; //Trả về Unknown Author nếu không tìm thấy tác giả
    }
}