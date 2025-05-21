<?php

namespace App\Models;

use PDOException;

class Order {
    public $id;
    public $user_id;
    public $name;
    public $total_amount;
    public $shipping_province_id;
    public $shipping_address;
    public $payment_method;
    public $status;
    public $created_at;
    public $updated_at;

    public static function add($data, $db)
    {
        $user_id = $data['user_id'];
        $name = $data['name'];
        $total_amount = (int)$data['total_amount'];
        $shipping_province_id = $data['province_id'];
        $shipping_address = $data['address'];
        $payment_method = $data['payment_method'];

        try {
            $sqlCreate = "INSERT INTO orders (user_id, order_name, total_amount, shipping_province_id, shipping_address, payment_method, status, created_at, updated_at) VALUES (:user_id, :order_name, :total_amount, :shipping_province_id, :shipping_address, :payment_method, 'pending', NOW(), NOW())";
            $params = [
                ':user_id' => $user_id,
                ':order_name' => $name,
                ':total_amount' => $total_amount,
                ':shipping_province_id' => $shipping_province_id,
                ':shipping_address' => $shipping_address,
                ':payment_method' => $payment_method
            ];
            if ($db->execute($sqlCreate, $params)) {
                $cartModel = new Cart($db);
                $cartModel->clearCart($user_id);
                return true;
            } else {
                error_log("OrderModel Error: Failed to create oder for user ID: {}");
                return false;
            }
        } catch (PDOException $e) {
            error_log("OrderModel PDOException: " . $e->getMessage());
            return false;
        }
    }

}