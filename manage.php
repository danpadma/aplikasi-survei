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
              <input type="text" name="answer1" placeholder="Your answer" readonly>
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