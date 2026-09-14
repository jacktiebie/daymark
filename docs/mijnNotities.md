Doelen
Mood
Spullen
Agenda
Habits
To Do
Notities


PDO-constant flow begrijpen:

Database object
connect()
->
Build DSN
->
mysql:host=localhost;
dbname=daymark;
charset=utf8mb4
->
new PDO (...)
-> 
PHP probeert verbinding te maken met MySQL
->
$pdo
->
return $pdo

PHP STARTEN ZONDER MYOCNFIG
cd public
C:\xampp\php\php.exe -S localhost:8000

## HANDIGE LINKS
https://fonts.google.com/icons?icon.size=24&icon.color=%23e3e3e3
pexels.com
fonts.google.com

EMMET = CONTROL + SHIFT + P en dan  Emmet: Wrap with abbrevation en dan DIV schrijven


4 OOP dingen snappen:
1. Class





2. Object / new
3. Constructur
4. $this


help mij met daymark ik heb nu dit 

.habitNav {

display: flex;

justify-content: space-between;

align-items: center;

padding-left: 1rem;

padding-right: 7rem;

padding-top: 2rem;

}

.habitNavWrapOne {

    text-align: left;

}

.habitNavWrapOne h1 {

    font-size: 3rem;

}

.habitNavWrapTwo {

}

.habitButtonAdd {

    padding: 0.5rem 1rem;

    background-color: darkgreen;

    text-decoration: none;

    font-family: inherit;

    color: white;

    border-radius: 10%;

}


/* STAT ITEMS */

.habitStats {

    display: flex;

    align-items: center;

    justify-content: space-between;

    margin-top: 4rem;

    padding-left: 1rem;

padding-right: 7rem;

}

.habitStatsItems {

    width: 100%;

    background-color: rgb(170, 238, 170);

    padding-inline: 2rem;

    padding-block: 1rem;

border-right: solid 1px rgb(46, 46, 46);

}

.habitStats img {

    width: 2rem;

}


/* HABITS */

.habits {

    display: flex;

    flex-direction: column;

        padding-left: 1rem;

padding-right: 7rem;

padding-top: 4rem;

}

.habitsItems {

    display: flex;

    background-color: rgb(239, 238, 238);

    width: 100%;

    padding: 1rem 2rem;

    justify-content: space-between;

}

.flexWrapOne {

    display: flex;

    flex-direction: row;

    gap: 2rem;

    margin-top: 2rem;

}


.flexWrapThree {

    margin-top: 2rem;

}

.habitsItemsImg {

    width: 4rem;

}

.habitItemsModify {

    width: 2rem;

}


.habitsItemsImg {

    background-color: rgb(203, 228, 237);

    padding: 0.5rem;

    border-radius: 25%;

}

.habitsItemsWrap {

    display: flex;

    flex-direction: column;

    text-align: left;

}

.habitItemsModify {

    background-color: rgb(200, 199, 199);

    padding: 0.25rem;

    border-radius: 25%;

}

.habitsItemsModifyWrap {

    display: flex;

    justify-content: right;

    gap: 1rem;

}


.habitWeek {

    display: flex;

    gap: 0.8rem;

    margin-top: 0.5rem;

}

.habitDay {

    display: flex;

    flex-direction: column;

    align-items: center;

    gap: 0.3rem;

}

.dayCircle {

    width: 16px;

    height: 16px;

    border-radius: 50%;

    border: 2px solid #bfc5cc;

    display: block;

}

.dayCircle.done {

    background-color: green;

    border-color: green;

}


.habitsAdd {

    background-color: darkgreen;

    color: white;

} <?php 
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
</html> <?php 
Class Habits { 
 
private PDO $pdo; 
 
    public function __construct(PDO $pdo) 
    //De meegegeven $pdo opslaan in dit Auth object. 
    { 
        $this->pdo = $pdo; 
    } 
 
    public function createHabit(string $title, string $description, $frequency, $userid) { 
       //trimdata 
    $title = trim($title); 
    $description = trim($description); 
    $frequency = trim($frequency); 
    $created_at = date("Y-m-d H:i:s"); 
 
        //checks 
        $this->validateHabit($title, $description, $frequency); 
 
        $this->uploadHabit($userid, $title, $description, $frequency, $created_at); 
    } 
 
    public function validateHabit($title, $description, $frequency) { 
    //max length frequency 
 
    if ($frequency > 8) { 
        //error message  
    } 
 
    if ($frequency < 1) { 
        //error message 
    } 
    } 
 
public function uploadHabit($userid, $title, $description, $frequency, $created_at) { 
$sql = "INSERT INTO habits (user_id, title, description, frequency, created_at) VALUES (?, ?, ?, ?, ?)"; 
$stmt = $this->pdo->prepare($sql); 
$stmt->execute([$userid, $title, $description, $frequency, $created_at]); 
    $_SESSION['notificationMessage'][] = "Habit is gemaakt"; 
    } 
 
 
public function getHabits ($userid) { 
$sql = "SELECT id, title, description, frequency FROM habits WHERE user_id = ?"; 
$stmt = $this->pdo->prepare($sql); 
$stmt->execute([$userid]); 
$habits = $stmt->fetchALL(PDO::FETCH_ASSOC); 
return $habits; 
} 
 
public function deleteHabit($habit_id) { 
$sql = "DELETE FROM habits WHERE id = ?"; 
$stmt = $this->pdo->prepare($sql); 
$stmt->execute([$habit_id]); 
$_SESSION['notificationMessage'][] = "Habit is verwijderd"; 
} 
} 
 
?> ik kan dus uploaden en verwijderen hoe zou ik nu verder gaan hou ook rekening met de database tabel habit_logs

Ja, je zit nu op een goed punt. Je hebt eigenlijk de CRUD-basis van habits al deels staan:

✅ Create habit
✅ Read habits
✅ Delete habit
⏳ Update habit
⏳ Habit afvinken per dag via habit_logs

Ik zou nu eerst habit_logs bouwen, vóór je stats en streaks gaat maken. Die stats zijn namelijk straks allemaal gebaseerd op de logs.

1. Waarvoor gebruik je habit_logs?

Je habits tabel bevat de habit zelf:

habits
id
user_id
title
description
frequency
created_at

Maar je wilt niet in habits opslaan:

Monday = done
Tuesday = done
Wednesday = done

Want volgende week begint alles opnieuw.

Daarom:

habit_logs
id
habit_id
log_date
completed

Bijvoorbeeld:

id | habit_id | log_date   | completed
1  | 5        | 2026-09-14 | 1
2  | 5        | 2026-09-15 | 1
3  | 8        | 2026-09-14 | 1

Dus habit 5 is op 14 en 15 september gedaan.

2. Je volgende feature: een habit vandaag afvinken

Je bolletjes zijn nu hardcoded:

<span class="dayCircle done"></span>

Dat moet uiteindelijk uit je database komen.

De flow wordt:

Gebruiker klikt bolletje
        ↓
POST request
        ↓
habit_id + datum
        ↓
HabitLogs / Habits class
        ↓
INSERT INTO habit_logs
        ↓
pagina opnieuw laden
        ↓
log bestaat → groene cirkel

Ik zou eerst alleen "vandaag afvinken" maken. Nog niet meteen heel de week dynamisch proberen te bouwen.

Bijvoorbeeld conceptueel:

habit_id = 7
log_date = vandaag
completed = 1

In SQL zou dat uiteindelijk neerkomen op iets als:

INSERT INTO habit_logs (habit_id, log_date, completed)
VALUES (?, ?, ?)
3. Maak hiervoor een aparte functie

In je Habits class kun je bijvoorbeeld richting dit ontwerp gaan:

createHabit()
getHabits()
deleteHabit()

completeHabit()
getHabitLogs()

Of, als je het later netter wilt scheiden:

Habits.php
HabitLogs.php

Voor jouw project zou ik nu gewoon in Habits.php doorgaan. Niet meteen extra classes maken als dat nog niet nodig is.

Je functie krijgt ongeveer deze verantwoordelijkheid:

completeHabit($habit_id, $date)

Die slaat bijvoorbeeld op:

habit_id = 3
date = 2026-09-14
completed = 1
4. Heel belangrijk: voorkom dubbele logs

Stel ik klik 5 keer op maandag.

Je wilt niet dit:

habit_id | log_date
3        | 2026-09-14
3        | 2026-09-14
3        | 2026-09-14
3        | 2026-09-14

Een habit mag voor één datum eigenlijk maar één log hebben.

Ik zou daarom in MySQL een unieke combinatie maken van:

habit_id + log_date

Dus:

UNIQUE(habit_id, log_date)

Dan kan:

Habit 3 + 14 september

maar één keer bestaan.

Dat gaat je later veel problemen besparen.

5. Je bolletje wordt dan een formulier

Je hebt nu bijvoorbeeld:

<div class="habitDay">
    <span class="dayCircle"></span>
    <span>M</span>
</div>

Conceptueel wil je uiteindelijk:

[button / circle]
      ↓
habit_id
date
action = complete

Net zoals je delete nu hebt:

<button type="submit" name="action" value="delete">

kun je dezelfde structuur gebruiken voor:

action = complete

Dus bovenaan krijg je uiteindelijk drie acties:

if ($_POST['action'] === 'create') {
}

if ($_POST['action'] === 'delete') {
}

if ($_POST['action'] === 'complete') {
}

Dat sluit mooi aan bij hoe je pagina nu al werkt.

6. Daarna haal je logs uit de database

Wanneer dit opslaan werkt, maak je daarna bijvoorbeeld:

getHabitLogs($habit_id)

Die doet ongeveer:

SELECT log_date, completed
FROM habit_logs
WHERE habit_id = ?

Dan kun je voor iedere habit bepalen:

maandag → bestaat log? → groen
dinsdag → bestaat log? → groen
woensdag → geen log → grijs

Dan wordt dit:

<span class="dayCircle done"></span>

dus niet meer hardcoded.

Je PHP bepaalt uiteindelijk:

is deze datum completed?
    ja → class "dayCircle done"
    nee → class "dayCircle"

Dat is denk ik de belangrijkste volgende stap van heel je habits-systeem.

7. Daarna kun je pas echt interessante dingen maken

Als habit_logs werkt, krijg je bijna gratis allerlei features.

Je kunt je bovenste stats bijvoorbeeld echt maken:

Active habits
4

Completed today
3

Current streak
7 days

Completion this week
82%

Active habits:

COUNT habits WHERE user_id = ?

Completed today:

COUNT habit_logs WHERE log_date = vandaag

Completion this week:

aantal completed / aantal verwachte completions

En voor:

🔥 7 day streak

kun je de opeenvolgende log_dates bekijken.

Maar streak zou ik nog niet als volgende maken. Dat is wat lastiger.

8. Frequency krijgt dan ook echt betekenis

Je slaat nu bijvoorbeeld op:

frequency = 4

Dat betekent:

Ik wil deze habit vier keer per week doen.

Later kun je dan zeggen:

Gym
3 / 4 deze week

Dat vind ik zelfs nuttiger dan direct een streak.

Bijvoorbeeld:

Gym

● ● ● ○ ○ ○ ○

3 / 4 completed this week

Dan vergelijk je:

COUNT habit_logs van deze week

met:

$habit['frequency']
Eén kleine fout die ik nu alvast zou aanpassen

Je hebt:

if ($frequency > 8)

Maar een week heeft natuurlijk maximaal 7 dagen als je bedoelt x per week.

Dus logisch zou zijn:

if ($frequency > 7)

Verder zou ik bij verwijderen ook uiteindelijk controleren of die habit echt van de ingelogde gebruiker is. Nu is je query:

DELETE FROM habits WHERE id = ?

Veiliger is conceptueel:

verwijder habit
WAAR id = habit_id
EN user_id = ingelogde gebruiker

Dan kan iemand nooit via een gemanipuleerd habit_id een habit van een andere gebruiker verwijderen.

Mijn volgorde voor Daymark vanaf hier

Nu: habit vandaag kunnen afvinken → log opslaan → logs ophalen → bolletjes automatisch groen/grijs maken.

Daarna: deze week automatisch genereren → 3 / 4 this week → echte dashboard-stats → streak → edit habit.

Ik kan als volgende stap met jou alleen het afvinken van één habit voor vandaag bouwen, stap voor stap en zonder meteen de volledige code voor je te schrijven.