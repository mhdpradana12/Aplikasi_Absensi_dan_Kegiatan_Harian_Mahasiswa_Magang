<?php
session_start();
    include '../../config/database.php';
    mysqli_query($kon,"START TRANSACTION");

    $id_mahasiswa=$_GET['id_mahasiswa'];
    $kode_mahasiswa=$_GET['kode_mahasiswa'];

    $hapus_admin=mysqli_query($kon,"DELETE FROM tbl_mahasiswa WHERE id_mahasiswa='$id_mahasiswa'");
    $hapus_pengguna=mysqli_query($kon,"DELETE FROM tbl_user WHERE kode_pengguna='$kode_admin'");

    if ($hapus_admin and $hapus_pengguna) {
        mysqli_query($kon,"COMMIT");
        header("Location:../../index.php?page=mahasiswa&hapus=berhasil");
    }
    else {
        mysqli_query($kon,"ROLLBACK");
        header("Location:../../index.php?page=mahasiswa&hapus=gagal");

    }

?>