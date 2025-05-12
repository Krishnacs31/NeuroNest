<?php
session_start();
include("../connection.php");

if (!isset($_SESSION['uid'])) {
    echo "User not logged in";
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_SESSION['uid']; // Get user ID from session
    $score = $_POST["score"];
    $attempt_date = date("Y-m-d H:i:s");

    $query = "INSERT INTO social_score (user_id, score, attempt_date) VALUES ('$user_id', '$score', '$attempt_date')";
    if (mysqli_query($con, $query)) {
        echo "Score saved successfully";
    } else {
        echo "Error: " . mysqli_error($con);
    }
}
?>