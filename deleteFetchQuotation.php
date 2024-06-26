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

//     include("db-connection.php");
    
//     if(mysqli_connect_error())
//     {
//         echo mysqli_connect_error();
//         exit();
//     }
//     else{
        
//         $id = $_POST['id'];

//         $sql = "DELETE FROM `quotation` WHERE `id` = '$id'";
//         $res = mysqli_query($conn,$sql);
        
//         if($res)
//         {
//             echo "Quotation deleted successfully!";
//         }
//         else{
//             echo "error!";
//         }
//     }

// ******************************************** //

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

// Check if the record with the given ID exists
$checkQuery = "SELECT * FROM `quotation` WHERE `id` = ?";
$stmt = $conn->prepare($checkQuery);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // If the record with the given ID exists
    $updateQuery = "UPDATE `quotation` SET `DeleteTime` = ? WHERE `id` = ?";
    $stmt = $conn->prepare($updateQuery);
    $stmt->bind_param("si", $dateTime, $id);

    if ($stmt->execute()) {
        // If the update query is successful
        echo json_encode(['message' => 'Update successful']);
    } else {
        // If there's an error in the update query
        echo json_encode(['error' => 'Error updating record: ' . $stmt->error]);
    }
} else {
    // If the record with the given ID does not exist
    echo json_encode(['error' => 'ID not found']);
}

// Close the database connection
$conn->close();
?>  
