<div class="row">
    <ol class="breadcrumb">
        <li><a href="index.php?page=beranda">
                <em class="fa fa-home"></em>
            </a></li>
        <li class="active">Kegiatan Harian</li>
    </ol>
</div><!--/.row-->

<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
            Kegiatan Harian
                <span class="pull-right clickable panel-toggle panel-button-tab-left"><em class="fa fa-toggle-up"></em></span></div>
            <div class="panel-body">
            <div id="div_periode" class='alert alert-warning'><strong>Periode Kegiatan Harian Selesai</strong></div>
                <div class="row">
                <form action="#" method="GET">
                    <input type="hidden" name="page" value="kegiatan"/>
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

<?php
    include 'config/database.php';
    $id_mahasiswa=$_SESSION["id_mahasiswa"];
    $sql="select * from tbl_mahasiswa where id_mahasiswa=$id_mahasiswa limit 1";
    $hasil=mysqli_query($kon,$sql);
    $data = mysqli_fetch_array($hasil);
    $mulai_magang=$data['mulai_magang'];
    $akhir_magang=$data['akhir_magang'];

    setlocale(LC_TIME, 'id_ID');
    $tanggal_sekarang = new DateTime();
    $tanggal_masuk = strftime("%d %B %Y", strtotime($mulai_magang));
    $tanggal_keluar = strftime("%d %B %Y", strtotime($akhir_magang));
?>

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
            ?>

                <div class="form-group">
                    <button id_mahasiswa="<?php echo $_SESSION['id_mahasiswa']; ?>" type="button" class="btn btn-success" id="tombol_kegiatan"><i class="fa fa-plus"></i>  Tambah</button>
                    <button id_mahasiswa="<?php echo $_SESSION['id_mahasiswa']; ?>" class="cetak_kegiatan btn btn-primary btn-circle" id="cetak_kegiatan"><i class="fa fa-print"></i> Cetak</button>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th class="text-center">No</th>
                                <th class="text-center">Hari</th>
                                <th class="text-center">Tanggal</th>
                                <th class="text-center">Jam</th>
                                <th class="text-center">Kegiatan</th>
                            </tr>
                        </thead>
        
                        <tbody>
                        <?php
                            include 'config/database.php';
                            include 'config/function.php';
                            $id_mahasiswa= $_SESSION["id_mahasiswa"];
                            if (isset($_GET['tanggal_awal']) AND $_GET['tanggal_akhir']) {
                                $tanggal_awal=$_GET["tanggal_awal"];
                                $tanggal_akhir=$_GET["tanggal_akhir"];
                                $sql= MencarikanKegiatan($id_mahasiswa, $tanggal_awal, $tanggal_akhir);
                            } 
                            else { 
                            $sql= MenampilkanKegiatan($id_mahasiswa);
                            }                          
                            $hasil=mysqli_query($kon,$sql);
                            $no=0;
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
                            <td class="text-center">
                                <?php 
                                $string_kegiatan = $data['kegiatan'];
                                echo WaktuKegiatan($string_kegiatan);
                                ?>
                            </td> 
                            <td class="">
                                <?php
                                // Ambil string kegiatan
                                $string_kegiatan = $data['kegiatan'];
                                echo BarisKegiatan($string_kegiatan);
                                ?>
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
    $('#tombol_kegiatan').on('click',function(){
        var id_mahasiswa = $(this).attr("id_mahasiswa");
        $.ajax({
            url: 'apps/pengguna/mulai_kegiatan.php',
            method: 'POST',
            data: {id_mahasiswa: id_mahasiswa},
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
    $('#cetak_kegiatan').on('click',function(){
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

<script>
    $(document).ready(function() {
        var hari = new Date().getDay();
        if (hari == 0 || hari == 6) {
    $('#tombol_kegiatan').attr('disabled', true);
        }
    });
</script>

<script>
    $(document).ready(function() {
        var tanggal_sekarang = new Date();
        var tanggal_keluar = new Date("<?php echo $tanggal_keluar; ?>");
        if (tanggal_sekarang > tanggal_keluar) {
            $("#tombol_kegiatan").hide();
            $("#div_periode").show();
        } else {
            $("#div_periode").hide();
        }
    });
</script>