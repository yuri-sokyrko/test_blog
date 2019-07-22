<?php

namespace app\controllers;

use app\core\Controller;

class AccountController extends Controller{
    public function __construct($route) {
        parent::__construct($route);
    }

    /**
     * User login
     * Validates user login form
     * Checks if user exists
     */
    public function loginAction() {
        if(isset($_SESSION['auth'])) {
            $this->view->redirect('main/index/1');
        }

        if(!empty($_POST)) {
            if(!$this->model->userValidate($_POST)) {
                $this->view->message('error', $this->model->error);
            }

            unset($_SESSION['admin']);
            $_SESSION['auth'] = true;
            $this->view->location('main/index/1');
        }

        $this->view->render('User login');
    }

    /**
     * Register user
     * validate user register form
     * Cheks if login and email exist
     * Register user in DB
     */
    public function registerAction() {
        if(!empty($_POST)) {
            if(!$this->model->registerValidate($_POST)) {
                $this->view->message('error', $this->model->error);
            }
            elseif(!$this->model->loginExists($_POST['login'])) {
                $this->view->message('error', $this->model->error);
            }
            elseif(!$this->model->emailExists($_POST['email'])) {
                $this->view->message('error', $this->model->error);
            }
            $this->model->registerUser($_POST);
            $this->view->message('Success', 'You have successfully registered. Now you can login!)');
        }
        
        $this->view->render('User register');
    }

    /**
     * Logout, ends session
     */
    public function logoutAction() {
        unset($_SESSION['auth']);
        $this->view->redirect('account/login');
    }
}