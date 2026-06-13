<?php 
// Delete This in Production
$request = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');

// If the requested file exists (CSS, JS, images), serve it normally
if ($request && file_exists($request)) {
    return false;
}




# Getting Pages
$page = $_GET['page'] ?? 'home';


# Allowed Pages
$allowed = ['home', 'test', 'signin', 'login', 'admin'];

# Validating Page
if (!in_array($page, $allowed)) {
    $page = '404';
};

# URL for including HTML content
$url = "public/pages/$page";

# Including css
$CSS = "public/assets/css/$page.css";
$JS = "public/assets/js/$page.js";

# Including Html Page Specific Content 
if (file_exists("$url.php")) {
    $HTML = "$url.php";
}
elseif (file_exists("$url.html")) {
    $HTML = "$url.html";
}
else {
    $HTML = 'app/templates/404.html';
}

# Including Database Queries
include 'app/database/db_queries.php';

# Base Template
include 'public/layouts/base.php';