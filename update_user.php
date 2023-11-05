<?php
    header("Content-type: Application/json");
    
    require 'koneksi.php';

    if($_SERVER['REQUEST_METHOD']=='POST'){

        $username = $_POST['username'];
        $nama = $_POST['nama'];
        $nohp = $_POST['nohp'];
        $alamat = $_POST['alamat'];
      	$kota = $_POST['kota'];
        $kodepos = $_POST['kodepos'];
  		$email = $_POST['email'];

        // checking username if already exist

        $query = $koneksi->query("UPDATE user SET nama='$nama', nohp='$nohp',alamat='$alamat',kota = '$kota',kodepos='$kodepos',email='$email' WHERE username = '$username'");

        if($koneksi->affected_rows > 0) {
            http_response_code(200);
                echo json_encode(array('message' => 'success'));
        } else {    
            http_response_code(500);
            echo json_encode(array('message' => $koneksi->error));
        }
    }    
?>