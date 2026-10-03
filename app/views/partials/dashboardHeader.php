<?php 
$quotes = [
    [
        "quote" => "Success is the sum of small efforts, repeated day in and day out.",
        "author" => "Robert Collier"
    ],
    [
        "quote" => "The secret of getting ahead is getting started.",
        "author" => "Mark Twain"
    ],
    [
        "quote" => "Great things are done by a series of small things brought together.",
        "author" => "Vincent van Gogh"
    ]
];

$randomQuote = $quotes[array_rand($quotes)];

$quote = $randomQuote['quote'];
$author = $randomQuote['author'];
?>
<div class="dashboardHeaderOne">
    <a href=""><img src="assets/images/logo.svg" alt="Logo"></a>
        <?php  if (isset($_SESSION["first_name"])) { ?> <p class="welcomeMessage">Welkom 
   <?php echo ($_SESSION["first_name"]); ?></p><?php } ?>
   <p><?php echo $quote; ?> -<?php echo $author ?></p>
</div>
<div class="classWrap">
<div class="dashboardHeaderTwo">
    <ul>
        <li ><img src="../assets/images/home.svg" alt="" class="headerIcon"><a href="./index.php">Home</a></li>
        <li><img src="../assets/images/home.svg" alt="" class="headerIcon"><a href="./goals.php">Goals</a></li>
        <li><img src="../assets/images/home.svg" alt="" class="headerIcon"><a href="./daily-checkins.php">Daily Check-in</a></li>
        <li><img src="../assets/images/home.svg" alt="" class="headerIcon"><a href="./tasks.php">Habits</a></li>
        <li><img src="../assets/images/home.svg" alt="" class="headerIcon"><a href="./tasks.php">Progress</a></li>
        <li><img src="../assets/images/home.svg" alt="" class="headerIcon"><a href="./tasks.php">Settings</a></li>
    </ul>
</div>
</div>