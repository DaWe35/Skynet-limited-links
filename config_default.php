<?php
date_default_timezone_set('UTC');
// CONNECT
try {
    $db = new PDO('mysql:host=localhost;dbname=sia_links;charset=utf8', 'USER', 'PASSWORD');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
} catch (PDOException $e) {
    header($_SERVER['SERVER_PROTOCOL'] . ' 500 Internal Server Error', true, 500);
    error_log("Failed to connect DB: " . $e->getMessage());
    exit("Database error");
}

define('URL', 'http://skylimit.local/');