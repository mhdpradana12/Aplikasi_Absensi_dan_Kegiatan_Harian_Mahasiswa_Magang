<?php 
    include '../../config/database.php';
    include '../../config/function.php';
    $id_mahasiswa=$_POST["id_mahasiswa"];
    $sql="SELECT * FROM tbl_mahasiswa WHERE id_mahasiswa=$id_mahasiswa LIMIT 1";
    $hasil=mysqli_query($kon,$sql);
    $data = mysqli_fetch_array($hasil); 
?>

<table class="table">
    <tbody>
        <tr>
            <td>Nama Lengkap</td>
            <td width="75%">: <?php echo $data['nama'];?></td>
        </tr>
        <tr>
            <td>Nomor Induk Mahasiswa</td>
            <td width="75%">: <?php echo $data['nim'];?></td>
        </tr>
        <tr>
            <td>Universitas</td>
            <td width="75%">: <?php echo $data['universitas'];?></td>
        </tr>
        <tr>
            <td>Jurusan</td>
            <td width="75%">: <?php echo $data['jurusan'];?></td>
        </tr>
        <tr>
            <td>Mulai Magang</td>
            <td width="75%">: <?php $tgl = date("d", strtotime($data['mulai_magang']));
                                    $bulan = date("m", strtotime($data['mulai_magang']));
                                    $tahun = date("Y", strtotime($data['mulai_magang']));
                                    echo $tgl.' '.MendapatkanBulan($bulan).' '.$tahun ?></td>
        </tr>
        <tr>
            <td>Akhir Magang</td>
            <td width="75%">: <?php $tgl = date("d", strtotime($data['akhir_magang']));
                                    $bulan = date("m", strtotime($data['akhir_magang']));
                                    $tahun = date("Y", strtotime($data['akhir_magang']));
                                    echo $tgl.' '.MendapatkanBulan($bulan).' '.$tahun ?></td>
        </tr>
        <tr>
            <td>No Telp</td>
            <td width="75%">: <?php echo $data['no_telp'];?></td>
        </tr>
        <tr>
            <td>Alamat</td>
            <td width="75%">: <?php echo $data['alamat'];?></td>
        </tr>
    </tbody>
</table>