<?php
// config.php

// Load Composer autoloader
require __DIR__ . '/../vendor/autoload.php';

// Load environment variables from .env
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();




// Define constants from .env values
define('HOST', $_ENV['HOST']);
define('USER', $_ENV['DB_USER']);
define('PASSWORD', $_ENV['PASSWORD']);
define('DATABASE', $_ENV['DATABASE']);

// (Optional) Mail constants
define('MAIL_HOST', $_ENV['MAIL_HOST']);
define('MAIL_PORT', $_ENV['MAIL_PORT']);
define('MAIL_USERNAME', $_ENV['MAIL_USERNAME']);
define('MAIL_PASSWORD', $_ENV['MAIL_PASSWORD']);
define('MAIL_FROM', $_ENV['MAIL_FROM']);
define('MAIL_ENCRYPTION', $_ENV['MAIL_ENCRYPTION']);

// (Optional) App config
define('APP_URL', $_ENV['APP_URL']);
