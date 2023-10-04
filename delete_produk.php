<?php
header("Content-type: Application/json");

require 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $delete = $_POST['delete'];

    if ($delete == "produk") {
        $id_produk = $_POST['id'];
        $files = getcwd() . '/uploads/thumbnail_berita_' . $id_produk . '.jpg';
        if (unlink($files)) {
            $query = $koneksi->query("DELETE FROM produk WHERE id = '$id_produk'");
            if ($query) {
                http_response_code(200);
                echo json_encode(array('message' => 'success'));
            } else {
                http_response_code(500);
                echo json_encode(array('message' => 'error'));
            }
        } else {
            http_response_code(500);
            echo json_encode(array('message' => 'error'));
        }
        // echo json_encode(array("your location is" => $files));           
    }
}
