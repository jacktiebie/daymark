<?php
require_once '../app/bootstrap.php';
require_once '../app/classes/goals.php';

$userid = $_SESSION["user_id"];
$goalsModel = new Goals($pdo);
$goals = $goalsModel->getGoals($userid);
$activeGoals = 0;
$completedGoals = 0;
//Total Goals
$goalsNumber = count($goals);
foreach ($goals as $goal) {
    if ($goal['status'] == 0) {
        $activeGoals++;
    } elseif ($goal['status'] == 1) {
        $completedGoals++;
    }
}
$selectedGoal = null;
$goalActive = false;

// Overall Progress
$totalProgress = $goalsModel->getOverallProgress($userid);

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
            $goalsModel->createGoal($title, $description, $target, $current, $unit, $due_date, $status, $userid);
            //echo "<meta http-equiv='refresh' content='0'>";
            $goalActive = false;
            break;

        case 'edit':
            $goal_id = $_POST['goal_id'];
            foreach ($goals as $goal) {
                if ($goal['id'] == $goal_id) {
                    $selectedGoal = $goal;
                }
            }
            break;

        case 'reset':
            $selectedGoal = null;
            $goalActive = true;
            break;

        case 'editCurrentGoal':
            $goal_id = $_POST['goal_id'];
            $title = $_POST['title'];
            $description = $_POST['description'];
            $target = $_POST['target_value'];
            $current = $_POST['current_value'];
            $unit = $_POST['unit'];
            $due_date = $_POST['due_date'];
            $status = $_POST['status'];
            $goalsModel->editGoal($goal_id, $title, $description, $target, $current, $unit, $due_date, $status, $userid);
            //echo "<meta http-equiv='refresh' content='0'>";
            $goalActive = false;
            break;
        case 'delete':
            $goal_id = $_POST['goal_id'];
            $goalsModel->deleteGoal($goal_id, $userid);
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
    <?php require_once '../app/views/partials/dashboardHeader.php'; ?>

    <?php
    if (isset($_SESSION['notificationMessage'])) {
        foreach ($_SESSION['notificationMessage'] as $notificiation) {
            echo "<span>" . $notificiation . "</span>";
        }
        unset($_SESSION['notificationMessage']);
    }
    ?>

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
                <h3><?php echo $goalsNumber ?></h3>
                <p class="goalsDataDescription"><?php echo $activeGoals ?> active * <?php echo $completedGoals ?> completed</p>
            </div>

        </div>


        <div class="goalsDataCard goalsDataProgress">

            <div class="goalsDataIconWrapper">
                <img src="./assets/images/target.png" alt="" class="goalsDataIcon">
            </div>

            <div class="goalsDataContent">
                <p class="goalsDataSubtitle">Overall Progress</p>
                <h3><?php echo $totalProgress ?>%</h3>

                <div class="progressBar">
                    <div class="progress" style="width: <?php echo $totalProgress ?>%;"></div>
                </div>
            </div>

        </div>


        


        </div>

    <div class="bottom">

        <div class="bottomLeft">
            <?php
            $status = $_GET['status'] ?? 'all';
            ?>
            <form method="GET">
                <select name="status" onchange="this.form.submit()">
                    <option value="all" <?= $status == 'all' ? 'selected' : '' ?>>Alle goals</option>
                    <option value="new" <?= $status == 'new' ? 'selected' : '' ?>>Nieuw</option>
                    <option value="old" <?= $status == 'old' ? 'selected' : '' ?>>Oud</option>
                    <option value="active" <?= $status == 'active' ? 'selected' : '' ?>>Active</option>
                    <option value="completed" <?= $status == 'completed' ? 'selected' : '' ?>>Completed</option>
                </select>
            </form>

            <h2>My Goals</h2>

            <?php
            function cmp($a, $b)
            {
                if ($a['created_at'] == $b['created_at']) {
                    return 0;
                }
                return ($a['created_at'] > $b['created_at']) ? -1 : 1;
            }

            function cmp2($a, $b)
            {
                if ($a['created_at'] == $b['created_at']) {
                    return 0;
                }
                return ($a['created_at'] < $b['created_at']) ? -1 : 1;
            }

            switch ($status) {
                case 'completed':
                    $goals = array_filter($goals, function ($goal) {
                        return $goal['status'] == 1;
                    });
                    break;

                case 'active':
                    $goals = array_filter($goals, function ($goal) {
                        return $goal['status'] == 0;
                    });
                    break;

                case 'all':
                    $goals = $goals;
                    break;

                case 'new':
                    usort($goals, "cmp");
                    break;

                case 'old':
                    usort($goals, "cmp2");
                    break;
            }
            ?>

            <?php
            foreach ($goals as $goal) {
            ?>

                <div class="bottomLeftWrap">

                    <img src="./assets/images/target.png" alt="">

                    <div class="bottomLeftWrapText">

                        <h4><?php echo $goal['title']; ?></h4>

                        <p><?php echo $goal['description']; ?></p>

                        <?php echo $goal['current_value'] ?><?php echo " /" ?> <?php echo $goal['target_value'] ?> <?php echo $goal['unit'] ?>
                        <?php $currentCompletedPercentage = $goal['current_value'] / $goal['target_value'] * 100; ?>

                        <div class="progressBar">
                            <div class="progress" style="width: <?php echo $currentCompletedPercentage ?>%;"></div>
                        </div>

                    </div>

                    <form method="post">
                        <button class="active" name="action" value="edit">
                            <?php
                            if ($goal['status'] == 0) {
                                echo 'Active';
                            } else {
                                echo 'Completed';
                            }
                            ?>
                            <input type="hidden" name="goal_id" value="<?= $goal['id'] ?>">
                        </button>
                    </form>
                       <form method="post">
                        <button class="warning" name="action" value="delete"  onclick="return confirm('Are you sure?')">
                         Verwijderen 
                        <input type="hidden" name="goal_id" value="<?= $goal['id'] ?>">
                        </button>
                    </form>

                </div>

            <?php
            }
            ?>

        </div>


        <div class="bottomRight">

            <div class="bottomRightAddGoal">
                <form method="post">
                    <button name="action" value="reset">+ Add New Goal</button>
                </form>
            </div>

            <div class="bottomRightQuote">
                <p class="bottomRightQuoteSubtitle">Progress. not perfection</p>
                <h2>"A little progress each days adds up to big results."</h2>
            </div>

        </div>

    </div>

    <?php ?>

    <div class="goalPopup <?= ($selectedGoal || $goalActive === true) ? 'goalPopupActive' : '' ?>" id="goalPopup">
        <section class="goalsAdd">

            <form action="" method="post">

                <label for="goalTitle">Goal title</label>
                <input
                    type="text"
                    name="title"
                    id="goalTitle"
                    value="<?= $selectedGoal['title'] ?? '' ?>">

                <label for="goalDescription">Description</label>
                <input
                    type="text"
                    name="description"
                    id="goalDescription"
                    value="<?= $selectedGoal['description'] ?? '' ?>">

                <div class="goalInputRow">

                    <div>
                        <label for="targetValue">Target</label>
                        <input
                            type="number"
                            name="target_value"
                            id="targetValue"
                            value="<?= $selectedGoal['target_value'] ?? '' ?>">
                    </div>

                    <div>
                        <label for="currentValue">Current</label>
                        <input
                            type="number"
                            name="current_value"
                            id="currentValue"
                            value="<?= $selectedGoal['current_value'] ?? '' ?>">
                    </div>

                    <div>
                        <label for="unit">Unit</label>
                        <input
                            type="text"
                            name="unit"
                            id="unit"
                            value="<?= $selectedGoal['unit'] ?? '' ?>"
                            placeholder="kg, days, pages...">
                    </div>

                </div>

                <label for="dueDate">Due date</label>
                <input
                    type="date"
                    name="due_date"
                    id="dueDate"
                    value="<?= $selectedGoal['due_date'] ?? '' ?>">

                <label for="status">Status</label>

                <div class="goalStatusOptions">

                    <label class="goalStatusOption">
                        <input
                            type="radio"
                            name="status"
                            value="active"
                            <?= isset($selectedGoal) && $selectedGoal['status'] == 0 ? 'checked' : '' ?>>
                        <span>Active</span>
                        <input type="hidden" name="goal_id" value="<?= $selectedGoal['id'] ?? '' ?>">
                    </label>

                    <label class="goalStatusOption">
                        <input
                            type="radio"
                            name="status"
                            value="completed"
                            <?= isset($selectedGoal) && $selectedGoal['status'] == 1 ? 'checked' : '' ?>>
                        <span>Completed</span>
                    </label>

                </div>

                <div class="goalPopupButtons">

                    <?php if ($goalActive === true) { ?>

                        <button type="submit" name="action" value="create">
                            Add Goal
                        </button>

                    <?php } else { ?>

                        <button type="submit" name="action" value="editCurrentGoal">
                            Edit Goal
                        </button>

                    <?php } ?>

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
    function removeGoalPopup() {
        var element = document.getElementById("goalPopup");
        element.classList.remove("goalPopupActive");
    }
</script>