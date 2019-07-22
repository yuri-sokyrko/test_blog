<?php

namespace app\controllers;

use app\core\Controller;
use app\lib\Pagination;
use app\models\Admin;

class MainController extends Controller{
    public function indexAction() {
        $adminModel = new Admin;
        $postsAmount = 10;
        $pagination = new Pagination($this->route, $this->model->countPosts(), $postsAmount);
        $vars = [
            'pagination' => $pagination->get(),
            'list'       => $this->model->listPosts($this->route, $postsAmount),
            'categories' => $adminModel->listCategories($this->route),
        ];
        $this->view->render('All blog articles', $vars);
    }

    public function postAction() {
        $adminModel = new Admin;
        if(!$adminModel->isPost($this->route['id'])) {
            $this->view->errorCode(404);
        }

        $vars = [
            'data' => $adminModel->postData($this->route['id'])[0],
            'categories' => $adminModel->listCategories($this->route),
        ];
        $this->view->render('Post', $vars);
    }

    public function likeAction() {
        $this->model->likePost($this->route['id']);
        $this->view->redirect('post/' . $this->route['id']);
    }

    public function categoryAction() {
        $currentCatId =   $this->model->getCatId($this->route['id']);
        $currentCatName = $this->model->getCatName($this->route['id']);
        $adminModel = new Admin;
        
        $vars = [
            'list'       => $this->model->listCatPosts($currentCatId),
            'categories' => $adminModel->listCategories($this->route),
            'catID'      => $currentCatId,
            'catNAME'    => $currentCatName,
        ];

        $this->view->render('Category:', $vars);
    }
}
