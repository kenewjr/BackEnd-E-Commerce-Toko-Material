<?php
require 'koneksi.php';

// Mengambil semua data yang memiliki status "lunas"
$query = $koneksi->query("SELECT * FROM riwayat WHERE status = 'Terkirim'");

if ($query) {
    while ($row = $query->fetch_assoc()) {
        $id = $row['id'];
        $tanggal_transaksi = strtotime($row['tgl_transaksi']);
        $today = strtotime(date('Y-m-d'));
        $total =  $today-$tanggal_transaksi ;
        if (($total) >= 3 * 24 * 60 * 60) {
            // Mengubah status menjadi "selesai"
            $update_query = $koneksi->query("UPDATE riwayat SET status = 'Selesai' WHERE id = '$id'");
            
            if ($update_query) {
                // Jika pembaruan berhasil, lanjutkan ke ID berikutnya
                continue;
            } else {
                // Jika pembaruan gagal, catat pesan kesalahan
                echo "Gagal mengubah status untuk ID $id: " . $koneksi->error;
            }
        }
    }
    
    http_response_code(200);
    echo json_encode(['message' => $total]);
} else {
    http_response_code(400);
    echo json_encode(['message' => "Gagal mengambil data dari database: " . $koneksi->error]);
}
?>
