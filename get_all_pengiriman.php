<?php
    header("Content-type: Application/json");
    
    require 'koneksi.php';

    if($_SERVER['REQUEST_METHOD']=='GET'){

        $query_checking = $koneksi->query("SELECT * FROM `pengiriman`");

        if($query_checking->num_rows > 0) {
            $data_list = array();
            foreach ($query_checking as $data) {
                array_push($data_list, array(
                    'id'  => $data['id'],
                    'kendaraan'  => $data['kendaraan'],
                    'harga' => $data['harga'],          
                    'max_berat' => $data['max_berat']          
                ));
            }
            echo json_encode($data_list);
        } else {
            http_response_code(200);
            echo json_encode(array([]));
            
        }
    }  else {
      http_response_code(404);
        echo json_encode(array(['message' => 'error occurred']));
    }
?>
