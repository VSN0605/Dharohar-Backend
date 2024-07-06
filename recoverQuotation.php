<?php
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Methods: POST, OPTIONS');
    header('Access-Control-Allow-Headers: Content-Type');
    header('Content-Type: application/json');

    if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
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

    $checkQuery = "SELECT * FROM `quotation` WHERE `id` = ?";
    $stmt = $conn->prepare($checkQuery);
    if (!$stmt) {
        echo json_encode(['error' => 'Prepare statement failed: ' . $conn->error]);
        exit();
    }
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $updateQuery = "UPDATE `quotation` SET `DeleteTime` = NULL WHERE `id` = ?";
        $stmt = $conn->prepare($updateQuery);
        if (!$stmt) {
            echo json_encode(['error' => 'Prepare statement failed: ' . $conn->error]);
            exit();
        }
        $stmt->bind_param("i", $id);

        if ($stmt->execute()) {
            echo json_encode(['message' => 'Update successful']);
        } else {
            echo json_encode(['error' => 'Error updating record: ' . $stmt->error]);
        }
    } else {
        echo json_encode(['error' => 'ID not found']);
    }

    $stmt->close();
    $conn->close();
?>
