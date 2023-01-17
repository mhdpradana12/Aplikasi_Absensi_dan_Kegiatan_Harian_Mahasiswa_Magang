<?php 
    if ($_SESSION["level"]!='Admin' and $_SESSION["level"]!='admin'){
        echo"<br><div class='alert alert-danger'>Tidak Memiliki Hak Akses</div>";
        exit;
    }
?>

<div class="row">
    <ol class="breadcrumb">
        <li><a href="index.php?page=beranda">
                <em class="fa fa-home"></em>
            </a></li>
        <li class="active">Data Absensi</li>
    </ol>
</div><!--/.row-->

<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
            Data Absensi
                <span class="pull-right clickable panel-toggle panel-button-tab-left"><em class="fa fa-toggle-up"></em></span></div>
            <div class="panel-body">
                <div class="row">
                <form action="#" method="GET">
                    <input type="hidden" name="page" value="data_absensi"/>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label>Nama Mahasiswa :</label>
                            <input type="text" name="nama" id="nama" class="form-control"  value="" placeholder="Cari Mahasiswa" required>
                        </div>
                    </div>
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

            
            
            <?php
                // Validasi untuk menampilkan pesan pemberitahuan saat user update pengaturan aplikasi                
                if (isset($_GET['mulai'])) {
                    if ($_GET['mulai']=='berhasil'){
                        echo"<div class='alert alert-success'><strong>Berhasil!</strong> Daya Absensi Berhasil Ditambah</div>";
                    }else if ($_GET['mulai']=='gagal'){
                        echo"<div class='alert alert-warning'><strong>Maaf!</strong> Data Absensi Sudah Ada</div>";
                    }
                }
            ?>

                <div class="form-group">
                    <button type="button" class="btn btn-success" id="tambah_absensi"><i class="tambah_absensi fa fa-plus"></i> Absensi</button>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Universitas</th>
                                <th>Status</th>
                                <th>Waktu</th>
                                <th>Hari</th>
                                <th>Tanggal</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
        
                        <tbody>
                        <?php
                            include 'config/database.php';
                            include 'config/function.php';
                            if (isset($_GET['nama']) AND $_GET['nama']!="") {
                                $nama=trim($_GET["nama"]);
                                $tanggal_awal=$_GET["tanggal_awal"];
                                $tanggal_akhir=$_GET["tanggal_akhir"];
                                $sql= PencarianAbsensi($nama, $tanggal_awal, $tanggal_akhir);
                            } else {
                                $sql= AbsensiOtomatis('');
                            }                            
                            $hasil=mysqli_query($kon,$sql);
                            $no=0;
                            //Menampilkan data dengan perulangan while
                            while ($data = mysqli_fetch_array($hasil)):
                            $no++;
                        ?>
                        <tr>
                            <td><?php echo $no; ?></td>
                            <td><?php echo $data['nama']; ?></td>
                            <td><?php echo $data['universitas']; ?></td>
                            <td><?php echo $data['status']; ?></td>
                            <td><?php echo $data['waktu']; ?></td>
                            <td>
                                <?php
                                    $hari = $data["hari"];
                                    echo MendapatkanHari($hari);
                                ?>
                            </td>
                            <td>
                                <?php
                                    $tgl = date("d", strtotime($data['tanggal']));
                                    $bulan = date("m", strtotime($data['tanggal']));
                                    $tahun = date("Y", strtotime($data['tanggal']));
                                    echo $tgl.' '.MendapatkanBulan($bulan).' '.$tahun
                                ?>
                            </td>
                            <td>
                                <button id_mahasiswa="<?php echo $data['id_mahasiswa']; ?>" id_absensi="<?php echo $data['id_absensi']; ?>" class="absensi btn btn-success btn-circle" ><i class="fa fa-clock-o"></i> Absensi</button>
                                <button id_mahasiswa="<?php echo $data['id_mahasiswa']; ?>" class="cetak btn btn-primary btn-circle" ><i class="fa fa-print"></i> Cetak</button>
                            </td>
                        </tr>
                        <!-- bagian akhir (penutup) while -->
                        <?php endwhile; ?>
                        </tbody>
                    </table>
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
            </div>  
        </div>
  
        <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
        </div>

        </div>
    </div>
</div>

<script>
    //Menambahkan absensi oleh admin
    $('#tambah_absensi').on('click',function(){
        $.ajax({
            url: 'apps/data_absensi/tambah.php',
            method: 'post',
            success:function(data){
                $('#tampil_data').html(data);  
                document.getElementById("judul").innerHTML='Tambah Absensi';
            }
        });
        // Membuka modal
        $('#modal').modal('show');
    });
</script>

<script>
    //Mengubah absensi oleh admin
    $('.absensi').on('click',function(){
        var id_mahasiswa = $(this).attr("id_mahasiswa");
        var id_absensi = $(this).attr("id_absensi");
        $.ajax({
            url: 'apps/data_absensi/absensi.php',
            method: 'POST',
            data: {id_mahasiswa: id_mahasiswa, 
                    id_absensi: id_absensi},
            success:function(data){
                $('#tampil_data').html(data);  
                document.getElementById("judul").innerHTML='Mulai Absensi';
            }
        });
        // Membuka modal
        $('#modal').modal('show');
    });
</script>

<script>
    //Cetak Absensi
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