<?php
    session_start();
    if (isset($_POST['tambah_mahasiswa'])) {
        
        //Include file koneksi, untuk koneksikan ke database
        include '../../config/database.php';
        
        //Fungsi untuk mencegah inputan karakter yang tidak sesuai
        function input($data) {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }

        //Cek apakah ada kiriman form dari method post
        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            //Memulai transaksi
            mysqli_query($kon,"START TRANSACTION");

            $nama=input($_POST["nama"]);
            $universitas=input($_POST["universitas"]);
            $jurusan=input($_POST["jurusan"]);
            $nim=input($_POST["nim"]);
            $mulai_magang=input($_POST["mulai_magang"]);
            $akhir_magang=input($_POST["akhir_magang"]);
            $no_telp=input($_POST["no_telp"]);
            $alamat=input($_POST["alamat"]);
            $ekstensi_diperbolehkan	= array('png','jpg','jpeg','gif');
            $foto = $_FILES['foto']['name'];
            $x = explode('.', $foto);
            $ekstensi = strtolower(end($x));
            $ukuran	= $_FILES['foto']['size'];
            $file_tmp = $_FILES['foto']['tmp_name'];

            include '../../config/database.php';
            $query = mysqli_query($kon, "SELECT max(id_mahasiswa) as id_terbesar FROM tbl_mahasiswa");
            $ambil= mysqli_fetch_array($query);
            $id_mahasiswa = $ambil['id_terbesar'];
            $id_mahasiswa++;
            //Membuat kode admin
            $huruf = "M";
            $kode_mahasiswa = $huruf . sprintf("%03s", $id_mahasiswa);

            $sql="insert into tbl_user (kode_pengguna) values
            ('$kode_mahasiswa')";

            //Menyimpan ke tabel pengguna
            $simpan_pengguna=mysqli_query($kon,$sql);

            if (!empty($foto)){
                if(in_array($ekstensi, $ekstensi_diperbolehkan) === true){
                    //Mengupload gambar
                    move_uploaded_file($file_tmp, 'foto/'.$foto);
                    //Sql jika menggunakan foto
                    $sql="insert into tbl_mahasiswa (kode_mahasiswa,nama,universitas,jurusan,nim,mulai_magang,akhir_magang,alamat,no_telp,foto) values
                    ('$kode_mahasiswa','$nama','$universitas','$jurusan','$nim','$mulai_magang','$akhir_magang','$alamat','$no_telp','$foto')";
                }
            }else {
                //Sql jika tidak menggunakan foto, maka akan memakai gambar_default.png
                $foto="foto_default.png";
                $sql="insert into tbl_mahasiswa (kode_mahasiswa,nama,universitas,jurusan,nim,mulai_magang,akhir_magang,alamat,no_telp,foto) values
                ('$kode_mahasiswa','$nama','$universitas','$jurusan','$nim','$mulai_magang','$akhir_magang','$alamat','$no_telp','$foto')";
            }

            //Menyimpan ke tabel admin
            $simpan_mahasiswa=mysqli_query($kon,$sql);
            
            if ($simpan_pengguna and $simpan_mahasiswa) {
                mysqli_query($kon,"COMMIT");
                header("Location:../../index.php?page=mahasiswa&add=berhasil");
            }
            else {
                mysqli_query($kon,"ROLLBACK");
                header("Location:../../index.php?page=mahasiswa&add=gagal");
            }
        }
    }
?>

<form action="apps/mahasiswa/tambah.php" method="post" enctype="multipart/form-data">
    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                <label>Nama Lengkap :</label>
                <input type="text" name="nama" class="form-control" placeholder="Masukan Nama Mahasiswa" required>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <label>Universitas :</label>
                <input type="text" name="universitas" class="form-control" placeholder="Masukan Nama Universitas" required>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <label>Jurusan :</label>
                <input type="text" name="jurusan" class="form-control" placeholder="Masukan Nama Jurusan" required>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <label>Nomor Induk Mahasiswa :</label>
                <input type="text" name="nim" class="form-control" placeholder="Masukan Nomor Induk Mahasiswa" required>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <label>Mulai Magang :</label>
                <input type="date" name="mulai_magang" class="form-control" required>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <label>Akhir Magang :</label>
                <input type="date" name="akhir_magang" class="form-control" required>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                <label>Email :</label>
                <input type="email" name="email" class="form-control" placeholder="Masukan Email" required>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <label>No Telp :</label>
                <input type="text" name="no_telp" class="form-control" placeholder="Masukan No Telp" required>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-7">
            <div class="form-group">
                <label>Alamat :</label>
                <textarea class="form-control" name="alamat" rows="4" id="alamat"></textarea>
            </div>
        </div>
        <div class="col-sm-5">
            <div class="form-group">
                <div id="msg"></div>
                <label>Foto :</label>
                <input type="file" name="foto" class="file" >
                    <div class="input-group my-3">
                        <input type="text" class="form-control" disabled placeholder="Upload Foto" id="file">
                        <div class="input-group-append">
                            <button type="button" id="pilih_foto" class="browse btn btn-info"><i class="fa fa-search"></i> Pilih</button>
                        </div>
                    </div>
                <img src="source/img/size.png" id="preview" class="img-thumbnail">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-4">
            <button type="submit" name="tambah_mahasiswa" id="Submit" class="btn btn-success"><i class="fa fa-plus"></i> Daftar</button>
            <button type="reset" class="btn btn-warning"><i class="fa fa-trash"></i> Reset</button>
        </div>
    </div>
</form>

<style>
    .file {
    visibility: hidden;
    position: absolute;
    }
</style>

<script>
    $(document).on("click", "#pilih_foto", function() {
    var file = $(this).parents().find(".file");
    file.trigger("click");
    });
    $('input[type="file"]').change(function(e) {
    var fileName = e.target.files[0].name;
    $("#file").val(fileName);

    var reader = new FileReader();
    reader.onload = function(e) {
        // get loaded data and render thumbnail.
        document.getElementById("preview").src = e.target.result;
    };
    // read the image file as a data URL.
    reader.readAsDataURL(this.files[0]);
    });
</script>
