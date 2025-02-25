<?php

namespace App\Controllers;

use App\Core\Controller; 
use App\Models\Book;
use App\Models\Category;

class HomeController extends Controller {
    private $db; // Thêm thuộc tính $db

    public function __construct($db) { // Thêm constructor
        $this->db = $db;
    }

    public function index() {
        // Lấy sách mới nhất (ví dụ: 10 cuốn)
        $Books = Book::getAllBooks($this->db);


        // Truyền dữ liệu cho view
        $data = [
            'Books' => $Books,
        ];

        // 4. Gọi view để hiển thị trang chủ
        return $this->view('home', $data);
    }
}