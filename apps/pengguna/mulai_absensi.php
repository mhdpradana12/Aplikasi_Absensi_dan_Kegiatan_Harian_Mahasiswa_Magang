<?php
    session_start();
    if (isset($_POST['submit'])) {
        //Include file koneksi, untuk koneksikan ke database
        include '../../config/database.php';
        function input($data) {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }
        // Mengambil data dari form absensi
        $id_mahasiswa=$_SESSION["id_mahasiswa"];
        $status = $_POST["status"];
        date_default_timezone_set("Asia/Jakarta");
        $tanggal= date("Y-m-d");
        $waktu = date("H:i:s");
        $alasan = $_POST["alasan"];
        //Cek apakah ada kiriman form dari method post
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $cek_waktu="SELECT CONCAT(CURDATE(), ' ', mulai_absen) as mulai_absen, CONCAT(CURDATE(), ' ', akhir_absen) as akhir_absen, NOW() as waktu_sekarang FROM tbl_setting_absensi LIMIT 1;";
        $query=mysqli_query($kon,$cek_waktu);
        $setting = mysqli_fetch_array($query);
        $mulai_absen=$setting["mulai_absen"];
        $akhir_absen=$setting["akhir_absen"];
        $waktu_sekarang=$setting["waktu_sekarang"];
        if ($waktu_sekarang >= $mulai_absen && $waktu_sekarang <= $akhir_absen) {
            // Menambahkan data ke tabel absensi
            $sql = "INSERT INTO tbl_absensi (id_mahasiswa,status,waktu,tanggal) VALUES 
                ('$id_mahasiswa',$status,'$waktu','$tanggal')";
            $simpan_absensi=mysqli_query($kon,$sql);
        } else {

        }

        if ($status == "2" ) {
        $sql = "INSERT INTO tbl_alasan (id_mahasiswa,alasan,tanggal) VALUES 
            ('$id_mahasiswa', '$alasan', '$tanggal')";
        $simpan_izin=mysqli_query($kon,$sql);
        }

        // validasi data
        if ($simpan_absensi AND $simpan_izin) {
            mysqli_query($kon,"COMMIT");
            header("Location:../../index.php?page=absen&mulai=berhasil");
        } if ($simpan_absensi) {
            mysqli_query($kon,"COMMIT");
            header("Location:../../index.php?page=absen&mulai=berhasil");
        } else {
            mysqli_query($kon,"ROlLBACK");
            header("Location:../../index.php?page=absen&mulai=gagal");
        }
        }
    }
?>

<?php
    $id_mahasiswa=$_SESSION["id_mahasiswa"];
    $nama_mahasiswa=$_SESSION["nama_mahasiswa"];
    $tanggal= date("Y-m-d");
    include '../../config/database.php';
    $query = mysqli_query($kon, 
    "SELECT mulai_magang, akhir_magang FROM tbl_mahasiswa WHERE id_mahasiswa=$id_mahasiswa;");
    $periode= mysqli_fetch_array($query);
    $tanggal_masuk= $periode["mulai_magang"];
    $tanggal_keluar= $periode["akhir_magang"];
?>

<?php
    $tanggal_sekarang = date("Y-m-d");
    $query = "SELECT COUNT(*) FROM tbl_absensi WHERE tanggal = '$tanggal_sekarang' AND id_mahasiswa = '$id_mahasiswa'";
    $result = mysqli_query($kon, $query);
    $data = mysqli_fetch_assoc($result);
    if ($data['COUNT(*)'] > 0) {
        $absensi_sudah = "disabled";
    } else {
        $absensi_sudah = "";
    }  
?>

<form action="apps/pengguna/mulai_absensi.php" method="post" enctype="multipart/form-data">
    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                <label>Status :</label>
                <select class="form-control" id="status" name="status"  required>
                <option>Pilih</option>
                    <option value="1">Hadir</option>
                    <option value="2">Izin</option>
                    <option value="3">Tidak Hadir</option>
                </select>
            </div>
        </div>
        <div class="col-sm-6" id="text_alasan" style="display:none;">
            <div class="form-group">
                <label>Alasan :</label>
                <input type="text" name="alasan" id="alasan" class="form-control"  value="" placeholder="Masukkan Alasan Kenapa Izin?">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-4">
            <div class="form-group">
                <br>
                <button type="submit" name="submit" id="tombol_hari" class="simpan_absensi btn btn-primary" <?php echo $absensi_sudah; ?>><i class="fa fa-clock-o"></i> Absensi</button>
            </div>
        </div>
    </div>
</form>

<script>
$(document).ready(function() {
    $("#status").change(function() {
      // Menampilkan input teks jika opsi "izin" dipilih
    if ($(this).val() == "2") {
        $("#text_alasan").show();
        $("#alasan").attr("required", true);
    } else {
        $("#text_alasan").hide();
        $("#alasan").attr("required", false);
    }
    });
});
</script>

<script>
    $(document).ready(function() {
        var hari = new Date().getDay(); 
        if (hari == 0 || hari == 6) {
    $('#tombol_hari').attr('disabled', true);
        }
    });
</script>

<script>
    $('.simpan_absensi').on('click',function(){
        konfirmasi=confirm("Konfirmasi sebelum absen?")
        if (konfirmasi){
            return true;
        }else {
            return false;
        }
    });
</script>