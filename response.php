<?php 

require "functions.php";

$surveyId = $_GET["id"];

$survey = query("SELECT * FROM surveys WHERE id = $surveyId")[0];

$questions = query(("SELECT * FROM questions WHERE survey_id = $surveyId"));

$responses = query("SELECT * FROM responses WHERE survey_id = $surveyId");

$responsesAndAnswers = query("SELECT * FROM responses JOIN answers ON answers.response_id = responses.id");

var_dump($responsesAndAnswers);

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
    <h2><?= count($responses); ?> Responden</h2>
    <h1><?= $survey["title"]; ?></h1>
    <h3><?= $survey["description"]; ?></h3>
    <?php foreach ($questions as $row): ?>
        <p><?= $row["question"]; ?></p>
        <?php 
            $questionId = $row["id"]; 
            $shortAnswers = query("SELECT * FROM answer_short WHERE question_id = $questionId");
            $optionAnswers = query("SELECT * FROM answer_options WHERE question_id = $questionId");
            // jawabannya isian
            if (count($shortAnswers) != 0) { 
                foreach ($responsesAndAnswers as $n) {

        ?>
        <?php 
                }
            }
            // jawabannya pilihan
            else if (count($optionAnswers) != 0) {
                foreach ($optionAnswers as $x) {
        ?>
                    <input type="radio" name="option" value="<?= $x["option"]; ?>"><?= $x["option"]; ?>
                    <br>
        <?php
                }
            }
        ?>
    <?php endforeach; ?>
</body>
</html>