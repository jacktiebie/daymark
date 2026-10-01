<?php

Class Goals
{
    private PDO $pdo;

    // Store the PDO connection inside this class
    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function createGoal($title, $description, $target, $current, $unit, $due_date, $status) {
    $title = trim($title);
    $description = trim($description);

    }

}