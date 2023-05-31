<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
    <script src="https://kit.fontawesome.com/3dc4dca5ea.js" crossorigin="anonymous"></script>
</head>
<style>
    body {
        margin: 0;
    }

    .full-height {
        height: 100vh;
    }

    .center-content {
        display: flex;
        justify-content: center;
        align-items: center;
    }
</style>
<body>
    <div class="full-height center-content">
        <h1>Terima kasih, <?= $_GET["username"]; ?>! <i class="fa-solid fa-face-laugh-wink fa-xl"></i></h1>
    </div>
</body>
</html>