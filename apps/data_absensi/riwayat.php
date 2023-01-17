<div class="row">
    <ol class="breadcrumb">
        <li><a href="index.php?page=beranda">
                <em class="fa fa-home"></em>
            </a></li>
        <li class="active">Riwayat Absensi</li>
    </ol>
</div><!--/.row-->

<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
            Riwayat Absensi
            <span class="pull-right clickable panel-toggle panel-button-tab-left"><em class="fa fa-toggle-up"></em></span></div>
            <div class="panel-body">
            <div class="row">
                <form action="#" method="GET">
                    <input type="hidden" name="page" value="riwayat"/>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label>Tanggal Awal :</label>
                            <input type="date" name="tanggal_awal" id="tanggal_awal" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label>Tanggal Akhir :</label>
                            <input type="date" name="tanggal_akhir" id="tanggal_akhir" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            </br>
                            <button type="submit" class="btn btn-info"><i class="fa fa-search"></i> Cari</button>
                        </div>
                    </div>
                </form>
                </div>
            </div>
        </div>
    </div>
</div><!--/.row-->

<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-body">
                
                <div class="form-group">
                    <button id_mahasiswa='<?php echo $_SESSION['id_mahasiswa']; ?>' type="button" class="cetak btn btn-primary" id="cetak"><i class="fa fa-print"></i> Cetak</button>
                </div>
                <table class="table table-bordered table-center" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th class="text-center">No</th>
                                <th class="text-center">Hari</th>
                                <th class="text-center">Tanggal</th>
                                <th class="text-center">Waktu</th>
                                <th class="text-center">Kehadiran</th>
                                <th class="text-center">Keterangan</th>
                            </tr>
                        </thead>
        
                        <tbody>
                        <?php
                            // include database
                            include 'config/database.php';
                            include 'config/function.php';
                            $id_mahasiswa=$_SESSION["id_mahasiswa"];
                            if (isset($_GET['tanggal_awal']) AND $_GET['tanggal_akhir']) {
                                $tanggal_awal=$_GET["tanggal_awal"];
                                $tanggal_akhir=$_GET["tanggal_akhir"];
                                $sql= "SELECT tbl_absensi.id_absensi, tbl_absensi.id_mahasiswa, tbl_alasan.id_alasan, 
                                DAYNAME(tbl_absensi.tanggal) AS hari,
                                tbl_absensi.waktu,
                                tbl_absensi.tanggal,
                                IFNULL(tbl_alasan.alasan, ' - ') AS alasan,
                                  (CASE
                                    WHEN tbl_absensi.status = 1 THEN 'Hadir'
                                    WHEN tbl_absensi.status = 2 THEN 'Izin'
                                    WHEN tbl_absensi.status = 3 THEN 'Tidak Hadir'
                                    ELSE 'Belum Absensi'
                                END) AS status
                                FROM tbl_absensi
                                LEFT JOIN tbl_alasan ON tbl_absensi.tanggal = tbl_alasan.tanggal AND tbl_absensi.id_mahasiswa = tbl_alasan.id_mahasiswa
                                WHERE tbl_absensi.id_mahasiswa = '$id_mahasiswa' AND
                                tbl_absensi.tanggal >= '$tanggal_awal' AND
                                tbl_absensi.tanggal <= '$tanggal_akhir'
                                ORDER BY tbl_absensi.tanggal DESC;";
                            } else {
                                $sql="SELECT tbl_absensi.id_absensi, tbl_absensi.id_mahasiswa, tbl_alasan.id_alasan, 
                                DAYNAME(tbl_absensi.tanggal) AS hari,
                                tbl_absensi.waktu,
                                tbl_absensi.tanggal,
                                IFNULL(tbl_alasan.alasan, ' - ') AS alasan,
                                  (CASE
                                    WHEN tbl_absensi.status = 1 THEN 'Hadir'
                                    WHEN tbl_absensi.status = 2 THEN 'Izin'
                                    WHEN tbl_absensi.status = 3 THEN 'Tidak Hadir'
                                    ELSE 'Belum Absensi'
                                END) AS status
                                FROM tbl_absensi
                                LEFT JOIN tbl_alasan ON tbl_absensi.tanggal = tbl_alasan.tanggal AND tbl_absensi.id_mahasiswa = tbl_alasan.id_mahasiswa
                                WHERE tbl_absensi.id_mahasiswa = '$id_mahasiswa'
                                ORDER BY tbl_absensi.tanggal DESC;";
                            }                           
                            $hasil=mysqli_query($kon,$sql);
                            $no=0;
                            //Menampilkan data dengan perulangan while
                            while ($data = mysqli_fetch_array($hasil)):
                            $no++;
                        ?>
                        <tr>
                            <td class="text-center"><?php echo $no; ?></td>
                            <td class="text-center">
                                <?php
                                    $hari = $data['hari'];
                                    echo MendapatkanHari($hari);
                                ?>
                            </td>
                            <td class="text-center">
                                <?php 
                                $tgl = date("d", strtotime($data['tanggal']));
                                $bulan = date("m", strtotime($data['tanggal']));
                                $tahun = date("Y", strtotime($data['tanggal']));
                                echo $tgl.' '.MendapatkanBulan($bulan).' '.$tahun
                                ?>
                            </td>
                            <td class="text-center"><?php echo $data['waktu']; ?></td> 
                            <td class="text-center"><?php echo $data['status']; ?></td>
                            <td class="text-center"><?php echo $data['alasan']; ?></td>                         
                        </tr>
                        <!-- bagian akhir (penutup) while -->
                        <?php endwhile; ?>
                        </tbody>
                    </table>
                <div class="form-group">
                </div>
            </div>
        </div>
    </div>
</div><!--/.row-->

<!-- Modal -->
<div class="modal fade" id="modal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

        <div class="modal-header">
            <h4 class="modal-title" id="judul"></h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <div class="modal-body">
            <div id="tampil_data">
                 <!-- Data akan di load menggunakan AJAX -->                   
            </div>  
        </div>
  
        <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
        </div>

        </div>
    </div>
</div>

<script>
    // Setting absensi
    $('.cetak').on('click',function(){
        var id_mahasiswa = $(this).attr("id_mahasiswa");
        $.ajax({
            url: 'apps/data_absensi/cetak.php',
            method: 'POST',
            data: {id_mahasiswa: id_mahasiswa},
            success:function(data){
                $('#tampil_data').html(data);  
                document.getElementById("judul").innerHTML='Cetak Absensi';
            }
        });
        // Membuka modal
        $('#modal').modal('show');
    });
</script>