<?php

namespace app\models;

use app\core\Model;
use Imagick;

class Admin extends Model {
    public $error;

    /**
     * Validation of admin login form
     */
    public function loginValidate($post) {
        $config = require 'app/config/admin.php';
        if($config['login'] != $post['login'] || $config['password'] != $post['password']) {
            $this->error = 'Please enter coorect login or password';
            return false;
        }

        return true;
    }

    /**
     * Validation of add or edit post form 
     */
    public function postValidate($post, $type) {
        $titleLength   = iconv_strlen($post['post_title']);
        $descrLength   = iconv_strlen($post['post_description']);
        $contentLength = iconv_strlen($post['post_content']);

        /**
         * Text content validation
         */
        if($titleLength < 3) {
            $this->error = 'Title shoud be longer than 3 symbols';
            return false;
        }
        elseif($descrLength < 3 or $descrLength > 100) {
            $this->error = 'Description shoud be from 3 to 100 symbols';
            return false;
        }
        elseif($contentLength < 10) {
            $this->error = 'Content shoud be from 10 symbols';
            return false;
        }

        /**
         * Validation on adding the post
         */
        if($type == 'add') {
            
            if(empty($_FILES['post_image']['tmp_name'])) {            
                $this->error = 'The post thumbnail was not added';
                return false;
            }
        }

        return true;
    }

    /**
     * Create new post with in DB
     * returns id of post
     */
    public function postAdd($post) {
        $params = [
            'id'               => '',
            'post_title'       => $post['post_title'],
            'post_description' => $post['post_description'],
            'post_content'     => $post['post_content'],
            'category'         => $post['category'],
        ];

        $this->database->query('INSERT INTO posts (id, post_title, post_description, post_content, category) VALUES (:id, :post_title, :post_description, :post_content, :category)', $params);

        return $this->database->lastInsertId();
    }
    
    /**
     * Update post data in DB
     */
    public function postEdit($post, $id) {
        $params = [
            'id'               => $id,
            'post_title'       => $post['post_title'],
            'post_description' => $post['post_description'],
            'post_content'     => $post['post_content'],
            'post_likes'       => $post['post_likes'],
            'category'         => $post['category'],
        ];
        $this->database->query('UPDATE posts SET post_title = :post_title, post_description = :post_description, post_content = :post_content, post_likes = :post_likes, category = :category WHERE id = :id', $params);
    }

    /**
     * Upload thumb
     */
    public function postUploadThumbnail($file, $id) {
        $thumb = new Imagick($file);
        $w = $thumb->getImageWidth();
        $h = $thumb->getImageHeight();
        
        if ($w > 1024 && $h > 664) {
            $thumb->cropThumbnailImage(1024, 664);
        }

        $thumb->setImageCompressionQuality(75);
        $thumb->writeImage('public/thumbnails/thumb-' . $id . '.jpg');
    }

    /**
     * Check if post exists
     */
    public function isPost($id) {
        $params = [
            'id' => $id,
        ];
        return $this->database->column('SELECT id FROM posts WHERE id = :id', $params);
    }

    public function postData($id) {
        $params = [
            'id' => $id,
        ];
        return $this->database->row('SELECT * FROM posts WHERE id = :id', $params);
    }

    /**
     * Delete post from DB
     * Delete thumb from files
     */
    public function postDelete($id) {
        $params = [
            'id' => $id,
        ];

        $this->database->query('DELETE FROM posts WHERE id = :id', $params);
        unlink('public/thumbnails/thumb-' . $id . '.jpg');
    }

    /**
     * Get all categories from DB
     */
    public function listCategories($route) {
        $params = [
            'id' => '',
        ];

        return $this->database->row('SELECT * FROM categories ORDER BY cat_name ASC', $params);
    }

    /**
     * Validation before adding new category
     * If category exists -> throw error
     */
    public function categoryValidate($post) {
        $params = [
            'cat_name' => $post['category'],
        ];
        $length   = iconv_strlen($post['category']);

        if($length < 2) {
            $this->error = 'Length of category sould be longre than 1 symbol';
            return false;
        }
        elseif($this->database->column('SELECT id FROM categories WHERE cat_name = :cat_name', $params)) {
            $this->error = 'Category exists already';
            return false;
        }
        
        return true;
    }

    /**
     * Add new category to DB
     */
    public function categoryAdd($post) {
        $params = [
            'id' => '',
            'cat_name' => $post['category'],
        ];

        $this->database->query('INSERT INTO categories (id, cat_name) VALUES (:id, :cat_name)', $params);

        return $this->database->lastInsertId();
    }

    /**
     * Check if category exists
     */
    public function isCategory($id) {
        $params = [
            'id' => $id,
        ];
        return $this->database->column('SELECT id FROM categories WHERE id = :id', $params);
    }

    /**
     * Delete category from DB
     * It also shange post table (category = 1 ) for posts that has deleted category
     */
    public function categoryDelete($id) {
        $params = [
            'id' => $id,
        ];

        $this->database->query('UPDATE posts SET category = 1 WHERE category = :id', $params);
        $this->database->query('DELETE FROM categories WHERE id = :id', $params);
    }
}