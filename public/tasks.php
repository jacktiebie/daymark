<?php
require_once '../app/bootstrap.php';
require_once '../app/classes/habits.php';
$userid = $_SESSION["user_id"];
$habitModel = new Habits($pdo);
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if ($_POST['action'] === 'create') {
     $title = $_POST['title'];
    $description = $_POST['description'];
    $frequency = $_POST['frequency'];
    $habitModel->createHabit($title, $description, $frequency, $userid);
    }

    if ($_POST['action'] === 'delete') {
        $habit_id = $_POST['habit_id'];
        $habitModel->deleteHabit($habit_id);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link rel="stylesheet" href="./assets/css/dashboardHeader.css">
    <link rel="stylesheet" href="./assets/css/global.css">
    <link rel="stylesheet" href="./assets/css/tasks.css">
    <title>Document</title>
</head>
<body>
<?php require_once '../app/views/partials/dashboardHeader.php';?>
<?php if (isset($_SESSION['notificationMessage'])) {foreach ($_SESSION['notificationMessage'] as $notificiation) {
    echo "<span>" . $notificiation . "</span>";
}unset($_SESSION['notificationMessage']);
}  ?>
<div class="habitNav">
    <div class="habitNavWrapOne">
    <h1>Habits</h1>
<p>Build a better you, one habit at a time</p>
   </div>
  <div class="habitNavWrapTwo"></div>
<a href="" class="habitButtonAdd">+ Add Habit</a>
</div>
<section class="habitStats">
    <div class="habitStatsItems">
        <img src="./assets/images/drop.png" alt="">
        <h2>3</h2>
        <p>Active habits</p>
    </div>
        <div class="habitStatsItems">
        <img src="./assets/images/drop.png" alt="">
        <h2>3</h2>
        <p>Active habits</p>
    </div>
        <div class="habitStatsItems">
        <img src="./assets/images/drop.png" alt="">
        <h2>3</h2>
        <p>Active habits</p>
    </div>
        <div class="habitStatsItems">
        <img src="./assets/images/drop.png" alt="">
        <h2>3</h2>
        <p>Active habits</p>
    </div>
</section>
<section class="habits">
    <?php 
    /* LOOP */
    $habits = $habitModel->getHabits($userid);
    
    foreach ($habits as $habit) {

    
    ?>
    <div class="habitsItems">
        <div class="flexWrapOne">
    <img class="habitsItemsImg" src="./assets/images/drop.png" alt="">
    <div class="habitsItemsWrap">
    <h3><?php echo $habit['title']; ?></h3>
    <p><?php echo $habit['description']; ?></p>
    
    </div>
    </div>
    <div class="flexWrapTwo">
        <p>🔥 7 day streak</p>

    <div class="habitWeek">

        <div class="habitDay">
            <span class="dayCircle done"></span>
            <span>M</span>
        </div>

        <div class="habitDay">
            <span class="dayCircle done"></span>
            <span>T</span>
        </div>

        <div class="habitDay">
            <span class="dayCircle done"></span>
            <span>W</span>
        </div>

        <div class="habitDay">
            <span class="dayCircle"></span>
            <span>T</span>
        </div>

        <div class="habitDay">
            <span class="dayCircle"></span>
            <span>F</span>
        </div>

        <div class="habitDay">
            <span class="dayCircle"></span>
            <span>S</span>
        </div>

        <div class="habitDay">
            <span class="dayCircle"></span>
            <span>S</span>
        </div>

    </div>
    </div>
    <div class="flexWrapThree">
    <div class="habitsItemsModifyWrap">
      
    <a href=""><img src="./assets/images/pencil.png" class="habitItemsModify" alt=""></a>
      <form method="post">
        <input type="hidden" name="habit_id" value="<?php echo $habit['id'];?>">
    <button type="submit" name="action" value="delete"><img src="./assets/images/trashCan.png" class="habitItemsModify" alt=""></button>
</form>
</div>
</div>
</div>
<?php 
/* LOOP END*/
    }
?>
</section>
<section class="habitsAdd">
    <form action="" method="post">
        <input type="hidden" name="userID">
        <label for="title">Titel</label>
        <input type="text" name="title" id="title">
        <label for="description">Beschrijving</label>
        <input type="text" name="description" id="description">
        <label for="frequency">Hoeveel x per week</label>
        <input type="number" name="frequency"  id="frequency">
<button type="submit" name="action" value="create">Toevoegen</button>
    </form>
</section>
</body>
</html>