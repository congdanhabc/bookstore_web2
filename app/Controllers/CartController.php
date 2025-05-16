<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\Cart;
use App\Models\Book; // Cần để lấy giá sách
use App\Core\Database; // Giả sử

class CartController extends Controller
{
    private $cartModel;
    private $db; // Thêm đối tượng DB

    public function __construct($db)
    {
        $this->db = $db;
        $this->cartModel = new Cart($this->db);
    }

    //Lưu thông báo vào session.
    protected function setFlashMessage(string $message, string $type = 'success')
    {
        $_SESSION['flash_message'] = [
            'message' => $message,
            'type' => $type
        ];
    }

    //Chuyển hướng người dùng về trang trước đó.
    protected function redirectBack()
    {
        $previousUrl = $_SERVER['HTTP_REFERER'] ?? '/'; // Lấy URL trang trước hoặc về trang chủ
        header('Location: ' . $previousUrl);
        exit;
    }

    //Xử lý yêu cầu POST (từ form) để thêm sản phẩm vào giỏ hàng DB.
    public function add()
    {
        // --- Kiểm tra đăng nhập ---
        if (!isset($_SESSION['user_id'])) { // Giả sử user_id lưu trong session sau khi login
            $this->setFlashMessage('Bạn cần đăng nhập để thêm vào giỏ hàng.', 'error');
            header('Location: /login'); // Chuyển đến trang đăng nhập
            exit;
        }
        $userId = (int) $_SESSION['user_id'];

        // --- Kiểm tra phương thức POST ---
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: /');
            exit;
        }

        // --- Lấy và Validate dữ liệu ---
        $bookId = $_POST['book_id'] ?? null;
        $quantity = $_POST['quantity'] ?? 1;

        if (empty($bookId) || !filter_var($bookId, FILTER_VALIDATE_INT)) {
            $this->setFlashMessage('Lỗi: ID sách không hợp lệ.', 'error');
            $this->redirectBack();
        }
        if (!filter_var($quantity, FILTER_VALIDATE_INT) || (int) $quantity < 1) {
            $this->setFlashMessage('Lỗi: Số lượng không hợp lệ.', 'error');
            $this->redirectBack();
        }
        $bookId = (int) $bookId;
        $quantity = (int) $quantity;

        // --- Gọi Model để thêm vào giỏ hàng ---
        $success = $this->cartModel->addItem($userId, $bookId, $quantity);

        // --- Xử lý kết quả và chuyển hướng ---
        if ($success) {
            $this->setFlashMessage('Đã thêm sản phẩm vào giỏ hàng!', 'success');
        } else {
            $this->setFlashMessage('Có lỗi xảy ra khi thêm vào giỏ hàng.', 'error');
        }

        $this->redirectBack();
    }

    //Hiển thị trang giỏ hàng
    public function index()
    {
        $this->view('cart/cart');
    }

    public function read()
    {
        if (!isset($_SESSION['user_id'])) {
            header('Content-Type: application/json');
            $responseData = [
                'success' => false,
                'message' => 'Bạn cần đăng nhập để xem giỏ hàng.'];
            echo json_encode($responseData);
        exit;
        }
        $userId = (int) $_SESSION['user_id'];

        try{
            // Lấy các mục trong giỏ từ Model
            $cartItems = $this->cartModel->getItems($userId);

            // Tính tổng tiền (ví dụ)
            $totalPrice = 0;
            foreach ($cartItems as $item) {
                // Nên dùng price_at_add để tính tổng, vì giá hiện tại có thể đã thay đổi
                $totalPrice += $item['sale_price'] * $item['quantity'];
            }

            $responseData = [
                'success' => true,
                'cartItems' => $cartItems,
                'totalPrice' => $totalPrice
            ];         
        } catch (\Exception $e) {
            // Ghi log lỗi ở đây nếu cần
            error_log("AJAX Load Cart Error: " . $e->getMessage());
            $responseData = [
                'success' => false,
                'message' => 'Đã có lỗi xảy ra khi tải dữ liệu giỏ hàng.'
            ];
        }

        header('Content-Type: application/json');
        echo json_encode($responseData);
        exit;
    }

    public function update()
    {
        $jsonBody = file_get_contents('php://input');
        $data = json_decode($jsonBody, true);
        $cartItemId = $data['itemID'];
        $newQuantity = $data['quantity'];

        $responseData['success'] = $this->cartModel->updateQuantity($cartItemId, $newQuantity);
        header('Content-Type: application/json');
        echo json_encode($responseData);
        exit;
    }

    public function remove($id)
    {
        if (!isset($_SESSION['user_id'])) {
            header('Location: /login');
            exit;
        }
        if($this->cartModel->removeItem($id))
        {
            $this->setFlashMessage('Đã xóa sản phẩm khỏi giỏ hàng!', 'success');
        }
        else
        {
            $this->setFlashMessage('Có lỗi xảy ra khi xóa sản phẩm khỏi giỏ hàng.', 'error');
        }
        $this->redirectBack();
    }

    public function clear($id)
    {

    }
}