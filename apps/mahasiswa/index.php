<?php 
    if ($_SESSION["level"]!='Admin' and $_SESSION["level"]!='admin'){
    echo"<br><div class='alert alert-danger'>Tidak memiliki Hak Akses</div>";
    exit;
    }
?>

<div class="row">
    <ol class="breadcrumb">
        <li><a href="index.php?page=beranda">
                <em class="fa fa-home"></em>
            </a></li>
        <li class="active">Data Mahasiswa</li>
    </ol>
</div><!--/.row-->

<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
            Data Mahasiswa
                <span class="pull-right clickable panel-toggle panel-button-tab-left"><em class="fa fa-toggle-up"></em></span></div>
            <div class="panel-body">
                <div class="row">
                <form action="#" method="GET">
                    <input type="hidden" name="page" value="mahasiswa"/>
                        <div class="col-sm-3">
                            <div class="form-group">
                            <input type="text" name="cari" id="cari" class="form-control"  value="" placeholder="Pencarian">
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="form-group">
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
                // Validasi untuk menampilkan pesan pemberitahuan saat user menambah admin
                if (isset($_GET['add'])) {
                    if ($_GET['add']=='berhasil'){
                        echo"<div class='alert alert-success'><strong>Berhasil!</strong> Data Mahasiswa Telah Disimpan</div>";
                    }else if ($_GET['add']=='gagal'){
                        echo"<div class='alert alert-danger'><strong>Gagal!</strong> Data Mahasiswa Gagal Disimpan</div>";
                    }    
                }

                // Validasi untuk menampilkan pesan pemberitahuan saat user mengedit admin
                if (isset($_GET['edit'])) {
                    if ($_GET['edit']=='berhasil'){
                        echo"<div class='alert alert-success'><strong>Berhasil!</strong> Data Mahasiswa Telah Diupdate</div>";
                    }else if ($_GET['edit']=='gagal'){
                        echo"<div class='alert alert-danger'><strong>Gagal!</strong> Data Mahasiswa Gagal Diupdate</div>";
                    }    
                }

                // Validasi untuk menampilkan pesan pemberitahuan saat user menghapus admin
                if (isset($_GET['pengguna'])) {
                    if ($_GET['pengguna']=='berhasil'){
                        echo"<div class='alert alert-success'><strong>Berhasil!</strong> Setting Data Mahasiswa Berhasil</div>";
                    }else if ($_GET['pengguna']=='gagal'){
                        echo"<div class='alert alert-danger'><strong>Gagal!</strong> Setting Data Mahasiswa Gagal</div>";
                    }    
                }

                // Validasi untuk menampilkan pesan pemberitahuan saat user menghapus admin
                if (isset($_GET['hapus'])) {
                    if ($_GET['hapus']=='berhasil'){
                        echo"<div class='alert alert-success'><strong>Berhasil!</strong> Data Mahasiswa Telah Dihapus</div>";
                    }else if ($_GET['hapus']=='gagal'){
                        echo"<div class='alert alert-danger'><strong>Gagal!</strong> Data Mahasiswa Gagal Dihapus</div>";
                    }    
                }
            ?>
                <div class="form-group">
                    <button type="button" class="btn btn-success" id="tombol_tambah"><i class="fa fa-plus"></i> Tambah</button>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Universitas</th>
                                <th>NIM</th>
                                <th>Mulai Magang</th>
                                <th>Ahir Magang</th>
                                <th>Foto</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
        
                        <tbody>

                        <?php
                            include 'config/database.php';
                            if (isset($_GET['cari']) AND $_GET['cari']!="") {
                                $cari=trim($_GET["cari"]);
                                $sql="SELECT * FROM tbl_mahasiswa WHERE 
                                nama LIKE '%$cari%' OR 
                                nim LIKE '%$cari%' OR 
                                universitas LIKE '%$cari%' 
                                OR jurusan LIKE '%$cari%';";
                            } else {
                                $sql="SELECT * FROM tbl_mahasiswa";
                            }
                            $hasil=mysqli_query($kon,$sql);
                            $no=0;
                            while ($data = mysqli_fetch_array($hasil)):
                            $no++;                        
                        ?>

                        <tr>
                            <td><?php echo $no; ?></td>
                            <td><?php echo $data['nama']; ?></td>
                            <td><?php echo $data['universitas']; ?></td>
                            <td><?php echo $data['nim'];?></td>
                            <td><?php echo date('d-m-Y', strtotime($data["mulai_magang"])); ?></td>
                            <td><?php echo date('d-m-Y', strtotime($data["akhir_magang"])); ?></td>
                            <td><img src="apps/mahasiswa/foto/<?php echo $data["foto"]; ?>" width="120"></td>
                            <td>
                                <button id_mahasiswa="<?php echo $data['id_mahasiswa'];?>" class="tombol_detail btn btn-success btn-circle" ><i class="fa fa-mouse-pointer"></i></button>
                                <button kode_mahasiswa="<?php echo $data['kode_mahasiswa'];?>" class="tombol_setting btn btn-primary btn-circle" ><i class="fa fa-user"></i></button>
                                <button id_mahasiswa="<?php echo $data['id_mahasiswa'];?>" class="tombol_edit btn btn-warning btn-circle" ><i class="fa fa-edit"></i></button>
                                <a href="apps/mahasiswa/hapus.php?id_mahasiswa=<?php echo $data['id_mahasiswa']; ?>&kode_mahasiswa=<?php echo $data['kode_mahasiswa']; ?>" class="btn-hapus-mahasiswa btn btn-danger btn-circle" ><i class="fa fa-trash"></i></a>
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

<!-- Data akan di load menggunakan AJAX -->
<script>
    // Tambah admin
    $('#tombol_tambah').on('click',function(){
        $.ajax({
            url: 'apps/mahasiswa/tambah.php',
            method: 'post',
            success:function(data){
                $('#tampil_data').html(data);  
                document.getElementById("judul").innerHTML='Tambah Mahasiswa';
            }
        });
        // Membuka modal
        $('#modal').modal('show');
    });
</script>

<script>
    // Detail Mahasiswa
    $('.tombol_detail').on('click',function(){
        var id_mahasiswa = $(this).attr("id_mahasiswa");
        $.ajax({
            url: 'apps/mahasiswa/detail.php',
            method: 'post',
            data: {id_mahasiswa:id_mahasiswa},
            success:function(data){
                $('#tampil_data').html(data);  
                document.getElementById("judul").innerHTML='Detail Mahasiswa';
            }
        });
        // Membuka modal
        $('#modal').modal('show');
    });
</script>


<script>
    // Setting Mahasiswa
    $('.tombol_setting').on('click',function(){
        var kode_mahasiswa = $(this).attr("kode_mahasiswa");
        $.ajax({
            url: 'apps/mahasiswa/pengguna.php',
            method: 'post',
            data: {kode_mahasiswa:kode_mahasiswa},
            success:function(data){
                $('#tampil_data').html(data);  
                document.getElementById("judul").innerHTML='Setting Mahasiswa';
            }
        });
        // Membuka modal
        $('#modal').modal('show');
    });
</script>


<script>
    // Edit Mahasiswa
    $('.tombol_edit').on('click',function(){
        var id_mahasiswa = $(this).attr("id_mahasiswa");
        $.ajax({
            url: 'apps/mahasiswa/edit.php',
            method: 'post',
            data: {id_mahasiswa:id_mahasiswa},
            success:function(data){
                $('#tampil_data').html(data);  
                document.getElementById("judul").innerHTML='Edit Mahasiswa';
            }
        });
        // Membuka modal
        $('#modal').modal('show');
    });
</script>

<script>
   // Hapus admin
   $('.btn-hapus-mahasiswa').on('click',function(){
        konfirmasi=confirm("Konfirmasi Sebelum Menghapus Mahasiswa?")
        if (konfirmasi){
            return true;
        }else {
            return false;
        }
    });
</script>
<!-- Data akan di load menggunakan AJAX -->