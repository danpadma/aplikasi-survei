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
        <h1>Nama Survei</h1>
        <p>Deskripsi survei</p>
        <div class="kontainer-survei">
            <!-- pertanyaan2 -->
            <div class="questions">
                <div class="question-box">
                    <div class="question">
                        <p>Apa pendapatmu tentang konser Coldplay?</p>
                    </div>
                    <div class="answer">
                        <input type="text" name="answer1" placeholder="Your answer">
                    </div>
                </div>
            </div>
        </div>
      <input type="submit" name="submit" value="submit">
    </form>
</body>
</html>