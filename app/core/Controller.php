<?php

namespace app\core;

use app\core\View;

abstract class Controller {
    public $route;
    public $view;
    public $roles;

    public function __construct($route) {
        $this->route = $route;
        
        if(!$this->checkRoles()) {
            View::errorCode(403);
        }

        $this->view = new View($route);
        $this->model = $this->loadModel($route['controller']);
    }

    public function loadModel($name) {
        $path = 'app\models\\' . ucfirst($name);

        if(class_exists($path)) {
            return new $path;
        }
    }

    public function checkRoles() {
        $this->roles = require 'app/config/roles.php';
        
        if($this->isRole('guest')) {
            return true;
        }
        elseif(isset($_SESSION['auth']) and $this->isRole('auth')) {
            return true;
        }
        elseif(isset($_SESSION['admin']) and $this->isRole('admin')) {
            return true;
        }

        return false;
    }

    public function isRole($key) {
        return in_array($this->route['action'], $this->roles[$key]);
    }
}