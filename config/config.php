<?php

// Include Composer autoloader
require '../vendor/autoload.php';

// Load .env file
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

define('HOST', $_ENV['HOST']);
define('USER', $_ENV['USER']);
define('PASSWORD', '');
define('DATABASE', $_ENV['DATABASE']);



