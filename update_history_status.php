<?php

    require 'koneksi.php';

    header("Content-type: Application/json");
   

    if($_SERVER['REQUEST_METHOD']=='POST'){

    	$id = $_POST['id'];
       	$status = $_POST ['status'];

        $query_add = $koneksi->query("UPDATE `riwayat` SET status = '$status' WHERE id = '$id'");

        if($query_add) {
            http_response_code(200);
            echo json_encode(['message'=>'success']);
        } else {
            http_response_code(500);
            echo json_encode(['message'=>"$koneksi->error"]);
        }
    }  
?>
