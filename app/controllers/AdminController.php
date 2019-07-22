<?php

namespace app\controllers;

use app\core\Controller;
use app\lib\Pagination;
use app\models\Main;

class AdminController extends Controller{
    public function __construct($route) {
        parent::__construct($route);
        $this->view->layout = 'admin';
    }
    
    /**
     * Admin Login
     * Render Admin login page
     */
    public function loginAction() {
        if(isset($_SESSION['admin'])) {
            $this->view->redirect('admin/add');
        }

        if(!empty($_POST)) {
            if(!$this->model->loginValidate($_POST)) {
                $this->view->message('error', $this->model->error);
            }

            unset($_SESSION['auth']);
            $_SESSION['admin'] = true;
            $this->view->location('admin/add');
        }

        $this->view->render('Login Admin');
    }

    public function logoutAction() {
        unset($_SESSION['admin']);
        $this->view->redirect('admin/login');
    }

    /**
     * Render posts list in admin panel
     * use Main from app/models make pagination and create posts list
     */
    public function postsAction() {
        $mainModel = new Main;
        $postsAmount = 10;
        $pagination = new Pagination($this->route, $mainModel->countPosts(), $postsAmount);
        $vars = [
            'pagination' => $pagination->get(),
            'list'       => $mainModel->listPosts($this->route, $postsAmount),
            'categories' => $this->model->listCategories($this->route),
        ];

        $this->view->render('All Posts', $vars);
    }

    /**
     * Add new post into DB
     * Render Add Page
     */
    public function addAction() {
        if(!empty($_POST)) {
            if(!$this->model->postValidate($_POST, 'add')) {
                $this->view->message('error', $this->model->error);
            }

            $id = $this->model->postAdd($_POST);

            if(!$id) {
                $this->view->message('error', 'Query has failed');
                exit();
            }

            $this->model->postUploadThumbnail($_FILES['post_image']['tmp_name'], $id);
            $this->view->message('success', 'The post was added');
        }

        $vars = [
            'list' => $this->model->listCategories($this->route),
        ];

        $this->view->render('Add Post', $vars);
    }

    /**
     * Edit post in DB
     * Rende Post edit page
     */
    public function editAction() {
        if(!$this->model->isPost($this->route['id'])) {
            $this->view->errorCode(404);
        }

        if(!empty($_POST)) {
            if(!$this->model->postValidate($_POST, 'edit')) {
                $this->view->message('error', $this->model->error);
            }

            $this->model->postEdit($_POST, $this->route['id']);
            
            if($_FILES['post_image']['tmp_name']) {
                $this->model->postUploadThumbnail($_FILES['post_image']['tmp_name'], $this->route['id']);
            }

            $this->view->message('success', 'Post was edited');
        }

        $vars = [
            'data' => $this->model->postData($this->route['id'])[0],
            'list' => $this->model->listCategories($this->route),
        ];
        $this->view->render('Edit Post', $vars);
    }

    /**
     * Delete Post action
     */
    public function deleteAction() {
        if(!$this->model->isPost($this->route['id'])) {
            $this->view->errorCode(404);
        }

        $this->model->postDelete($this->route['id']);
        $this->view->redirect('admin/posts');
    }

    /**
     * Add categories to DB, show their list in admin panel
     */
    public function categoriesAction() {
        $vars = [
            'list' => $this->model->listCategories($this->route),
        ];

        if(!empty($_POST)) {
            if(!$this->model->categoryValidate($_POST)) {
                $this->view->message('error', $this->model->error);
            }

            $cat_id = $this->model->categoryAdd($_POST);

            if(!$cat_id) {
                $this->view->message('error', 'Query has failed');
                exit();
            }

            $this->view->location('admin/categories');
        }

        $this->view->render('Categories', $vars);
    }
    
    /**
     * Action deletes category from DB
     */
    public function deleteCatAction() {
        if(!$this->model->isCategory($this->route['id'])) {
            $this->view->errorCode(404);
        }

        $this->model->categoryDelete($this->route['id']);
        $this->view->redirect('admin/categories');
    }
}
