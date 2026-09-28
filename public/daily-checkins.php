<?php
require_once '../app/bootstrap.php';
require_once '../app/classes/dailyCheckins.php';
$userid = $_SESSION["user_id"];
$dailyCheckinsModel = new dailyCheckin($pdo);

$dailyCheckinsResults = $dailyCheckinsModel->getDailyCheckin($userid);


// Heeft de gebruiker vandaag al een check-in gedaan?
$alreadyCheckedIn = false;
if (!empty($dailyCheckinsResults)) {
    $latest = $dailyCheckinsResults[0]; // nieuwste door ORDER BY DESC
    $alreadyCheckedIn = date('Y-m-d', strtotime($latest['created_at'])) === date('Y-m-d');
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
$mood = $_POST['mood'];
$energy = $_POST['energy'];
$productivity = $_POST['productivity'];
$sleep = $_POST['sleep'];
$note = $_POST['note'];

$dailyCheckinsModel->createDailyCheckin($mood, $energy, $productivity, $sleep, $note, $userid);
header('Location: ' . $_SERVER['PHP_SELF']);
exit;
}
$averages = $dailyCheckinsModel->getDailyCheckinAverages($userid);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link rel="stylesheet" href="./assets/css/dashboardHeader.css">
    <link rel="stylesheet" href="./assets/css/global.css">
    <link rel="stylesheet" href="./assets/css/dailyCheckins.css">
    <title>Document</title>
</head>
<body>
    
<?php require_once '../app/views/partials/dashboardHeader.php';
if (isset($_SESSION['notificationMessage'])) {foreach ($_SESSION['notificationMessage'] as $notificiation) {
    echo "<span>" . $notificiation . "</span>";
}unset($_SESSION['notificationMessage']);
}  

if (!$alreadyCheckedIn) {
?>
<div class="formWrap">
<form action="" method="POST">

    <div class="moodSection">
        <h2>How are you feeling today?</h2>

        <div class="moodOptions">

            <label class="moodOption">
                <input type="radio" name="mood" value="1"  required>

                <span class="moodCard">
                    <img src="./assets/images/bad.png" alt="Bad" class="moodCardImage">
                </span>
            </label>


            <label class="moodOption">
                <input type="radio" name="mood"value="2">

                <span class="moodCard">
                    <img src="./assets/images/meh.png" alt="Meh"class="moodCardImage">
                </span>
            </label>


            <label class="moodOption">
                <input type="radio" name="mood" value="3">

                <span class="moodCard">
                    <img src="./assets/images/okay.png" alt="Okay"class="moodCardImage">
                </span>
            </label>

            <label class="moodOption">
                <input type="radio" name="mood"value="4">

                <span class="moodCard">
                    <img src="./assets/images/good.png" alt="Good"class="moodCardImage">
                </span>
            </label>


            <label class="moodOption">
                <input type="radio" name="mood" value="5">

                <span class="moodCard">
                    <img src="./assets/images/great.png" alt="Great"class="moodCardImage">
                </span>
            </label>

        </div>
    </div>
    <div class="energyProductivityWrapper">
    <div class="energy">
<div class="energyHeader">
            <h2>Energy level</h2>
        <p>How much energy do you have today?</p>
</div>
<div class="energyForm">

    <label>
        <input type="radio" name="energy" value="1" required>
        <div class="energyCircle"></div>
        <span>1</span>
    </label>

    <label>
        <input type="radio" name="energy" value="2">
        <div class="energyCircle"></div>
           <span>2</span>
    </label>

    <label>
        <input type="radio" name="energy" value="3">
        <div class="energyCircle"></div>
           <span>3</span>
    </label>

    <label>
        <input type="radio" name="energy" value="4">
        <div class="energyCircle"></div>
           <span>4</span>
    </label>

    <label>
        <input type="radio" name="energy" value="5">
        <div class="energyCircle"></div>
           <span>5</span>
    </label>

</div>
    </div>
  <div class="productivity">
    <div class="productivityHeader">
        <h2>Productivity</h2>
        <p>How productive were you today?</p>
    </div>

    <div class="productivityForm">

        <label>
            <input type="radio" name="productivity" value="1" required>
            <div class="productivityCircle"></div>
            <span>1</span>
        </label>

        <label>
            <input type="radio" name="productivity" value="2">
            <div class="productivityCircle"></div>
            <span>2</span>
        </label>

        <label>
            <input type="radio" name="productivity" value="3">
            <div class="productivityCircle"></div>
            <span>3</span>
        </label>

        <label>
            <input type="radio" name="productivity" value="4">
            <div class="productivityCircle"></div>
            <span>4</span>
        </label>

        <label>
            <input type="radio" name="productivity" value="5">
            <div class="productivityCircle"></div>
            <span>5</span>
        </label>

    </div>
</div>
    </div>
    <div class="sleepNotesWrapper">

    <div class="sleep">

        <div class="sleepHeader">
            <h2>Sleep</h2>
            <p>How well did you sleep?</p>
        </div>

        <div class="sleepForm">

            <label>
                <input type="radio" name="sleep" value="1" required>
                <div class="sleepCircle"></div>
                <span>1</span>
            </label>

            <label>
                <input type="radio" name="sleep" value="2">
                <div class="sleepCircle"></div>
                <span>2</span>
            </label>

            <label>
                <input type="radio" name="sleep" value="3">
                <div class="sleepCircle"></div>
                <span>3</span>
            </label>

            <label>
                <input type="radio" name="sleep" value="4">
                <div class="sleepCircle"></div>
                <span>4</span>
            </label>

            <label>
                <input type="radio" name="sleep" value="5">
                <div class="sleepCircle"></div>
                <span>5</span>
            </label>

        </div>

    </div>

    <div class="note">

        <div class="noteHeader">
            <h2>Notes</h2>
            <p>Anything you want to remember about today?</p>
        </div>

        <textarea name="note" id="note" placeholder="Write something about your day..."></textarea>

    </div>

</div>
    </div>
    <button type="submit">Submit Daily Check-In</button>
</form>

<?php
}
?>
<?php if ($averages !== null) { ?>

<section class="averageSection">
    <div class="averageHeader">
        <h2>Your averages</h2>
        <p>Your overall check-in statistics.</p>
    </div>

    <div class="averageCards">

        <div class="averageCard">
            <h3>Mood</h3>
            <p><?php echo $averages['mood']; ?> <span>/ 5</span></p>
        </div>

        <div class="averageCard">
            <h3>Energy</h3>
            <p><?php echo $averages['energy']; ?> <span>/ 5</span></p>
        </div>

        <div class="averageCard">
            <h3>Productivity</h3>
            <p><?php echo $averages['productivity']; ?> <span>/ 5</span></p>
        </div>

        <div class="averageCard">
            <h3>Sleep</h3>
            <p><?php echo $averages['sleep']; ?> <span>/ 5</span></p>
        </div>

        <div class="averageCard overallAverage">
            <h3>Overall Day</h3>
            <p><?php echo $averages['overall_day']; ?> <span>/ 5</span></p>
        </div>

    </div>
</section>

<?php } ?>
<?php
$nummer = count($dailyCheckinsResults);
foreach ($dailyCheckinsResults as $checkin) {
    $dateToday = date('d-m-Y');
    $dag = date('d-m-Y', strtotime($checkin['created_at']));
?>
<div class="dailyCheckinsResult">
    <div class="dailyNumber dailyResult"><h3>Check-in</h3><p>#<?php echo $nummer--; ?></p></div>
    <div class="dailyDate dailyResult"><h3>Dag</h3><p><?php echo $dag; ?></p></div>
    <div class="overallDay dailyResult"><h3>Overall Day:</h3><p><?php echo $checkin['overall_day']; ?></p></div>
    <div class="dailyMood dailyResult"><h3>Feeling Today</h3><p><?php echo $checkin['mood']; ?></p></div>
    <div class="dailyEnergy dailyResult"><h3>Energy Level</h3><p><?php echo $checkin['energy']; ?></p></div>
    <div class="dailyProductivity dailyResult"><h3>Productivity</h3><p><?php echo $checkin['productivity']; ?></p></div>
    <div class="dailySleep dailyResult"><h3>Sleep Quality</h3><p><?php echo $checkin['sleep']; ?></p></div>
    <div class="dailyNotes dailyResult"><h3>Notes</h3><p><?php echo htmlspecialchars($checkin['note']); ?></p></div>
</div>
<?php
}
?>
</body>
</html>

<script>
const images = document.querySelectorAll(".moodCardImage");

images.forEach(image => {
    image.addEventListener("click", function () {

        images.forEach(img => {
            img.classList.remove("moodCardImageSize");
        });

        this.classList.add("moodCardImageSize");
    });
});

const energyCircles = document.querySelectorAll(".energyCircle");

energyCircles.forEach(circle => {
    circle.addEventListener("click", function () {

        energyCircles.forEach(circle => {
            circle.classList.remove("energyCircleActive");
        });

        this.classList.add("energyCircleActive");
    });
});

const productivityCircles = document.querySelectorAll(".productivityCircle");

productivityCircles.forEach(circle => {
    circle.addEventListener("click", function () {

        productivityCircles.forEach(circle => {
            circle.classList.remove("productivityCircleActive");
        });

        this.classList.add("productivityCircleActive");
    });
});

const sleepCircles = document.querySelectorAll(".sleepCircle");

sleepCircles.forEach(circle => {
    circle.addEventListener("click", function () {

        sleepCircles.forEach(circle => {
            circle.classList.remove("sleepCircleActive");
        });

        this.classList.add("sleepCircleActive");
    });
});
</script>