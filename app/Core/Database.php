<?php

namespace App\Core;

use PDO;
use PDOException;

class Database {
    private $pdo; // Instance của PDO

    public function __construct(array $config) {
        $driver = $config['driver'];
        $host = $config['host'];
        $port = $config['port'];
        $database = $config['database'];
        $username = $config['username'];
        $password = $config['password'];
        $charset = $config['charset'];
        $collation = $config['collation'];

        try {
            $dsn = "$driver:host=$host;port=$port;dbname=$database;charset=$charset";
            $this->pdo = new PDO($dsn, $username, $password); // Truyền options vào PDO
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die("Lỗi kết nối database: " . $e->getMessage());
        }
    }

    public function getPDO(): PDO {
        return $this->pdo;
    }

    //query(): Thực hiện một truy vấn SQL bất kỳ.
    /*Lưu ý quan trọng: Hàm này không sử dụng prepared statements, vì vậy nó rất dễ bị tấn công SQL injection nếu bạn không cẩn thận. 
    Chỉ sử dụng hàm này cho các truy vấn tĩnh (không có tham số từ người dùng) hoặc khi bạn đã tự escape các tham số một cách an toàn.*/
    public function query(string $sql) {
        try {
            return $this->pdo->query($sql);
        } catch (PDOException $e) {
            die("Lỗi truy vấn: " . $e->getMessage());
        }
    }

    //fetch(): Thực hiện một truy vấn và trả về một dòng kết quả.
    public function fetch(string $sql, array $params = []) {
        try {
            $stmt = $this->pdo->prepare($sql);
            /*Phương thức prepare() chuẩn bị một câu truy vấn SQL để thực thi. 
            Trả về một PDOStatement object (chứa các phương thức để thực thi truy vấn và lấy kết quả) nếu thành công.*/
            $stmt->execute($params); //Thực thi  PDOStatement object
            return $stmt->fetch(); //Trả về 1 dòng kết quả
        } catch (PDOException $e) {
            die("Lỗi fetch: " . $e->getMessage());
        }
    }

    //fetchAll(): Thực hiện một truy vấn và trả về tất cả các dòng kết quả.
    public function fetchAll(string $sql, array $params = []): array {
        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute($params);
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            die("Lỗi fetchAll: " . $e->getMessage());
        }
    }

    //execute(): Thực hiện một truy vấn mà không trả về kết quả (ví dụ: INSERT, UPDATE, DELETE).
    public function execute(string $sql, array $params = []): bool {
        try {
            $stmt = $this->pdo->prepare($sql);
            return $stmt->execute($params);
        } catch (PDOException $e) {
            die("Lỗi execute: " . $e->getMessage());
        }
    }
}