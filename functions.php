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

function tambahPertanyaan($q, $id) {
    global $conn;
    $surveyId = $id;
    $question = $q;
    $query = "INSERT INTO questions (survey_id, question) VALUES ('$surveyId', '$question')";
    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
}

?>