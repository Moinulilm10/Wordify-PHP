<?php

// Include Composer autoloader
require '../vendor/autoload.php';

// Load .env file
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

var_dump($_ENV['HOST'], $_ENV['USER'], $_ENV['PASSWORD'], $_ENV['DATABASE']);
exit(); // Stop execution here to check output

define('HOST', $_ENV['HOST']);
define('USER', $_ENV['USER']);
define('PASSWORD', $_ENV['PASSWORD']);
define('DATABASE', $_ENV['DATABASE']);
