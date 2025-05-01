<?php

namespace App\Models;

class Category {
    public $id;
    public $name;
    public $slug;
    public $description;

    public static function getAllCategories($db) {
        $sql = "SELECT * FROM categories";
        $categories = $db->fetchAll($sql);

        // Chuyển đổi kết quả thành mảng các đối tượng Category
        $categoryObjects = [];
        foreach ($categories as $category) {
            $categoryObjects[] = self::createCategoryObject($category);
        }

        return $categoryObjects;
    }

    private static function createCategoryObject($categoryData) {
        $category = new Category();
        $category->id = $categoryData['id'];
        $category->name = $categoryData['name'];
        $category->slug = $categoryData['slug'];
        $category->description = $categoryData['description'];
        return $category;
    }
}
