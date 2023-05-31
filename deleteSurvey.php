<?php 

require "functions.php";

$surveyId = $_GET["id"];

mysqli_query($conn, "DELETE FROM surveys WHERE id = $surveyId");

if (mysqli_affected_rows($conn) > 0) {
    echo "
        <script>
            alert('Survei berhasil dihapus');
            document.location.href = 'home.php'; 
        </script> 
    ";
} else {
    echo "
        <script>
            alert('Survei gagal dihapus');
            document.location.href = 'home.php'; 
        </script> 
    ";
}

?>