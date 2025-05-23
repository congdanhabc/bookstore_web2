<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\Book; 

class HomeController extends Controller {
    private $db; // Thêm thuộc tính $db

    public function __construct($db) { // Thêm constructor
        $this->db = $db;
    }

    public function index() {
        $data = Book::getAllBooks($this->db);
        return $this->view('home', $data);
    }
}