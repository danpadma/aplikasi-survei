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

?>