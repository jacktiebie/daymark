<?php
// ============================================================
// SETUP
// ============================================================
require_once '../app/bootstrap.php';
require_once '../app/classes/auth.php';
require_once '../app/classes/dailyCheckins.php';
require_once '../app/classes/goals.php';
require_once '../app/classes/habits.php';

// Make sure dates use the correct timezone (can also go in bootstrap.php)
date_default_timezone_set('Europe/Amsterdam');

$userid = $_SESSION["user_id"];
$today = date('Y-m-d');

// ============================================================
// DAILY CHECK-INS
// ============================================================
$dailyCheckinsModel = new dailyCheckin($pdo);
$dailyCheckinsResults = $dailyCheckinsModel->getDailyCheckin($userid);

// Has the user already done a check-in today?
$alreadyCheckedIn = false;
if (!empty($dailyCheckinsResults)) {
    $latest = $dailyCheckinsResults[0]; // newest one, because of ORDER BY DESC
    $alreadyCheckedIn = date('Y-m-d', strtotime($latest['created_at'])) === $today;
}

// ============================================================
// STREAK (consecutive days with a daily check-in)
// ============================================================
// Collect all check-in dates (one entry per day)
$checkinDates = [];
foreach ($dailyCheckinsResults as $checkin) {
    $checkinDates[] = date('Y-m-d', strtotime($checkin['created_at']));
}
$checkinDates = array_unique($checkinDates);

$streak = 0;

// Start counting at today. If the user hasn't checked in yet today,
// start at yesterday so the streak doesn't reset before the day is over.
$day = $alreadyCheckedIn ? $today : date('Y-m-d', strtotime('-1 day'));

// Keep going back one day at a time until a day has no check-in
while (in_array($day, $checkinDates)) {
    $streak++;
    $day = date('Y-m-d', strtotime("$day -1 day"));
}

// ============================================================
// GOALS
// ============================================================
$goalsModel = new Goals($pdo);
$goals = $goalsModel->getGoals($userid);

$goalsNumber = count($goals); // total goals
$activeGoals = 0;
$completedGoals = 0;
$activeGoalsList = []; // active goals that are shown on the dashboard

// Count active/completed goals and collect the active ones
foreach ($goals as $goal) {
    if ($goal['status'] == 0) {
        $activeGoals++;
        $activeGoalsList[] = $goal;
    } elseif ($goal['status'] == 1) {
        $completedGoals++;
    }
}

// Only show the first 3 active goals on the dashboard
$activeGoalsList = array_slice($activeGoalsList, 0, 3);

// Overall progress of all goals (in %)
$totalProgress = $goalsModel->getOverallProgress($userid);

// ============================================================
// HABITS
// ============================================================
$habitsModel = new Habits($pdo);
$todaysHabits = $habitsModel->getHabits($userid);
$habitsTotal = count($todaysHabits);
$habitsDone = 0;

// Check for every habit if it is completed today
foreach ($todaysHabits as $key => $habit) {
    $log = $habitsModel->findHabit($habit['id'], $today);
    $todaysHabits[$key]['completed'] = ($log !== false);

    if ($log !== false) {
        $habitsDone++;
    }
}

// ============================================================
// GREETING (based on the time of day)
// ============================================================
$hour = (int) date('G'); // current hour, 0-23
if ($hour < 12) {
    $greeting = "Good morning";
} elseif ($hour < 18) {
    $greeting = "Good afternoon";
} else {
    $greeting = "Good evening";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="./assets/css/dashboardHeader.css">
    <link rel="stylesheet" href="./assets/css/global.css">
    <link rel="stylesheet" href="./assets/css/dashboard.css">
</head>
<body>
<?php require_once '../app/views/partials/dashboardHeader.php'; ?>

<?php
// Show notifications (e.g. "Habit is gelogd") and clear them afterwards
if (isset($_SESSION['notificationMessage'])) {
    foreach ($_SESSION['notificationMessage'] as $notification) {
        echo "<span>" . $notification . "</span>";
    }
    unset($_SESSION['notificationMessage']);
}
?>

<main class="dashboard">

    <!-- HEADER: greeting + date -->
    <section class="dashboardHeader">
        <div>
            <p class="dashboardGreeting"><?php echo $greeting; ?>, <?php echo htmlspecialchars($_SESSION["first_name"]); ?></p>
            <h1>Your day at a glance.</h1>
        </div>

        <div class="dashboardDate">
            <span><?php echo date('l'); ?></span>
            <strong><?php echo date('d F Y'); ?></strong>
        </div>
    </section>


    <!-- TOP STATS -->
    <section class="dashboardStats">

        <!-- Overall progress of all goals -->
        <div class="dashboardCard progressCard">
            <div class="cardTop">
                <p>Overall Progress</p>
                <span>Goals</span>
            </div>

            <div class="progressInfo">
                <strong><?php echo $totalProgress; ?>%</strong>
                <p>Keep going, you're doing great.</p>
            </div>

            <div class="progressBar">
                <div class="progressBarFill" style="width: <?php echo $totalProgress; ?>%;"></div>
            </div>
        </div>

        <!-- Number of active goals -->
        <div class="dashboardCard smallStat">
            <p>Active Goals</p>
            <strong><?php echo $activeGoals; ?></strong>
            <span>of <?php echo $goalsNumber; ?> total goals</span>
        </div>

        <!-- Number of completed goals -->
        <div class="dashboardCard smallStat">
            <p>Completed Goals</p>
            <strong><?php echo $completedGoals; ?></strong>
            <span>Goals completed</span>
        </div>

    </section>


    <!-- MAIN CONTENT -->
    <section class="dashboardGrid">

        <!-- HABITS (max 4 shown) -->
        <div class="dashboardCard habitsCard">

            <div class="cardHeader">
                <div>
                    <p>Today's habits</p>
                    <h2>Keep your streak alive</h2>
                </div>

                <!-- Completed today / total habits -->
                <span class="cardNumber"><?php echo $habitsDone; ?> / <?php echo $habitsTotal; ?></span>
            </div>

            <div class="habitList">

                <?php if (empty($todaysHabits)) { ?>
                    <p>You don't have any habits yet.</p>
                <?php } else { ?>
                    <?php foreach (array_slice($todaysHabits, 0, 4) as $habit) { ?>
                        <div class="habitItem <?php echo $habit['completed'] ? 'completed' : ''; ?>">
                            <div class="habitIcon"><?php echo $habit['completed'] ? '✓' : ''; ?></div>

                            <div>
                                <strong><?php echo htmlspecialchars($habit['title']); ?></strong>
                                <span><?php echo (int) $habit['frequency']; ?>x per week</span>
                            </div>
                        </div>
                    <?php } ?>
                <?php } ?>

            </div>

            <?php if ($habitsTotal > 4) { ?>
                <a href="./tasks.php">View all →</a>
            <?php } ?>

        </div>


<<<<<<< HEAD
        <!-- CHECK-IN -->
        <!-- CHECK-IN -->
<div class="dashboardCard checkinCard">
=======
        <!-- DAILY CHECK-IN -->
        <div class="dashboardCard checkinCard">
>>>>>>> aab9110b206c75e364b9a9ab39b366f57d7254aa

    <?php if ($alreadyCheckedIn): ?>

                <?php if (!$alreadyCheckedIn) { ?>
                    <!-- Not checked in yet: show the button -->
                    <a href="./daily-checkins.php" class="dailyCheckinButton">Create your Daily Check-In</a>
                <?php } else { ?>
                    <!-- Already checked in: show the score of today -->
                    <span class="checkinScore"><?php echo $latest['overall_day']; ?></span>
                <?php } ?>
            </div>

            <?php if ($alreadyCheckedIn) { ?>
                <!-- Details of today's check-in -->
                <div class="checkinList">

                    <div class="checkinItem">
                        <span>Mood</span>
                        <strong><?php echo $latest['mood']; ?> / 5</strong>
                    </div>

                    <div class="checkinItem">
                        <span>Energy</span>
                        <strong><?php echo $latest['energy']; ?> / 5</strong>
                    </div>

                    <div class="checkinItem">
                        <span>Productivity</span>
                        <strong><?php echo $latest['productivity']; ?> / 5</strong>
                    </div>

                    <div class="checkinItem">
                        <span>Sleep</span>
                        <strong><?php echo $latest['sleep']; ?> / 5</strong>
                    </div>

                </div>
            <?php } ?>

        </div>

        <?php if (!empty($dailyCheckinsResults[0]['note'])): ?>
            <p class="checkinNote">
                "<?= htmlspecialchars($dailyCheckinsResults[0]['note']) ?>"
            </p>
        <?php endif; ?>

    <?php else: ?>

        <div class="cardHeader">
            <div>
                <p>Daily Check-in</p>
                <h2>How was your day?</h2>
            </div>
        </div>

        <p>
            You haven't completed your daily check-in yet.
        </p>

        <a href="dailyCheckin.php" class="checkinButton">
            Go to Daily Check-in
        </a>

    <?php endif; ?>

</div>


        <!-- ACTIVE GOALS (max 3 shown) -->
        <div class="dashboardCard goalsCard">

            <div class="cardHeader">
                <div>
                    <p>Active Goals</p>
                    <h2>Your current focus</h2>
                </div>

                <a href="./goals.php">View all →</a>
            </div>

            <?php if (empty($activeGoalsList)) { ?>
                <p>You don't have any active goals yet.</p>
            <?php } else { ?>
                <?php foreach ($activeGoalsList as $goal) { ?>
                    <?php
                    // Progress of this goal in %, never above 100 (and no division by zero)
                    $percentage = 0;
                    if ($goal['target_value'] > 0) {
                        $percentage = min(100, $goal['current_value'] / $goal['target_value'] * 100);
                    }
                    ?>
                    <div class="dashboardGoal">

                        <div class="goalInfo">
                            <strong><?php echo htmlspecialchars($goal['title']); ?></strong>
                            <span><?php echo $goal['current_value']; ?> / <?php echo $goal['target_value']; ?> <?php echo htmlspecialchars($goal['unit']); ?></span>
                        </div>

                        <div class="goalProgress">
                            <div style="width: <?php echo $percentage; ?>%;"></div>
                        </div>

                    </div>
                <?php } ?>
            <?php } ?>

        </div>


        <!-- STREAK -->
        <div class="dashboardCard streakCard">

            <p>Current Streak</p>

            <div class="streakNumber">
                <strong><?php echo $streak; ?></strong>
                <span><?php echo $streak == 1 ? 'day' : 'days'; ?></span>
            </div>

            <p class="streakText">
                <?php
                // Message depends on the streak
                if ($streak == 0) {
                    echo "Check in today to start your streak.";
                } else {
                    echo "You're building a solid routine.";
                }
                ?>
            </p>

        </div>

    </section>

</main>

</body>
</html>