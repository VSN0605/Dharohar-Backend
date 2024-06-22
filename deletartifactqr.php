<?php
   header('Access-Control-Allow-Origin: *');
   header('Access-Control-Allow-Headers: X-Request-With');
   header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
   header("Access-Control-Allow-Headers: Content-Type, Authorization");
   
   if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
       header('Content-Length: 0');
       header('Content-Type: text/plain');
       header('Access-Control-Allow-Origin: *');
       header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
       header('Access-Control-Allow-Headers: Content-Type, Authorization');
       exit;
   }

    // $conn = new mysqli("localhost","ruralhaa_royals","Royals#2023","ruralhaa_royals");

    include("db-connection.php");
    
    if(mysqli_connect_error())
    {
        echo mysqli_connect_error();
        exit();
    }
    else{
        
        $qrid = $_POST['qrid'];

        $sql = "DELETE FROM artifacts WHERE qrid = '$qrid'";
        $res = mysqli_query($conn,$sql);
        
        if($res)
        {
            echo "Artifact deleted successfully!";
        }
        else{
            echo "error!";
        }
    }
?>  
