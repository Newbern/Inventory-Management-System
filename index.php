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
$allowed = ['home', 'test', '404', 'signin'];

# Validating Page
if (!in_array($page, $allowed)) {
    $page = '404';
};

$url = "app/templates/$page";

echo "Page: $page <br>";


# Including css
$CSS = "app/styles/$page.css";
$JS = "app/scripts/$page.js";

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
include 'app/backend/db_queries.php';

# Base Template
include 'app/templates/base.php';