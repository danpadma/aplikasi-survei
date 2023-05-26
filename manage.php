<?php 

require "functions.php";

$imageNo = 1;

if (isset($_POST["submit"])) {
  // tambah survey
  if (tambahSurvey($_POST) > 0) {
    echo "<script>alert('data berhasil ditambahkan');document.location.href = 'home.php';</script>";
    // dapetin last id yg dimasukin di surveys
    $surveyId = mysqli_insert_id($conn);

    // tambah tiap pertanyaan
    foreach ($_POST as $key => $value) {
      if (str_contains($key, "question")) {
        // tambah pertanyaan + gambar
        $image = upload("gambar$imageNo");
        mysqli_query($conn, "INSERT INTO questions (survey_id, question, image) VALUES ('$surveyId', '$value', '$image')");
        // dapetin last id yg dimasukin di questions
        $questionId = mysqli_insert_id($conn);

        $imageNo++;
      }
      // tambah tiap jawaban
      // kalo tipe jawabannya short
      else if (str_contains($key, "answer")) {
        mysqli_query($conn, "INSERT INTO answer_short (question_id, hint) VALUES ('$questionId', '$value')");
      }
      // kalo tipe jawabannya option
      else if (str_contains($key, "option")) {
        mysqli_query($conn, "INSERT INTO answer_options (question_id, option) VALUES ('$questionId', '$value')");
      }
    }
  } 
  else {
    echo "<script>alert('data gagal ditambahkan');document.location.href = 'home.php';</script>";
  }
}

?>
<!DOCTYPE html>
<html>

<head>
    <title>Manage</title>
    <link rel="stylesheet" type="text/css" href="style.css">

    <style>

    </style>
    <script src="https://kit.fontawesome.com/3dc4dca5ea.js" crossorigin="anonymous"></script>
</head>

<body>
    <!-- change tab -->
    <div class="header">
      <div class="navigation">
        <a class="btnTab" id="current-tab" href="manage.php">Manage</a>
        <a class="btnTab" href="fill.php">Fill</a>
        <a class="btnTab" href="response.php">Result</a>
      </div>
    </div>
    

    <!-- form survei -->
    <form action="" method="post" enctype="multipart/form-data">

    <!-- bagian title dan desc -->
    <div class="kontainer-title">
      <input type="text" name="title" id="title" placeholder="Judul survei" required> <br>
      <input type="text" name="desc" id="desc" placeholder="Deskripsi (opsional)">
    </div>

    <div class="kontainer-survei">
        <!-- pertanyaan2 -->
        <div class="questions">
          <div class="question-box">

            <div class="question">
              <input type="text" name="question1" id="question" placeholder="Pertanyaan ...">
              <input type="file" name="gambar1" id="gambar1" hidden>
              <label for="gambar1"><i class="fa-regular fa-image"></i></label>
            </div>

            <div class="answerShort">
              <input type="text" name="answer1" id="answerShort" value="Jawaban singkat" readonly>
            </div>

            <div class="answerChoice">
              <div>
                <input type="radio" id="answerChoiceButton" disabled>
                <input type="text" id="answerChoice" placeholder="option">
              </div>
              <a class="add-option" id="addOption">Tambah pilihan</a>
            </div>

            <div class="utility">
              <select class="select">
                <option class="choice" value="Jawaban Singkat">Jawaban Singkat</option>
                <option class="choice" value="Pilihan Ganda">Pilihan Ganda</option>
              </select>
              <button type="button" class="up-btn">^</button>
              <button type="button" class="down-btn">v</button>
              <button type="button" class="hapus-btn">x</button>
              <button type="button" class="tambah-btn">+</button>
            </div>

          </div>
        </div>
      </div>
      <div class="kontainer-send">
        <input type="submit" name="submit" id="submitsurvei-btn" value="Kirim">
      </div>
    </form>
    <script src="script.js"></script>
</body>

</html>