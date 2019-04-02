<?php

$router = new AltoRouter;

$router->map('GET', '/about', '', 'about us');

$match = $router->match();

if ($match) {
    echo 'ABout page';
} else {
    header($_SERVER['SERVER_PROTOCOL'] . '404 Not Found');
    echo 'Page not found';
}
