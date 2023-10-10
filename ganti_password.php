<?php
    header("Content-type: Application/json");
    
    require 'koneksi.php';

    if($_SERVER['REQUEST_METHOD']=='POST'){

        $username = $_POST['username'];
        $password = $_POST['password'];

        // checking username if already exist

        $query = $koneksi->query("UPDATE user SET `password`='$password' WHERE username = '$username'");

        if($koneksi->affected_rows > 0) {
            http_response_code(200);
                echo json_encode(array('message' => 'success'));
        } else {    
            http_response_code(500);
            echo json_encode(array('message' => $koneksi->error));
        }
    }    
?>