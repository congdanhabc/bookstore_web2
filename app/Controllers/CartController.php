<?php

namespace App\Controllers;

use App\Core\Controller; 
use App\Models\Cart;




class CartController extends Controller {
    private $db; // Thêm thuộc tính $db

    public function __construct($db) { // Thêm constructor
        $this->db = $db;
    }

    public function index() {
        // Lấy sách mới nhất
        $books = Cart::getAllBookInCart($this->db);

        // Truyền dữ liệu cho view
        $data = [
            'books' => $books,
        ];

        // 4. Gọi view để hiển thị trang chủ
        return $this->view('/cart/cart', $data);
    }

    public function add($id){

    }

    public function update($id){

    }

    public function remove($id){

    }

    public function clear($id){

    }
}