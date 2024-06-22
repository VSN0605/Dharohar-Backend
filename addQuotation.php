<?php

    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Methods: GET, POST');
    header("Access-Control-Allow-Headers: X-Request-With");

    include("db-connection.php");

    if(mysqli_connect_error())
    {
        echo mysqli_connect_error();
        exit();
    }
    else{
        $quotation_no = $_POST['quotationNo'];
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
        
        $sql = "INSERT INTO `quotation` (`id`, `quotation_no`, `name`, `contact`, `email`, `address`, `pname`, `pid`, `pqrid`, `hsncode`, `timestamp`, `price`, `rate`, `t_quantity`, `gst`, `fprice`, `discount`, `image`) VALUES 
        (NULL, '$quotation_no', '$name', '$cno', '$email', '$address', '$pname' ,'$id', '$qrid', '$hsncode', NULL, '$price', '$rate', '$t_quantity', '$gst', '$fprice', '$discount', '$image');";
        $res = mysqli_query($conn, $sql); 
        if($res)        
        {
            echo "Sucess!";
        }
        else{
            echo "error!";
        }       
        $conn->close();
    }

?>