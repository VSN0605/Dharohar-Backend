<?php

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');
header("Access-Control-Allow-Headers: X-Request-With");

include("db-connection.php");

if (mysqli_connect_error()) {
    echo mysqli_connect_error();
    exit();
} else {
    $iid = $_POST['iid'];
    $invoice_id = $_POST['invoiceId'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $cno = $_POST['cno'];
    $address = $_POST['address'];
    $hsncode = $_POST['hsncode'];
    $qrid = $_POST['qrid'];
    $pname = $_POST['pname'];
    $id = $_POST['id'];
    $price = $_POST['price'];
    $gst = $_POST['gst'];
    $discount = $_POST['discount'];
    $fprice = $_POST['fprice'];
    $image = $_POST['image'];
    $rate = $_POST['rate'];
    $t_quantity = $_POST['t_quantity'];
    $t_price = $_POST['t_price'];
    $description = $_POST['description'];
    $invoiceNo = $_POST['invoiceNo'];

    $sql = "INSERT INTO `invoice` (`id`, `invoice_id`, `invoice_no`, `name`, `contact`, `email`, `address`, `pname`, `pid`, `pqrid`, `hsncode`, `rate`, `t_quantity`, `t_price`, `description`, `timestamp`, `price`, `gst`, `fprice`, `discount`, `image`) VALUES 
        (NULL, '$invoice_id', '$invoiceNo', '$name', '$cno', '$email', '$address', '$pname' , '$id' , '$qrid', '$hsncode' , '$rate', '$t_quantity', '$t_price', '$description', NULL, '$price', '$gst', '$fprice', '$discount', '$image');";

    $res = mysqli_query($conn, $sql);
    if ($res) {
        echo "Success!";
    } else {
        echo "error!";
    }
    $conn->close();
}

?>