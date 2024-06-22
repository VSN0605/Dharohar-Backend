<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Content-Type: application/json');

// $conn = new mysqli("localhost","ruralhaa_royals","Royals#2023","ruralhaa_royals");

include("db-connection.php");

if (mysqli_connect_error()) {
    echo json_encode(['error' => 'Database connection error']);
    exit();
}

// Assuming you have received the 'id', 'description', and 'price' from the FormData
$id = $_POST['id'];
$description = $_POST['description'];
$price = isset($_POST['price']) ? $_POST['price'] : null; // Optional, only if 'price' is provided

// Check if the record with the given ID exists
$checkQuery = "SELECT * FROM `artifacts` WHERE `qrid` = '$id'";
$result = $conn->query($checkQuery);

if ($result->num_rows > 0) {
    // If the record with the given ID exists
    $updateQuery = "UPDATE artifacts SET `description` = '$description'";
    
    // Only update the price if it's provided
    if (!empty($price)) {
        $updateQuery .= ", `price` = '$price'";
    }

    $updateQuery .= " WHERE `qrid` = '$id'";

    if ($conn->query($updateQuery) === TRUE) {
        // If the update query is successful
        echo json_encode(['message' => 'Update successful']);
    } else {
        // If there's an error in the update query
        echo json_encode(['error' => 'Error updating record: ' . $conn->error]);
    }
} else {
    // If the record with the given ID does not exist
    echo json_encode(['error' => 'ID not found']);
}

// Close the database connection
$conn->close();
?>
