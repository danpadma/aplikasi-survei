<?php 
require "functions.php";

$surveys = query("SELECT * FROM surveys");

$i=1;
$shareModalBtnIndex = 1;
$deleteModalBtnIndex = 1;
$shareModalIndex = 1;
$deleteModalIndex = 1;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Home</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <script src="https://kit.fontawesome.com/3dc4dca5ea.js" crossorigin="anonymous"></script>
</head>
<body>
    <!-- header -->
    <div class="header">
        <a class="header-judul">Home</a>
    </div>

    <!-- back to home -->
    <div class="kontainer-home">
        <a href="manage.php" class="btn-basic">Buat survey baru</a>
    </div>

    <!-- teks home -->
    <div class="kontainer-teks">
        <a class="teks-surveidibuat">Survey yang sudah dibuat: </a>
    </div>

    <!-- list survei -->
    <div class="kontainer-daftarsurvei">
        <?php foreach ($surveys as $row): ?>
            <div class="kontainer-detailsurvei">
                <table>
                    <tr>
                        <td rowspan="2" class="td-nomorresponden">
                            <?php echo $i; $i = $i + 1 ?>
                        </td>
                        <td><a class="td-namasurvei"><?= $row["title"]; ?></a></td>
                        <td rowspan="2"><a href="response.php?id=<?= $row["id"]; ?>"><i class="btn-aksihome fa-solid fa-square-poll-vertical" title="Lihat hasil"></i></a></td>
                        <td rowspan="2"><i class="btn-aksihome fa-solid fa-share" id="shareModalBtn<?= $shareModalBtnIndex; ?>" title="Bagikan"></i></td>
                        <td rowspan="2"><i class="btn-aksihome fa-solid fa-trash-can" id="deleteModalBtn<?= $deleteModalBtnIndex; ?>" title="Hapus"></i></td> 
                    </tr>
                    <?php $rowid =  $row["id"]; ?>
                    <?php $responses = query("SELECT * FROM responses WHERE survey_id = $rowid"); ?>
                    <tr>
                        <td class="td-jumlahresponden">Jumlah responden: <?= count($responses); ?></td>
                    </tr>
                </table>
                <!-- share modal box -->
                <div id="shareModal<?= $shareModalIndex; ?>" class="modal">
                    <i class="btn fa-solid fa-xmark"></i> <br>
                    <a>Link isi survei</a> <br>
                    <div class="modal-content">
                        <div class="left-content">http://localhost/aplikasi-survei/fill.php?id=<?= $row["id"]; ?></div>
                        <div class="right-content">Salin</div>
                    </div>
                </div>  
                <!-- delete modal box -->
                <div id="deleteModal<?= $deleteModalIndex; ?>" class="modal">
                    <i class="btn fa-solid fa-xmark"></i> <br>
                    <a>Apa anda yakin ingin menghapus survei ini?</a>
                    <p>Survei <b><?= $row["title"]; ?></b></p>
                    <a href="deleteSurvey.php?id=<?= $row["id"]; ?>" class="btn-hapus">Hapus</a>
                </div>
            </div>
        <?php 
            $shareModalBtnIndex++;
            $deleteModalBtnIndex++;
            $shareModalIndex++;
            $deleteModalIndex++;
        
            endforeach; 
        ?>
    </div>
    <script>
        //
        const kontainerDaftarSurvei = document.getElementsByClassName("kontainer-daftarsurvei")[0];

        kontainerDaftarSurvei.addEventListener("click", function(e) {
            console.log(e.target.className)
            // tombol share link dipencet => tampilkan share modal box
            if (e.target.className == "btn-aksihome fa-solid fa-share") {
                let modalIndex = getNumber(e.target.id)
                let namaId = "shareModal" + modalIndex
                document.getElementById(namaId).style.display = "block"
            }
            // tombol close di modal box dipencet => modal box
            if (e.target.className == "btn fa-solid fa-xmark") {
                e.target.parentElement.style.display = "none"
            }
            // copy to clipboard
            if (e.target.className == "left-content" || e.target.className == "right-content") {
                let salin = ""
                if (e.target.className == "left-content") {
                    navigator.clipboard.writeText(e.target.innerHTML)
                    salin = e.target.nextElementSibling
                } else if (e.target.className == "right-content") {
                    navigator.clipboard.writeText(e.target.previousElementSibling.innerHTML)
                    salin = e.target
                }
                // ubah jadi check mark
                salin.innerHTML = "Disalin"
                salin.style = "color: #4ab036;"
                // tuggu 2 detik ubah lagi
                setTimeout(function() {
                    salin.innerHTML = "Salin"
                    salin.style = "color: #000"
                }, 2000)
            }
            // tombol delete dipencet => tampilkan delete modal box
            if (e.target.className == "btn-aksihome fa-solid fa-trash-can") {
                let modalIndex = getNumber(e.target.id)
                let namaId = "deleteModal" + modalIndex
                document.getElementById(namaId).style.display = "block"
            }
        })

        function getNumber(text) {
            let nums = ["1", "2", "3", "4", "5", "6", "7", "8", "9", "0"]
            let num = ""
            for (let i = 0; i < text.length; i++) {
                if (nums.includes(text[i])) {
                    num += text[i]
                }
            }
            return num
        }
    </script>
</body>
</html>