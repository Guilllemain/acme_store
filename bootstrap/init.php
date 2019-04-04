<?php
use App\Classes\ErrorHandler;

// Start session if not already started
if (!isset($_SESSION)) {
    session_start();
}

// Load environment variables
require_once __DIR__ . '/../app/config/_env.php';

// Instantiate database class
new App\Classes\Database();

// Set custom error handler
set_error_handler([new ErrorHandler(), 'handleErrors']);

// Load routes
require_once __DIR__ . '/../app/routing/routes.php';

new App\RouteDispatcher($router);
