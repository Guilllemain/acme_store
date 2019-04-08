<?php

$router = new AltoRouter;

$router->map('GET', '/', 'App\Controllers\IndexController@index', 'home');

// admin routes
$router->map('GET', '/admin', 'App\Controllers\Admin\DashboardController@index', 'admin_dashboard');
$router->map('POST', '/admin', 'App\Controllers\Admin\DashboardController@store', 'admin_form');

// product management
$router->map('GET', '/admin/products/categories', 'App\Controllers\Admin\ProductCategoryController@index', 'product_category');
$router->map('POST', '/admin/products/categories', 'App\Controllers\Admin\ProductCategoryController@store', 'product_category_create');
$router->map('POST', '/admin/products/categories/[i:id]/update', 'App\Controllers\Admin\ProductCategoryController@update', 'product_category_update');
