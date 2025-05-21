<?php
//Trong class Author
namespace App\Models;

class Province {
    public static function getProvinceName(int $provinceId, $db) {
        $sql = "SELECT name FROM provinces WHERE id = ?";
        $params = [$provinceId];
        $publisher = $db->fetch($sql, $params);
        return $publisher ? $publisher['name'] : 'Unknown Province'; //Trả về Unknown Author nếu không tìm thấy tác giả
    }

    public static function getAllProvince($db) {
        $sql = "SELECT id, name FROM provinces ORDER BY id ASC";
        $provinces = $db->fetchAll($sql);
        return $provinces;
    }
}