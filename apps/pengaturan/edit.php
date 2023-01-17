<?php
session_start();
if (isset($_POST['ubah_aplikasi'])) {
    include '../../config/database.php';
    
    function input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        mysqli_query($kon,"START TRANSACTION");
        $id_site=$_POST["id"];
        $nama_instansi=input($_POST["nama_instansi"]);
        $pimpinan=input($_POST["pimpinan"]);
        $pembimbing=input($_POST["pembimbing"]);
        $no_telp=input($_POST["no_telp"]);
        $alamat=input($_POST["alamat"]);
        $website=input($_POST["website"]);
        $logo_sebelumnya=input($_POST["logo_sebelumnya"]);
        $logo = $_FILES['logo']['name'];
        $ekstensi_diperbolehkan	= array('png','jpg','jpeg');
        $x = explode('.', $logo);
        $ekstensi = strtolower(end($x));
        $ukuran	= $_FILES['logo']['size'];
        $file_tmp = $_FILES['logo']['tmp_name'];	

        if (!empty($logo)){
            if(in_array($ekstensi, $ekstensi_diperbolehkan) === true){

                //Mengupload logo yang baru
                move_uploaded_file($file_tmp, 'logo/'.$logo);

                //Menghapus logo sebelumya
                unlink("logo/".$logo_sebelumnya);
                
                $sql="UPDATE tbl_site SET
                nama_instansi='$nama_instansi',
                pimpinan='$pimpinan',
                pembimbing='$pembimbing',
                no_telp='$no_telp',
                alamat='$alamat',
                website='$website',
                logo='$logo'
                WHERE id_site=$id";
            }
        }else {
            $sql="UPDATE tbl_site SET
            nama_instansi='$nama_instansi',
            pimpinan='$pimpinan',
            pembimbing='$pembimbing',
            no_telp='$no_telp',
            alamat='$alamat',
            website='$website'
            WHERE id_site=$id";
        }
        //Mengeksekusi query 
        $update_profil_aplikasi=mysqli_query($kon,$sql);
        //Kondisi apakah berhasil atau tidak dalam mengeksekusi query diatas
        if ($update_profil_aplikasi) {
            mysqli_query($kon,"COMMIT");
            header("Location:../../index.php?page=pengaturan&edit=berhasil");
        }
        else {
            mysqli_query($kon,"ROLLBACK");
            header("Location:../../index.php?page=pengaturan&edit=gagal");
        }
    }
}
?>