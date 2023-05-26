<?php 

$conn = mysqli_connect("localhost", "root", "", "survei_db");

function tambahSurvey($data) {
    global $conn;
    $title = $data["title"];
    if (isset($data)) {
        $desc = $data["desc"];
    }
    $userId = 1;

    $query = "INSERT INTO surveys(user_id, title, description) VALUES ('$userId', '$title', '$desc')";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function query($query) {
    global $conn;
    $result = mysqli_query($conn, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}

function upload($name) {
    $namaFile = $_FILES[$name]["name"];
    $ukuranFile = $_FILES[$name]["size"];
    $tmpName = $_FILES[$name]["tmp_name"];

    $ekstensiGambarValid = ["jpg", "jpeg", "png"];
    $ekstensiGambar = explode(".", $namaFile);
    $ekstensiGambar = strtolower(end($ekstensiGambar));

    // if (!in_array($ekstensiGambar, $ekstensiGambarValid)) {
    //     echo "<script>alert('Yang anda upload bukan gambar.');</script>";
    //     return false;
    // }

    // if ($ukuranFile > 1000000) {
    //     echo "<script>alert('Ukuran file terlalu besar.');</script>";
    //     return false;
    // }

    $namaFileBaru = uniqid();
    $namaFileBaru .= ".";
    $namaFileBaru .= $ekstensiGambar;

    move_uploaded_file($tmpName, 'img/' . $namaFileBaru);

    return $namaFileBaru;
}

function getNumber($string) {
    $nums = ["1", "2", "3", "4", "5", "6", "7", "8", "9", "0"];
    $num = "";
    for ($i = 0; $i < strlen($string); $i++) {
        if (in_array($string[$i], $nums)) {
            $num .= $string[$i];
        }
    }
    return $num;
}

?>
