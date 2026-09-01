<?php
require_once '../app/bootstrap.php';


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/auth.css">
    <title>Login</title>
</head>
<body>
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