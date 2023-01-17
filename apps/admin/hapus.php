<?php
    //Memulai Session
    session_start();

    //Koneksi database
    include '../../config/database.php';
    //Memulai admin
    mysqli_query($kon,"START TRANSACTION");

    $id_admin=$_GET['id_admin'];
    $kode_admin=$_GET['kode_admin'];

    //Menghapus data dalam tabel admin
    $hapus_admin=mysqli_query($kon,"DELETE FROM tbl_admin WHERE id_admin='$id_admin'");
    //Menghapus data dalam tabel pengguna
    $hapus_pengguna=mysqli_query($kon,"DELETE FROM tbl_user WHERE kode_pengguna='$kode_admin'");

    //Kondisi apakah berhasil atau tidak dalam mengeksekusi query diatas
    if ($hapus_admin and $hapus_pengguna) {
        mysqli_query($kon,"COMMIT");
        header("Location:../../index.php?page=admin&hapus=berhasil");
    }
    else {
        mysqli_query($kon,"ROLLBACK");
        header("Location:../../index.php?page=admin&hapus=gagal");

    }

?>