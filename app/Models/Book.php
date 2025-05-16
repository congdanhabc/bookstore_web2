<?php

namespace App\Models;

class Book {
    public $id;
    public $category;
    public $category_id;
    public $name;
    public $author;
    public $authorID;
    public $publisher;
    public $publisherID;
    public $description;
    public $price;
    public $sale_price;
    public $image;
    public $stock;
    public $created_at;
    public $updated_at;
    public $publish_year;
    public $size;
    public $page;
    public $cover_type;

    // Hàm hỗ trợ để tạo đối tượng Book từ mảng
    private static function createBookObject($bookData, $db) {
        $book = new Book();
        $book->id = $bookData['id'];
        $book->category_id = $bookData['category_id'];
        $book->category = Category::getCategoryName($bookData['category_id'], $db);
        $book->name = $bookData['name'];
        $book->authorID = $bookData['author_id'];
        $book->author = Author::getAuthorName($bookData['author_id'], $db);
        $book->publisherID = $bookData['publisher_id'];
        $book->publisher = Publisher::getPublisherName($bookData['publisher_id'], $db);
        $book->description = $bookData['description'];
        $book->price = $bookData['price'];
        $book->sale_price = $bookData['sale_price'];
        $book->image = $bookData['image'];
        $book->stock = $bookData['stock'];
        $book->created_at = $bookData['created_at'];
        $book->updated_at = $bookData['updated_at'];
        $book->publish_year = $bookData['publish_year'];
        $book->size = $bookData['size'];
        $book->page = $bookData['page'];
        $book->cover_type = $bookData['cover_type'];
        return $book;
    }

    private static function createBookObjectForList($bookData, $db) {
        $book = new Book();
        $book->id = $bookData['id'];
        $book->name = $bookData['name'];
        $book->author = Author::getAuthorName($bookData['author_id'], $db); // Lấy tên tác giả từ bảng authors
        $book->price = $bookData['price'];
        $book->sale_price = $bookData['sale_price'];
        $book->image = $bookData['image'];
        $book->publisher = Publisher::getPublisherName($bookData['publisher_id'], $db);
        $book->category = Category::getCategoryName($bookData['category_id'], $db);
        return $book;
    }

    public static function getAllBooks($db) {
        $sql = "SELECT id, name, author_id, publisher_id, category_id, price, sale_price, image FROM books";
        $books = $db->fetchAll($sql);

        // Chuyển đổi kết quả thành mảng các đối tượng Book
        $bookObjects = [];
        foreach ($books as $book) {
            $bookObjects[] = self::createBookObjectForList($book, $db);
        }

        return $bookObjects;
    }

    public static function getBooksWithFiltersAndPagination(array $filters, int $limit, int $offset ,$db): array
    {
        $sql = "SELECT id, name, author_id, price, sale_price, image, publisher_id, category_id FROM books";
        $params = [];
        $whereClauses = [];

        // Áp dụng bộ lọc (Ví dụ)
        if (!empty($filters['category_id'])) {
            $whereClauses[] = "category_id = ".$filters['category_id'];
        }
        if (!empty($filters['price_min'])) {
            $whereClauses[] = "sale_price >= ".$filters['price_min'];
        }
         if (!empty($filters['price_max'])) {
            $whereClauses[] = "sale_price <= ".$filters['price_max'];
        }
        if (!empty($filters['search'])) {
            $whereClauses[] = "name LIKE :search";
            $params[':search'] = '%' . $filters['search'] . '%';
        }

        if (!empty($whereClauses)) {
            $sql .= " WHERE " . implode(" AND ", $whereClauses);
        }
        
        // Sắp xếp
        $sql .= " ORDER BY ".$filters['sort']. " ".($filters['ascending'] === true ? "ASC" : "DESC");

        // Phân trang
        $sql .= " LIMIT $limit OFFSET $offset";

        // print($sql);

        $books = $db->fetchAll($sql, $params);

        // Chuyển đổi kết quả thành mảng các đối tượng Book
        $bookObjects = [];
        foreach ($books as $book) {
            $bookObjects[] = self::createBookObjectForList($book, $db);
        }
        
        return $bookObjects;
    }

    public static function countBooksWithFilters(array $filters ,$db): int
    {
        $sql = "SELECT COUNT(id) FROM books";
        $params = [];
        $whereClauses = [];

         // Áp dụng bộ lọc (TƯƠNG TỰ như phương thức trên)
         if (!empty($filters['category_id'])) {
            $whereClauses[] = "category_id = :category_id";
            $params[':category_id'] = $filters['category_id'];
        }
        if (!empty($filters['price_min'])) {
            $whereClauses[] = "sale_price >= :price_min";
            $params[':price_min'] = $filters['price_min'];
        }
         if (!empty($filters['price_max'])) {
            $whereClauses[] = "sale_price <= :price_max";
            $params[':price_max'] = $filters['price_max'];
        }
        if (!empty($filters['search'])) {
            $whereClauses[] = "name LIKE :search";
            $params[':search'] = '%' . $filters['search'] . '%';
        }


        if (!empty($whereClauses)) {
            $sql .= " WHERE " . implode(" AND ", $whereClauses);
        }

        // Thực thi query (điều chỉnh theo class Database của bạn)
        $count = $db->fetch($sql, $params);
        return intval($count['COUNT(id)']);
    }

    public static function getBooksByID($id ,$db) {
        $sql = "SELECT * FROM books WHERE id = $id";
        $book = $db->fetch($sql);
        $bookObject = self::createBookObject($book, $db);
        return $bookObject;
    }

    public static function getBooksByID_Cart($id ,$db) {
        $sql = "SELECT * FROM books WHERE id = $id";
        $book = $db->fetch($sql);
        $bookObject = self::createBookObjectForList($book, $db);
        return $bookObject;
    }

    public static function suggestBookbyID($id, $suggest_type, $suggest_typeID, $db){
        $sql = "SELECT id, name, author_id, price, sale_price, image, publisher_id, category_id FROM books WHERE id != $id AND $suggest_type = $suggest_typeID ORDER BY RAND() LIMIT 5";
        $books = $db->fetchAll($sql);
        $bookObjectsList = [];
        foreach ($books as $book) {
            $bookObjectsList[] = self::createBookObjectForList($book, $db);
        }
        return $bookObjectsList;
    }

}