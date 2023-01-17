<?php
    session_start();
?>

<form action="apps/cetak/cetak_absensi.php" method="GET" enctype="multipart/form-data">
    <div class="row">
    <div class="col-sm-6">
        <div class="form-group">

                <!-- Input untuk menyimpan id untuk proses query  -->
                <input type="hidden" name="id_mahasiswa" value="<?php echo $_POST['id_mahasiswa']; ?>">
                <!-- ----- -->

                <label>Tanggal Awal :</label>
                <input type="date" name="tanggal_awal" class="form-control" value="" required>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <label>Tanggal Akhir :</label>
                <input type="date" name="tanggal_akhir" class="form-control"  value="" required>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-4">
            <div class="form-group">
                <br>
                <button type="submit" name="cetak" id="cetak" class="btn btn-primary" ><i class="fa fa-print"></i> Cetak</button>
            </div>
        </div>
    </div>
</form>