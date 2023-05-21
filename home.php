<?php 

require "functions.php";

$surveys = query("SELECT * FROM surveys");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <a href="manage.php">Create</a>
    <h1>Survey yang udah kamu bikin</h1>
    <?php foreach ($surveys as $row): ?>
        <a href="response.php?id=<?= $row["id"]; ?>"><?= $row["title"]; ?></a>
        <p>Link ngisi: <a href="fill.php?id=<?= $row["id"]; ?>">http://localhost/aplikasi-survei/fill.php?id=<?= $row["id"]; ?></a></p>
    <?php endforeach; ?>
</body>
</html>