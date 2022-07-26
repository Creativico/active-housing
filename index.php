<?php
// Silence is golden, not always :)

$debug = true;
if ($debug) {
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
}


require_once 'vendor/autoload.php';

$api = new Api\Core();