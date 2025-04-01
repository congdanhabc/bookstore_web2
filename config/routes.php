<?php

/**
 * File này định nghĩa tất cả các route (tuyến đường) của ứng dụng.
 * Mỗi route liên kết một URL (pattern) với một controller và action cụ thể.
 */

// Lưu ý: Giả sử $router là một instance của App\Core\Router đã được tạo
// trong app/Core/App.php và được truyền cho file này.

// Lưu ý: này mới tạo thử thôi, trong quá trình làm có thể sửa lại cho phù hợp

// Trang chủ
$router->addRoute('/', ['controller' => 'HomeController', 'action' => 'index'], 'GET', 'home');

// Danh sách sách
$router->addRoute('/books', ['controller' => 'BookController', 'action' => 'index'], 'GET', 'books.index');

// Chi tiết sách
$router->addRoute('/books/{param}', ['controller' => 'BookController', 'action' => 'show'], 'GET', 'books.show');

// Tìm kiếm sách
$router->addRoute('/search', ['controller' => 'BookController', 'action' => 'search'], 'GET', 'books.search');//chưa

// Danh sách danh mục
$router->addRoute('/categories', ['controller' => 'CategoryController', 'action' => 'index'], 'GET', 'categories.index');//chưa

// Hiển thị sách theo danh mục (sử dụng slug)
$router->addRoute('/categories/{param}', ['controller' => 'CategoryController', 'action' => 'show'], 'GET', 'categories.show');//chưa

// Đăng ký
$router->addRoute('/register', ['controller' => 'UserController', 'action' => 'register'], 'POST', 'register.submit'); //chưa // Xử lý đăng ký

// Đăng nhập
$router->addRoute('/login', ['controller' => 'UserController', 'action' => 'login'], 'GET', 'login.form'); //chưa // Hiển thị form đăng nhập
$router->addRoute('/authenticate', ['controller' => 'UserController', 'action' => 'authenticate'], 'POST', 'login.submit'); //chưa // Xử lý đăng nhập

// Đăng xuất
$router->addRoute('/logout', ['controller' => 'UserController', 'action' => 'logout'], 'GET', 'logout');//chưa

// Trang profile (yêu cầu đăng nhập)
$router->addRoute('/profile', ['controller' => 'UserController', 'action' => 'profile'], 'GET', 'profile');//chưa

// Giỏ hàng
$router->addRoute('/cart', ['controller' => 'CartController', 'action' => 'index'], 'GET', 'cart.index');//chưa
$router->addRoute('/cart/add/{param}', ['controller' => 'CartController', 'action' => 'add'], 'POST', 'cart.add');//chưa
$router->addRoute('/cart/update/{param}', ['controller' => 'CartController', 'action' => 'update'], 'POST', 'cart.update');//chưa
$router->addRoute('/cart/remove/{param}', ['controller' => 'CartController', 'action' => 'remove'], 'POST', 'cart.remove');//chưa
$router->addRoute('/cart/clear', ['controller' => 'CartController', 'action' => 'clear'], 'POST', 'cart.clear');//chưa

// Thanh toán
$router->addRoute('/checkout', ['controller' => 'OrderController', 'action' => 'checkout'], 'GET', 'checkout.form'); //chưa // Hiển thị form thanh toán
$router->addRoute('/checkout', ['controller' => 'OrderController', 'action' => 'processCheckout'], 'POST', 'checkout.submit'); //chưa // Xử lý thanh toán

// Đặt hàng thành công
$router->addRoute('/order/success/{param}', ['controller' => 'OrderController', 'action' => 'success'], 'GET', 'order.success');//chưa

// Lịch sử đơn hàng
$router->addRoute('/order/history', ['controller' => 'OrderController', 'action' => 'history'], 'GET', 'order.history');//chưa

// Admin (ví dụ)
$router->addRoute('/admin', ['controller' => 'Admin\\DashboardController', 'action' => 'index'], 'GET', 'admin.dashboard');//chưa
$router->addRoute('/admin/books', ['controller' => 'Admin\\BookController', 'action' => 'index'], 'GET', 'admin.books.index');//chưa
$router->addRoute('/admin/books/create', ['controller' => 'Admin\\BookController', 'action' => 'create'], 'GET', 'admin.books.create');//chưa
$router->addRoute('/admin/books/store', ['controller' => 'Admin\\BookController', 'action' => 'store'], 'POST', 'admin.books.store');//chưa
$router->addRoute('/admin/books/{param}/edit', ['controller' => 'Admin\\BookController', 'action' => 'edit'], 'GET', 'admin.books.edit');//chưa
$router->addRoute('/admin/books/{param}/update', ['controller' => 'Admin\\BookController', 'action' => 'update'], 'POST', 'admin.books.update');//chưa
$router->addRoute('/admin/books/{param}/delete', ['controller' => 'Admin\\BookController', 'action' => 'delete'], 'POST', 'admin.books.delete');//chưa