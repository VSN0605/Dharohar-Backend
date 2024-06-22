<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');
header('Access-Control-Allow-Headers: X-Request-With');
header('Content-Type: application/json');

// $conn = new mysqli("localhost","ruralhaa_royals","Royals#2023","ruralhaa_royals");
include("db-connection.php");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM artifacts ";
$result = $conn->query($sql);

$json_data = array();
if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $json_data[] = $row;
    }
}

echo json_encode(['phpresult' => $json_data]);

$conn->close();
?>
