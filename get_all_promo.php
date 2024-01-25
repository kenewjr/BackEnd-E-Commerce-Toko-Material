<?php
    header("Content-type: Application/json");
    
    require 'koneksi.php';

    if ($_SERVER['REQUEST_METHOD'] == 'GET') {

        $query_checking = $koneksi->query("SELECT * FROM `promo`");

        if ($query_checking->num_rows > 0) {
            $data_list = array();
            foreach ($query_checking as $data) {
                array_push($data_list, array(
                    'id'  => $data['id'],
                    'min_harga'  => $data['min_harga'],
                    'max_harga' => $data['max_harga'],
                    'harga_diskon' => $data['harga_diskon']
                ));
            }

            // Function to compare min_harga values for sorting
            function compareMinHarga($a, $b) {
                return $a['min_harga'] - $b['min_harga'];
            }

            // Sort the array by min_harga field
            usort($data_list, 'compareMinHarga');

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
