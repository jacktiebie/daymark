<?php

Class Habits
{
    private PDO $pdo;

    // Store the PDO connection inside this class
    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    // Create a new habit
    public function createHabit(string $title, string $description, $frequency, $userid)
    {
        // Remove unnecessary spaces from the input data
        $title = trim($title);
        $description = trim($description);
        $frequency = trim($frequency);

        // Store the current date and time
        $created_at = date("Y-m-d H:i:s");

        // Validate the habit data
        $this->validateHabit($title, $description, $frequency);

        // Save the habit to the database
        $this->uploadHabit($userid, $title, $description, $frequency, $created_at);
    }

    // Validate the habit input
    public function validateHabit($title, $description, $frequency)
    {
        // Check if the frequency is too high
        if ($frequency > 8) {
            $_SESSION['notificationMessage'][] = "Frequency is te hoog";
            header("Location: tasks.php");
            exit();
        }

        // Check if the frequency is too low
        if ($frequency < 1) {
            $_SESSION['notificationMessage'][] = "Frequency is te laag";
            header("Location: tasks.php");
            exit();
        }
    }

    // Insert a new habit into the database
    public function uploadHabit($userid, $title, $description, $frequency, $created_at)
    {
        $sql = "INSERT INTO habits (user_id, title, description, frequency, created_at) VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$userid, $title, $description, $frequency, $created_at]);

        // Show a success notification
        $_SESSION['notificationMessage'][] = "Habit is gemaakt";
    }

    // Get all habits that belong to the current user
    public function getHabits($userid)
    {
        $sql = "SELECT id, title, description, frequency FROM habits WHERE user_id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$userid]);

        // Retrieve all habits as an associative array
        $habits = $stmt->fetchALL(PDO::FETCH_ASSOC);

        return $habits;
    }

    // Delete a habit from the database
    public function deleteHabit($habit_id)
    {
        $sql = "DELETE FROM habits WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$habit_id]);

        // Show a success notification
        $_SESSION['notificationMessage'][] = "Habit is verwijderd";
    }

    // Check if a habit log already exists for a specific date
    public function findHabit($habit_id, $habit_date)
    {
        $sql = "SELECT log_date FROM habit_logs 
        WHERE habit_id = ? AND log_date = ?";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$habit_id, $habit_date]);

        // Return the habit log if it exists, otherwise return false
        return $stmt->fetch();
    }

    // Toggle a habit between completed and not completed
    public function habitCompleted($habit_id, $habit_date)
    {
        // Check if a log already exists
        $log = $this->findHabit($habit_id, $habit_date);

        // If the habit is not completed yet, create a new habit log
        if ($log === false) {
            $sql = "INSERT INTO habit_logs (habit_id, log_date) VALUES (?, ?)";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([$habit_id, $habit_date]);

            $_SESSION['notificationMessage'][] = "Habit is gelogd";

        // If the habit is already completed, remove the habit log
        } else {
            $sql = "DELETE FROM habit_logs WHERE habit_id = ? AND log_date = ?";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([$habit_id, $habit_date]);

            $_SESSION['notificationMessage'][] = "Habitlog is verwijderd";
        }
    }

    // Check if a habit is completed and return the correct CSS class
    public function checkHabitCompleted($habit_id, $habit_date)
    {
        // Search for an existing habit log
        $completedHabit = $this->findHabit($habit_id, $habit_date);

        // Return the default class if the habit is not completed
        if ($completedHabit === false) {
            return $class = "dayCircle";

        // Return the completed class if the habit is completed
        } else {
            return $class = "dayCircle done";
        }
    }

    public function getCompletedHabitCount($userid) {
        // Returns the number of rows - from habit logs and use habits to get habits.id where habits.user_id = ?
        $sql = "SELECT COUNT(*)
        FROM habit_logs
        JOIN habits ON habit_logs.habit_id = habits.id
        WHERE habits.user_id = ?;";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$userid]);
        //Gebruik fetchColumn want geeft maar een waade terug en anders heb je een arraymmet fetch
        return $stmt->fetchColumn();
    }
}

?>