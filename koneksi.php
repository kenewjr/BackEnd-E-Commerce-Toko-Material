<?php

$host = "localhost";
$username = "root";
$password = "";
$dbname = "material";

$koneksi = new mysqli($host,$username,$password,$dbname);
if($koneksi->error){
    die("Error".mysqli_connect_error());
}
?>