<?php 

require "functions.php";

$surveyId = $_GET["id"];

$survey = query("SELECT * FROM surveys WHERE id = $surveyId")[0];

$responses = query("SELECT * FROM responses WHERE survey_id = $surveyId");

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
    <h1>Responses</h1>
    <h1><?= $survey["title"]; ?></h1>
    <h2><?= count($responses); ?> Responden</h2>
    <?php foreach ($responses as $row): ?>
        <a href="detail.php?id=<?= $row["id"]; ?>&sid=<?= $surveyId; ?>"><?= $row["username"]; ?></a>
    <?php endforeach; ?>
    <a href="home.php">Kembali</a>
</body>
</html>