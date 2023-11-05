<?php
    header("Content-type: Application/json");
    
    require 'koneksi.php';

    if($_SERVER['REQUEST_METHOD']=='POST'){

    	$id_produk = $_POST['id'];
        $nama_produk = $_POST['nama_produk'];
        $kategori_produk = $_POST['kategori_produk'];
        $stok = $_POST['stok'];
        $harga = $_POST['harga'];
    	$berat = $_POST['berat'];
        $deskripsi = $_POST['deskripsi'];
        $update_at = date("Y-m-d H:i:s");
    
    	$uploadedFile = $_FILES['gambar']['tmp_name'];
		$filename = $_FILES['gambar']['name'];
		$uploadDirectory = 'uploads/thumbnail_berita_'.$id_produk.'.jpg'; 
    	unlink(getcwd().'/'.$uploadDirectory);
    	move_uploaded_file($uploadedFile, $uploadDirectory);
    	$query = $koneksi->query("UPDATE produk SET nama_produk = '$nama_produk', berat = '$berat', deskripsi = '$deskripsi', kategori_produk = '$kategori_produk', update_at = '$update_at', stok= '$stok', harga = '$harga', gambar = '$uploadedFile' WHERE id = '$id_produk'");
                
        if ($query) {                    
            http_response_code(200);
            echo json_encode(array('message' => 'success'));
        } else {                
            http_response_code(500);
            echo json_encode(array('message' => 'server error '. $koneksi->error));
        }
    }
