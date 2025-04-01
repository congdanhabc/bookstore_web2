<?php

namespace App\Models;

class Book {
    public $id;
    public $category_id;
    public $name;
    public $author;
    public $publisher;
    public $description;
    public $price;
    public $sale_price;
    public $image;
    public $stock;
    public $created_at;
    public $updated_at;
    public $publish_year;
    public $size;
    public $page;
    public $cover_type;

    // Hàm hỗ trợ để tạo đối tượng Book từ mảng
    private static function createBookObject($bookData, $db) {
        $book = new Book();
        $book->id = $bookData['id'];
        $book->category_id = $bookData['category_id'];
        $book->name = $bookData['name'];
        $book->author = Author::getAuthorName($bookData['author_id'], $db); // Lấy tên tác giả từ bảng authors
        $book->publisher = Publisher::getPublisherName($bookData['publisher_id'], $db);
        $book->description = $bookData['description'];
        $book->price = $bookData['price'];
        $book->sale_price = $bookData['sale_price'];
        $book->image = $bookData['image'];
        $book->stock = $bookData['stock'];
        $book->created_at = $bookData['created_at'];
        $book->updated_at = $bookData['updated_at'];
        $book->publish_year = $bookData['publish_year'];
        $book->size = $bookData['size'];
        $book->page = $bookData['page'];
        $book->cover_type = $bookData['cover_type'];
        return $book;
    }

    private static function createBookObjectForList($bookData, $db) {
        $book = new Book();
        $book->id = $bookData['id'];
        $book->name = $bookData['name'];
        $book->author = Author::getAuthorName($bookData['author_id'], $db); // Lấy tên tác giả từ bảng authors
        $book->price = $bookData['price'];
        $book->sale_price = $bookData['sale_price'];
        $book->image = $bookData['image'];
        return $book;
    }


    public static function getAllBooks($db) {
        $sql = "SELECT id, name, author_id, price, sale_price, image FROM books";
        $books = $db->fetchAll($sql);

        // Chuyển đổi kết quả thành mảng các đối tượng Book
        $bookObjects = [];
        foreach ($books as $book) {
            $bookObjects[] = self::createBookObjectForList($book, $db);
        }

        return $bookObjects;
    }

    public static function getBooksByID($id ,$db) {
        $sql = "SELECT * FROM books WHERE id = $id";
        $book = $db->fetch($sql);
        $bookObject = self::createBookObject($book, $db);

        return $bookObject;
    }

}