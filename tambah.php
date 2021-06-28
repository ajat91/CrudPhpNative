<?php 
        session_start();
        if (!isset($_SESSION['login'])){
            header("location:login.php");
            exit;
        }
        include ("function.php");
        if (isset($_POST['submit'])){
            if (tambah ($_POST) > 0){
                echo "
                    <script>
                    alert('Data Berhasil Ditambahkan');
                    window.location='index.php';
                    </script>
                ";
            } else {
                echo "
                <script>
                alert('Data Gagal Ditambahkan');
                window.location='tambah.php';
                </script>
            ";
            }

            
        
        }
    ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Mahasiswa</title>
</head>
<body>
    <form action="" method="POST" enctype="multipart/form-data">
        <table width="30%" align="center">
            <tr>
                <td colspan=3><h1 width="30%" align="center" >Tambah Mahasiswa</h1></td>
            </tr>
            <tr>
                <td><label for="">Nama</label></td>
                <td>:</td>
                <td><input type="text" name="nama" required></td>
            </tr>
            <tr>
                <td><label for="">Npm</label></td>
                <td>:</td>
                <td><input type="text" name="npm" required></td>
            </tr>
            <tr>
                <td><label for="">Email</label></td>
                <td>:</td>
                <td><input type="email" name="email" required></td>
            </tr>
            <tr>
                <td><label for="">Jurusan</label></td>
                <td>:</td>
                <td><input type="text" name="jurusan" required></td>
            </tr>
            <tr>
                <td><label for="gambar">Gambar</label></td>
                <td>:</td>
                <td><input type="file" name="gambar" id="gambar"></td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td><button type="submit" name="submit">Tambah Data</button></td>
            </tr>
        </table>
    </form>
</body>
</html>