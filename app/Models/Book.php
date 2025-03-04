<?php

namespace App\Models;

use App\Models\Author;

class Book {
    public $id;
    public $category_id;
    public $name;
    public $author;
    public $description;
    public $price;
    public $image;
    public $stock;
    public $created_at;
    public $updated_at;

    // Hàm hỗ trợ để tạo đối tượng Book từ mảng
    private static function createBookObject($bookData, $db) {
        $book = new Book();
        $book->id = $bookData['id'];
        $book->category_id = $bookData['category_id'];
        $book->name = $bookData['name']; // Kiểm tra dòng này
        $book->author = Author::getAuthorName($bookData['author_id'], $db); // Lấy tên tác giả từ bảng authors
        $book->description = $bookData['description'];
        $book->price = $bookData['price'];
        $book->image = $bookData['image'];
        $book->stock = $bookData['stock'];
        $book->created_at = $bookData['created_at'];
        $book->updated_at = $bookData['updated_at'];
        return $book;
    }


    public static function getAllBooks($db) {
        $sql = "SELECT * FROM books";
        $books = $db->fetchAll($sql);

        // Chuyển đổi kết quả thành mảng các đối tượng Book
        $bookObjects = [];
        foreach ($books as $book) {
            $bookObjects[] = self::createBookObject($book, $db);
        }

        return $bookObjects;
    }


}