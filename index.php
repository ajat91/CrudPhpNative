<?php
session_start();
if (!isset($_SESSION['login'])){
    header("location:login.php");
    exit;
}
include ("function.php");
$mahasiswa=query("SELECT * FROM mahasiswa ORDER BY id DESC");

if (isset($_POST["cari"])){
    $mahasiswa=cari($_POST["keyword"]);
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        .loader{
            width:86px;
            position: absolute;
            top:0;
            z-index: -1;
            left: 900px;
            display:none;

        }
    </style>
    <title>Halaman Admin</title>
</head>
<body>
        <table width="80%" align="center">
            <tr>
                <td>
                    <button><a href="tambah.php">Tambah Data</a></button>
                    <button><a href="logout.php">Log Out</a></button>
                </td>
                <td align="center">
                    <h3>Daftar Mahasiswa</h3>
                </td>
                <td>
                    <form action="" method="POST" align="right">
                        <input type="text" name="keyword" size="30" placeholder="Masukan Keyword Pencarian.."  autocomplete="off" id="keyword">
                        <button id="tombol-cari" type="submit" name="cari">Cari</button>
                        <img src="https://media3.giphy.com/media/3oEjI6SIIHBdRxXI40/200.gif" class="loader">
                    </form> 
                </td>
            </tr>
        </table>
        <div id="container">
            <table align="center" width="80%" border="1" cellpadding="10" cellspacing="0">
                <tr>
                    <th>No.</th>
                    <th>Gambar</th>
                    <th>Npm</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Jurusan</th>
                    <th>Aksi</th>
                </tr>

                <?php $i=1; ?>
                <?php foreach($mahasiswa as $row) :?>
                <tr>
                    <td><?php echo $i ?></td>
                    <td><img src="img/<?= $row->gambar ?>" alt="" width="50"></td>
                    <td><?php echo $row->npm ?></td>
                    <td><?php echo $row->nama ?></td>
                    <td><?php echo $row->email ?></td>
                    <td><?php echo $row->jurusan ?></td>
                    <td>
                        <a href="ubah.php?id=<?php echo $row->id ?>">Ubah</a> | <a href="hapus.php?id=<?php echo $row->id ?>" onclick= "return confirm('Yakin');">Hapus</a>
                    </td>
                </tr>
                <?php $i++; ?>
                <?php endforeach; ?>   
            </table>
        </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="js/script.js"></script>
</body>
</html>