<?php
    header("Content-type: Application/json");
    
    require 'koneksi.php';

    if($_SERVER['REQUEST_METHOD']=='GET'){

        $query_checking = $koneksi->query("SELECT * FROM `category`");

        if($query_checking->num_rows > 0) {
            $data_list = array();
            foreach ($query_checking as $data) {
                array_push($data_list, array(
                    'id'  => $data['id'],
                    'name'  => $data['name'],
                    'createdAt' => $data['createdAt']          
                ));
            }
            echo json_encode($data_list);
        } else {
            http_response_code(404);
            echo json_encode(array('message' => 'data not found'));
            
        }
    }
