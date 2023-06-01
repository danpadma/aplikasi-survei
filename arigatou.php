<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>Terima kasih</title>
    <link rel="stylesheet" href="style.css">
    <script src="https://kit.fontawesome.com/3dc4dca5ea.js" crossorigin="anonymous"></script>
</head>
<body>
    <!-- header -->
    <div class="header">
        <a class="header-judul">Isi Survei</a>
    </div>
    
    <!-- terima kasih -->
    <div class="teks-terimakasih">
        <h1>Terima kasih sudah mengisi <?= $_GET["username"]; ?>! <i class="fa-solid fa-face-laugh-wink fa-xl"></i></h1>
    </div>
</body>
</html>