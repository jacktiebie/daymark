<?php
require_once '../app/bootstrap.php';

// Features shown in section two (icon, title, description)
$features = [
    [
        'icon'  => './assets/images/smileyIcon.svg',
        'title' => 'Goals',
        'text'  => 'Set a target, track your progress and see how close you are.',
    ],
    [
        'icon'  => './assets/images/smileyIcon.svg',
        'title' => 'Habits',
        'text'  => 'Tick off your habits every day and build a routine that lasts.',
    ],
    [
        'icon'  => './assets/images/smileyIcon.svg',
        'title' => 'Check-ins',
        'text'  => 'Rate your mood, energy and sleep in less than a minute.',
    ],
    [
        'icon'  => './assets/images/smileyIcon.svg',
        'title' => 'Streaks',
        'text'  => 'Stay consistent and watch your streak grow day by day.',
    ],
];

// Steps shown in section three
$steps = [
    [
        'title' => 'Create your account',
        'text'  => 'Sign up for free and get your own personal dashboard.',
    ],
    [
        'title' => 'Add goals and habits',
        'text'  => 'Decide what you want to achieve and which habits get you there.',
    ],
    [
        'title' => 'Check in every day',
        'text'  => 'Log your day, keep your streak alive and see your progress at a glance.',
    ],
];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php require_once '../app/css.php'; ?>
    <link rel="stylesheet" href="./assets/css/index.css">
    <title>Daymark | Small steps. Bigger dreams.</title>
</head>
<body>
<?php require_once '../app/views/partials/nav.php'; ?>

<?php
// Show notifications and clear them afterwards
if (isset($_SESSION['notificationMessage'])) {
    foreach ($_SESSION['notificationMessage'] as $notification) {
        echo "<span>" . $notification . "</span>";
    }
    unset($_SESSION['notificationMessage']);
}
?>

<main>

    <!-- SECTION ONE: hero -->
    <section class="sectionOne">
        <div class="sectionOneGroup">
            <h1>Small steps. Bigger dreams.</h1>
            <p>Daymark brings your goals, habits and daily check-ins together in one simple dashboard, so you always know where you stand and what to do next.</p>

            <div class="buttonGroup">
                <a href="./register.php" class="button">Get started</a>
                <a href="./login.php" class="button">Log in</a>
            </div>
        </div>

        <img src="./assets/images/backgroundAuth.jpg" alt="Preview of the Daymark app">
    </section>

    <!-- SECTION TWO: features -->
    <section class="sectionTwo">
        <h2>Everything you need to stay on track.</h2>
        <p>Stop juggling notes, lists and apps. Daymark helps you plan, follow up and reflect, all in one place.</p>

        <div class="sectionTwoGroup">
            <?php foreach ($features as $feature) { ?>
                <div class="statItem">
                    <img src="<?php echo $feature['icon']; ?>" alt="">

                    <div>
                        <h3><?php echo $feature['title']; ?></h3>
                        <p><?php echo $feature['text']; ?></p>
                    </div>
                </div>
            <?php } ?>
        </div>
    </section>

    <!-- SECTION THREE: how it works -->
    <section class="sectionThree">
        <p class="sectionLabel">How it works</p>
        <h2>Get started in three simple steps.</h2>

        <div class="sectionThreeGroup">
            <?php foreach ($steps as $number => $step) { ?>
                <div class="stepItem">
                    <span class="stepNumber"><?php echo $number + 1; ?></span>
                    <h3><?php echo $step['title']; ?></h3>
                    <p><?php echo $step['text']; ?></p>
                </div>
            <?php } ?>
        </div>
    </section>

</main>

<?php require_once '../app/views/partials/footer.php'; ?>
</body>
</html>