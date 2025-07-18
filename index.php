<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once __DIR__ . '/vendor/autoload.php';

use Database\Init;
use FileCheck\FileChecker;

try {
    $init = new Init('mysql');

    $result = $init->get();

    if ($result) {
        print_r($result);
    } else {
        echo "Нет данных";
    }

} catch (Throwable $t) {
    echo "Ошибка: " . $t->getMessage();
}

$cheker = new FileChecker();

$cheker->printFiles();


