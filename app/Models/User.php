<?php

namespace App\Models;

class User {
    public $id;
    public $name;
    public $email;
    public $password;
    public $address;
    public $phone;
    public $created_at;
    public $updated_at;
    public $role;

    public static function getUserByEmail(string $email, $db) {
        $sql = "SELECT * FROM users WHERE email = ?";
        $params = [$email];
        $stmt = $db->fetch($sql, $params);
        if ($stmt) {
            return self::createUserObjectLogin($stmt);
        }
        return false;
    }

    public static function getUserByID(int $id, $db){
        $sql = "SELECT * FROM users WHERE id = ?";
        $params = [$id];
        $stmt = $db->fetch($sql, $params);
        if ($stmt) {
            return self::createUserObject($stmt);
        }
        return false;
    }

    private static function createUserObjectLogin($userData) {
        $user = new User();
        $user->id = $userData['id'];
        $user->password = $userData['password'];
        $user->role = $userData['role'];
        return $user;
    }

    private static function createUserObject($userData) {
        $user = new User();
        $user->id = $userData['id'];
        $user->name = $userData['name'];
        $user->email = $userData['email'];
        $user->password = $userData['password'];
        $user->address = $userData['address'];
        $user->phone = $userData['phone'];
        $user->created_at = $userData['created_at'];
        $user->updated_at = $userData['updated_at'];
        $user->role = $userData['role'];
        return $user;
    }

    public static function register(array $data, $db) {
        if (self::emailExists($data['email'], $db)) {
            return ['success' => false, 'error' => 'Email này đã được đăng ký.'];
        }

        // 3. Mã hóa mật khẩu
        $hashedPassword = password_hash($data['password'], PASSWORD_DEFAULT);

        // 4. Thêm người dùng mới vào database
        $sql = "INSERT INTO users (name, email, password, address, phone, role) VALUES (?, ?, ?, ?, ?, ?)";
        $params = [
            $data['name'],
            $data['email'],
            $hashedPassword,
            $data['address'].", ".$data['ward'].", ".$data['district'].", ".$data['city'],
            $data['phone'],
            1
        ];

        $result = $db->execute($sql, $params);

        if ($result) {
            return ['success' => true, 'message' => 'Đăng ký thành công! Vui lòng đăng nhập.'];
        } else {
            return ['success' => false, 'error' => 'Đã có lỗi xảy ra khi đăng ký. Vui lòng thử lại sau.'];
        }
    }

    private static function emailExists(string $email, $db): bool {
        $sql = "SELECT id FROM users WHERE email = ?";
        $params = [$email];
        $user = $db->fetch($sql, $params);
        return $user ? true : false;
    }
}