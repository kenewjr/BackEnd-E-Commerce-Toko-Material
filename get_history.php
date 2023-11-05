<?php
    header("Content-type: Application/json");
    
    require 'koneksi.php';

    if($_SERVER['REQUEST_METHOD']=='GET'){

        // checking username if already exist

        $query_checking = $koneksi->query("SELECT * FROM `riwayat` ORDER BY `riwayat`.`tgl_transaksi` DESC");

        if($query_checking->num_rows > 0) {
            $data_list = array();
            foreach ($query_checking as $data) {

                array_push($data_list, array(
                    'id'             => $data['id'],
                    'id_user'             => $data['id_user'],
                    'id_produk'             => $data['id_produk'],
                	'ongkos'     =>$data['ongkos'],
                	'order_id'      =>$data['order_id'],
                	'alamat'       =>$data['alamat'],
                    'nama_pembeli'             => $data['nama_pembeli'],
                    'tgl_transaksi'             => $data['tgl_transaksi'],
                    'nama_produk'             => $data['nama_produk'],
                    'harga_produk'             => $data['harga_produk'],
                    'total_harga'             => $data['total_harga'],
                    'jumlah_produk'             => $data['jumlah_produk'],
                    'gambar'             => 'https://abrar.vzcyberd.my.id/API/uploads/thumbnail_berita_'. $data['id_produk'].'.jpg',
                    'status'             => $data['status'],
                	'tujuan_rekening' => $data['tujuan_rekening'],
                	'nama_rekening' => $data['nama_rekening']

                ));
            }
            http_response_code(200);
            echo json_encode($data_list);
        } else {
            http_response_code(404);
            echo json_encode(array('message' => 'data not found'));
            
        }
    }    
?>
