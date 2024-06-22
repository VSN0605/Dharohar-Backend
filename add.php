<?php

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');
header("Access-Control-Allow-Headers: X-Request-With");

// $conn = new mysqli("localhost","ruralhaa_royals","Royals#2023","ruralhaa_royals"); 

include("db-connection.php");

if (mysqli_connect_error()) {
    echo mysqli_connect_error();
    exit();
} else {

    $id = $_POST['id']; 
    $artid = $_POST['artid'];
    $name = $_POST['name'];
    $desc = $_POST['desc'];
    $hsncode = $_POST['hsncode'];
    $quantity = $_POST['quantity'];
    $price = $_POST['price'];
    $qrid = $_POST['qrid'];
    // $aqrid = $_POST['aqrid'];
    $image = $_FILES['image'];


    $uploadDir = 'uploads/';
    $filename = $id . '_' . $image['name'];
    $destination = $uploadDir . $filename;

    if (move_uploaded_file($image['tmp_name'], $destination)) {

        $sql = "INSERT INTO `images` (filename) VALUES ('$filename')";
        $desc2 = str_replace("'", "''", $desc);
        $sql = "INSERT INTO `artifacts` (`id`, `artid`, `name`, `description`, `hsncode`, `price`, `qrid`, `quantity`, `image`) VALUES (NULL, '$artid','$name', '$desc2', '$hsncode', '$price', '$qrid', '$quantity', '$filename');";
        $res = mysqli_query($conn, $sql);
    } else {
        echo "Error !";
    }

    if ($res) {
        echo "Artifact added successfully!";
    } else {
        // echo $sql; 
        echo "error!";
    }
    $conn->close();
}


?>


