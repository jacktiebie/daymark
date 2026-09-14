<?php
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
    }


public function getHabits ($userid) {
$sql = "SELECT title, description, frequency FROM habits WHERE user_id = ?";
$stmt = $this->pdo->prepare($sql);
$stmt->execute([$userid]);
$habits = $stmt->fetchALL(PDO::FETCH_ASSOC);
return $habits;
}
}

?>