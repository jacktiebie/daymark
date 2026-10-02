<?php

Class Goals
{
    private PDO $pdo;

    // Store the PDO connection inside this class
    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function createGoal($title, $description, $target, $current, $unit, $due_date, $status, $userid) {
    $this->validateGoal($title, $target, $current, $unit, $due_date);

     $created_at = date('Y-m-d H:i:s');
    $updated_at = date('Y-m-d H:i:s');

    $sql = "INSERT INTO goals (user_id, title, description, target_value, current_value, unit, status, due_date, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $this->pdo->prepare($sql);

    $stmt->execute([
        $userid,
        $title,
        $description,
        $target,
        $current,
        $unit,
        $status,
        $due_date,
        $created_at,
        $updated_at
    ]);

    $_SESSION['notificationMessage'][] = "Goal succesvol toegevoegd";

    header("Location: goals.php");
    exit();

    }

    public function editGoal($goal_id, $title, $description, $target, $current, $unit, $due_date, $status, $userid)
{
    $this->validateGoal($title, $target, $current, $unit, $due_date);

    $updated_at = date('Y-m-d H:i:s');

    $sql = "UPDATE goals 
            SET title = ?, 
                description = ?, 
                target_value = ?, 
                current_value = ?, 
                unit = ?, 
                status = ?, 
                due_date = ?, 
                updated_at = ?
            WHERE id = ? AND user_id = ?";

    $stmt = $this->pdo->prepare($sql);

    $stmt->execute([
        $title,
        $description,
        $target,
        $current,
        $unit,
        $status,
        $due_date,
        $updated_at,
        $goal_id,
        $userid
    ]);

    $_SESSION['notificationMessage'][] = "Goal succesvol aangepast";

    header("Location: goals.php");
    exit();
}

    public function validateGoal($title, $target, $current, $unit, $due_date) {
    //Basic String Trimming
    $title = trim($title);
    $description = trim($description);
    $unit = trim($unit);
    //Title not empty
    if (empty($title)) {
        $_SESSION['notificationMessage'][] = "Titel is leeg";
        header("Location: goals.php");
        exit();       
    }
        //Targert not empty
    if (empty($unit)) {
        $_SESSION['notificationMessage'][] = "Unit is leeg";
        header("Location: goals.php");
        exit();       
    }
    //Target bigger than 0
    if ($target <= 0) {
        $_SESSION['notificationMessage'][] = "Target is 0 of lager";
          header("Location: goals.php");
        exit();      
    }
    //Current not bigger than target
    if ($current > $target) {
        $_SESSION['notificationMessage'][] = "Current value groter dan target";
        header("Location: goals.php");
        exit();  
    }
    if ($current < 0) {
    $_SESSION['notificationMessage'][] = "Current value kan niet negatief zijn";
    header("Location: goals.php");
    exit();
}
if ($due_date < date('Y-m-d')) {
    $_SESSION['notificationMessage'][] = "Due date kan niet in het verleden liggen";
    header("Location: goals.php");
    exit();
}

    }
    public function getGoals($userid) {
    $sql = "SELECT id, title, description, target_value, current_value, unit, status, due_date, created_at FROM goals WHERE user_id = ?";
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute([$userid]);
    $goals = $stmt->fetchALL(PDO::FETCH_ASSOC);

    return $goals;
    }

}