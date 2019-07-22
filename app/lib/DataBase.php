<?php

namespace app\lib;

use PDO;

class DataBase {
    protected $database;

    public function __construct() {
        $config = require 'app/config/database.php';
        
        $this->database = new PDO('mysql:host=' . $config['host'] . ';dbname=' . $config['name'] . '', $config['user'], $config['password']);
    }

    public function query($sql, $params = []) {
       $statement = $this->database->prepare($sql);

        if(!empty($params)) {
            foreach ($params as $key => $value) {
                if(is_int($value)) {
                    $type = PDO::PARAM_INT;
                } else {
                    $type = PDO::PARAM_STR;
                }
                
                $statement->bindValue(':' . $key, $value, $type);
            }
        }

        $statement->execute();
        return $statement;
    }

    public function row($sql, $params = []) {
        $result = $this->query($sql, $params);
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }

    public function column($sql, $params = []) {
        $result = $this->query($sql, $params);
        return $result->fetchColumn();
    }

    public function lastInsertId() {
        return $this->database->lastInsertId();
    }
}