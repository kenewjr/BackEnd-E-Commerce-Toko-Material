<?php


$host = "localhost";
$username = "abrar";
$password = "abrar12345";
$dbname = "project_abrar";
$link_gambar = "http://abrar.vzcyberd.my.id/API/uploads/thumbnail_produk_";
$koneksi = new mysqli($host,$username,$password,$dbname);
if($koneksi->error){
    die("Error".mysqli_connect_error());
}
?>