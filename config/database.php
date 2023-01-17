<?php
    $host="localhost";
    $user="user";
    $password="123456";
    $db="db_magang";
    $kon = mysqli_connect($host,$user,$password,$db);
    if (!$kon){
        die("Koneksi gagal:".mysqli_connect_error());
    }
?>