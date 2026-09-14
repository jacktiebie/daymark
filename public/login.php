<?php
require_once '../app/bootstrap.php';
require_once '../app/classes/auth.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
$email = $_POST['email'];
$password = $_POST['password'];
/** @var PDO $pdo */
$auth = new Auth($pdo);
$auth->loginUsers($email, $password);
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
 <?php require_once '../app/css.php'; ?>
    <link rel="stylesheet" href="assets/css/auth.css">
    <title>Login</title>
</head>
<body>
    <?php require_once 'C:\Users\PC\Desktop\codingProjects\dayMark\app\views\partials\nav.php';?>
    <div class="wrapper">
        <form action="" method="post">
            <div>
                <label for="email"><span>@</span></label>
                <input type="email" name="email" id="email" placeholder="email" required>
            </div>
            <div>
                <label for="password"><img src="assets/images/lockIcon.svg" alt="Lock Icoon"></label>
                <input type="password" name="password" id="password" placeholder="Wachtwoord" required>
            </div>
            <button type="submit">Inloggen</button>
        </form>
    </div>
</body>
</html>