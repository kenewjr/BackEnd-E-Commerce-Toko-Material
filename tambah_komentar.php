<?php

    require 'koneksi.php';

    header("Content-type: Application/json");
   

    if($_SERVER['REQUEST_METHOD']=='POST'){

        $id_user = $_POST['id_user'];
        $komentar = $_POST['komentar'];
        $id_produk = $_POST['id_produk'];
        $nama_pembeli = $_POST['nama_pembeli'];
    	$rating = $_POST['rating'];
        $dateNow = date("Y-m-d h:i:s");

        $query_add = $koneksi->query("INSERT INTO `ulasan` (`komentar`, `id_produk`, `id_user`, `nama_pembeli`, `create_at`)
         VALUES ('$komentar','$id_produk','$id_user','$nama_pembeli','$dateNow')");
    

        if($query_add) {
         $koneksi->query("UPDATE produk SET rating = rating + $rating, ratinguser = ratinguser + 1 WHERE id = '$id_produk'");
            http_response_code(200);
       
            echo json_encode(['message'=>'success']);
        } else {
            http_response_code(500);
            echo json_encode(['message'=>"$koneksi->error"]);
        }
    }  
?>
