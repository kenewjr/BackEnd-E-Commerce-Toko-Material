<?php
header("Content-type: Application/json");

require 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $id_produk = $_POST['id'];
    $nama_produk = $_POST['nama_produk'];
    $kategori_produk = $_POST['kategori_produk'];
    $stok = $_POST['stok'];
    $harga = $_POST['harga'];
    $deskripsi = $_POST['deskripsi'];
    $created_at = date("Y-m-d H:i:s");
    $updated_at = date("Y-m-d H:i:s");

    $thumbnail = $_POST['gambar'];
    $filename = "thumbnail_berita_" . $id_produk . ".jpg";

    $files = getcwd() . '/uploads/thumbnail_berita_' . $id_produk . '.jpg';

    if (file_exists($files)) {
        if (unlink($files)) {
            $query = $koneksi->query("UPDATE produk SET nama_produk = '$nama_produk', deskripsi = '$deskripsi', kategori_produk = '$kategori_produk', updated_at = '$updated_at', stok= '$stok', harga = '$harga', gambar = '$thumbnail' WHERE id = '$id_produk'");


            if ($query) {
                file_put_contents("img/" . $filename, base64_decode($thumbnail));
                http_response_code(200);
                echo json_encode(array('message' => 'success'));
            } else {
                http_response_code(500);
                echo json_encode(array('message' => 'server error ' . $koneksi->error));
            }
        } else {
            http_response_code(500);
            echo json_encode(array('message' => 'image replacing error'));
        }
    } else {
        http_response_code(404);
        echo json_encode(array('message' => 'image replacing error'));
    }
}
