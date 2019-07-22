<?php

namespace app\models;

use app\core\Model;

class Main extends Model {
    public $error;
    
    public function countPosts() {
        return $this->database->column('SELECT COUNT(id) FROM posts');
    }

    public function listPosts($route, $max) {
        $params = [
            'max' => $max,
            'start' => ((($route['page'] ?? 1) - 1) * $max),
        ];

        return $this->database->row('SELECT * FROM posts ORDER BY id DESC LIMIT :start, :max', $params);
    }

    public function listCatPosts($cat_id) {
        $params = [
            'category' => $cat_id,
        ];

        return $this->database->row('SELECT * FROM posts WHERE category = :category  ORDER BY id DESC', $params);
    }

    public function likePost($id) {
        $params = [
            'id' => $id,
            'post_likes' => 0,
        ];

        $params['post_likes'] = $this->database->column('SELECT post_likes FROM posts WHERE id = :id', ['id' => $id]);

        $params['post_likes'] += 1;

        $this->database->query('UPDATE posts SET post_likes = :post_likes WHERE id = :id', $params);
    }

    public function getCatId($id) {
        $params = [
            'id' => $id,
        ];

        return $this->database->column('SELECT id FROM categories WHERE id = :id', $params);
    }

    public function getCatName($id) {
        $params = [
            'id' => $id,
        ];

        return $this->database->column('SELECT cat_name FROM categories WHERE id = :id', $params);
    }
}