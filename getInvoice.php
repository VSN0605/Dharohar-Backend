<?php

    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Methods: GET, POST');
    header("Access-Control-Allow-Headers: X-Request-With");

    include("db-connection.php");

    $sql = "SELECT * FROM invoice WHERE invoice_no = (SELECT MAX(invoice_no) FROM invoice);";
    // $sql = "SELECT * FROM artifacts WHERE qrid = (SELECT MAX(qrid) FROM artifacts);";
    $mysqli = mysqli_query($conn,$sql);
    $json_data = array();

    while($row = mysqli_fetch_assoc($mysqli))
    {
        $json_data[] = $row;
    }
    echo json_encode(['phpresult'=>$json_data]);

?>  