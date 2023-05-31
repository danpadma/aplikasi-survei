<?php 

require "functions.php";

$surveyId = $_GET["id"];

$survey = query("SELECT * FROM surveys WHERE id = $surveyId")[0];

$questions = query("SELECT * FROM questions WHERE survey_id = $surveyId");

$answersCount = 0;
$optionsCount = 0;
$optionsCountId = 0;

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

    header("Location: arigatou.php?username=$username");
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>Isi Survei - <?= $survey["title"]; ?></title>
</head>
<body>
    <!-- header -->
    <div class="header">
        <a class="header-judul">Isi Survei</a>
    </div>

    <!-- form survei -->
    <form action="" method="post">
        <div class="kontainer-title">
            <a class="teks-judulfill"><?= $survey["title"]; ?></a> <br>
            <a class="teks-deskfill"><?= $survey["description"]; ?></a>
        </div>



        <div class="kontainer-masukkannama">
            <a class="teks-nama">Masukkan nama Anda</a> <br>
            <input type="text" name="username" class="input-nama" placeholder="Nama ..." required>
        </div>
        
            <?php foreach ($questions as $row): ?>
                <div class="kontainer-surveijawab">
                <a class="teks-nama"><?= $row["question"]; ?></a> <br>
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
                        <input type="text" name="answer<?= $answersCount; ?>" class="input-nama" placeholder="Jawaban ...">
                        </div>
                <?php 
                    }
                    // jawabannya pilihan
                    else if (count($optionAnswers) != 0) {
                        foreach ($optionAnswers as $x) {
                ?>
                            <input type="radio" name="option<?= $optionsCount; ?>" id ="option<?= $optionsCountId; ?>" class="answer-choice-button" value="<?= $x["option"]; ?>"> 
                            <label for="option<?= $optionsCountId; ?>" class="teks-pilihan"><?= $x["option"]; ?></label>
                            <br>
                <?php
                            $optionsCountId++;
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