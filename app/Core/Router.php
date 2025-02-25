<?php

/* Class này chứa logic để so khớp URL request với các route đã được định nghĩa trong config/routes.php, 
trích xuất các tham số từ URL (nếu có), và trả về thông tin về controller và action cần gọi. */ 

namespace App\Core;

class Router {
    private $routes = [];

    public function addRoute($url, $controllerAction, $method = 'GET', $name = null) {
        $this->routes[$url] = [
            'controller' => $controllerAction['controller'],
            'action' => $controllerAction['action'],
            'method' => strtoupper($method), // Chuyển về chữ hoa để so sánh dễ dàng hơn
            'name' => $name,
        ];
    }

    public function getRoute($uri, $method = 'GET') {
        $method = strtoupper($method); // Chuyển về chữ hoa để so sánh dễ dàng hơn

        foreach ($this->routes as $routeUrl => $routeData) {
            // So khớp URL
            if ($routeUrl === $uri && $routeData['method'] === $method) {
                return $routeData;
            }
        }

        return null; // Không tìm thấy route
    }
}