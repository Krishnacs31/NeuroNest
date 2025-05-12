<?php
session_start();
include("../connection.php");

// Increment the count of completed images
if (!isset($_SESSION['completed_images'])) {
    $_SESSION['completed_images'] = 0;
} else {
    $_SESSION['completed_images']++;
}

$totalImages = 5; // Change this based on database
if ($_SESSION['completed_images'] >= $totalImages) {
    echo json_encode(['redirect' => true]);
    exit;
}

// Fetch a new random image
$sel = "SELECT * FROM image_recognition ORDER BY RAND() LIMIT 1";
$res = mysqli_query($con, $sel);
$row = mysqli_fetch_assoc($res);

echo json_encode([
    'image' => "../image_recognition/uploads/" . $row['image'],
    'word' => strtolower($row['word'])
]);
?>

