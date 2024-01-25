<?php
    require 'koneksi.php';

    header("Content-type: Application/json");
   
    if($_SERVER['REQUEST_METHOD']=='POST'){

        $name = $_POST['name'];
        $dateNow = date("Y-m-d h:i:s");

        $query_add = $koneksi->query("INSERT INTO `category` (`name`, `createdAt`)
         VALUES ('$name','$dateNow')");

        if($query_add) {
            http_response_code(200);
            echo json_encode(['message'=>'success']);
        } else {
            http_response_code(500);
            echo json_encode(['message'=>"$koneksi->error"]);
        }
    }  
?>

