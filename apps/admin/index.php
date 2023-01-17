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
        <li class="active">Administrator</li>
    </ol>
</div><!--/.row-->

<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
            Administrator

                <span class="pull-right clickable panel-toggle panel-button-tab-left"><em class="fa fa-toggle-up"></em></span></div>
            <div class="panel-body">

            <?php

                // Validasi untuk menampilkan pesan pemberitahuan saat user menambah admin
                if (isset($_GET['add'])) {
                    if ($_GET['add']=='berhasil'){
                        echo"<div class='alert alert-success'><strong>Berhasil!</strong> Administrator Telah Disimpan</div>";
                    }else if ($_GET['add']=='gagal'){
                        echo"<div class='alert alert-danger'><strong>Gagal!</strong> Administrator Gagal Disimpan</div>";
                    }    
                }

                // Validasi untuk menampilkan pesan pemberitahuan saat user mengedit admin
                if (isset($_GET['edit'])) {
                    if ($_GET['edit']=='berhasil'){
                        echo"<div class='alert alert-success'><strong>Berhasil!</strong> Administrator Telah Diupdate</div>";
                    }else if ($_GET['edit']=='gagal'){
                        echo"<div class='alert alert-danger'><strong>Gagal!</strong> Administrator Gagal Diupdate</div>";
                    }    
                }

                // Validasi untuk menampilkan pesan pemberitahuan saat user update admin
                if (isset($_GET['pengguna'])) {
                    if ($_GET['pengguna']=='berhasil'){
                        echo"<div class='alert alert-success'><strong>Berhasil!</strong> Administrator Berhasil Diatur</div>";
                    }else if ($_GET['pengguna']=='gagal'){
                        echo"<div class='alert alert-danger'><strong>Gagal!</strong> Administrator Gagal</div>";
                    }    
                }

                // Validasi untuk menampilkan pesan pemberitahuan saat user menghapus admin
                if (isset($_GET['hapus'])) {
                    if ($_GET['hapus']=='berhasil'){
                        echo"<div class='alert alert-success'><strong>Berhasil!</strong> Administrator Telah Dihapus</div>";
                    }else if ($_GET['hapus']=='gagal'){
                        echo"<div class='alert alert-danger'><strong>Gagal!</strong> Administrator Gagal Dihapus</div>";
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
                                <th>NIP</th>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
        
                        <tbody>

                        <?php
                            // include database
                            include 'config/database.php';
                        
                            $sql="select * from tbl_admin";
                            $hasil=mysqli_query($kon,$sql);
                            $no=0;
                            //Menampilkan data dengan perulangan while
                            while ($data = mysqli_fetch_array($hasil)):
                            $no++;
                        ?>
                        <tr>
                            <td><?php echo $no; ?></td>
                            <td><?php echo $data['nip']; ?></td>
                            <td><?php echo $data['nama']; ?></td>
                            <td><?php echo $data['email']; ?></td>
                            <td>
                                <button kode_admin="<?php echo $data['kode_admin'];?>" class="tombol_setting_pengguna btn btn-primary btn-circle" ><i class="fa fa-user"></i></button>
                                <button id_admin="<?php echo $data['id_admin'];?>" class="tombol_edit btn btn-warning btn-circle" ><i class="fa fa-edit"></i></button>
                                <a href="apps/admin/hapus.php?id_admin=<?php echo $data['id_admin']; ?>&kode_admin=<?php echo $data['kode_admin']; ?>" class="btn-hapus-admin btn btn-danger btn-circle" ><i class="fa fa-trash"></i></a>
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
            url: 'apps/admin/tambah.php',
            method: 'post',
            success:function(data){
                $('#tampil_data').html(data);  
                document.getElementById("judul").innerHTML='Tambah Administrator';
            }
        });
        // Membuka modal
        $('#modal').modal('show');
    });
</script>

<script>
    // Setting admin
    $('.tombol_setting_pengguna').on('click',function(){
        var kode_admin = $(this).attr("kode_admin");
        $.ajax({
            url: 'apps/admin/pengguna.php',
            method: 'post',
            data: {kode_admin:kode_admin},
            success:function(data){
                $('#tampil_data').html(data);  
                document.getElementById("judul").innerHTML='Setting Pengguna';
            }
        });
        // Membuka modal
        $('#modal').modal('show');
    });
</script>


<script>
    // Edit admin
    $('.tombol_edit').on('click',function(){
        var id_admin = $(this).attr("id_admin");
        $.ajax({
            url: 'apps/admin/edit.php',
            method: 'post',
            data: {id_admin:id_admin},
            success:function(data){
                $('#tampil_data').html(data);  
                document.getElementById("judul").innerHTML='Edit Administator';
            }
        });
        // Membuka modal
        $('#modal').modal('show');
    });
</script>

<script>
   // Hapus admin
   $('.btn-hapus-admin').on('click',function(){
        konfirmasi=confirm("Konfirmasi Sebelum Menghapus Administator?")
        if (konfirmasi){
            return true;
        }else {
            return false;
        }
    });
</script>
<!-- Data akan di load menggunakan AJAX -->