<?php

// Load .env file from project root
$dotenv = Dotenv\Dotenv::createMutable(__DIR__ . '/../../');
$dotenv->load();

// Retrive env variable
$dbHost = $_ENV['DB_HOST'] ?: 'localhost';
$dbUser = $_ENV['DB_USER'] ?: 'root';
$dbPass = $_ENV['DB_PASS'] ?: '';
$dbName = $_ENV['DB_NAME'] ?: 'blog';

// Database params
define('DB_HOST', $dbHost);
define('DB_USER', $dbUser);
define('DB_PASS', $dbPass);
define('DB_NAME', $dbName);