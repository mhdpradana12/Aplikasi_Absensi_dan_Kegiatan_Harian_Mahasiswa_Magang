<?php
    session_start();
    if (isset($_POST['submit_absensi'])) {
        include '../../config/database.php';

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
        mysqli_query($kon,"START TRANSACTION");
        
        function input($data) {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }
            
        $id_mahasiswa = $_POST['id_mahasiswa'];
        $id_absensi = $_POST['id_absensi'];
        $id_alasan = $_POST['id_alasan'];
        $status = $_POST["status"];
        $tanggal= $_POST["tanggal"];
        $waktu = $_POST["waktu"];
        $alasan = $_POST["alasan"];

        if (empty($id_absensi)) {
            $sql = "INSERT INTO tbl_absensi (id_mahasiswa, status, tanggal, waktu)
            VALUES ('$id_mahasiswa', '$status', '$tanggal', '$waktu')";
        } else {
            $sql = "UPDATE tbl_absensi SET 
            id_mahasiswa = '$id_mahasiswa', 
            status = '$status', 
            tanggal = '$tanggal', 
            waktu = '$waktu' 
            WHERE id_absensi = '$id_absensi'";
        }
        $simpan_absensi = mysqli_query($kon, $sql);
        
        if (empty($id_alasan)) {
            $sql = "INSERT INTO tbl_alasan (id_mahasiswa,alasan,tanggal) 
            VALUES ('$id_mahasiswa', '$alasan', '$tanggal')";
        } else {
            $sql = "UPDATE tbl_alasan SET
            id_mahasiswa = '$id_mahasiswa', 
            alasan = '$alasan', 
            tanggal = '$tanggal' 
            WHERE id_alasan = '$id_alasan';";
        }
        //Menyimpan hasil query alasan
        $simpan_izin=mysqli_query($kon,$sql);

        if ($simpan_absensi AND $simpan_izin) {
            mysqli_query($kon,"COMMIT");
            header("Location:../../index.php?page=data_absensi&mulai=berhasil");
        } else if ($simpan_absensi) {
            mysqli_query($kon,"COMMIT");
            header("Location:../../index.php?page=data_absensi&mulai=berhasil");
        } else {
        // validasi data jika gagal
            mysqli_query($kon,"ROlLBACK");
            header("Location:../../index.php?page=data_absensi&mulai=gagal");
        }
        }
    }
?>

<?php
    $id_absensi = $_POST['id_absensi'];
    include '../../config/database.php';
    include '../../config/function.php';

    $sql = EditAbsensi($id_absensi);
    $result = $kon->query($sql);
    
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $id_mahasiswa = $row['id_mahasiswa'];
        $status = $row['status'];
        $tanggal = $row['tanggal'];
        $waktu = $row['waktu'];
    } else {
        $id_mahasiswa = "";
        $status = "";
        date_default_timezone_set("Asia/Jakarta");
        $tanggal= date("Y-m-d");
        $waktu = date("H:i:s");
    }
?>

<?php
    include '../../config/database.php';


    $query = "SELECT id_alasan, alasan FROM tbl_alasan WHERE id_mahasiswa = '$id_mahasiswa' AND tanggal = '$tanggal';";
    $result = $kon->query($query);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $id_alasan = $row['id_alasan'];
        $alasan = $row['alasan'];
    } else {
        $id_alasan = "";
        $alasan = "";
    }
?>

<form action="apps/data_absensi/absensi.php" method="post" enctype="multipart/form-data">
    <div class="row">
    <div class="col-sm-6">
        <div class="form-group">

                <!-- Input untuk menyimpan id untuk proses query  -->
                <input type="hidden" name="id_mahasiswa" value="<?php echo $_POST['id_mahasiswa']; ?>">
                <input type="hidden" name="id_absensi" value="<?php echo $_POST['id_absensi']; ?>">
                <input type="hidden" name="id_alasan" value="<?php echo $id_alasan; ?>">
                <!-- Input untuk menyimpan id untuk proses query -->

                <label>Tanggal Absensi :</label>
                <input type="date" name="tanggal" class="form-control" value="<?php echo $tanggal; ?>" required>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <label>Waktu Absensi :</label>
                <input type="time" name="waktu" class="form-control"  value="<?php echo $waktu; ?>" required>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <label>Status Absensi :</label>
                <select class="form-control" id="status" name="status"  required>
                    <option value="0" <?php if ($status == 0) echo 'selected'; ?>>Pilih</option>
                    <option value="1" <?php if ($status == 1) echo 'selected'; ?>>Hadir</option>
                    <option value="2" <?php if ($status == 2) echo 'selected'; ?>>Izin</option>
                    <option value="3" <?php if ($status == 3) echo 'selected'; ?>>Tidak Hadir</option>
                </select>
            </div>
        </div>
        <div class="col-sm-6" id="text_alasan" style="display:none;">
            <div class="form-group">
                <label>Alasan :</label>
                <input type="text" name="alasan" id="alasan" class="form-control" value="<?php echo $alasan; ?>" placeholder="Masukkan alasan jika menghapus harap ketik 'delete'">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-4">
            <div class="form-group">
                <br>
                <button type="submit" name="submit_absensi" id="submit_absensi" class="btn btn-success" ><i class="fa fa-clock-o"></i> Simpan</button>
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
$(document).ready(function(){
  if('<?php echo $status; ?>' == "2"){
    $('#text_alasan').show();
    $("#alasan").attr("required", true);
  } else {
    $('#text_alasan').hide();
    $("#alasan").attr("required", true);
  }
});
</script>