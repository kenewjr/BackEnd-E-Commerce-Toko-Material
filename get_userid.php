<?php
    header("Content-type: application/json");
    
    require 'koneksi.php';

    if ($_SERVER['REQUEST_METHOD'] == 'GET') {

        // Check if a user ID is provided in the URL parameter
        if (isset($_GET['user_id'])) {
            $user_id = $_GET['user_id'];

            // Query the database to get the user with the specified ID
            $query = $koneksi->prepare("SELECT * FROM user WHERE id = ?");
            $query->bind_param("i", $user_id);
            $query->execute();
            $result = $query->get_result();

            if ($result->num_rows > 0) {
                $data = $result->fetch_assoc();
                echo json_encode(array(
                    'user_id'  => $data['id'],
                    'username' => $data['username'],
                    'password' => $data['password'],
                    'nama'     => $data['nama'],
                    'nohp'     => $data['nohp'],
                    'alamat'   => $data['alamat']
                ));
            } else {
                http_response_code(404);
                echo json_encode(array('message' => 'User not found'));
            }
        } else {
            http_response_code(400);
            echo json_encode(array('message' => 'User ID is required'));
        }
    }
?>
