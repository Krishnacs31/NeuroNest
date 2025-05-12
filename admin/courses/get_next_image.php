<?php
include("../connection.php");

// Fetch a new random image
$sel = "SELECT * FROM image_recognition ORDER BY RAND() LIMIT 1";
$res = mysqli_query($con, $sel);

if ($row = mysqli_fetch_assoc($res)) {
    echo json_encode([
        "image" => $row['image'],
        "answer" => strtolower($row['answer'])
    ]);
} else {
    echo json_encode(["error" => "No images found"]);
}
?>
