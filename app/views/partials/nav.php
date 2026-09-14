<nav> 
    <div>
<img src="assets/images/logo.svg" alt="Daymark logo" class="logo">
</div>
<div>
<ul>
<li>
<a href="./index.php">Home</a></li>
<li>
<a href="">Hoe Werkt Het</a>
</li>
<li>
<a href="">Lorem Ipsum</a>
</li>
<li>
<a href="">Contct</a>
</li>
</ul>
</div>
<div class="button">
    <?php if (isset($_SESSION['user_id'])) {
        
    ?> 
    <a href="./dashboard.php" class="navLogin">Dashboard</a>
    <a href="./logout.php" class="navRegister">Uitloggen</a> <?php
    } else { ?>
    <a href="./login.php" class="navLogin">Inloggen</a>
    <a href="./register.php" class="navRegister">Registreren</a>
    <?php } ?>
</div>


</nav>