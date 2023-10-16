<?php


$host = "localhost";
$username = "abrar";
$password = "abrar12345";
$dbname = "project_abrar";

$koneksi = new mysqli($host,$username,$password,$dbname);
if($koneksi->error){
    die("Error".mysqli_connect_error());
}
?>