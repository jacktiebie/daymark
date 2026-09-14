<div class="dashboardHeaderOne">
    <a href=""><img src="assets/images/logo.svg" alt="Logo"></a>
        <?php  if (isset($_SESSION["first_name"])) { ?> <p class="welcomeMessage">Welkom 
   <?php echo ($_SESSION["first_name"]); ?></p><?php } ?>
   <p>lorem ipsum quote</p>
</div>
<div class="classWrap">
<div class="dashboardHeaderTwo">
    <ul>
        <li><a href="./tasks.php">Taken</a></li>
    </ul>
</div>
</div>