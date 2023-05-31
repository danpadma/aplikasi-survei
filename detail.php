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
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>Detail Respon</title>
</head>
<body>
    <!-- header -->
    <div class="header">
        <a class="header-judul">Detail Respon</a>
    </div>

    <!-- back to home -->
    <div class="kontainer-home">
        <a href="response.php?id=<?= $surveyId; ?>" class="btn-basic">Kembali</a>
    </div>

    <!-- nama survey -->
    <div class="kontainer-title">
        <a class="teks-judulfill"><?= $survey["title"]; ?></a> <br>
        <a class="teks-deskfill"><?= $survey["description"]; ?></a>
    </div>

    <!-- nama responden -->
    <div class="kontainer-title">
        <a>Username: <?= $responden["username"]; ?></a>
    </div>

    <!-- list jawaban -->
    <?php foreach ($questions as $row): ?>
        <div class="kontainer-surveijawab">
            <a class="teks-pertanyaan"><?= $row["question"]; ?></a> <br>
            <?php 
                if ($row["image"] != "") {
            ?>
                    <div>
                        <img src="img/<?= $row["image"]; ?>" alt="" width="300">
                    </div>
            <?php
                }
            ?>
            <?php 
                $questionId = $row["id"]; 
                $shortAnswers = query("SELECT * FROM answer_short WHERE question_id = $questionId");
                $optionAnswers = query("SELECT * FROM answer_options WHERE question_id = $questionId");
                // jawabannya isian
                if (count($shortAnswers) != 0) { 
            ?>
                   <a class="teks-jawabanshort"><?= $responsesAndAnswers[$jawabanNo]["answer"]; ?></a> 
            <?php 
                }
                // jawabannya pilihan
                else if (count($optionAnswers) != 0) {
                    foreach ($optionAnswers as $x) {
                        // opsi yang dipilih
                        if ($x["option"] == $responsesAndAnswers[$jawabanNo]["answer"]) {

            ?>
                            <span><input type="radio" class="answer-choice-button" name="option" value="<?= $x["option"]; ?>" disabled checked><a class="teks-opsi"><?= $x["option"]; ?></a></span>
            <?php
                        } else {
            ?>
                            <input type="radio" class="answer-choice-button" name="option" value="<?= $x["option"]; ?>" disabled><a class="teks-opsi"><?= $x["option"]; ?></a>
            <?php
                        }
            ?>
                        <br>
            <?php
                    }
                }
                $jawabanNo++;
            ?>
        </div>
    <?php endforeach; ?>
</body>
</html>