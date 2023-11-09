<?php
header("Content-type: Application/json");

require 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    // checking username if already exist

    $query_checking = $koneksi->query("SELECT * FROM `produk` ORDER BY `produk`.`create_at` DESC");

    if ($query_checking) {
        if ($query_checking->num_rows > 0) {
            $data_list = array();
            foreach ($query_checking as $data) {
                $kategori = $data['kategori_produk'];
                $query_kategori = $koneksi->query("SELECT * FROM category WHERE id = '$kategori'");
                $data_kategori = $query_kategori->fetch_assoc();

                array_push($data_list, array(
                    'id' => $data['id'],
                    'nama_produk' => $data['nama_produk'],
                    'gambar' => 'https://abrar.vzcyberd.my.id/API/uploads/thumbnail_berita_' . $data['id'] . '.jpg',
                    'deskripsi' => $data['deskripsi'],
                    'harga' => $data['harga'],
                    'berat' => $data['berat'],
                    'kategori' => $data_kategori['name'],
                    'stok' => $data['stok'],
                    'create_at' => $data['create_at'],
                    'update_at' => $data['update_at'],
                    'viewer' => $data['viewer'],
            	    'rating'    => $data['rating'],
                    'ratinguser'  => $data['ratinguser']
                ));
            }
            http_response_code(200);
            echo json_encode($data_list);
        } else {
            http_response_code(200);
            echo json_encode(array([]));
        }
    } else {
        http_response_code(404);
        echo json_encode(array(['message' => 'error occurred']));
    }
}
?>
