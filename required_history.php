<?php
header("Content-type: application/json");
require 'koneksi.php';

function fetchDataFromAPI($ORDER_ID) {
    $url = "https://api.sandbox.midtrans.com/v2/{$ORDER_ID}/status";
    $headers = array(
        "Content-type: application/json",
        "Accept: application/json",
        "x-api-key: SB-Mid-client-UyV8fwVUJHmHywYZ",
        "Authorization: Basic U0ItTWlkLXNlcnZlci1LYlAxYjMzU05JbzhlNEVvQ0xQM3l6NDM6"
    );

    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    curl_close($ch);

    if ($response === false) {
        return null;
    }

    $data = json_decode($response, true);
    return $data;
}

function fetchProductData($koneksi, $id_produk) {
    $query = "SELECT * FROM produk WHERE id = ?";
    $stmt = $koneksi->prepare($query);
    $stmt->bind_param('s', $id_produk);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        return $result->fetch_assoc();
    }

    return null;
}

if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['id']) && isset($_GET['ORDER_ID'])) {
    $id_produk = $_GET['id'];
    $ORDER_ID = $_GET['ORDER_ID'];

    // Mengambil data dari API eksternal
    $externalData = fetchDataFromAPI($ORDER_ID);

    if ($externalData === null) {
        die("Gagal mengambil data dari API eksternal.");
    }

    // Mengambil data dari database lokal
    $productData = fetchProductData($koneksi, $id_produk);

    if ($productData === null) {
        http_response_code(404);
        echo json_encode(array('message' => 'Data not found'));
    } else {
        $kategori = $productData['kategori_produk'];
        $query_kategori = $koneksi->query("SELECT * FROM category WHERE id = '$kategori'");
        $data_kategori = $query_kategori->fetch_assoc();

        // Menggabungkan data dari eksternal dan lokal
        $mergedData = array_merge($externalData, array(
            'id' => $productData['id'],
            'nama_produk' => $productData['nama_produk'],
            'gambar' => $link_gambar . $productData['id'] . '.jpg',
            'deskripsi' => $productData['deskripsi'],
            'harga' => $productData['harga'],
            'berat' => $productData['berat'],
            'kategori' => $data_kategori['name'],
            'kategori_id' => $productData['kategori_produk'],
            'stok' => $productData['stok'],
            'create_at' => $productData['create_at'],
            'update_at' => $productData['update_at'],
            'viewer' => $productData['viewer']
        ));

        echo json_encode($mergedData);
    }
}
?>
