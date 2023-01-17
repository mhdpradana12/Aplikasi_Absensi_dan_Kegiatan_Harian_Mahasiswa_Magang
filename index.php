<?php
    //Memulai sesi
    session_start();
    //Jika kode pengguna di session kosong maka kembali ke login
    if (!$_SESSION["kode_pengguna"]){
        header("Location:login.php");
    //Jika kode pengguna ada maka akan di proses masuk ke halaman utama
    } else {
        //Menghubungkan database
        include 'config/database.php';
        //Mengambil variable dari session 
        $kode_pengguna=$_SESSION["kode_pengguna"];
        $username=$_SESSION["username"];
        //Query untuk menampilkan nama ke halaman utama
        $hasil=mysqli_query($kon,"select username from tbl_user where kode_pengguna='$kode_pengguna'");
        //Menyimpan data query ke variable data
        $data = mysqli_fetch_array($hasil); 
        //Menyimpan data username ke variable username
        $username_db=$data['username'];
    //Jika username kosong maka session akan di hapus
    if ($username!=$username_db){
        //Menghapus session
        session_unset();
        session_destroy();
        //Mengalihkan page ke halaman login
        header("Location:login.php");
    }
    }
?>

<?php
    //Menghubungkan database
    include 'config/database.php';
    //Query untuk menampilkan table tbl_site
    $query = mysqli_query($kon, "select * from tbl_site limit 1");    
    //Menyimpan hasil query ke variable
    $row = mysqli_fetch_array($query);
    //Menyimpan nama instansi dari tbl_site
    $nama_instansi=$row['nama_instansi'];
    //Menyimpan logo dari tbl_site
    $logo=$row['logo'];
?>

<!DOCTYPE html>
<html>
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Favicon -->
    <link rel="shortcut icon" href="apps/pengaturan/logo/<?php echo $logo; ?>">
    <!-- Title Website -->
    <title><?php echo $nama_instansi; ?></title>
    <!-- Bootstrap -->
    <link href="template/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="template/css/font-awesome.min.css" rel="stylesheet">
    <!-- Date Picker 3 -->
    <link href="template/css/datepicker3.css" rel="stylesheet">
    <!-- Local CSS -->
    <link href="template/css/styles.css" rel="stylesheet">
    <!-- jQuery -->
    <link rel="stylesheet" href="assets/css/jquery-ui.css">
    <script src="template/js/jquery-2.2.3.min.js"></script>
    <script src="template/js/jquery-1.11.1.min.js"></script>
    <!-- Custom Font -->
    <link href="src/font/font.css" rel="stylesheet" type="text/css">
    <!-- Custom CSS -->
    <style>
        .no-js #loader { display: none;  }
        .js #loader { display: block; position: absolute; left: 100px; top: 0; }
        .se-pre-con {
            position: fixed;
            left: 0px;
            top: 0px;
            width: 100%;
            height: 100%;
            z-index: 9999;
            background: url('loading.gif') center no-repeat #fff;
        }
    </style>
</head>

<body>
<nav class="navbar navbar-custom navbar-fixed-top bg-info" role="navigation">
    <div class="container-fluid"><!-- container-fluid -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#sidebar-collapse"><span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span></button>
            <a class="navbar-brand" href="#">ABSENSI | KEGIATAN</a>
        </div>
    </div><!-- /.container-fluid -->
</nav>
<div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">
    <!-- Menampilkan info nama dan level admin di navbar -->
    <?php if ($_SESSION['level']=='Admin' or $_SESSION['level']=='admin'):?>
        <div class="profile-sidebar">
            <div class="profile-userpic">
                <img src="source/img/profile.png" class="img-responsive" alt="">
            </div>
            <div class="profile-usertitle">
            <?php echo substr($_SESSION['nama_admin'],0,20); ?>
                <div class="profile-usertitle-name"><?php echo "Administrator"; ?></div>
                <div></div>
            </div>
            <div class="clear"></div>
        </div>
    <?php endif; ?>
    <!-- Menampilkan info nama dan level admin di navbar -->

    <!-- Menampilkan info nama dan level mahasiswa di navbar -->
    <?php if ($_SESSION['level']=='Mahasiswa' or $_SESSION['level']=='mahasiswa'):?>
        <div class="profile-sidebar">
            <div class="profile-userpic">
                <img src="apps/mahasiswa/foto/<?php echo $_SESSION['foto'];?>" class="img-responsive" alt="">
            </div>
            <div class="profile-usertitle">
            <?php echo substr($_SESSION['nama_mahasiswa'],0,20); ?>
                <div class="profile-usertitle-name"><?php echo "Mahasiswa"; ?></div>
                <div></div>
            </div>
            <div class="clear"></div>
        </div>
    <?php endif;  ?>
    <!-- Menampilkan info nama dan level mahasiswa di navbar -->

<!-- Side Bar Navigation -->
<div class="divider"></div>
    <!-- Menu Beranda -->
    <ul class="nav menu">
		<li><a href='index.php?page=beranda'><em class='fa fa-home'>&nbsp;</em>  Beranda</a></li>
    <!-- Menu Beranda -->
    <!-- Menu Admin -->
        <?php if ($_SESSION["level"]=="Admin" or $_SESSION['level']=='admin'): ?>
            <li><a href="index.php?page=mahasiswa" id="mahasiswa"><em class="fa fa-users">&nbsp;</em> Data Mahasiswa</a></li>
            <li><a href="index.php?page=data_absensi" id="data_absensi"><em class="fa fa-calendar">&nbsp;</em> Data Absensi</a></li>
            <li><a href="index.php?page=data_kegiatan" id="kegiatan"><em class="fa fa-book">&nbsp;</em> Data Kegiatan</a></li>
            <li><a href="index.php?page=admin" id="admin"><em class="fa fa-user">&nbsp;</em> Administrator</a></li>
            <li><a href="index.php?page=pengaturan" id="pengaturan"><em class="fa fa-gear">&nbsp;</em> Pengaturan</a></li>
            <?php endif; ?>
    <!-- Menu Admin -->
    <!-- Menu Mahasiswa -->
            <?php  if ($_SESSION["level"]=="Mahasiswa" or $_SESSION["level"]=="mahasiswa"): ?>
                <li><a href="index.php?page=absen"><em class="fa fa-calendar-check-o">&nbsp;</em> Absensi</a></li>
                <li><a href="index.php?page=riwayat"><em class="fa fa-history">&nbsp;</em> Riwayat Absensi</a></li>
                <li><a href="index.php?page=kegiatan"><em class="fa fa-book">&nbsp;</em> Kegiatan Harian</a></li>
                <li><a href="index.php?page=profil"><em class="fa fa-user-circle-o">&nbsp;</em> Profil</a></li>    
            <?php endif; ?>
    <!-- Menu Mahasiswa -->
    <!-- Menu Keluar -->    
        <li><a href="logout.php" id="keluar"><em class="fa fa-sign-out">&nbsp;</em> Keluar</a></li>
    </ul>
    <!-- Menu Keluar -->
</div>
<!-- Side Bar Navigation -->

<!-- Page Penghubung -->
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
    <?php 
        if(isset($_GET['page'])){
            $page = $_GET['page'];
            switch ($page) {
                case 'beranda':
                    include "apps/beranda/index.php";
                    break;
                case 'admin':
                    include "apps/admin/index.php";
                    break;
                case 'mahasiswa':
                    include "apps/mahasiswa/index.php";
                    break;
                case 'data_absensi':
                    include "apps/data_absensi/index.php";
                    break;
                case 'data_kegiatan':
                    include "apps/data_kegiatan/index.php";
                    break;
                case 'pengaturan':
                    include "apps/pengaturan/index.php";
                    break;
                case 'absen':
                    include "apps/pengguna/absen.php";
                    break;
                case 'riwayat':
                    include "apps/data_absensi/riwayat.php";
                    break;
                case 'kegiatan':
                    include "apps/data_kegiatan/kegiatan.php";
                    break;
                case 'profil':
                    include "apps/pengguna/profil.php";
                    break;
                default:
                echo "<center><h3>Maaf. Halaman Tidak Di Temukan !</h3></center>";
                break;
            }
        }
    ?>
<!-- Function Page Penghubung -->

    <!--/.row-->
</div>
<!--/.main-->

<!-- Java Script -->
<script src="template/js/bootstrap.min.js"></script>
<script src="template/js/chart.min.js"></script>
<script src="template/js/chart-data.js"></script>
<script src="template/js/easypiechart.js"></script>
<script src="template/js/easypiechart-data.js"></script>
<script src="template/js/bootstrap-datepicker.js"></script>
<script src="template/js/custom.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.2/css/buttons.dataTables.min.css">
<script src="/assets/chart/chart.js"></script>
<!-- Java Script -->

<script>
   // konfirmasi sebelum keluar aplikasi
   $('#keluar').on('click',function(){
        konfirmasi=confirm("Apakah Anda Yakin Ingin Keluar?")
        if (konfirmasi){
            return true;
        }else {
            return false;
        }
    });
</script>
</body>
</html>