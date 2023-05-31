<?php 

require "functions.php";

$surveyId = $_GET["id"];

$survey = query("SELECT * FROM surveys WHERE id = $surveyId")[0];

$responses = query("SELECT * FROM responses WHERE survey_id = $surveyId");

$i = 1;

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>Response - <?= $survey["title"]; ?></title>
</head>
<body>

    <!-- header -->    
    <div class="header">
        <a class="header-judul">Hasil Survei</a>
    </div>

    <!-- back to home -->
    <div class="kontainer-home">
        <a href="home.php" class="btn-basic">Kembali ke Home</a>
    </div>

    <!-- nama survei & jumlah responden -->
    <div class="kontainer-namasurveiresponden">
        <a class="teks-nama"><?= $survey["title"]; ?></a> <br>
        <a><?= count($responses); ?> Responden</a>
    </div>

    <!-- pengisi survei -->
    <div class="kontainer-listresponden">
        <table>
            <tr>
                <th class="td-nomor">No</td>
                <th class="td-nama">Nama</td>
                <th>Aksi</td>
            </tr>
            <?php foreach ($responses as $row): ?>
                <tr>
                    <td class="tdnomor"><?php echo $i; $i = $i + 1 ?></td>
                    <td><a><?= $row["username"]; ?></a></td>
                    <td><a href="detail.php?id=<?= $row["id"]; ?>&sid=<?= $surveyId; ?>">Lihat detail</a></td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>

</body>
</html>