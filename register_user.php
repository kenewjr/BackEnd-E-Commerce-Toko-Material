<?php
    header("Content-type: Application/json");
    
    require 'koneksi.php';

    if($_SERVER['REQUEST_METHOD']=='POST'){

        $username = $_POST['username'];
        $password = $_POST['password'];
        $nama = $_POST['nama'];
        $nohp = $_POST['nohp'];
        $alamat = $_POST['alamat'];
        $dateNow = date("Y-m-d h:i:s");

        // checking username if already exist

        $query_checking = $koneksi->query("SELECT * FROM user WHERE username = '$username'");

        if($query_checking->num_rows > 0) {
            http_response_code(409);
            echo json_encode(array('message' => 'username already exist'));
        } else {
            $query = $koneksi->query("INSERT INTO `user` (`username`, `password`, `nama`,`nohp`,`alamat`,`date`,'status') VALUES ('$username','$password','$nama','$nohp','$alamat','$dateNow','buyer')");
            if ($query) {
                http_response_code(200);
                echo json_encode(array('message' => 'success'));
            } else {
                http_response_code(500);
                echo json_encode(array('message' => $koneksi->error));
            } 
        }
    }    
?>