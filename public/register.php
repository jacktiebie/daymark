<?php
require_once '../app/bootstrap.php';
require_once '../app/classes/auth.php';

/** @var PDO $pdo */
$auth = new Auth($pdo);


//Retrieving data using POST if submit button is clicked.
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $passwordRepeat = $_POST['passwordRepeat'];

//Checking if password is equal
    if ($passwordRepeat !== $password) {

$_SESSION['registerErrors'][] = "De wachtwoorden komen niet overeen";
            header('Location: register.php');
    exit;
    } else {

    $auth->register(
        $firstName,
        $lastName,
        $email,
        $password
    );
    }

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
 <?php require_once '../app/css.php'; ?>
    <link rel="stylesheet" href="assets/css/auth.css">

    <title>Registreren</title>
</head>
<body>
    <?php require_once 'C:\Users\PC\Desktop\codingProjects\dayMark\app\views\partials\nav.php';?>
   <div class="wrapper">
    <h1>Registreren</h1>
    <form action="register.php" method="POST">
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
            <input type="password" name="password" id="password" placeholder="Wachtwoord" required>
        </div>
        <div>
            <label for="passwordRepeat"><img src="assets/images/lockIcon.svg" alt="Slotje icoon"></label>
            <input type="password" name="passwordRepeat" id="passwordRepeat" placeholder="Wachtwoord herhalen" required>
        </div>
           <?php
if (isset($_SESSION['registerErrors'])) {foreach ($_SESSION['registerErrors'] as $error) {
    echo "<span class='errorMessage'>" . $error . "</span>";
}unset($_SESSION['registerErrors']);
}
           ?>
        <button type="submit">Account Aanmaken</button>
    </form>
    <p>Heb je al een accunt? <a href="login.php">Login</a></p>
   </div> 
  
</body>
</html>