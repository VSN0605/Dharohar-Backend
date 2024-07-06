<?php

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');
header("Access-Control-Allow-Headers: X-Requested-With");

include("db-connection.php");

if (mysqli_connect_error()) {
    echo json_encode(['error' => mysqli_connect_error()]);
    exit();
} else {
    $sql = "SELECT * FROM `invoice` WHERE id != '0' AND DeleteTime IS NOT NULL";
    $result = mysqli_query($conn, $sql);
    
    if (!$result) {
        echo json_encode(['error' => mysqli_error($conn)]);
        exit();
    }

    $json_data = array();
    while ($row = mysqli_fetch_assoc($result)) {
        $json_data[] = $row;
    }
    echo json_encode(['phpresult' => $json_data]);
}
?>
