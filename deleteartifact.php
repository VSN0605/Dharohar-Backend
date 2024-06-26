<?php
//    header('Access-Control-Allow-Origin: *');
//    header('Access-Control-Allow-Headers: X-Request-With');
//    header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
//    header("Access-Control-Allow-Headers: Content-Type, Authorization");
   
//    if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
//        header('Content-Length: 0');
//        header('Content-Type: text/plain');
//        header('Access-Control-Allow-Origin: *');
//        header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
//        header('Access-Control-Allow-Headers: Content-Type, Authorization');
//        exit;
//    }

//         include("db-connection.php");
    
//     if (mysqli_connect_error()) {
//         echo json_encode(["error" => mysqli_connect_error()]);
//         exit();
//     }
    
//     $data = json_decode(file_get_contents('php://input'), true);
    
//     $id = $data['id'];
    
//     $sql = "DELETE FROM artifacts WHERE id='$id'";
    
//     if ($conn->query($sql) === TRUE) {
//         echo json_encode(["success" => "Artifact deleted successfully"]);
//     } else {
//         echo json_encode(["error" => "Error deleting artifact: " . $conn->error]);
//     }
    
//     $conn->close();

//**********************************************//



    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Methods: POST, OPTIONS');
    header('Access-Control-Allow-Headers: Content-Type');
    header('Content-Type: application/json');

    if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
        // Return only the headers and not the content if the request method is OPTIONS
        exit(0);
    }

    include("db-connection.php");

    if (mysqli_connect_error()) {
        echo json_encode(['error' => 'Database connection error']);
        exit();
    }

    $data = json_decode(file_get_contents('php://input'), true);

    if (!isset($data['id'])) {
        echo json_encode(['error' => 'ID not provided']);
        exit();
    }

    $id = $data['id'];
    $dateTime = date('Y-m-d H:i:s');


    $checkQuery = "SELECT * FROM `artifacts` WHERE `id` = ?";
    $stmt = $conn->prepare($checkQuery);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
    
        $updateQuery = "UPDATE `artifacts` SET `deleteTime` = ? WHERE `id` = ?";
        $stmt = $conn->prepare($updateQuery);
        $stmt->bind_param("si", $dateTime, $id);

        if ($stmt->execute()) {
            
            echo json_encode(['message' => 'Update successful']);
        } else {
            
            echo json_encode(['error' => 'Error updating record: ' . $stmt->error]);
        }
    } else {
    
        echo json_encode(['error' => 'ID not found']);
    }

    $conn->close();
?>
    