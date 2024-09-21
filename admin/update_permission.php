<?php
include 'connection.php';

$type = $_POST['type'];
$id = $_POST['account_id'];
$permission = $_POST['permission'];

if ($type == 'user') {
    $query = "UPDATE user_details SET permission='$permission' WHERE account_id='$id'";
} else if ($type == 'holder') {
    $query = "UPDATE holder_details SET permission='$permission' WHERE account_id='$id'";
}

if ($conn->query($query) === TRUE) {
    echo "Record updated successfully";
} else {
    echo "Error updating record: " . $conn->error;
}

$conn->close();
?>
