<?php
    header("Content-type: Application/json");
    
    require 'koneksi.php';
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
    if($_SERVER['REQUEST_METHOD']=='POST'){

        $username = $_POST['username'];
        $password = $_POST['password'];
        $nama = $_POST['nama'];
        $email = $_POST['email'];
        $nohp = $_POST['nohp'];
        $alamat = $_POST['alamat'];
        $kota = $_POST['kota'];
        $kodepos = $_POST['kodepos'];
        $dateNow = date("Y-m-d h:i:s");

        // checking username if already exist

        $query_checking = $koneksi->query("SELECT * FROM user WHERE username = '$username' OR nohp = '$nohp' OR email = '$email'");

        if($query_checking->num_rows > 0) {
            http_response_code(409);
            echo json_encode(array(['message' => 'Data Already Exist']));
        } else {
            $query = $koneksi->query("INSERT INTO `user` (`username`, `password`, `nama`,`nohp`,`alamat`,`kota`,`kodepos`,`email`,`date`,`status`) 
            VALUES ('$username','$password','$nama','$nohp','$alamat','$kota','$kodepos','$email','$dateNow','buyer')");
            if ($query) {
                http_response_code(200);
                echo json_encode(array(['message' => 'success']));
            } else {
                http_response_code(500);
                echo json_encode(array(['message' => $koneksi->error]));
            } 
        }
    }    
?>