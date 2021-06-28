<?php
    session_start();
    if (!isset($_SESSION['login'])){
        header("location:login.php");
        exit;
    }
     include ("function.php");
     $id=$_GET['id'];
     $mhs=query("SELECT * FROM mahasiswa where id=$id")[0];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ubah Data Mahasiswa</title>
</head>
<body>
    <h1 align="center" >Ubah Data Mahasiswa</h1>
    <form action="" method="POST" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?php echo $mhs->id  ?>">
    <input type="hidden" name="gambarLama" value="<?php echo $mhs->gambar  ?>">
        <table width="30%" align="center" >
            <tr>
                <td><label for="">Nama</label></td>
                <td>:</td>
                <td><input type="text" name="nama" value="<?php echo $mhs->nama  ?>"></td>
            </tr>
            <tr>
                <td><label for="">Npm</label></td>
                <td>:</td>
                <td><input type="text" name="npm" value="<?php echo $mhs->npm  ?>"></td>
            </tr>
            <tr>
                <td><label for="">Email</label></td>
                <td>:</td>
                <td><input type="email" name="email" value="<?php echo $mhs->email  ?>"></td>
            </tr>
            <tr>
                <td><label for="">Jurusan</label></td>
                <td>:</td>
                <td><input type="text" name="jurusan" value="<?php echo $mhs->jurusan ?>"></td>
            </tr>
            <tr>
                <td><label for="">Gambar</label></td>
                <td>:</td> 
                <td>
                    <img src="img/<?php echo $mhs->gambar  ?>" alt="" width="80"><br>
                    <input type="file" name="gambar" value="">
                </td>
            </tr>
            <tr>
                <td><button type="submit" name="submit">Ubah Data</button></td>
            </tr>
        </table>
    </form>
    <?php 
       
        if (isset($_POST['submit'])){
            if (ubah ($_POST) > 0){
                echo "
                    <script>
                    alert('Data Berhasil Diubah');
                    window.location='index.php';
                    </script>
                ";
            } else {
                echo "
                <script>
                alert('Data Gagal Diubah');
                window.location='index.php';
                </script>
            ";
            }

            
        
        }
    ?>
</body>
</html>