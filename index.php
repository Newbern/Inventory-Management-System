<?php 
# Getting Pages
$page = $_GET['page'] ?? 'home';

# Allowed Pages
$allowed = ['home'];

# Validating Page
if (!in_array($page, $allowed)) {
    $page = '404';
};

$url = "app/templates/$page";



# Including css
$CSS = "app/styles.css";
$JS = "app/scripts.js";

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

# Base Template
include 'app/templates/base.php';