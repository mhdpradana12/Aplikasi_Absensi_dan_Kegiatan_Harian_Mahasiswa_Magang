<?php
session_start();
if (isset($_POST['ubah_absen'])) {
    include '../../config/database.php';

    function input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        mysqli_query($kon,"START TRANSACTION");
        $id_waktu=$_POST["id_waktu"];
        $mulai_absen=input($_POST["mulai_absen"]);
        $akhir_absen=input($_POST["akhir_absen"]);
                
        $sql="update tbl_setting_absensi set
            mulai_absen='$mulai_absen',
            akhir_absen='$akhir_absen'
            where id_waktu=$id_waktu";

        //Mengeksekusi query 
        $update_profil_aplikasi=mysqli_query($kon,$sql);

        //Kondisi apakah berhasil atau tidak dalam mengeksekusi query diatas
        if ($update_profil_aplikasi) {
            mysqli_query($kon,"COMMIT");
            header("Location:../../index.php?page=pengaturan&absen=berhasil");
        }
        else {
            mysqli_query($kon,"ROLLBACK");
            header("Location:../../index.php?page=pengaturan&absen=gagal");
        }
    }
}
?>