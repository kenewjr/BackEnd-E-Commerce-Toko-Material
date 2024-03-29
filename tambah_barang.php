<?php
    header("Content-type: Application/json");
    
    require 'koneksi.php';

    if($_SERVER['REQUEST_METHOD']=='POST'){

        $nama_produk = $_POST['nama_produk'];
        $kategori_produk = $_POST['kategori_produk'];
        $stok = $_POST['stok'];
        $harga = $_POST['harga'];
    	$berat = $_POST['berat'];
        $deskripsi = $_POST['deskripsi'];
        $created_at = date("Y-m-d H:i:s");
        $updated_at = date("Y-m-d H:i:s");


        $sql_id_produk = $koneksi->query("SELECT AUTO_INCREMENT FROM  INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = 'project_abrar' AND TABLE_NAME = 'produk'");
        $id_produk = $sql_id_produk->fetch_assoc()['AUTO_INCREMENT'];
        
        $thumbnail = $_POST['gambar'];
        $filename = "thumbnail_produk_".$id_produk.".jpg";
        file_put_contents("uploads/".$filename,base64_decode($thumbnail));

        $query_add = $koneksi->query("INSERT INTO produk (nama_produk, deskripsi,kategori_produk, stok, harga,berat, gambar, create_at, update_at, viewer,rating,ratinguser)
         VALUES ('$nama_produk','$deskripsi', '$kategori_produk', '$stok', '$harga','$berat', '$thumbnail', '$created_at', '$updated_at','0','0','0')");

        if($query_add) {
            http_response_code(200);
            echo json_encode(['message'=>'success']);
        } else {
            http_response_code(500);
            echo json_encode(['message'=>$koneksi->error]);
        }
    }    
?>
