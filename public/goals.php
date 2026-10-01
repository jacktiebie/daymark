<?php
require_once '../app/bootstrap.php';
require_once '../app/classes/goals.php';

$userid = $_SESSION["user_id"];
$goalsModel = new Goals($pdo);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

switch ($_POST['action']) {
case 'create':
    $title = $_POST['title'];
    $description = $_POST['description'];
    $target = $_POST['target_value'];
    $current = $_POST['current_value'];
    $unit = $_POST['unit'];
    $due_date = $_POST['due_date'];
    $status = $_POST['status'];
    $goalsModel->createGoal($title, $description, $target, $current, $unit, $due_date, $status);
    //echo "<meta http-equiv='refresh' content='0'>";
    break;
}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assets/css/goals.css">
    <link rel="stylesheet" href="./assets/css/dashboardHeader.css">
    <link rel="stylesheet" href="./assets/css/global.css">
    <title>Goals</title>
</head>
<body>
    <?php require_once '../app/views/partials/dashboardHeader.php';?>
<?php if (isset($_SESSION['notificationMessage'])) {foreach ($_SESSION['notificationMessage'] as $notificiation) {
    echo "<span>" . $notificiation . "</span>";
}unset($_SESSION['notificationMessage']);
}  ?>
<div class="upperSection">
    <p class="upperTitle">Small Steps. Bigger Dreams.</p>
    <h1>Goals</h1>
    <p class="upperDescription">Set your goals, stay focused and track your progress.</br>Turn your plans into progress.</p>
</div>
<div class="goalsData">

    <div class="goalsDataCard goalsDataGoals">

        <div class="goalsDataIconWrapper">
            <img src="./assets/images/target.png" alt="" class="goalsDataIcon">
        </div>

        <div class="goalsDataContent">
            <p class="goalsDataSubtitle">Total Goals</p>
            <h3>5</h3>
            <p class="goalsDataDescription">3 active * 2 completed</p>
        </div>

    </div>


    <div class="goalsDataCard goalsDataProgress">

        <div class="goalsDataIconWrapper">
             <img src="./assets/images/target.png" alt="" class="goalsDataIcon">
        </div>

        <div class="goalsDataContent">
            <p class="goalsDataSubtitle">Overall Progress</p>
            <h3>60%</h3>

            <div class="progressBar">
                <div class="progress" style="width: 70%;"></div>
            </div>
        </div>

    </div>


    <div class="goalsDataCard goalsDataWeek">

        <div class="goalsDataIconWrapper">
          <img src="./assets/images/target.png" alt="" class="goalsDataIcon">
        </div>

        <div class="goalsDataContent">
            <p class="goalsDataSubtitle">This Week</p>
            <h3>5</h3>
            <p class="goalsDataDescription">3 active * 2 completed</p>
        </div>

    </div>


    <div class="goalsDataCard goalsDataStreak">

        <div class="goalsDataIconWrapper">
        <img src="./assets/images/target.png" alt="" class="goalsDataIcon">
        </div>

        <div class="goalsDataContent">
            <p class="goalsDataSubtitle">Current Streak</p>
            <h3>5 days</h3>
            <p class="goalsDataDescription">Keep going!</p>
        </div>

    </div>

</div>
<div class="bottom">
<div class="bottomLeft">
    <h2>My Goals</h2>
    <div class="bottomLeftWrap">
        <img src="./assets/images/target.png" alt="">
        <div class="bottomLeftWrapText">
            <h4>Get stronger & stay lean</h4>
            <p>Go to the gym 4-x per week and eat high protein</p>
            <div class="progressBar">
    <div class="progress" style="width: 70%;"></div>
</div>
        </div>

        <p class="active">Active</p>
    </div>
      <div class="bottomLeftWrap">
    <img src="./assets/images/target.png" alt="">
        <div class="bottomLeftWrapText">
            <h4>Get stronger & stay lean</h4>
            <p>Go to the gym 4-x per week and eat high protein</p>
            <div class="progressBar">
    <div class="progress" style="width: 70%;"></div>
</div>
        </div>

        <p class="active">Active</p>
    </div>
</div>
<div class="bottomRight">
    <div class="bottomRightAddGoal">
        <button onclick="showGoalPopup()">+ Add New Goal</button>
    </div>
    <div class="bottomRightQuote">
        <p class="bottomRightQuoteSubtitle">Progress. not perfection</p>
        <h2>"A little progress each days adds up to big results."</h2>
    </div>
</div>
</div>
<div class="goalPopup" id="goalPopup">
    <section class="goalsAdd">

        <form action="" method="post">

            <label for="goalTitle">Goal title</label>
            <input type="text" name="title" id="goalTitle">

            <label for="goalDescription">Description</label>
            <input type="text" name="description" id="goalDescription">

            <div class="goalInputRow">

                <div>
                    <label for="targetValue">Target</label>
                    <input type="number" name="target_value" id="targetValue">
                </div>

                <div>
                    <label for="currentValue">Current</label>
                    <input type="number" name="current_value" id="currentValue">
                </div>

                <div>
                    <label for="unit">Unit</label>
                    <input type="text" name="unit" id="unit" placeholder="kg, days, pages...">
                </div>

            </div>

            <label for="dueDate">Due date</label>
            <input type="date" name="due_date" id="dueDate">

            <label for="status">Status</label>

            <div class="goalStatusOptions">

                <label class="goalStatusOption">
                    <input type="radio" name="status" value="active" checked>
                    <span>Active</span>
                </label>

                <label class="goalStatusOption">
                    <input type="radio" name="status" value="completed">
                    <span>Completed</span>
                </label>

            </div>

            <div class="goalPopupButtons">
                <button type="submit" name="action" value="create">
                    Add Goal
                </button>

                <button type="button" onclick="removeGoalPopup()">
                    Back
                </button>
            </div>

        </form>

    </section>
</div>
</body>
</html>
<script>
function showGoalPopup() {
    var element = document.getElementById("goalPopup");
    element.classList.add("goalPopupActive");
}

function removeGoalPopup() {
    var element = document.getElementById("goalPopup");
    element.classList.remove("goalPopupActive");
}
</script>