<?php
    header("Content-type: Application/json");
    
    require 'koneksi.php';

    if($_SERVER['REQUEST_METHOD']=='POST'){

        $username = $_POST['username'];
        $password = $_POST['password'];

        // checking username if already exist

        $query = "SELECT * FROM user WHERE username = '$username' AND password = '$password'";
        $obj_query = mysqli_query($koneksi, $query);
        $data = mysqli_fetch_assoc($obj_query);

        if ($data){
            http_response_code(200);
            echo json_encode(
                array(
                    'response' => true,
                    'payload' => array(
                        "username" => $data['username'],
                        "nama" => $data['nama'],
                    	'status' => $data['status'],
                        "id" => $data['id']
                )
                    )
            );
        } else {
            http_response_code(401);
            echo json_encode(
                array(
                    'response' => false,
                    'payload' => null
                    )
                );
        }
    }
?>