<?php
Class dailyCheckin
{
    private PDO $pdo;

    // Store the PDO connection inside this class
    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

public function calculateAverageDay($mood, $energy, $productivity, $sleep) {
$total = $mood + $energy + $productivity + $sleep;
$overall_day = $total / 4;
return $overall_day;
}

public function createDailyCheckin(int $mood, int $energy, int $productivity, int $sleep, string $note, int $userid) {
   $note = trim($note);
   $overall_day = $this->calculateAverageDay($mood, $energy, $productivity, $sleep);
   $sql = "INSERT INTO daily_checkins (user_id, mood, energy, productivity, sleep, overall_day, note) VALUES (?, ?, ?, ?, ?, ?, ?)";
   $stmt = $this->pdo->prepare($sql);
   $stmt->execute([$userid, $mood, $energy, $productivity, $sleep, $overall_day, $note]);
}


public function getDailyCheckin($userid) {
    $sql = "SELECT id, mood, energy, productivity, sleep, overall_day, note, created_at
            FROM daily_checkins
            WHERE user_id = ?
            ORDER BY created_at DESC";
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute([$userid]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

public function getDailyCheckinAverages($userid) {
    $dailyCheckinResults = $this->getDailyCheckin($userid);

    $totalMood = 0;
    $totalEnergy = 0;
    $totalProductivity = 0;
    $totalSleep = 0;
    $totalOverallDay = 0;

    $count = count($dailyCheckinResults);

    if ($count === 0) {
        return null;
    }

    foreach ($dailyCheckinResults as $checkin) {
        $totalMood += $checkin['mood'];
        $totalEnergy += $checkin['energy'];
        $totalProductivity += $checkin['productivity'];
        $totalSleep += $checkin['sleep'];
        $totalOverallDay += $checkin['overall_day'];
    }

    return [
        'mood' => round($totalMood / $count, 1),
        'energy' => round($totalEnergy / $count, 1),
        'productivity' => round($totalProductivity / $count, 1),
        'sleep' => round($totalSleep / $count, 1),
        'overall_day' => round($totalOverallDay / $count, 1)
    ];
}
}
?>