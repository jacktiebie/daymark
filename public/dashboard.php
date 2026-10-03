<?php 
require_once '../app/bootstrap.php';
require_once '../app/classes/auth.php';
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
<?php require_once '../app/views/partials/dashboardHeader.php';?>
<?php if (isset($_SESSION['notificationMessage'])) {foreach ($_SESSION['notificationMessage'] as $notificiation) {
    echo "<span>" . $notification . "</span>";
}unset($_SESSION['notificationMessage']);
}  ?>
<main class="dashboard">

    <!-- HEADER -->
    <section class="dashboardHeader">
        <div>
            <p class="dashboardGreeting">Good afternoon, Jack</p>
            <h1>Your day at a glance.</h1>
        </div>

        <div class="dashboardDate">
            <span>Wednesday</span>
            <strong>02 October 2026</strong>
        </div>
    </section>


    <!-- TOP STATS -->
    <section class="dashboardStats">

        <div class="dashboardCard progressCard">
            <div class="cardTop">
                <p>Overall Progress</p>
                <span>Goals</span>
            </div>

            <div class="progressInfo">
                <strong>72%</strong>
                <p>Keep going, you're doing great.</p>
            </div>

            <div class="progressBar">
                <div class="progressBarFill"></div>
            </div>
        </div>


        <div class="dashboardCard smallStat">
            <p>Active Goals</p>
            <strong>3</strong>
            <span>of 5 total goals</span>
        </div>


        <div class="dashboardCard smallStat">
            <p>Completed Goals</p>
            <strong>2</strong>
            <span>Goals completed</span>
        </div>

    </section>


    <!-- MAIN CONTENT -->
    <section class="dashboardGrid">

        <!-- HABITS -->
        <div class="dashboardCard habitsCard">

            <div class="cardHeader">
                <div>
                    <p>Today's habits</p>
                    <h2>Keep your streak alive</h2>
                </div>

                <span class="cardNumber">3 / 5</span>
            </div>

            <div class="habitList">

                <div class="habitItem completed">
                    <div class="habitIcon">✓</div>

                    <div>
                        <strong>Drink Water</strong>
                        <span>Daily</span>
                    </div>
                </div>


                <div class="habitItem completed">
                    <div class="habitIcon">✓</div>

                    <div>
                        <strong>Workout</strong>
                        <span>Daily</span>
                    </div>
                </div>


                <div class="habitItem">
                    <div class="habitIcon"></div>

                    <div>
                        <strong>Read</strong>
                        <span>30 minutes</span>
                    </div>
                </div>


                <div class="habitItem">
                    <div class="habitIcon"></div>

                    <div>
                        <strong>Learn PHP</strong>
                        <span>1 hour</span>
                    </div>
                </div>

            </div>

        </div>


        <!-- CHECK-IN -->
        <div class="dashboardCard checkinCard">

            <div class="cardHeader">
                <div>
                    <p>Daily Check-in</p>
                    <h2>How was your day?</h2>
                </div>

                <span class="checkinScore">4.0</span>
            </div>

            <div class="checkinList">

                <div class="checkinItem">
                    <span>Mood</span>
                    <strong>4 / 5</strong>
                </div>

                <div class="checkinItem">
                    <span>Energy</span>
                    <strong>3 / 5</strong>
                </div>

                <div class="checkinItem">
                    <span>Productivity</span>
                    <strong>4 / 5</strong>
                </div>

                <div class="checkinItem">
                    <span>Sleep</span>
                    <strong>4 / 5</strong>
                </div>

            </div>

            <p class="checkinNote">
                "Had a productive day and managed to finish my PHP work."
            </p>

        </div>


        <!-- GOALS -->
        <div class="dashboardCard goalsCard">

            <div class="cardHeader">
                <div>
                    <p>Active Goals</p>
                    <h2>Your current focus</h2>
                </div>

                <span>View all →</span>
            </div>


            <div class="dashboardGoal">

                <div class="goalInfo">
                    <strong>Learn PHP</strong>
                    <span>70 / 100 hours</span>
                </div>

                <div class="goalProgress">
                    <div style="width: 70%;"></div>
                </div>

            </div>


            <div class="dashboardGoal">

                <div class="goalInfo">
                    <strong>Build Daymark</strong>
                    <span>60 / 100%</span>
                </div>

                <div class="goalProgress">
                    <div style="width: 60%;"></div>
                </div>

            </div>


            <div class="dashboardGoal">

                <div class="goalInfo">
                    <strong>Read 5 books</strong>
                    <span>2 / 5 books</span>
                </div>

                <div class="goalProgress">
                    <div style="width: 40%;"></div>
                </div>

            </div>

        </div>


        <!-- STREAK -->
        <div class="dashboardCard streakCard">

            <p>Current Streak</p>

            <div class="streakNumber">
                <strong>7</strong>
                <span>days</span>
            </div>

            <p class="streakText">
                You're building a solid routine.
            </p>

        </div>

    </section>

</main>

</body>
</html>