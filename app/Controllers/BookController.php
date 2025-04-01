<?php

namespace App\Controllers;

use App\Core\Controller; 
use App\Models\Book;


class BookController extends Controller {
    private $db; // Thêm thuộc tính $db

    public function __construct($db) { // Thêm constructor
        $this->db = $db;
    }

    public function index() {
        // Lấy sách mới nhất
        $books = Book::getAllBooks($this->db);

        // Truyền dữ liệu cho view
        $data = [
            'books' => $books,
        ];

        // 4. Gọi view để hiển thị trang chủ
        return $this->view('/book/books', $data);
    }

    public function show($id){
        $book = Book::getBooksByID($id, $this->db);
        $data = [
            'book' => $book,
        ];
        return $this->view('/book/productinfo', $data);
    }

}