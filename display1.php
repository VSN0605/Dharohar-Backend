<?php
   header("Access-Control-Allow-Origin", "*");
   header("Access-Control-Allow-Credentials", "true");
   header("Access-Control-Allow-Methods", "GET,HEAD,OPTIONS,POST,PUT");
    header('Access-Control-Allow-Headers: Content-Type');
    
    // $conn = new mysqli("localhost","ruralhaa_royals","Royals#2023","ruralhaa_royals");
    include("db-connection.php");
    
    if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
        exit;
      }
      
    if(mysqli_connect_error())
    {
        echo mysqli_connect_error();
        exit();
    }
    else{
        if (isset($_POST['id'])) {
            $id = $_POST['id'];
          
            // Prepare and execute the query
            $stmt = $pdo->prepare('select * from artifacts where id= :id');
            $stmt->bindParam(':id', $id);
            $stmt->execute();
          
            // Fetch the data
            $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
          
            // Return the data as JSON
            header('Content-Type: application/json');
            echo json_encode($data);
          } else {
            // ID not found in POST request
            echo 'No ID provided';
          }
    }
?>  