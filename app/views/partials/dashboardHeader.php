<div class="dashboardHeaderOne">
    <a href=""><img src="assets/images/logo.svg" alt="Logo"></a>
        <?php  if (isset($_SESSION["first_name"])) { ?> <p class="welcomeMessage">Welkom 
   <?php echo ($_SESSION["first_name"]); ?></p><?php } ?>
   <p>lorem ipsum quote</p>
</div>
<div class="classWrap">
<div class="dashboardHeaderTwo">
    <ul>
        <li ><img src="../assets/images/home.svg" alt="" class="headerIcon"><a href="./tasks.php">Home</a></li>
        <li><img src="../assets/images/home.svg" alt="" class="headerIcon"><a href="./tasks.php">Tasks</a></li>
        <li><img src="../assets/images/home.svg" alt="" class="headerIcon"><a href="./tasks.php">Daily Check-in</a></li>
        <li><img src="../assets/images/home.svg" alt="" class="headerIcon"><a href="./tasks.php">Habits</a></li>
        <li><img src="../assets/images/home.svg" alt="" class="headerIcon"><a href="./tasks.php">Progress</a></li>
        <li><img src="../assets/images/home.svg" alt="" class="headerIcon"><a href="./tasks.php">Settings</a></li>
    </ul>
</div>
</div>