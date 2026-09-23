<?php
require_once '../app/bootstrap.php';
$userid = $_SESSION["user_id"];
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

</body>
</html>