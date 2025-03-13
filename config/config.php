<?php

// Include Composer autoloader
require '../vendor/autoload.php';

// Load .env file
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

echo "HOST: " . $_ENV['HOST'] . "<br>";
echo "USER: " . $_ENV['USER'] . "<br>";
echo "PASSWORD: " . $_ENV['PASSWORD'] . "<br>";
echo "DATABASE: " . $_ENV['DATABASE'] . "<br>";


exit(); // Stop execution here to check output

define('HOST', $_ENV['HOST']);
define('USER', $_ENV['USER']);
define('PASSWORD', $_ENV['PASSWORD']);
define('DATABASE', $_ENV['DATABASE']);
