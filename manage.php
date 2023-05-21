<?php 

require "functions.php";

if (isset($_POST["submit"])) {
  // tambah survey
  if (tambahSurvey($_POST) > 0) {
    echo "<script>alert('data berhasil ditambahkan')</script>";
  } else {
    echo "<script>alert('data gagal ditambahkan')</script>";
  }

  // dapetin last id yg dimasukin di surveys
  $surveyId = mysqli_insert_id($conn);

  // tambah tiap pertanyaan
  foreach ($_POST as $key => $value) {
    if (str_contains($key, "question")) {
      // tambah pertanyaan
      mysqli_query($conn, "INSERT INTO questions (survey_id, question) VALUES ('$surveyId', '$value')");
      // dapetin last id yg dimasukin di questions
      $questionId = mysqli_insert_id($conn);
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

?>
<!DOCTYPE html>
<html>

<head>
    <title>Manage</title>

    <style>
        h1 {
            text-align: center;
        }
    </style>
</head>

<body>
    <h1>Manage</h1>

    <!-- change tab -->
    <a class="btnTab" id="current-tab" href="manage.php">Manage</a>
    <a class="btnTab" href="form.php">Fill</a>
    <a class="btnTab" href="result.php">Result</a>

    <!-- form survei -->
    <form action="" method="post">
      <div class="kontainer-survei">
        <!-- bagian title dan desc -->
        <input type="text" name="title" id="heading" placeholder="Title" required> <br>
        <input type="text" name="desc" id="desc" placeholder="Description (optional)">
        <hr>
        <!-- pertanyaan2 -->
        <div class="questions">
          <div class="question-box">
            <div class="question">
              <input type="text" name="question1" placeholder="Question">
            </div>
            <div class="answer">
              <input type="text" name="answer1" placeholder="Your answer" value="short answer" readonly>
            </div>
            <div class="utility">
              <select class="select">
                <option class="choice" value="Jawaban Singkat">Jawaban Singkat</option>
                <option class="choice" value="Pilihan Ganda">Pilihan Ganda</option>
              </select>
              <button type="button" class="up-btn">^</button>
              <button type="button" class="down-btn">v</button>
              <button type="button" class="hapus-btn">hapus</button>
              <button type="button" class="tambah-btn">tambah</button>
            </div>
          </div>
        </div>
      </div>
      <input type="submit" name="submit" value="kirim">
    </form>
    <script src="script.js"></script>
</body>

</html>