<?php

namespace App\Controllers;

use App\Core\Controller; 
use App\Models\User;

class UserController extends Controller {
    private $db; // Thêm thuộc tính $db

    public function __construct($db) { // Thêm constructor
        $this->db = $db;
    }

    public function register() {
        // 1. Lấy dữ liệu từ form
        $data = $_POST;

        // 2. Gọi model để đăng ký người dùng
        $registrationResult = User::register($data, $this->db);

        // 3. Xử lý kết quả đăng ký
        if ($registrationResult['success']) {
            // Đăng ký thành công
            // Chuyển hướng đến trang đăng nhập với thông báo thành công
            return $this->view('user/login', ['success_message' => 'Đăng ký thành công!']);
        } else {
            // Đăng ký thất bại
            // Hiển thị lại form đăng ký với thông báo lỗi
            return $this->view('user/register', ['error_register' => $registrationResult['error'], 'data' => $data]); // Truyền dữ liệu đã nhập để giữ lại form
        }
    }
    public function login() {
        return $this->view('user/login');
    }
    public function authenticate() {
        // 1. Lấy dữ liệu từ form
        $email = $_POST['email'] ?? ''; // Sử dụng toán tử null coalesce để tránh lỗi undefined index
        $password = $_POST['password'] ?? '';

        // 2. Kiểm tra dữ liệu đầu vào (validation - tùy chọn, nên có)
        // if (empty($email) || empty($password)) {
        //     return $this->view('user/login', ['error' => 'Vui lòng nhập đầy đủ email và mật khẩu.']);
        // }

        // 3. Lấy thông tin người dùng từ database dựa trên email
        $user = User::getUserByEmail($email, $this->db);

        // 4. Kiểm tra xem user có tồn tại và mật khẩu có đúng không
        if ($user && password_verify($password, $user->password)) {
            // Đăng nhập thành công

            // 5. Lưu thông tin người dùng vào session
            $_SESSION['user_id'] = $user->id; // Lưu user ID vào session

            // 6. Chuyển hướng đến trang chủ
            header('Location: /');
            exit(); // Đảm bảo script dừng thực thi sau khi redirect
        } else {
            // Đăng nhập thất bại
            return $this->view('user/login', ['error_login' => 'Email hoặc mật khẩu không chính xác.']);
        }
    }
    public function logout() {

    }
    public function profile() {

    }
}