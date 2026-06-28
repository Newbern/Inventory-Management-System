<?php 
// Delete This in Production
$request = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);


# Setting Root Directory
define('ROOT', __DIR__ . '/');

# Including Router
require ROOT . 'router/router.php';

# Initializing Router
$router = new Router();

# Defining Routes
# Grouping up and Routeing for Public
$router->group('/', "public_controller" ,function($router){
    $router->get("", "home");
    $router->get("test", "test");
    $router->get("404", "Error");
    $router->get("login", "login");
    $router->get("signin", "signin");
});

# Executing Routes based off of current page
$router->dispatch($request);