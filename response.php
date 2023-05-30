<?php 

require "functions.php";

$surveyId = $_GET["id"];

$survey = query("SELECT * FROM surveys WHERE id = $surveyId")[0];

$responses = query("SELECT * FROM responses WHERE survey_id = $surveyId");

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>Response - <?= $survey["title"]; ?></title>
</head>
<body>
    <div class="header">
        <div class="navigation">
            <a class="btn-tab" id="another-tab" href="manage.php">Manage</a>
            <a class="btn-tab" id="another-tab" href="fill.php">Fill</a>
            <a class="btn-tab" id="current-tab" href="response.php">Result</a>
        </div>
    </div>

    <div class="kontainer-title">
        <a><?= $survey["title"]; ?></a> <br>
        <a><?= count($responses); ?> Responden</a>
    </div>

    <div class="kontainer-title">
        <?php foreach ($responses as $row): ?>
            <a href="detail.php?id=<?= $row["id"]; ?>&sid=<?= $surveyId; ?>"><?= $row["username"]; ?></a> <br>
        <?php endforeach; ?> <br>
    </div>

    <div class="kontainer-send">
        <a href="home.php">Kembali</a>
    </div>
</body>
</html>