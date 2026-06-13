<?php

if (!isset($_SESSION['user_id'])) {
    header("Location: index?page=login");
    exit();
}