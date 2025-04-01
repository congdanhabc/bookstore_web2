<?php

namespace App\Core;

use App\Controllers;
use App\Controllers\UserController;

class App {
    private $config;
    private $db;
    private $router;

    public function __construct() {
        // 1. Load cấu hình
        $this->config = require CONFIG_DIR . '/app.php';

        // 2. Kết nối database
        $databaseConfig = require CONFIG_DIR . '/database.php';
        $this->db = new Database($databaseConfig);

        // 3. Khởi tạo router
        $router = new Router();
        include CONFIG_DIR . '/routes.php';
        $this->router = $router;
        // $this->router = new Router();
    }

    public function getConfig() {
        return $this->config;
    }

    public function getDatabase() {
        return $this->db;
    }

    public function getRouter() {
        return $this->router;
    }

    public function run() {
        // 1. Lấy URL request
        $uri = $_SERVER['REQUEST_URI'];      
        $_method = $_SERVER['REQUEST_METHOD'];

        // 2. Load routes và truyền $router instance
        // $router = $this->router; // Lưu router vào biến cục bộ để sử dụng
        // include CONFIG_DIR . '/routes.php';

        // 3. Lấy route phù hợp với URL
        $route = $this->router->getRoute($uri, $_method);

        // 4. Kiểm tra xem route có tồn tại không
        if (!$route) {
            // Xử lý khi không tìm thấy route (ví dụ: hiển thị trang 404)
            http_response_code(404);
            echo "<h1>404 Not Found</h1>";
            return;
        }

        // 5. Gọi controller và action
        $controllerName = 'App\Controllers\\'. $route['controller'];
        $actionName = $route['action'];
        $actionParams = isset($route['param']) ? $route['param'] : null;

        // 6. Tạo instance của controller và gọi action
        if (class_exists($controllerName)) {
            $controller = new $controllerName($this->db); // Truyền database vào controller
            $actionParams ? $controller->$actionName($actionParams) : $controller->$actionName();
        } else {
            echo "Không tìm thấy class: " . $controllerName;
        }
    }
}