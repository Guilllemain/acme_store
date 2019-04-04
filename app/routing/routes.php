<?php

$router = new AltoRouter;

$router->map('GET', '/', 'App\Controllers\IndexController@index', 'home');

// admin routes
$router->map('GET', '/admin', 'App\Controllers\Admin\DashboardController@index', 'admin_dashboard');
