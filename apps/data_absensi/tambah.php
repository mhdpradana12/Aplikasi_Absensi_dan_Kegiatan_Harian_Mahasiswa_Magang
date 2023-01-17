<?php
    session_start();
    if (isset($_POST['simpan_absensi'])) {

        include '../../config/database.php';
        
        function input($data) {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }

        $id_mahasiswa=$_POST["id_mahasiswa"];
        $tanggal= $_POST["tanggal"];
        $waktu = $_POST["waktu"];
        $status = $_POST["status"];
        $alasan = $_POST["alasan"];
        
        if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $query = "SELECT * FROM tbl_absensi WHERE id_mahasiswa = '$id_mahasiswa' AND tanggal = '$tanggal'";
        $result = mysqli_query($kon, $query);
    
        if (mysqli_num_rows($result) > 0) {
        } else {
         // Menambahkan data ke tabel absensi
        $sql = "INSERT INTO tbl_absensi (id_mahasiswa,status,waktu,tanggal) VALUES 
            ('$id_mahasiswa',$status,'$waktu','$tanggal')";
            $simpan_absensi=mysqli_query($kon,$sql);
        }
            

        if ($status == "2" AND mysqli_num_rows($result) > 0) {
         $sql = "INSERT INTO tbl_alasan (id_mahasiswa,alasan,tanggal) VALUES 
            ('$id_mahasiswa', '$alasan', '$tanggal')";
            $simpan_izin=mysqli_query($kon,$sql);
        }
    

        // validasi data
        if ($simpan_absensi AND $simpan_izin) {
            mysqli_query($kon,"COMMIT");
            header("Location:../../index.php?page=data_absensi&mulai=berhasil");
        }
        else if ($simpan_absensi) {
            mysqli_query($kon,"COMMIT");
            header("Location:../../index.php?page=data_absensi&mulai=berhasil");
            }
        else {
            mysqli_query($kon,"ROlLBACK");
            header("Location:../../index.php?page=data_absensi&mulai=gagal");
        }
    }
    }
?>


<form action="apps/data_absensi/tambah.php" method="post" enctype="multipart/form-data">
    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                <label>Nama Mahasiswa :</label>
                <select class="form-control" id="id_mahasiswa" name="id_mahasiswa"  required>
                    <?php 
                        include '../../config/database.php';
                        $query = "SELECT id_mahasiswa, nama FROM tbl_mahasiswa WHERE mulai_magang <= CURDATE() AND akhir_magang >= CURDATE();";
                        $result = mysqli_query($kon, $query);
                        while ($data = mysqli_fetch_assoc($result)) {
                          echo "<option value='" . $data['id_mahasiswa'] . "'>" . $data['nama'] . "</option>";
                        }
                    ?>
                </select>
            </div>
        </div>
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
        <div class="col-sm-6">
            <div class="form-group">
                <label>Tanggal Absensi :</label>
                <input type="date" name="tanggal" id="tanggal" class="form-control"  value="">
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <label>Waktu Absensi :</label>
                <input type="time" name="waktu" id="waktu" class="form-control"  value="">
            </div>
        </div>
        <div class="col-sm-12" id="text_alasan" style="display:none;">
            <div class="form-group">
                <label>Alasan :</label>
                <input type="text" name="alasan" id="alasan" class="form-control"  value="" placeholder="Masukkan Alasan Kenapa Izin">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-4">
            <div class="form-group">
                <br>
                <button type="submit" name="simpan_absensi" id="simpan_absensi" class="btn btn-success" ><i class="fa fa-plus"></i> Simpan</button>
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