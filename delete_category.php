<?php
    header("Content-type: Application/json");
    
    require 'koneksi.php';

    if($_SERVER['REQUEST_METHOD']=='POST'){

        $id_ctgy = $_POST['id'];
        $query = $koneksi->query("DELETE FROM category WHERE id = '$id_ctgy'");
       
        if ($query) {
            http_response_code(200);
            echo json_encode(array('message' => 'success'));
        } else {                
            http_response_code(500);
            echo json_encode(array('message' => 'error'));
        }
    }    
?>
