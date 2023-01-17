<?php
session_start();
    if (isset($_POST['submit'])) {
        
        //Menghubungkan ke database
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

            //Mendapatkan kode_mahasiswa dari AJAX
            $kode_mahasiswa=input($_POST["kode_mahasiswa"]);

            //Mendapatkan input password dari form lalu di enkripsi menjadi md5
            $password=md5(input($_POST["password"]));
            
            //Query untuk update password dari tbl_user
            $sql="UPDATE tbl_user SET password='$password' WHERE kode_pengguna='$kode_mahasiswa'";

            //Menyimpan password ke tbl_user
            $password=mysqli_query($kon,$sql);

            //Jika password berhasil di update maka halaman beralih logout
            if ($password) {
                mysqli_query($kon,"COMMIT");
                header("Location:../../logout.php");
            }
            //Jika password gagal di update maka halaman beralih ke profil
            else {
                mysqli_query($kon,"ROLLBACK");
                header("Location:../../index.php?page=profil&password=gagal");
            }
        }
    }
?>

    <form action="apps/pengguna/ubah_password.php" method="post">

    <div class="row">
        <div class="col-sm-7">
            <div class="form-group">
                <!-- Menyimpan kode_mahasiswa dari AJAX -->
                <input name="kode_mahasiswa" type="hidden" id="kode_mahasiswa" class="form-control" value="<?php echo $_POST['kode_mahasiswa'];?>"/>
                <!-- Menyimpan kode_mahasiswa dari AJAX -->
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                <label>Password :</label>
                <input name="password" type="password" class="form-control" value="" placeholder="Ganti Password?" required>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-4">
            <button type="submit" name="submit" id="submit" class="btn-password btn btn-primary"><i class="fa fa-key"></i> Simpan</button>
        </div>
    </div>
</form>

<script>
    // fungsi mengubah password
   $('.btn-password').on('click',function(){
        konfirmasi=confirm("Konfirmasi mengubah Password?")
        if (konfirmasi){
            return true;
        }else {
            return false;
        }
    });
</script>