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

    include("db-connection.php");
    
    if(mysqli_connect_error())
    {
        echo mysqli_connect_error();
        exit();
    }
    else{
        
        $id = $_POST['id'];

        $sql = "DELETE FROM `invoice` WHERE `id` = '$id'";
        $res = mysqli_query($conn,$sql);
        
        if($res)
        {
            echo "Quotation deleted successfully!";
        }
        else{
            echo "error!";
        }
    }
?>  
