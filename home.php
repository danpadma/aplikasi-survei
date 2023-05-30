<?php 
require "functions.php";
$surveys = query("SELECT * FROM surveys");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Home</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <div class="header">
        <a href="manage.php">Create</a>
    </div>

    <h1>Survey yang udah kamu bikin</h1>

    <?php foreach ($surveys as $row): ?>
        <div class="kontainer-title">
            <a href="response.php?id=<?= $row["id"]; ?>"><?= $row["title"]; ?></a>
            <p>Link ngisi: <a href="fill.php?id=<?= $row["id"]; ?>">http://localhost/aplikasi-survei/fill.php?id=<?= $row["id"]; ?></a></p>
        </div>
    <?php endforeach; ?>
</body>
</html>