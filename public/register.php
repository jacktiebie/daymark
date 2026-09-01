<?php
require_once '../app/bootstrap.php';


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/auth.css">
    <title>Registreren</title>
</head>
<body>
   <div class="wrapper">
    <h1>Registreren</h1>
    <form action="post">
        <!-- I include an svg icon that can be assesed in the images folder for the label -->
        <div>
            <label for="firstName"><img src="assets/images/personIcon.svg" alt="Persoon Icoon"></label>
            <input type="text" name="firstName" id="firstName" placeholder="Voornaam" required>
        </div>
        <div>
            <label for="lastName"><img src="assets/images/personIcon.svg" alt="Persoon Icoon"></label>
            <input type="text" name="lastName" id="lastName" placeholder="Achternaam" required>
        </div>
        <div>
            <label for="email"><span>@</span></label>
            <input type="email" name="email" id="email" placeholder="Email" required>
        </div>
        <div>
            <label for="password"><img src="assets/images/lockIcon.svg" alt="Slotje icoon"></label>
            <input type="password" name="wachtwoord" id="wachtwoord" placeholder="Wachtwoord" required>
        </div>
        <div>
            <label for="password"><img src="assets/images/lockIcon.svg" alt="Slotje icoon"></label>
            <input type="password" name="passwordRepeat" id="passwordRepeat" placeholder="Wachtwoord herhalen" required>
        </div>
        <button type="submit">Account Aanmaken</button>
    </form>
    <p>Heb je al een accunt? <a href="login.php">Login</a></p>
   </div> 
</body>
</html>