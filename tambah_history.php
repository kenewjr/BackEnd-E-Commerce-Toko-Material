<?php

    require 'koneksi.php';

    header("Content-type: Application/json");
   

    if($_SERVER['REQUEST_METHOD']=='POST'){

        $id_user = $_POST['id_user'];
        $id_produk = $_POST['id_produk'];
        $nama_pembeli = $_POST['nama_pembeli'];
        $tgl_transaksi = $_POST['tgl_transaksi'];
    	$ongkos = $_POST['ongkos'];
        $order_id = $_POST['order_id'];
    	$alamat = $_POST['alamat'];
        $nama_produk = $_POST['nama_produk'];
        $harga_produk = $_POST['harga_produk'];
        $total_harga = $_POST['total_harga'];
        $jumlah_produk = $_POST['jumlah_produk'];
        $gambar = $_POST['gambar'];
    	$rekening = $_POST['tujuan_rekening'];
    	$namarek = $_POST['nama_rekening'];

        $query_add = $koneksi->query("INSERT INTO `riwayat` (`id_user`, `id_produk`,`order_id`,`ongkos`, `nama_pembeli`,`alamat`, `tgl_transaksi`, `nama_produk`, `harga_produk`, `total_harga`, `jumlah_produk`, `gambar`, `status`, `tujuan_rekening`,`nama_rekening`)
         VALUES ('$id_user','$id_produk','$order_id','$ongkos', '$nama_pembeli','$alamat', '$tgl_transaksi', '$nama_produk', '$harga_produk', '$total_harga', '$jumlah_produk','$gambar', 'pending','$rekening','$namarek')");

        if($query_add) {
            http_response_code(200);
            echo json_encode(['message'=>'success']);
        } else {
            http_response_code(500);
            echo json_encode(['message'=>"$koneksi->error"]);
        }
    }  
?>
