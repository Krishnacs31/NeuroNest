<?php
include("../connection.php");
include("table.php");

$id = $_REQUEST['id']; // Fixed missing quotes
$result = mysqli_query($con, "SHOW FIELDS FROM $table");

$i = 0;
$post_values = [];
$field_name = [];
$data_type = [];

while ($row = mysqli_fetch_array($result)) {
    $name = $row['Field'];
    $post_values[] = isset($_POST[$name]) ? mysqli_real_escape_string($con, $_POST[$name]) : '';

    $field_name[] = $name;
    $data_type[] = $row['Type'];
    $i++;
}

$datas = "";
for ($k = 1; $k < $i; $k++) {
    $type = explode("(", $data_type[$k]);
    $type_only = $type[0];

    if ($type_only == 'tinytext' && isset($_FILES[$field_name[$k]])) {
        $date = date("Y-m-d-h-i-s");
        $filename = $date . basename($_FILES[$field_name[$k]]['name']);
        $target_path = "../uploads/" . $filename; // Make sure the `uploads/` directory is writable
        
        if (move_uploaded_file($_FILES[$field_name[$k]]['tmp_name'], $target_path)) {
            $datas .= ($datas ? "," : "") . "$field_name[$k]='$filename'";
        } else {
            $result2 = mysqli_query($con, "SELECT * FROM $table WHERE id=$id") or die("Error: " . mysqli_error($con));
            $row2 = mysqli_fetch_array($result2);
            $datas .= ($datas ? "," : "") . "$field_name[$k]='" . $row2[$field_name[$k]] . "'";
        }
    } else {
        $datas .= ($datas ? "," : "") . "$field_name[$k]='" . $post_values[$k] . "'";
    }
}

$query = "UPDATE $table SET $datas WHERE id='$id'";
mysqli_query($con, $query) or die("Error: " . mysqli_error($con));

header("Location: update.php?id=$id");
exit;
?>
