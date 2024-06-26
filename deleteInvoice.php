<?php
   header('Access-Control-Allow-Origin: *');
   header('Access-Control-Allow-Headers: X-Request-With');
   header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
   header("Access-Control-Allow-Headers: Content-Type, Authorization");
   
   if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
       header('Content-Length: 0');
       header('Content-Type: text/plain');
       header('Access-Control-Allow-Origin: *');
       header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
       header('Access-Control-Allow-Headers: Content-Type, Authorization');
       exit;
   }

//    $conn = new mysqli("localhost","ruralhaa_royals","Royals#2023","ruralhaa_royals");
        include("db-connection.php");
    
    if (mysqli_connect_error()) {
        echo json_encode(["error" => mysqli_connect_error()]);
        exit();
    }
    
    $data = json_decode(file_get_contents('php://input'), true);
    
    $id = $data['id'];
    
    $sql = "DELETE FROM artifacts WHERE id='$id'";
    
    if ($conn->query($sql) === TRUE) {
        echo json_encode(["success" => "Invoice Entry deleted successfully"]);
    } else {
        echo json_encode(["error" => "Error deleting Invoice entry: " . $conn->error]);
    }
    
    $conn->close();
    ?>
    