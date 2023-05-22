<?php 

require "functions.php";

$surveyId = $_GET["id"];

$survey = query("SELECT * FROM surveys WHERE id = $surveyId")[0];

$questions = query("SELECT * FROM questions WHERE survey_id = $surveyId");

$answersCount = 0;
$optionsCount = 0;

if (isset($_POST["submit"])) {
    $username = $_POST["username"];
    // tambah responses
    mysqli_query($conn, "INSERT INTO responses (survey_id, username) VALUES ('$surveyId', '$username')");
    $responseId = mysqli_insert_id($conn);

    // tambahin tiap jawaban ke answers
    foreach ($_POST as $key => $value) {
        if (! str_contains($key, "username") && ! str_contains($key, "submit")) {
            mysqli_query($conn, "INSERT INTO answers (response_id, answer) VALUES ('$responseId', '$value')");
        }    
    }
}

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
    <!-- form survei -->
    <form action="" method="post">
        <input type="text" name="username" id="username" placeholder="Username" required>
        <h1><?= $survey["title"]; ?></h1>
        <h3><?= $survey["description"]; ?></h3>
        <?php foreach ($questions as $row): ?>
            <p><?= $row["question"]; ?></p>
            <?php 
                $answersCount++;
                $optionsCount++;
                $questionId = $row["id"]; 
                $shortAnswers = query("SELECT * FROM answer_short WHERE question_id = $questionId");
                $optionAnswers = query("SELECT * FROM answer_options WHERE question_id = $questionId");
                // jawabannya isian
                if (count($shortAnswers) != 0) { 
            ?>
                    <input type="text" name="answer<?= $answersCount; ?>" placeholder="Your answer">
            <?php 
                }
                // jawabannya pilihan
                else if (count($optionAnswers) != 0) {
                    foreach ($optionAnswers as $x) {
            ?>
                        <input type="radio" name="option<?= $optionsCount; ?>" value="<?= $x["option"]; ?>"><?= $x["option"]; ?>
                        <br>
            <?php
                    }
                }
            ?>
        <?php endforeach; ?>
      <input type="submit" name="submit" value="submit">
    </form>
</body>
</html>