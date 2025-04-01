<?php
ini_set('session.gc_maxlifetime', 3600);
session_set_cookie_params(3600);
session_start();
/**
 * Điểm vào (entry point) của ứng dụng.
 *
 * File này chịu trách nhiệm:
 *  1. Định nghĩa các hằng số quan trọng.
 *  2. Khởi động ứng dụng (bootstrap).
 *  3. Chạy ứng dụng.
 */

// 1. Định nghĩa các hằng số
define('ROOT_DIR', dirname(__DIR__)); // Đường dẫn đến thư mục gốc của project
define('APP_DIR', ROOT_DIR . '/app');   // Đường dẫn đến thư mục app
define('CONFIG_DIR', ROOT_DIR . '/config'); // Đường dẫn đến thư mục config
define('PUBLIC_DIR', ROOT_DIR . '/public'); // Đường dẫn đến thư mục public

// Load autoloader
require_once ROOT_DIR . '/vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(ROOT_DIR);
$dotenv->load(); //Load các biến từ file .env

// Load helper functions
require_once APP_DIR . '/Core/Helpers.php';

// 2. Khởi động ứng dụng (bootstrap)
require APP_DIR . '/Core/App.php';

// 3. Chạy ứng dụng
$app = new App\Core\App(); // Tạo một instance của class App (Core/App.php)

try {
    $app->run(); // Gọi phương thức run() để xử lý request và hiển thị response
} catch (Exception $e) {
    // Xử lý exception (ví dụ: ghi log, hiển thị thông báo lỗi thân thiện)
    error_log($e->getMessage() . "\n" . $e->getTraceAsString()); // Ghi log lỗi
    http_response_code(500); // Đặt mã trạng thái HTTP là 500 (Internal Server Error)
    echo "<h1>Oops! Đã có lỗi xảy ra.</h1>"; // Hiển thị thông báo lỗi
}