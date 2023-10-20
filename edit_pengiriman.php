<?php

    require 'koneksi.php';

    header("Content-type: Application/json");

    if($_SERVER['REQUEST_METHOD']=='POST'){
        $id = $_POST['id'];
        $kendaraan = $_POST['kendaraan'];
        $harga = $_POST['harga'];
        $max_berat = $_POST['max_berat'];

        $query_add = $koneksi->query("UPDATE category SET kendaraan = '$kendaraan', harga = '$harga', max_berat= '$max_berat' WHERE id = '$id'");

        if($query_add) {
            http_response_code(200);
            echo json_encode(['message'=>'success']);
        } else {
            http_response_code(500);
            echo json_encode(['message'=>"$koneksi->error"]);
        }
    }  
?>
