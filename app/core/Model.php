<?php

namespace app\core;

use app\lib\DataBase;

abstract class Model {
    public $database;

    public function __construct() {
        $this->database = new DataBase;
    }
}
