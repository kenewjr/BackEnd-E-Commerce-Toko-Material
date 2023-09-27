<?php
    header("Content-type: Application/json");
    
    require 'koneksi.php';

    if($_SERVER['REQUEST_METHOD']=='GET'){

        // checking username if already exist

        $query_checking = $koneksi->query("SELECT * FROM `ulasan` ORDER BY `ulasan`.`create_at` DESC");

        if($query_checking->num_rows > 0) {
            $data_list = array();
            foreach ($query_checking as $data) {
                array_push($data_list, array(
                    'id'             => $data['id'],
                    'komentar'             => $data['komentar'],
                   'id_produk'  => $data['id_produk'],
                   'id_user'  => $data['id_user'],
                   'nama_pembeli'  => $data['nama_pembeli'],
                   'create_at'  => $data['create_at']
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
