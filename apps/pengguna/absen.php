<?php 
    if ($_SESSION["level"]!='Mahasiswa' and $_SESSION["level"]!='mahasiswa'){
    echo"<br><div class='alert alert-danger'>Tidak Memiliki Hak Akses</div>";
    exit;
    }
?>

<?php
    // Mengambil data dari sessi login
    include 'config/database.php';
    $id_mahasiswa=$_SESSION["id_mahasiswa"];
    $sql="select * from tbl_mahasiswa where id_mahasiswa=$id_mahasiswa limit 1";
    $hasil=mysqli_query($kon,$sql);
    $data = mysqli_fetch_array($hasil);
    $nama=$data['nama'];
    $universitas=$data['universitas'];
    $nim=$data['nim'];
    $mulai_magang=$data['mulai_magang'];
    $akhir_magang=$data['akhir_magang'];
    $foto=$data['foto'];

    // Mengubah format tanggal ke bahasa Indonesia
    setlocale(LC_TIME, 'id_ID');
    $tanggal_sekarang = new DateTime();
    $tanggal_masuk = strftime("%d %B %Y", strtotime($mulai_magang));
    $tanggal_keluar = strftime("%d %B %Y", strtotime($akhir_magang));
?>

<?php
    // Mengambil data dari sessi login
    include 'config/database.php';
    $sql="select * from tbl_setting_absensi limit 1";
    $query=mysqli_query($kon,$sql);
    $setting = mysqli_fetch_array($query);
    $mulai_absen=$setting['mulai_absen'];
    $akhir_absen=$setting['akhir_absen'];
?>

<div class="row">
    <ol class="breadcrumb">
        <li><a href="index.php?page=absen">
                <em class="fa fa-home"></em>
            </a></li>
        <li class="active">Beranda</li>
    </ol>
</div>
<!--/.row-->

<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">Absensi</div>
            <div class="panel-body">
            <div id="div_periode" class='alert alert-warning'><strong>Periode Absensi Selesai</strong></div>

            <?php
                // Validasi untuk menampilkan pesan pemberitahuan saat user update pengaturan aplikasi                
                if (isset($_GET['mulai'])) {
                    if ($_GET['mulai']=='berhasil'){
                        echo"<div class='alert alert-success'><strong>Berhasil!</strong> Absensi</div>";
                    }  else if ($_GET['mulai']=='gagal'){
                        echo"<div class='alert alert-warning'><strong>Maaf!</strong> Rentang Waktu Absensi Anda Belum Atau Lewat</div>";
                    }
                }
            ?>

                <div class="row">
                    <table class="table">
                    <tbody>
                    <tr>
                        <td>Nama Mahasiswa</td>
                        <td width="80%">: <?php echo $nama; ?></td>
                    </tr>
                    <tr>
                        <td>Nomor Induk Mahasiswa</td>
                        <td width="80%">: <?php echo $nim; ?></td>
                    </tr>
                    <tr>
                        <td>Universitas</td>
                        <td width="80%">: <?php echo $universitas; ?></td>
                    </tr>
                    <tr>
                        <td>Tanggal</td>
                        <td width="80%">: 
                        <?php 
                            include 'config/function.php';
                            $tanggal_sekarang = date("d-m-Y");
                            $tgl = date("d", strtotime($tanggal_sekarang));
                            $bulan = date("m", strtotime($tanggal_sekarang));
                            $tahun = date("Y", strtotime($tanggal_sekarang));
                            echo $tgl.' '.MendapatkanBulan($bulan).' '.$tahun
                        ?> 
                        </td>
                    </tr>
                    <tr>
                        <td>Waktu</td>
                        <td width="80%">: 
                        <?php 
                            include 'config/database.php';
                            $tanggal_sekarang = date("Y-m-d");
                            $hari_sekarang = date("l", strtotime($tanggal_sekarang));
                            if ($hari_sekarang == "Saturday" || $hari_sekarang == "Sunday") {
                                echo "Hari Libur";
                            } else {
                                $kueri = "SELECT waktu FROM tbl_absensi WHERE id_mahasiswa = '$id_mahasiswa' AND tanggal = '$tanggal_sekarang'";
                                $result = mysqli_query($kon, $kueri);
                            if (mysqli_num_rows($result) > 0) {
                                $data = mysqli_fetch_assoc($result);
                                echo $data['waktu'];
                            } else {
                                echo "Belum Absensi";
                                }
                            }                         
                        ?>
                        </td>
                    </tr>
                    <tr>
                        <td>Status</td>
                        <td width="80">: 
                        <?php
                            include 'config/database.php';
                            $tanggal_sekarang = date("Y-m-d");
                            $hari_sekarang = date("l", strtotime($tanggal_sekarang));
                            if ($hari_sekarang == "Saturday" || $hari_sekarang == "Sunday") {
                                echo "Hari Libur";
                                } else {
                                    $kueri = "SELECT status FROM tbl_absensi WHERE id_mahasiswa = '$id_mahasiswa' AND tanggal = '$tanggal_sekarang'";
                                    $result = mysqli_query($kon, $kueri);
                                if (mysqli_num_rows($result) > 0) {
                                    $data = mysqli_fetch_array($result);
                                    if ($data['status'] == 1) {
                                    echo "Hadir";
                                    }
                                    elseif ($data['status'] == 2) {
                                    echo "Izin";
                                    }
                                    elseif ($data['status'] == 3) {
                                    echo "Tidak hadir";
                                    }
                                }
                                else {
                                    echo "Belum Absensi";
                                }
                            }
                        ?>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <button id_mahasiswa="<?php echo $id_mahasiswa; ?>" id="tombol_absensi" class="tombol_periode mulai_absensi btn btn-success btn-circle"><i class="fa fa-clock-o"></i>  Absensi</button>
                        </td>
                    </tr>
                    </tbody>
                    </table>
            </div>
        </div>
    </div>
</div>

<?php
    include 'config/database.php';
    $query = "SELECT mulai_absen, akhir_absen FROM tbl_setting_absensi";
    $result = mysqli_query($kon, $query);
    $data = mysqli_fetch_assoc($result);
    $mulai_absen = date("H:i:s", strtotime($data['mulai_absen']));
    $akhir_absen = date("H:i:s", strtotime($data['akhir_absen']));
?>

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
<!-- Model AJAX -->

<script>
    // Setting pengguna
    $('.mulai_absensi').on('click',function(){
        var id_mahasiswa = $(this).attr("id_mahasiswa");
        $.ajax({
            url: 'apps/pengguna/mulai_absensi.php',
            method: 'post',
            data: {id_mahasiswa:id_mahasiswa},
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
$(document).ready(function() {
    var tanggal_sekarang = new Date();
    var tanggal_keluar = new Date("<?php echo $tanggal_keluar; ?>");
    if (tanggal_sekarang > tanggal_keluar) {
      // Sembunyikan button absensi
        $(".tombol_periode").hide();
        $("#div_periode").show();
    } else {
        $("#div_periode").hide();
    }
});
</script>