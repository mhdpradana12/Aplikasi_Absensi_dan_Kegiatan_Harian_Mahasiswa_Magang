<?php
    session_start();
    if (isset($_POST['simpan_kegiatan'])) {
        
        include '../../config/database.php';
        function input($data) {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }

        $id_mahasiswa=$_SESSION["id_mahasiswa"];
        date_default_timezone_set("Asia/Jakarta");
        $kegiatan = $_POST["kegiatan"];
        $waktu_awal = $_POST["waktu_awal"];
        $waktu_akhir = $_POST["waktu_akhir"];
        $tanggal= date("Y-m-d");
        if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $sql = "INSERT INTO tbl_kegiatan (id_mahasiswa,kegiatan,waktu_awal,waktu_akhir,tanggal) 
        VALUES ('$id_mahasiswa','$kegiatan','$waktu_awal','$waktu_akhir','$tanggal')";

        $simpan_kegiatan=mysqli_query($kon,$sql);
        

        // validasi data
        if ($simpan_kegiatan) {
            mysqli_query($kon,"COMMIT");
            header("Location:../../index.php?page=kegiatan&tambah=berhasil");
        }
        else {
            mysqli_query($kon,"ROlLBACK");
            header("Location:../../index.php?page=kegiatan&tambah=gagal");
        }
        }
    }
?>

<form action="apps/pengguna/mulai_kegiatan.php" method="post" enctype="multipart/form-data">
    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                <label>Waktu Awal Kegiatan :</label>
                <input type="time" name="waktu_awal" class="form-control"  value="" required>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <label>Waktu Akhir Kegiatan :</label>
                <input type="time" name="waktu_akhir" class="form-control"  value="" required>
            </div>
        </div>
        <div class="col-sm-12">
            <div class="form-group">
                <label>Kegiatan :</label>
                <input type="text" name="kegiatan" class="form-control"  value="" placeholder="Masukkan Kegiatan Anda?" required>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-4">
            <div class="form-group">
                <br>
                <button type="submit" name="simpan_kegiatan" id="simpan_kegiatan" class="simpan_kegiatan btn btn-success" ><i class="fa fa-plus"></i> Simpan</button>
                <button type="reset" class="btn btn-warning" ><i class="fa fa-trash"></i> Hapus</button>
            </div>
        </div>
    </div>
</form>

<script>
    $('#simpan_kegiatan').on('click',function(){
        konfirmasi=confirm("Yakin ingin menyimpan kegiatan ini?")
        if (konfirmasi){
            return true;
        }else {
            return false;
        }
    });
</script>