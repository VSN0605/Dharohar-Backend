<?php
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Methods: GET, POST');
    header("Access-Control-Allow-Headers: X-Request-With");

    // $conn = new mysqli("localhost","ruralhaa_royals","Royals#2023","ruralhaa_royals");

    include("db-connection.php");

    
    if(mysqli_connect_error())
    {
        echo mysqli_connect_error();
        exit();
    }
    else
    {
        $id = $_POST['id'];
        
        $sql = "SELECT quantity from artifacts WHERE id = $id";
        $result = mysqli_query($conn,$sql);

        // Check if the UPDATE query was successful
        if($result)
        {
           
            // echo json_encode(['phpresult'=> 'Update successful']);
        }
        else
        {
            echo "error!";
            // echo json_encode(['phpresult'=> 'Update failed: ' . mysqli_error($conn)]);
        }
    }
?>
