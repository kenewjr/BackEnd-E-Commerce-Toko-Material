<?php

require 'koneksi.php';

$query_add = $koneksi->query("SELECT * FROM `riwayat` WHERE status='Lunas'");

if ($query_add) {
    // Lakukan tindakan yang diinginkan
    // Misalnya, log ke file atau kirim notifikasi
   	echo "Berhasil: " . $koneksi->error;
} else {
    // Lakukan tindakan jika ada kesalahan
    echo "Gagal mengubah status untuk  " . $koneksi->error;
}

?>
