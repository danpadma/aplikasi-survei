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
    <title>Home</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <script src="https://kit.fontawesome.com/3dc4dca5ea.js" crossorigin="anonymous"></script>
</head>
<body>
    <div class="header">
        <a class="header-judul">Home</a>
    </div>

    <div class="kontainer-home">
        <a href="manage.php" class="btn-basic">Buat survey baru</a>
    </div>

    <div class="kontainer-teks">
        <a class="teks-surveidibuat">Survey yang sudah dibuat: </a>
    </div>

    <div class="kontainer-daftarsurvei">
        <?php foreach ($surveys as $row): ?>
            <div class="kontainer-detailsurvei">
                <table>
                    <tr>
                        <td rowspan="2" class="td-nomorresponden">
                            <?php echo $i; $i = $i + 1 ?>
                        </td>
                        <td><a href="response.php?id=<?= $row["id"]; ?>" class="td-namasurvei"><?= $row["title"]; ?></a></td>
                        <td rowspan="2"><i class="btn fa-solid fa-share" id="shareModalBtn<?= $shareModalBtnIndex; ?>"></i></td>
                        <td rowspan="2"><i class="btn-danger fa-regular fa-trash-can" id="deleteModalBtn<?= $deleteModalBtnIndex; ?>"></i></td> 
                    </tr>
                    <?php $rowid =  $row["id"]; ?>
                    <?php $responses = query("SELECT * FROM responses WHERE survey_id = $rowid"); ?>
                    <tr>
                        <td class="td-jumlahresponden">Jumlah responden: <?= count($responses); ?></td>
                    </tr>
                </table>
                <!-- share modal box -->
                <div id="shareModal<?= $shareModalIndex; ?>" class="modal">
                    <i class="btn fa-solid fa-xmark"></i>
                    <p>Link isi survey</p>
                    <div class="modal-content">
                        <p>http://localhost/aplikasi-survei/fill.php?id=<?= $row["id"]; ?></p>
                        <i class="btn fa-regular fa-copy"></i>
                    </div>
                </div>
                <!-- delete modal box -->
                <div id="deleteModal<?= $deleteModalIndex; ?>" class="modal">
                    <i class="btn fa-solid fa-xmark"></i>
                    <p>Yakin dihapus bre?</p>
                    <p>Survei <span style="font-weight:bold"><?= $row["title"]; ?></span></p>
                    <a href="deleteSurvey.php?id=<?= $row["id"]; ?>" class="btn">Hapus</a>
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
            if (e.target.className == "btn fa-solid fa-share") {
                let modalIndex = getNumber(e.target.id)
                let namaId = "shareModal" + modalIndex
                document.getElementById(namaId).style.display = "block"
            }
            // tombol close di modal box dipencet => modal box
            if (e.target.className == "btn fa-solid fa-xmark") {
                e.target.parentElement.style.display = "none"
            }
            // copy to clipboard
            if (e.target.className == "btn fa-regular fa-copy") {
                let copyText = e.target.previousElementSibling
                navigator.clipboard.writeText(copyText.innerHTML)
                // ubah jadi check mark
                e.target.className = "btn fa-solid fa-check"
                e.target.style = "color: #4ab036;"
                // tunggu 1.5 detik baru ubah lagi
                setTimeout(function() {
                    e.target.className = "btn fa-regular fa-copy"
                    e.target.style = "color: #000;"
                }, 1500)
            }
            // tombol delete dipencet => tampilkan delete modal box
            if (e.target.className == "btn-danger fa-regular fa-trash-can") {
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