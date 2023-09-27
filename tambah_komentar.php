<?php

    require 'koneksi.php';

    header("Content-type: Application/json");
   

    if($_SERVER['REQUEST_METHOD']=='POST'){

        $id_user = $_POST['id_user'];
        $komentar = $_POST['komentar'];
        $id_produk = $_POST['id_produk'];
        $nama_pembeli = $_POST['nama_pembeli'];
        $dateNow = date("Y-m-d h:i:s");

        $query_add = $koneksi->query("INSERT INTO `ulasan` (`komentar`, `id_produk`, `id_user`, `nama_pembeli`, `create_at`)
         VALUES ('$komentar','$id_produk','$id_user','$nama_pembeli','$dateNow')");

        if($query_add) {
            http_response_code(200);
            echo json_encode(['message'=>'success']);
        } else {
            http_response_code(500);
            echo json_encode(['message'=>"$koneksi->error"]);
        }
    }  
?>
