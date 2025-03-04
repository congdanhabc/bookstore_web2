<?php

namespace App\Core;

use App\Controllers\HomeController;
use App\Controllers\BookController;

class App {
    private $config;
    private $database;
    private $router;

    public function __construct() {
        // 1. Load cấu hình
        $this->config = require CONFIG_DIR . '/app.php';

        // 2. Kết nối database
        $databaseConfig = require CONFIG_DIR . '/database.php';
        $this->database = new Database($databaseConfig);

        // 3. Khởi tạo router
        $this->router = new Router();
    }

    public function getConfig() {
        return $this->config;
    }

    public function getDatabase() {
        return $this->database;
    }

    public function getRouter() {
        return $this->router;
    }

    public function run() {
        // 1. Lấy URL request
        $uri = $_SERVER['REQUEST_URI'];

        // 2. Load routes và truyền $router instance
        $router = $this->router; // Lưu router vào biến cục bộ để sử dụng
        include CONFIG_DIR . '/routes.php';

        // 3. Lấy route phù hợp với URL
        $route = $this->router->getRoute($uri);

        // 4. Kiểm tra xem route có tồn tại không
        if (!$route) {
            // Xử lý khi không tìm thấy route (ví dụ: hiển thị trang 404)
            http_response_code(404);
            echo "<h1>404 Not Found</h1>";
            return;
        }

        // 5. Gọi controller và action
        $controllerName = $route['controller'];
        $actionName = $route['action'];

        // 6. Tạo instance của controller và gọi action
        if (class_exists($controllerName)) {
            $controller = new $controllerName($this->database); // Truyền database vào controller
            $controller->$actionName();
        } else {
            echo "Không tìm thấy class: " . $controllerName;
        }
    }
}