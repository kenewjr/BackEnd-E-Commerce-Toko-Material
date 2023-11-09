<?php

require 'koneksi.php';

header("Content-type: Application/json");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $input = $_POST['input'];
    $randompass = generateRandomPassword();

    $sql = "UPDATE user SET password = '$randompass' WHERE email = '$input' OR username = '$input' OR nohp = '$input'";
    $query_add = mysqli_query($koneksi, $sql);

    if ($query_add) {
        if (mysqli_affected_rows($koneksi) > 0) {
            // Now, fetch the username
            $username = getUserName($input);

            http_response_code(200);
            echo json_encode(array('message' => 'Password updated successfully', 'new_password' => $randompass, 'username' => $username));
        } else {
            http_response_code(404);
            echo json_encode(['message' => 'Data not found for the provided input']);
        }
    } else {
        http_response_code(500);
        echo json_encode(['message' => mysqli_error($koneksi)]);
    }
}

function generateRandomPassword() {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $password = '';
    $length = 10;
    for ($i = 0; $i < $length; $i++) {
        $password .= $characters[rand(0, strlen($characters) - 1)];
    }
    return $password;
}

function getUserName($identifier) {
    global $koneksi;
    $sql = "SELECT username FROM user WHERE email = '$identifier' OR username = '$identifier' OR nohp = '$identifier'";
    $result = mysqli_query($koneksi, $sql);
    
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        return $row['username'];
    } else {
        return null; // No user found for the provided identifier
    }
}
?>
