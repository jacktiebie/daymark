<?php
session_start();
require_once __DIR__ . '/classes/Database.php';

$database = new Database();
$pdo = $database->connect();
?>