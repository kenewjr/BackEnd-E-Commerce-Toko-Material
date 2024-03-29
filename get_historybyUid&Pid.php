<?php
header("Content-type: Application/json");
require 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (isset($_GET['id_user']) && isset($_GET['id_produk'])) {
        $id_user = $_GET['id_user'];
        $id_produk = $_GET['id_produk'];

        $query_checking = $koneksi->query("SELECT * FROM `riwayat` WHERE id_user='$id_user' AND id_produk='$id_produk'");

        if ($query_checking->num_rows > 0) {
            $data_list = array();
            foreach ($query_checking as $data) {
                array_push($data_list, array(
                    'id' => $data['id'],
                    'id_user' => $data['id_user'],
                    'id_produk' => $data['id_produk'],
                	'order_id' => $data['order_id'],
               		 'ongkos'     =>$data['ongkos'],
                    'nama_pembeli' => $data['nama_pembeli'],
               		'alamat'       =>$data['alamat'],
                    'tgl_transaksi' => $data['tgl_transaksi'],
                    'nama_produk' => $data['nama_produk'],
                    'harga_produk' => $data['harga_produk'],
                    'total_harga' => $data['total_harga'],
                    'jumlah_produk' => $data['jumlah_produk'],
                    'gambar' => $link_gambar. $data['id_produk'].'.jpg',
                    'status' => $data['status'],
               		 'tujuan_rekening' => $data['tujuan_rekening'],
                'nama_rekening' => $data['nama_rekening']
                ));
            }
            http_response_code(200);
            echo json_encode($data_list);
        } else {
            http_response_code(404);
            echo json_encode(array('message' => 'Data not found'));
        }
    } else {
        http_response_code(400);
        echo json_encode(array('message' => 'Missing id_user or id_produk parameter'));
    }
}
?>
