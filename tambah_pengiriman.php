<?php

    require 'koneksi.php';

    header("Content-type: Application/json");
   

    if($_SERVER['REQUEST_METHOD']=='POST'){

        $kendaraan = $_POST['kendaraan'];
        $harga = $_POST['harga'];
        $max_berat = $_POST['max_berat'];


        $query_add = $koneksi->query("INSERT INTO `pengiriman` (`kendaraan`, `harga`,`max_berat`)
         VALUES ('$kendaraan','$harga','$max_berat')");

        if($query_add) {
            http_response_code(200);
            echo json_encode(['message'=>'success']);
        } else {
            http_response_code(500);
            echo json_encode(['message'=>"$koneksi->error"]);
        }
    }  
?>
