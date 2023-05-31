<?php 
require "functions.php";

$surveys = query("SELECT * FROM surveys");

$i=1
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Home</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <div class="header">
        <a class="header-judul">Home</a>
    </div>

    <div class="kontainer-home">
        <a href="manage.php" class="btn-basic">Buat survey baru</a>
    </div>

    <div class="kontainer-teks">
        <a id="nama">Survey yang sudah dibuat: </a>
    </div>

    <?php foreach ($surveys as $row): ?>
        <div class="kontainer-detailsurvei">
            <table>
                <tr>
                    <td rowspan="2" class="td-nomorresponden">
                        <?php echo $i; $i = $i + 1 ?>
                    </td>
                    <td><a href="response.php?id=<?= $row["id"]; ?>" class="td-namasurvei"><?= $row["title"]; ?></a></td>
                    <td rowspan="2">tombol link ngisi - </td>
                    <td rowspan="2">tombol hapus</td> 
                </tr>
                <?php $rowid =  $row["id"]; ?>
                <?php $responses = query("SELECT * FROM responses WHERE survey_id = $rowid"); ?>
                <tr>
                    <td class="td-jumlahresponden">Jumlah responden: <?= count($responses); ?></td>
                </tr>
            </table>
            <!-- <p>Link ngisi: <a href="fill.php?id=<?= $row["id"]; ?>">http://localhost/aplikasi-survei/fill.php?id=<?= $row["id"]; ?></a></p> -->
        </div>
    <?php endforeach; ?>
</body>
</html>