<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');
header("Access-Control-Allow-Headers: X-Requested-With");

// $conn = new mysqli("localhost","ruralhaa_royals","Royals#2023","ruralhaa_royals");4

include("db-connection.php");

if (mysqli_connect_error()) {
    echo mysqli_connect_error();
    exit();
} else {
    // Assuming you have a database connection established
    
    // Assuming you have received the 'id' and 'quantity' from the FormData
    $id = $_POST['id'];
    $quantity = $_POST['quantity'];
    
    // Check if the record with the given ID exists
    $checkQuery = "SELECT * FROM `artifacts` WHERE `qrid` = '$id'";
    $result = $conn->query($checkQuery);
    
    if ($result->num_rows > 0) {
        // If the record exists, perform the update query
        $updateQuery = "UPDATE `artifacts` SET `quantity` = $quantity WHERE `qrid` = '$id'";
    
        if ($conn->query($updateQuery) === TRUE) {
            // If the update query is successful
            echo "Update successful";
        } else {
            // If there's an error in the update query
            echo "Error updating record: " . $conn->error;
        }
    } else {
        // If the record with the given ID does not exist
        echo "ID not found";
    }
    
    // Close the database connection
    $conn->close();
}
?>
