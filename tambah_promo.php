<?php

    require 'koneksi.php';

    header("Content-type: Application/json");
   

    if($_SERVER['REQUEST_METHOD']=='POST'){

        $id = $_POST['id'];
        $min_harga = $_POST['min_harga'];
        $max_harga = $_POST['max_harga'];
        $harga_diskon = $_POST['harga_diskon'];


        $query_add = $koneksi->query("INSERT INTO `promo` (`min_harga`, `max_harga`,`harga_diskon`)
         VALUES ('$min_harga','$max_harga','$harga_diskon')");

        if($query_add) {
            http_response_code(200);
            echo json_encode(['message'=>'success']);
        } else {
            http_response_code(500);
            echo json_encode(['message'=>"$koneksi->error"]);
        }
    }  
?>
