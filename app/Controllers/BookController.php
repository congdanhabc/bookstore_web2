<?php

namespace App\Controllers;

use App\Core\Controller; 
use App\Models\Book;
use App\Models\Category;


class BookController extends Controller {
    private $db; // Thêm thuộc tính $db

    public function __construct($db) { // Thêm constructor
        $this->db = $db;
    }

    public function index() {
        // Lấy sách mới nhất
        $categories = Category::getAllCategories($this->db);

        // Truyền dữ liệu cho view
        $data = [
            'categories' => $categories,
        ];

        // 4. Gọi view để hiển thị trang chủ
        return $this->view('/book/books', $data);
    }

    public function ajaxLoadBooks()
    {
        try {
            // 1. Lấy tham số từ query string ($_GET)
            $page = isset($_GET['page']) ? max(1, (int)$_GET['page']) : 1;
            $categoryId = isset($_GET['category_id']) && $_GET['category_id'] !== '' ? (int)$_GET['category_id'] : null;
            $sort = isset($_GET['sort']) ? $_GET['sort'] : 'name';
            $ascending = isset($_GET['ascending']) ? ($_GET['ascending'] === 'true' ? true : false) : true;
            $priceMin = isset($_GET['price_min']) && $_GET['price_min'] !== ''? (int)$_GET['price_min'] : null;
            $priceMax = isset($_GET['price_max']) && $_GET['price_max'] !== '' ? (int)$_GET['price_max'] : null;
            $search = isset($_GET['search']) ? trim($_GET['search']) : null;

            $limit = 12; // Số sách mỗi trang (cần giống với JS nếu có)
            $offset = ($page - 1) * $limit;

            // 2. Tạo mảng bộ lọc để truyền vào Model
            $filters = [
                'category_id' => $categoryId,
                'sort' => $sort,
                'ascending' => $ascending,
                'price_min' => $priceMin,
                'price_max' => $priceMax,
                'search' => $search,
            ];

            // 3. Gọi Model để lấy dữ liệu
            $bookModel = new Book(); // Hoặc cách bạn khởi tạo Model
            $books = $bookModel->getBooksWithFiltersAndPagination($filters, $limit, $offset, $this->db); // Lấy sách cho trang hiện tại
            $totalBooks = $bookModel->countBooksWithFilters($filters, $this->db); // Đếm tổng số sách phù hợp

            // 4. Tính toán phân trang
            $totalPages = ceil($totalBooks / $limit);

            // 5. Chuẩn bị dữ liệu trả về
            $responseData = [
                'success' => true,
                'books' => $books, // Đảm bảo $books là mảng các object/array sách
                'pagination' => [
                    'currentPage' => $page,
                    'totalPages' => $totalPages,
                    'totalBooks' => $totalBooks,
                    'limit' => $limit
                ]
            ];

        } catch (\Exception $e) {
            // Ghi log lỗi ở đây nếu cần
            error_log("AJAX Load Books Error: " . $e->getMessage());
            $responseData = [
                'success' => false,
                'message' => 'Đã có lỗi xảy ra khi tải dữ liệu sách.' // Thông báo lỗi chung chung
                // 'debug_error' => $e->getMessage() // Chỉ bật khi debug
            ];
            // Có thể đặt mã lỗi HTTP nếu muốn (ví dụ 500)
            // http_response_code(500);
        }

        // 6. Thiết lập Header và trả về JSON
        header('Content-Type: application/json');
        echo json_encode($responseData);
        exit; // Quan trọng: Dừng thực thi để không render thêm view nào khác
    }

    public function show($id){
        $book = Book::getBooksByID($id, $this->db);
        $data = [
            'book' => $book,
        ];
        return $this->view('/book/productinfo', $data);
    }

}