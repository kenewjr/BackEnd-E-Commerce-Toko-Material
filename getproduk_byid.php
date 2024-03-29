<?php
    header("Content-type: Application/json");
    
    require 'koneksi.php';

    if($_SERVER['REQUEST_METHOD']=='GET'){

        // checking username if already exist

        if (isset($_GET['id'])) {

            $id_produk= $_GET['id'];

            $data_produk = $koneksi->query("SELECT * FROM produk WHERE id = '$id_produk'");

            $koneksi->query("UPDATE produk SET viewer = viewer + 1 WHERE id = '$id_produk'");
            

            if($data_produk->num_rows > 0) {
                $data_list = array();
                foreach ($data_produk as $data) {
                    
                    $kategori = $data['kategori_produk'];
                    $query_kategori = $koneksi->query("SELECT * FROM category WHERE id = '$kategori'");
                    $data_kategori = $query_kategori->fetch_assoc();

                    echo json_encode(array(
                        'id'             => $data['id'],
                        'nama_produk'             => $data['nama_produk'],
                        'gambar'         => $link_gambar. $data['id'].'.jpg', 
                        'deskripsi'                 => $data['deskripsi'],
                        'harga'                   => $data['harga'],
                    	'berat'			=>$data['berat'],
                        'kategori'              => $data_kategori['name'],
                    	'kategori_id'     => $data['kategori_produk'],
                        'stok'              => $data['stok'],
                        'create_at'              => $data['create_at'],
                        'update_at'              => $data['update_at'],
                        'viewer'              => $data['viewer'],
                    	'rating'    => $data['rating'],
                    	'ratinguser'  => $data['ratinguser']
                    ));
                }
            } else {
                http_response_code(404);
                echo json_encode(array('message' => 'data not found'));
                
            }
        }
    }    
?>
