<?php
namespace App\Controllers;

use App\Core\Controller; 
use App\Models\User;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Province;
use Exception;

class OrderController extends Controller {
    private $db; // Thêm thuộc tính $db
    private $cartModel;

    public function __construct($db) { // Thêm constructor
        $this->db = $db;
        $this->cartModel = new Cart($this->db);
    }
    public function checkout() {
        if (!isset($_SESSION['user_id'])) {
            header('/login');
            exit;
        }
        $userId = (int) $_SESSION['user_id'];
        $user = User::getUserByID($_SESSION['user_id'], $this->db);
        $provinces = Province::getAllProvince($this->db);

        try{
            // Lấy các mục trong giỏ từ Model
            $cartItems = $this->cartModel->getItems($userId);

            // Tính tổng tiền (ví dụ)
            $totalPrice = 0;
            foreach ($cartItems as $item) {
                // Nên dùng price_at_add để tính tổng, vì giá hiện tại có thể đã thay đổi
                $totalPrice += $item['sale_price'] * $item['quantity'];
            }

            $data = [
                'user' => $user,
                'provinces' => $provinces,
                'cartItems' => $cartItems,
                'totalPrice' => $totalPrice
            ];         
        } catch (\Exception $e) {
            // Ghi log lỗi ở đây nếu cần
            error_log("Load Checkout From Error: " . $e->getMessage());
        }

        return $this->view('order/checkout', $data);
    }

    public function processCheckout() {
        // 1. Đọc nội dung thô từ request body
        $json_data = file_get_contents('php://input');

        // Kiểm tra xem có dữ liệu nào được gửi đi không
        if ($json_data === false || $json_data === '') {
            // Xử lý trường hợp request body rỗng hoặc không đọc được
            header('Content-Type: application/json', true, 400); // Bad Request
            echo json_encode(['success' => false, 'message' => 'Không có dữ liệu nào được gửi đi.']);
            exit; // Dừng script
        }

        // 2. Phân tích chuỗi JSON thành biến PHP
        // Tham số thứ hai (true) chỉ định rằng bạn muốn chuyển đổi các đối tượng JSON {} thành mảng kết hợp PHP []
        $data = json_decode($json_data, true);
        
        // 3. Kiểm tra xem quá trình decode có thành công không
        if ($data === null && json_last_error() !== JSON_ERROR_NONE) {
            // Xử lý lỗi cú pháp JSON
            header('Content-Type: application/json', true, 400); // Bad Request
            echo json_encode([
                'success' => false,
                'message' => 'Dữ liệu gửi đi không phải là JSON hợp lệ.',
                'json_error' => json_last_error_msg() // Thông báo lỗi chi tiết từ PHP
            ]);
            exit; // Dừng script
        }

        $order = [];
        $order['user_id'] = $_SESSION['user_id'];
        $order['name'] = $data['name'];
        $order['phone'] = $data['phone'];
        $order['email'] = $data['email'];
        $order['address'] = $data['address'];
        $order['province_id'] = $data['city'];
        $order['note'] = $data['note'];
        $order['payment_method'] = $data['payment_method'];
        $order['status'] = 'pending';
        $order['total_amount'] = $data['total_amount'];
        
        try 
        {
            Order::add($order, $this->db);
            header('Content-Type: application/json');
            echo json_encode(['success' => true, 'message' => 'Thành công.', 'redirect_url' => '/']);
            exit;
        }
        catch (Exception $e)
        {
            header('Content-Type: application/json', true, 400); // Bad Request
            echo json_encode([
                'success' => false,
                'message' => 'sql error',
                'json_error' => $e // Thông báo lỗi chi tiết từ PHP
            ]);
            exit; // Dừng script
        }
    }
}