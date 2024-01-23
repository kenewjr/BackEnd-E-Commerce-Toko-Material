<?php
    header("Content-type: Application/json");
    
    require 'koneksi.php';

    if($_SERVER['REQUEST_METHOD']=='GET'){

        $query_checking = $koneksi->query("SELECT SUM(jumlah_produk) AS total_produk, SUM(total_harga) AS total_semua_harga FROM riwayat WHERE status = 'selesai'");

        if($query_checking->num_rows > 0) {
            $data_list = array();
            foreach ($query_checking as $data) {

                array_push($data_list, array(
                    'total_harga'  => $data['total_semua_harga'],     
                    'total_produk' => $data['total_produk']
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
