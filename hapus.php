<?php
    session_start();
    if (!isset($_SESSION['login'])){
        header("location:login.php");
        exit;
    }
    include ("function.php");
    $id =$_GET["id"];
    if (hapus($id)>0){
        echo "
        <script>
        alert('Data Berhasil Dihapus');
        window.location='index.php';
        </script>
    ";
    }else {
        echo "
        <script>
        alert('Data Gagal Dihapus');
        window.location='index.php';
        </script>
    ";
    }
?>