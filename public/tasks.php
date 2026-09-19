<?php
require_once '../app/bootstrap.php';
require_once '../app/classes/habits.php';
$userid = $_SESSION["user_id"];
$habitModel = new Habits($pdo);

$class = "Daycircle";
$weekDays = ["Monday", "Tuesday", "Wensday", "Thursday", "Friday", "Saturday", "Sunday"];

//Retrieving current dates
//create a loop with i+ 
for ($i = 0; $i <=6; $i++) {
 $time[] = date('Y-m-d', strtotime("monday this week +$i days"));
}


// for the loop and the count

  $habits = $habitModel->getHabits($userid);
$habitsNumber = count($habits);


//get completed habit logs row count
$habitLogCount = $habitModel->getCompletedHabitCount($userid);






if ($_SERVER['REQUEST_METHOD'] === 'POST') {

switch ($_POST['action']) {
case 'create':
    $title = $_POST['title'];
    $description = $_POST['description'];
    $frequency = $_POST['frequency'];
    $habitModel->createHabit($title, $description, $frequency, $userid);
    echo "<meta http-equiv='refresh' content='0'>";
    break;
 case 'delete':
  $habit_id = $_POST['habit_id'];
        $habitModel->deleteHabit($habit_id);
        echo "<meta http-equiv='refresh' content='0'>";
        break;
case 'habitCase':
  $habit_id = $_POST['habit_id'];
    $habit_date = $_POST['habit_date'];
    $habitModel->habitCompleted($habit_id, $habit_date);
    echo "<meta http-equiv='refresh' content='0'>";
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
        <h2><?php echo $habitsNumber; ?></h2>
        <p>Active habits</p>
    </div>
        <div class="habitStatsItems">
        <img src="./assets/images/drop.png" alt="">
        <h2><?php echo $habitLogCount; ?></h2>
        <p>Habits Finished</p>
    </div>
        <div class="habitStatsItems">
        <img src="./assets/images/drop.png" alt="">
        <h2>?</h2>
        <p>Lorem Ipsum</p>
    </div>
        <div class="habitStatsItems">
        <img src="./assets/images/drop.png" alt="">
        <h2>?</h2>
        <p>Lorem Ipsum</p>
    </div>
</section>
<section class="habits">
    <?php 
    /* LOOP */
    foreach ($habits as $habit) {
$weekDaysI = 0;
   
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
        <p>🔥 <?php echo $habit['frequency']; ?> Expected Frequency</p>

    <div class="habitWeek">
<form class="habitDayForm" method="post">
    <?php

    foreach($time as $day) {
        $class = $habitModel->checkHabitCompleted($habit['id'], $day);
        ?>
           <div class="habitDay">
            <input type="hidden" name="habit_id" value="<?php echo $habit['id'];?>">
            <input type="hidden" name="action" value="habitCase";>
         <button type="submit" name="habit_date" value="<?php echo $day; ?>"><span class="<?php echo $class ?>"></span></button>
         
         
         <span><?php echo $weekDays[$weekDaysI]; ?></span>
   
            <?php $weekDaysI++?>
        </div>
        <?php
    }
        ?>
        
    <!--
        <div class="habitDay">
         <button type="submit" name="action" value="monday"><span class="dayCircle done"></span></button>
            <span>M</span>
        </div>

        <div class="habitDay">
            <button type="submit" name="action" value="tuesday"><span class="dayCircle done"></span></button>
            <span>T</span>
        </div>

        <div class="habitDay">
            <button type="submit" name="action" value="wensday"><span class="dayCircle done"></span></button>
            <span>W</span>
        </div>

        <div class="habitDay">
            <button type="submit" name="action" value="thursday"><span class="dayCircle"></span></button>
            <span>T</span>
        </div>

        <div class="habitDay">
            <button type="submit" name="action" value="friday"><span class="dayCircle"></span></button>
            <span>F</span>
        </div>

        <div class="habitDay">
            <button type="submit" name="action" value="saturday"><span class="dayCircle"></span></button>
            <span>S</span>
        </div>

        <div class="habitDay">
            <button type="submit" name="action" value="sunday"><span class="dayCircle"></span></button>
            <span>S</span>
        </div>
 -->
    
</form>
    </div>
    </div>
    <div class="flexWrapThree">
    <div class="habitsItemsModifyWrap">
      
    <a href=""><img src="./assets/images/pencil.png" class="habitItemsModify" alt=""></a>
      <form method="post">
        <input type="hidden" name="habit_id" value="<?php echo $habit['id'];?>">
    <button type="submit" name="action" value="delete"><img  src="./assets/images/trashCan.png" class="habitItemsModify" alt=""></button>
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

<!-- 
TO DO:
- Habit Graph
- POP UP ADD HABIT 
- ACTIVE HABITS + OTHER STATS
- STYLING
- EDIT HABIT
-->
