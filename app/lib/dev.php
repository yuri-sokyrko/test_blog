<?php

ini_set('display_errors', 1); // Show eerors on screen
error_reporting(E_ALL); // Set error log

/**
 * Debug func
 */
function debug($str) {
    echo '<pre>';
    var_dump($str);
    echo '</pre>';
    exit;
}