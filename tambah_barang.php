<?php
    header("Content-type: Application/json");
    
    require 'koneksi.php';

    if($_SERVER['REQUEST_METHOD']=='POST'){

        $nama_produk = $_POST['nama_produk'];
        $kategori_produk = $_POST['kategori_produk'];
        $stok = $_POST['stok'];
        $harga = $_POST['harga'];
        $deskripsi = $_POST['deskripsi'];
        $created_at = date("Y-m-d H:i:s");
        $updated_at = date("Y-m-d H:i:s");


        $sql_id_berita = $koneksi->query("SELECT AUTO_INCREMENT FROM  INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = 'material' AND TABLE_NAME = 'produk'");
        $id_berita = $sql_id_berita->fetch_assoc()['AUTO_INCREMENT'];
        
        $thumbnail = $_POST['gambar'];
        $filename = "thumbnail_berita_".$id_berita.".jpg";
        file_put_contents("uploads/".$filename,base64_decode($thumbnail));

        $query_add = $koneksi->query("INSERT INTO produk (nama_produk, deskripsi,kategori_produk, stok, harga, gambar, create_at, update_at)
         VALUES ('$nama_produk','$deskripsi', '$kategori_produk', '$stok', '$harga', '$thumbnail', '$created_at', '$updated_at')");

        if($query_add) {
            http_response_code(200);
            echo json_encode(['message'=>'success']);
        } else {
            http_response_code(500);
            echo json_encode(['message'=>$koneksi->error]);
        }
    }    
?>
