<?php
    header("Content-type: Application/json");
    
    require 'koneksi.php';

    if($_SERVER['REQUEST_METHOD']=='GET'){
    
      if (isset($_GET['id_user'])) {

        // checking username if already exist
        $id_user= $_GET['id_user'];

        $query_checking = $koneksi->query("SELECT * FROM `riwayat` WHERE id_user='$id_user'");

        if($query_checking->num_rows > 0) {
            foreach ($query_checking as $data) {

               echo json_encode array_push(array(
                    'id'             => $data['id'],
                    'id_user'             => $data['id_user'],
                    'id_produk'             => $data['id_produk'],
               		'order_id'        =>$data['order_id'],
                    'nama_pembeli'             => $data['nama_pembeli'],
                    'tgl_transaksi'             => $data['tgl_transaksi'],
                    'nama_produk'             => $data['nama_produk'],
                    'harga_produk'             => $data['harga_produk'],
                    'total_harga'             => $data['total_harga'],
                    'jumlah_produk'             => $data['jumlah_produk'],
                    'gambar'             => 'https://dev.vzcyberd.cloud/abrar/API/uploads/thumbnail_berita_'. $data['id_produk'].'.jpg',
                    'status'             => $data['status']

                ));
            }
            http_response_code(200);
        } else {
            http_response_code(404);
            echo json_encode(array('message' => 'data not found'));
            
        }
    }    
    }
?>
