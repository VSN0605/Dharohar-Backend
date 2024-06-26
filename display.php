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
        
        $id = $_GET['id'];

        $sql = "SELECT * from artifacts WHERE qrid='$id' AND deleteTime IS NULL";
        $mysqli = mysqli_query($conn,$sql);
        $json_data = array();
    
        while($row = mysqli_fetch_assoc($mysqli))
        {
            $json_data[] = $row;
        }
        echo json_encode(['phpresult'=>$json_data]);
    }


?>  