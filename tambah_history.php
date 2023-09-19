<?php
    header("Content-type: Application/json");
    
    require 'koneksi.php';

    if($_SERVER['REQUEST_METHOD']=='POST'){

        $id_user = $_POST['id_user'];
        $id_produk = $_POST['id_produk'];
        $nama_pembeli = $_POST['nama_pembeli'];
        $tgl_transaksi = $_POST['tgl_transaksi'];
        $nama_produk = $_POST['nama_produk'];
        $harga_produk = $_POST['harga_produk'];
        $total_harga = $_POST['total_harga'];
        $jumlah_produk = $_POST['jumlah_produk'];
        $gambar = $_POST['gambar'];

        $query_add = $koneksi->query("INSERT INTO `riwayat` (`id_user`, `id_produk`, `nama_pembeli`, `tgl_transaksi`, `nama_produk`, `harga_produk`, `total_harga`, `jumlah_produk`, `gambar`)
         VALUES ('$id_user','$id_produk', '$nama_pembeli', '$tgl_transaksi', '$nama_produk', '$harga_produk', '$total_harga', '$jumlah_produk','$gambar')");

        if($query_add) {
            http_response_code(200);
            echo json_encode(['message'=>'success']);
        } else {
            http_response_code(500);
            echo json_encode(['message'=>$koneksi->error]);
        }
    }    
?>
