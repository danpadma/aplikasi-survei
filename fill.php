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
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>Isi Survei <?= $survey["title"]; ?></title>
</head>
<body>
    <!-- header -->
        <div class="header">
          <div class="navigation">
            <a class="btn-tab" id="another-tab" href="manage.php">Manage</a>
            <a class="btn-tab" id="current-tab" href="fill.php">Fill</a>
            <a class="btn-tab" id="another-tab" href="response.php">Result</a>
          </div>
        </div>

    <!-- form survei -->
    <form action="" method="post">
        <div class="kontainer-nama">
            <p id="username-desc">Masukkan nama anda</p>
           <input type="text" name="username" class="answer-text" id="username" placeholder="Nama ..." required>
        </div>
        
        <div class="kontainer-title">
            <p id="title-fill"><?= $survey["title"]; ?></p>
            <p id="desc-fill"><?= $survey["description"]; ?></p>
        </div>
        
        <div class="kontainer-survei">
            <?php foreach ($questions as $row): ?>
                <p><?= $row["question"]; ?></p>
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
        </div>
        
        <div class="kontainer-send">
            <input type="submit" class="btn-basic" name="submit" value="Submit">
        </div>
    </form>
</body>
</html>