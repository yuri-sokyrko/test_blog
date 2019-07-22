<?php

namespace app\models;

use app\core\Model;

class Account extends Model {
    public $error;

    /**
     * Validation of user login form
     */
    public function userValidate($post) {
        $params = [
            'login' => $post['login'],
        ];

        $hash = $this->database->column('SELECT password FROM users WHERE login = :login', $params);

        if($hash == false || !password_verify($post['password'], $hash)) {
            $this->error = 'Enter correct login or password';
            return false;
        }
        return true;
    }

    public function registerValidate($post) {
        $login    = $post['login'];
        $logRegex = "#^[a-zA-Z0-9]{2,20}$#";
        $email    = $post['email'];
        $password = $post['password'];

        if(!preg_match($logRegex, $login)) {
            $this->error = "Login should be from 2 to 20 and latin symbols or numbers";
            return false;
        }
        elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->error = "Enter valid email";
            return false;
        }
        elseif(iconv_strlen($password) < 6) {
            $this->error = "Password length should be at least 6 symbols";
            return false;
        }

        return true;
    }

    public function loginExists($login) {
        $params = [
            'login' => $login,
        ];

        if($this->database->column('SELECT id FROM users WHERE login = :login', $params)) {
            $this->error = 'This login is currently used';
            return false;
        }
        return true;
    }

    public function emailExists($email) {
        $params = [
            'email' => $email,
        ];

        if($this->database->column('SELECT id FROM users WHERE email = :email', $params)) {
            $this->error = 'This email is currently used';
            return false;
        }
        return true;
    }

    public function registerUser($post) {
        $params = [
            'id'       => '',
            'login'    => $post['login'],
            'email'    => $post['email'],
            'password' => password_hash($post['password'], PASSWORD_BCRYPT),
        ];

        $this->database->query('INSERT INTO users (id, login, email, password) VALUES (:id, :login, :email, :password)', $params);
    }
}