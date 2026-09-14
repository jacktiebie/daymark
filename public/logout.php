<?php
require_once '../app/bootstrap.php';
require_once '../app/classes/auth.php';
$auth = new Auth($pdo);
$auth->logout();
?>