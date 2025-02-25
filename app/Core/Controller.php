<?php

namespace App\Core;

class Controller {
    protected function view(string $path, array $data = []) {
        // Giải nén dữ liệu để có thể truy cập các biến trong view
        extract($data);

        // Đường dẫn đầy đủ đến file view
        $viewPath = APP_DIR . '/Views/' . $path . '.php';

        // Kiểm tra xem file view có tồn tại hay không
        if (file_exists($viewPath)) {
            // Load view
            require $viewPath;
        } else {
            // Xử lý lỗi nếu view không tồn tại
            echo "View không tồn tại: " . $viewPath;
        }
    }
}