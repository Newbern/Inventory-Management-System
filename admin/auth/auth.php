<?php

if (!isset($_SESSION['user_id'])) {
    header("Location: ".ROOT."index?page=login");
    exit();
}