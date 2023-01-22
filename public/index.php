<?php

// bootstrap
if (empty($_SESSION)) {
    session_start();
}

// composer autoload
require_once __DIR__ . '/../vendor/autoload.php';

// Load Config
require_once __DIR__ . '/../src/config/DB.php';

// Add Routes
require_once __DIR__ . '/../src/routes/Web.php';
