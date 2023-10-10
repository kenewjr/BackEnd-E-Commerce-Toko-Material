<?php

require_once 'db_config.php';

// midtrans json received
$json_result = file_get_contents('php://input');
$result = json_decode($json_result, true);

// echo json_encode($result);

$id_riwayat = $result['custom_field1'];
$status = $result['transaction_status'];
$stok = $result['custom_field2'];
$idproduk = $result['custom_field3'];


if ($status === 'pending') {
	$update_data = $db_conn->query("UPDATE riwayat SET status = 'Pending' WHERE id = '$id_riwayat'");
	if ($update_data) {
		http_response_code(200);
        echo json_encode(['status_code' => '200', 'message' => 'success']);
    }   else {
            http_response_code(500);
            echo json_encode(['message'=>"$db_conn->error"]);
        }
} else if ($status === 'settlement') {
	$update_data = $db_conn->query("UPDATE riwayat SET status = 'Lunas' WHERE id = '$id_riwayat'");
	$db_conn->query("UPDATE produk SET stok = stok - $stok WHERE id = '$idproduk'");
	if ($update_data) {
		http_response_code(200);
        echo json_encode(['status_code' => '200', 'message' => 'success']);
    	}else {
            http_response_code(500);
            echo json_encode(['message'=>"$db_conn->error"]);
        }	
}