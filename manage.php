<?php 

require "functions.php";

if (isset($_POST["submit"])) {
  // tambah survey
  if (tambahSurvey($_POST) > 0) {
    echo "<script>alert('data berhasil ditambahkan');document.location.href = 'home.php';</script>";
    // var_dump($_FILES);
    // dapetin last id yg dimasukin di surveys
    $surveyId = mysqli_insert_id($conn);

    // tambah tiap pertanyaan
    foreach ($_POST as $key => $value) {
      if (str_contains($key, "question")) {
        // tambah pertanyaan + gambar
        $no = getNumber($key);
        $image = upload("gambar$no"); // !!! pertanyaan ke berapa == gambar ke berapa
        mysqli_query($conn, "INSERT INTO questions (survey_id, question, image) VALUES ('$surveyId', '$value', '$image')");
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
    <script src="https://kit.fontawesome.com/3dc4dca5ea.js" crossorigin="anonymous"></script>
</head>

<body>
    <!-- change tab -->
    <div class="header">
      <div class="navigation">
        <a class="btn-tab" id="current-tab" href="manage.php">Manage</a>
        <a class="btn-tab" id="another-tab" href="fill.php">Fill</a>
        <a class="btn-tab" id="another-tab" href="response.php">Result</a>
      </div>
    </div>
    

    <!-- form survei -->
    <form action="" method="post" enctype="multipart/form-data">

    <!-- bagian title dan desc -->
    <div class="kontainer-title">
      <input type="text" name="title" id="title" placeholder="Judul Survei" required> <br>
      <input type="text" name="desc" id="desc" placeholder="Deskripsi (opsional)">
    </div>

    <!-- pertanyaan2 -->
    <div class="questions">
      <div class="kontainer-survei">
        <div class="question-div">
          <input type="text" name="question1" class="question" placeholder="Pertanyaan ...">
          <input type="file" name="gambar1" id="gambar1" hidden>
          <label for="gambar1"><i class="fa-regular fa-image"></i></label>
          <div></div> <!-- buat nampung gambar -->
        </div>
        <div class="answer-div">
          <input type="text" name="answer1" id="answer-text" value="Jawaban singkat" readonly>
        </div>
        <div class="utility">
          <select class="select">
            <option class="choice" value="Jawaban Singkat">Jawaban Singkat</option>
            <option class="choice" value="Pilihan Ganda">Pilihan Ganda</option>
          </select>
            <button type="button" class="up-btn"><i class="fa-solid fa-arrow-up"></i></button>
            <button type="button" class="down-btn"><i class="fa-solid fa-arrow-down"></i></button>
            <button type="button" class="hapus-btn"><i class="fa-solid fa-trash-can"></i></button>
            <button type="button" class="tambah-btn"><i class="fa-solid fa-plus"></i></i></button>
        </div>
      </div>
    </div>
      <div class="kontainer-send">
        <input type="submit" name="submit" class="btn-basic" value="Kirim">
      </div>
    </form>
    <script src="script.js"></script>
</body>

</html>