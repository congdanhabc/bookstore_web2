<?php

namespace App\Models;

use App\Core\Database;
use PDOException;

class Cart
{
    private $db;

    public function __construct(Database $db)
    {
        $this->db = $db;
    }

    
    //Tìm cart_id hiện có của user hoặc tạo mới nếu chưa có.
    private function findOrCreateCartId(int $userId)
    {
        // 1. Thử tìm giỏ hàng hiện có của user
        $sql = "SELECT id FROM carts WHERE user_id = $userId LIMIT 1";
        try {
            $cartId = $this->db->fetch($sql);

            if ($cartId !== false) {
                return (int)$cartId; // Trả về ID nếu tìm thấy
            }

            // 2. Nếu không tìm thấy, tạo giỏ hàng mới
            $sqlCreate = "INSERT INTO carts (user_id, created_at, updated_at) VALUES ($userId, NOW(), NOW())";
            if ($this->db->execute($sqlCreate)) {
                // Lấy ID của giỏ hàng vừa tạo
                $newCartId = $this->db->lastInsertId();
                return (int)$newCartId;
            } else {
                error_log("CartModel Error: Failed to create cart for user ID: {$userId}");
                return false;
            }
        } catch (PDOException $e) {
            error_log("CartModel PDOException in findOrCreateCartId: " . $e->getMessage());
            return false;
        }
    }

    //Thêm hoặc cập nhật sản phẩm trong bảng cart_items.
    public function addItem(int $userId, int $bookId, int $quantity): bool
    {
        if ($quantity < 1) {
            return false; // Số lượng không hợp lệ
        }

        // Lấy hoặc tạo cart_id cho user
        $cartId = $this->findOrCreateCartId($userId);
        if ($cartId === false) {
            return false; // Không thể lấy/tạo giỏ hàng
        }

        try {
            // Kiểm tra xem sản phẩm đã tồn tại trong giỏ hàng này chưa
            $sql = "SELECT id, quantity FROM cart_items WHERE cart_id = $cartId AND product_id = $bookId LIMIT 1";
            $existingItem = $this->db->fetch($sql);

            if ($existingItem) {
                // Sản phẩm đã tồn tại -> Cập nhật số lượng và giá
                $newQuantity = $existingItem['quantity'] + $quantity;
                $sqlUpdate = "UPDATE cart_items SET quantity = $newQuantity WHERE id = ".$existingItem['id'];
                return $this->db->execute($sqlUpdate);
            } else {
                // Sản phẩm chưa tồn tại -> Thêm mới
                $sqlInsert = "INSERT INTO cart_items (cart_id, product_id, quantity)
                              VALUES ($cartId, $bookId, $quantity)";
                return $this->db->execute($sqlInsert);
            }
        } catch (\PDOException $e) {
            error_log("CartModel PDOException in addItem: " . $e->getMessage());
            return false;
        }
    }

    //Tìm cart_id của user (không tạo mới nếu không có)
    private function findCartId(int $userId)
    {
        $sql = "SELECT id FROM carts WHERE user_id = $userId LIMIT 1";
        try {
            $cartId = $this->db->fetch($sql);
            return ($cartId === false) ? null : (int)$cartId;
        } catch (\PDOException $e) {
            error_log("CartModel PDOException in findCartId: " . $e->getMessage());
            return null;
        }
    }


    //Lấy danh sách các mục trong giỏ hàng của user, kèm thông tin sách.
    public function getItems(int $userId): array
    {
        $cartId = $this->findCartId($userId);
        if ($cartId === null) {
            return []; // Người dùng chưa có giỏ hàng
        }

        $sql = "SELECT id, product_id, quantity FROM cart_items WHERE cart_id = $cartId";

        try {
            $cartItems = $this->db->fetchAll($sql);
            foreach ($cartItems as &$item) {
                $book = Book::getBooksByID_Cart($item['product_id'], $this->db);
                $item['name'] = $book->name;
                $item['sale_price'] = $book->sale_price;
                $item['image'] = $book->image;
                $item['author'] = $book->author;
            }           
            return $cartItems;
        } catch (\PDOException $e) {
             error_log("CartModel PDOException in getItems: " . $e->getMessage());
             return []; // Trả về mảng rỗng nếu lỗi
        }
    }

    //Đếm tổng số lượng sản phẩm (tính cả số lượng của từng loại) trong giỏ hàng.
    public function getTotalItemCount(int $userId): int
    {
        $cartId = $this->findCartId($userId);
        if ($cartId === null) {
            return 0;
        }

        $sql = "SELECT SUM(quantity) FROM cart_items WHERE cart_id = $cartId";
        try {
            $total = $this->db->fetch($sql);
            return $total ? (int)$total : 0; // Trả về 0 nếu SUM là NULL (giỏ trống)
        } catch (\PDOException $e) {
             error_log("CartModel PDOException in getTotalItemCount: " . $e->getMessage());
             return 0;
        }
    }

    public function removeItem(int $cartItemId)
    {
        $sql = "DELETE FROM cart_items WHERE id = $cartItemId";
        try {
            return $this->db->execute($sql);
        } catch (\PDOException $e) {
             error_log("CartModel PDOException in removeItem: " . $e->getMessage());
             return 0;
        }
    }
    public function updateQuantity(int $cartItemId, int $newQuantity)
    {
        $sql = "UPDATE cart_items SET quantity = $newQuantity WHERE id = ".$cartItemId;
        try {
            return $this->db->execute($sql);
        } catch (\PDOException $e) {
             error_log("CartModel PDOException in updateQuantity: " . $e->getMessage());
             return 0;
        }
    }
    public function clearCart(int $userId)
    {
        $cartId = $this->findCartId($userId);
        if ($cartId === null) {
            return 0;
        }

        try{
            $sql = "DELETE FROM cart_items WHERE cart_id = $cartId";
            return $this->db->execute($sql);
        }
        catch (\PDOException $e) {
             error_log("CartModel PDOException in clearCart: " . $e->getMessage());
             return 0;
        }
    }
    // public function getTotalPrice(int $userId): float
}