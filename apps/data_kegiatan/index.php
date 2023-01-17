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
        <li class="active">Data Kegiatan</li>
    </ol>
</div><!--/.row-->

<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
            Data Kegiatan
                <span class="pull-right clickable panel-toggle panel-button-tab-left"><em class="fa fa-toggle-up"></em></span></div>
            <div class="panel-body">
                <div class="row">
                <form action="#" method="GET">
                    <input type="hidden" name="page" value="data_kegiatan"/>
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
            
                if (isset($_GET['tambah'])) {
                    if ($_GET['tambah']=='berhasil'){
                        echo"<div class='alert alert-success'><strong>Berhasil!</strong> Menambahkan Kegiatan Harian</div>";
                    }else if ($_GET['mulai']=='tambah'){
                        echo"<div class='alert alert-warning'><strong>Sudah!</strong> Menambahkan Kegiatan Harian</div>";
                    }
                }

                if (isset($_GET['edit'])) {
                    if ($_GET['edit']=='berhasil'){
                        echo"<div class='alert alert-success'><strong>Berhasil!</strong> Mengubah Kegiatan Harian</div>";
                    }else if ($_GET['edit']=='gagal'){
                        echo"<div class='alert alert-danger'><strong>Gagal!</strong> Mengubah Kegiatan Harian</div>";
                    }    
                }

                if (isset($_GET['hapus'])) {
                    if ($_GET['hapus']=='berhasil'){
                        echo"<div class='alert alert-success'><strong>Berhasil!</strong> Menghapus Kegiatan Harian</div>";
                    }else if ($_GET['hapus']=='gagal'){
                        echo"<div class='alert alert-danger'><strong>Gagal!</strong> Menghapus Kegiatan Harian</div>";
                    }    
                }
            ?>

                <div class="form-group">
                    <button type="button" class="btn btn-success" id="tambah_kegiatan"><i class="tambah_kegiatan fa fa-plus"></i>  Tambah</button>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Hari</th>
                                <th>Tanggal</th>
                                <th>Jam</th>
                                <th>Kegiatan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
        
                        <tbody>
                        <?php
                            // include database
                            include 'config/database.php';
                            include 'config/function.php';
 
                            if (isset($_GET['nama']) AND $_GET['nama']!="") {
                                $nama=trim($_GET["nama"]);
                                $tanggal_awal=$_GET["tanggal_awal"];
                                $tanggal_akhir=$_GET["tanggal_akhir"];
                                $sql= CariKegiatan($nama, $tanggal_awal, $tanggal_akhir);
                            } 
                            else { 
                                $sql= DataKegiatan("");
                            }                             
                            $hasil=mysqli_query($kon,$sql);
                            $no=0;
                            while ($data = mysqli_fetch_array($hasil)):
                            $no++;
                        ?>
                        <tr>
                            <td><?php echo $no; ?></td>
                            <td><?php echo $data['nama']; ?></td>
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
                            <td><?php echo $data['waktu']; ?></td>
                            <td><?php echo $data['kegiatan']; ?></td>
                            <td>
                                <button id_mahasiswa="<?php echo $data['id_mahasiswa']; ?>" id_kegiatan="<?php echo $data['id_kegiatan']; ?>" class="ubah_kegiatan cetak btn btn-warning" ><i class="fa fa-edit"></i></button>
                                <a href="apps/data_kegiatan/hapus.php?id_kegiatan=<?php echo $data['id_kegiatan']; ?>" class="btn-hapus-kegiatan btn btn-danger btn-circle" ><i class="fa fa-trash"></i></a>
                                <button id_mahasiswa="<?php echo $data['id_mahasiswa']; ?>" class="cetak_kegiatan btn btn-primary btn-circle" ><i class="fa fa-print"></i></button>
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
    // Tambah kegiatan dari admin
    $('#tambah_kegiatan').on('click',function(){
        $.ajax({
            url: 'apps/data_kegiatan/tambah.php',
            method: 'post',
            success:function(data){
                $('#tampil_data').html(data);  
                document.getElementById("judul").innerHTML='Tambah Kegiatan';
            }
        });
        // Membuka modal
        $('#modal').modal('show');
    });
</script>

<script>
    // Mengubah kegiatan dari admin
    $('.ubah_kegiatan').on('click',function(){
        var id_mahasiswa = $(this).attr("id_mahasiswa");
        var id_kegiatan = $(this).attr("id_kegiatan");
        $.ajax({
            url: 'apps/data_kegiatan/edit.php',
            method: 'POST',
            data: {id_mahasiswa: id_mahasiswa, 
                    id_kegiatan: id_kegiatan},
            success:function(data){
                $('#tampil_data').html(data);  
                document.getElementById("judul").innerHTML='Edit Kegiatan';
            }
        });
        // Membuka modal
        $('#modal').modal('show');
    });
</script>

<script>
// fungsi hapus mahasiswa
   $('.btn-hapus-kegiatan').on('click',function(){
        konfirmasi=confirm("Yakin ingin menghapus kegiatan ini?")
        if (konfirmasi){
            return true;
        }else {
            return false;
        }
    });
</script>

<script>
    // cetak absensi
    $('.cetak_kegiatan').on('click',function(){
        var id_mahasiswa = $(this).attr("id_mahasiswa");
        $.ajax({
            url: 'apps/data_kegiatan/cetak.php',
            method: 'POST',
            data: {id_mahasiswa: id_mahasiswa},
            success:function(data){
                $('#tampil_data').html(data);  
                document.getElementById("judul").innerHTML='Cetak Kegiatan';
            }
        });
        // Membuka modal
        $('#modal').modal('show');
    });
</script>