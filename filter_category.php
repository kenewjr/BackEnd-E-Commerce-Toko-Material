<?php
    header("Content-type: Application/json");
    
    require 'koneksi.php';

    if($_SERVER['REQUEST_METHOD']=='GET'){

        // Pastikan ada parameter kategori yang diberikan
        if(isset($_GET['kategori'])) {
            $kategori_id = $_GET['kategori'];

            // checking username if already exist
            $query_checking = $koneksi->query("SELECT * FROM `produk` WHERE kategori_produk = $kategori_id ORDER BY `produk`.`create_at` DESC");

            if($query_checking->num_rows > 0) {
                $data_list = array();
                foreach ($query_checking as $data) {
                    // Anda dapat mempertahankan bagian ini untuk mengambil informasi kategori
                    $kategori = $data['kategori_produk'];
                    $query_kategori = $koneksi->query("SELECT * FROM category WHERE id = '$kategori'");
                    $data_kategori = $query_kategori->fetch_assoc();

                    array_push($data_list, array(
                    'id' => $data['id'],
                    'nama_produk' => $data['nama_produk'],
                    'gambar' => $link_gambar . $data['id'] . '.jpg',
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
                echo json_encode(array('message' => 'Data not found for the specified category'));
            }
        } else {
            http_response_code(400);
            echo json_encode(array('message' => 'Category parameter is missing'));
        }
    }    
?>
