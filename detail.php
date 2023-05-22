<?php 

require "functions.php";

$responseId = $_GET["id"];
$surveyId = $_GET["sid"];

$survey = query("SELECT * FROM surveys WHERE id = $surveyId")[0];

$responden = query("SELECT * FROM responses WHERE id = $responseId")[0];

$questions = query(("SELECT * FROM questions WHERE survey_id = $surveyId"));

$responsesAndAnswers = query("SELECT * FROM responses JOIN answers ON answers.response_id = responses.id WHERE responses.id = $responseId");

$jawabanNo = 0;

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
    <h1>Username: <?= $responden["username"]; ?></h1>
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
        ?>
               <p style="background-color: greenyellow;"><?= $responsesAndAnswers[$jawabanNo]["answer"]; ?></p> 
        <?php 
            }
            // jawabannya pilihan
            else if (count($optionAnswers) != 0) {
                foreach ($optionAnswers as $x) {
                    // opsi yang dipilih
                    if ($x["option"] == $responsesAndAnswers[$jawabanNo]["answer"]) {

        ?>
                        <span style="background-color: greenyellow;"><input type="radio" name="option" value="<?= $x["option"]; ?>" disabled><?= $x["option"]; ?></span>
        <?php
                    } else {
        ?>
                        <input type="radio" name="option" value="<?= $x["option"]; ?>" disabled><?= $x["option"]; ?>
        <?php
                    }
        ?>
                    <br>
        <?php
                }
            }
            $jawabanNo++;
        ?>
    <?php endforeach; ?>
    <a href="response.php?id=<?= $surveyId; ?>">Kembali</a>
</body>
</html>