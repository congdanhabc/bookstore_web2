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

// Lọc và sắp xếp sách
$router->addRoute('/books/ajax?{param}', ['controller' => 'BookController', 'action' => 'ajaxLoadBooks'], 'GET', 'books.filter');

// Chi tiết sách
$router->addRoute('/books/{param}', ['controller' => 'BookController', 'action' => 'show'], 'GET', 'books.show');

// Đăng ký
$router->addRoute('/register', ['controller' => 'UserController', 'action' => 'register'], 'POST', 'register.submit'); // Xử lý đăng ký

// Đăng nhập
$router->addRoute('/login', ['controller' => 'UserController', 'action' => 'login'], 'GET', 'login.form'); // Hiển thị form đăng nhập
$router->addRoute('/authenticate', ['controller' => 'UserController', 'action' => 'authenticate'], 'POST', 'login.submit'); // Xử lý đăng nhập

// Đăng xuất
$router->addRoute('/logout', ['controller' => 'UserController', 'action' => 'logout'], 'GET', 'logout');

// Trang profile (yêu cầu đăng nhập)
$router->addRoute('/profile', ['controller' => 'UserController', 'action' => 'profile'], 'GET', 'profile');
$router->addRoute('/profile/update', ['controller' => 'UserController', 'action' => 'update'], 'POST', 'profile.update');

// Giỏ hàng
$router->addRoute('/cart', ['controller' => 'CartController', 'action' => 'index'], 'GET', 'cart.index');
$router->addRoute('/cart/read', ['controller' => 'CartController', 'action' => 'read'], 'GET', 'cart.read');
$router->addRoute('/cart/add', ['controller' => 'CartController', 'action' => 'add'], 'POST', 'cart.add');
$router->addRoute('/cart/update', ['controller' => 'CartController', 'action' => 'update'], 'POST', 'cart.update');
$router->addRoute('/cart/remove/{param}', ['controller' => 'CartController', 'action' => 'remove'], 'GET', 'cart.remove');
$router->addRoute('/cart/clear', ['controller' => 'CartController', 'action' => 'clear'], 'POST', 'cart.clear');//chưa

// Thanh toán
$router->addRoute('/checkout', ['controller' => 'OrderController', 'action' => 'checkout'], 'GET', 'checkout.form'); // Hiển thị form thanh toán
$router->addRoute('/checkout_submit', ['controller' => 'OrderController', 'action' => 'processCheckout'], 'POST', 'checkout.submit'); //chưa // Xử lý thanh toán

// Đặt hàng thành công
$router->addRoute('/order/success/{param}', ['controller' => 'OrderController', 'action' => 'success'], 'GET', 'order.success');//chưa

// Lịch sử đơn hàng
$router->addRoute('/order/history', ['controller' => 'OrderController', 'action' => 'history'], 'GET', 'order.history');//chưa

// Admin (ví dụ)
$router->addRoute('/admin/home', ['controller' => 'AdminController', 'action' => 'home'], 'GET', 'admin.home');
$router->addRoute('/admin/account', ['controller' => 'AdminController', 'action' => 'account'], 'GET', 'admin.account');
$router->addRoute('/admin/chart', ['controller' => 'AdminController', 'action' => 'chart'], 'GET', 'admin.chart');
$router->addRoute('/admin/order', ['controller' => 'AdminController', 'action' => 'order'], 'GET', 'admin.order');
$router->addRoute('/admin/bill', ['controller' => 'AdminController', 'action' => 'bill'], 'GET', 'admin.bill');
$router->addRoute('/admin/bill_deleted', ['controller' => 'AdminController', 'action' => 'bill_deleted'], 'GET', 'admin.bill_deleted');
$router->addRoute('/admin/product', ['controller' => 'AdminController', 'action' => 'product'], 'GET', 'admin.product');
$router->addRoute('/admin/statistical', ['controller' => 'AdminController', 'action' => 'statistical'], 'GET', 'admin.statistical');
