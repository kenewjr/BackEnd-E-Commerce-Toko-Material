<?php

    function OpenCon(){
        $host = "localhost";
        $username = "root";
        $password = "";
        $dbname = "material";
        $conn = new mysqli($host,$username,$password,$dbname) or die("Connect failed: %s\n". $conn -> error);
            
        return $conn;
    }

    function storeToDatabase($grossAmount){
        global $conn;
        $ga = strval($grossAmount);
        mysqli_query($conn, "INSERT INTO test VALUES ($ga,'')");

        if(mysqli_affected_rows($conn) == 1){
            return mysqli_insert_id($conn);
        } else{ 
            echo "Gagal untuk mendapatkan id !";
            exit();
        } 
    }
?>