<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\Province;
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
        $provinces = Province::getAllProvince($this->db);
        $data = [
            'provinces' => $provinces
        ];
        return $this->view('user/login', $data);
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
            $_SESSION['role'] = $user->role; // Lưu role

            // 6. Chuyển hướng
            if($_SESSION['role'] == 0){
                header('Location: /admin');
            }
            else{
                header('Location: /');
            }
            exit(); // Đảm bảo script dừng thực thi sau khi redirect
        } else {
            // Đăng nhập thất bại
            return $this->view('user/login', ['error_login' => 'Email hoặc mật khẩu không chính xác.']);
        }
    }
    public function logout() {
        // Xóa thông tin người dùng khỏi session
        unset($_SESSION['user_id']);
        unset($_SESSION['role']);

        // Chuyển hướng
        header('Location: /');
        exit();
    }
    public function profile() {
        $user = User::getUserByID($_SESSION['user_id'], $this->db);
        $provinces = Province::getAllProvince($this->db);
        $data = [
            'user' => $user,
            'provinces' => $provinces
        ];
        return $this->view('/user/profile', $data);
    }

    public function update() {
        // 1. Lấy dữ liệu từ form
        $user_id = $_SESSION['user_id'];
        $data = $_POST;

        // 2. Gọi model để cập nhật thông tin người dùng
        $updateResult = User::update($data, $user_id, $this->db);

        $user = User::getUserByID($_SESSION['user_id'], $this->db);
        $provinces = Province::getAllProvince($this->db);
        $data = [
            'user' => $user,
            'provinces' => $provinces,
        ];

        // 3. Xử lý kết quả cập nhật
        if ($updateResult) {
            // Cập nhật thành công
            $data['success'] = 'Cập nhật thông tin thành công!';            
        } else {
            // Cập nhật thất bại
            $data['error'] = 'Đã có lỗi xảy ra khi cập nhật thông tin. Vui lòng thử lại sau.';
        }
        return $this->view('/user/profile', $data);
    }
}