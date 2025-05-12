<?php
include("../connection.php");
session_start();

$user_id = $_SESSION['uid'];

// Fetch last 5 emotions
$query = "SELECT emotion FROM emotions ORDER BY timestamp DESC LIMIT 5";
$result = mysqli_query($con, $query);

$negative_emotions = ['sad', 'fear', 'angry'];
$negative_count = 0;

while ($row = mysqli_fetch_assoc($result)) {
    if (in_array($row['emotion'], $negative_emotions)) {
        $negative_count++;
    }
}

// If 3 or more negative emotions are detected, return "redirect"
if ($negative_count >= 3) {
    echo json_encode(["redirect" => true]);
} else {
    echo json_encode(["redirect" => false]);
}
?>