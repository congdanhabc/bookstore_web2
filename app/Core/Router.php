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

    public function getRoute($uri, $method) {
        $method = strtoupper($method); // Chuyển về chữ hoa để so sánh dễ dàng hơn
        foreach ($this->routes as $routeUrl => $routeData) {
            // Chuyển đổi URL pattern thành regular expression
            $pattern = preg_replace('/\{([a-zA-Z0-9_]+)\}/', '(?P<$1>[^/]+)', $routeUrl);
            $pattern = '#^' . $pattern . '$#';

            // var_dump($pattern, " - ", $uri , "_________");
            // So khớp URL request với regular expression
            if (preg_match($pattern, $uri, $matches) && $routeData['method'] === $method) {
                // Trích xuất các tham số từ matches
                $params = array_filter($matches, "is_string", ARRAY_FILTER_USE_KEY);
                    
                // Trả về thông tin route và các tham số
                return array_merge($routeData, $params);
            }
        }

        return null; // Không tìm thấy route
    }
}