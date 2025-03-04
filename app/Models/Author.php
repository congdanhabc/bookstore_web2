<?php
//Trong class Author
namespace App\Models;

class Author {
    public static function getAuthorName(int $authorId, $db) {
        $sql = "SELECT name FROM authors WHERE id = ?";
        $params = [$authorId];
        $author = $db->fetch($sql, $params);
        return $author ? $author['name'] : 'Unknown Author'; //Trả về Unknown Author nếu không tìm thấy tác giả
    }
}