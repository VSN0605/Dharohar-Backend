
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
    
    else{
        
        $sql = $_POST['query'];
        $mysqli = mysqli_query($conn,$sql);
        $json_data = array();
    
        while($row = mysqli_fetch_assoc($mysqli))
        {
            $json_data[] = $row;
        }
        echo json_encode(['phpresult'=>$json_data]);
    }
?>  