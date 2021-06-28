<?php 
 $koneksi = mysqli_connect("sql103.epizy.com","epiz_28527986","kDBfGHYom3tr","epiz_28527986_projectluar_inven");

 function query($query){
     global $koneksi;
     $result=mysqli_query($koneksi,$query);
     $rows=[];
     while ($row=mysqli_fetch_object($result)){
     $rows[]=$row;
     }
     return $rows;
 }
 function tambah($data){
    global $koneksi;
    $nama=htmlspecialchars ($data['nama']);
    $npm=htmlspecialchars($data['npm']);
    $jurusan=htmlspecialchars ($data['jurusan']);
    $email=htmlspecialchars ($data['email']);
   
   
    $gambar=upload();
        if (!$gambar){
        return false;
     }


    $query="INSERT INTO mahasiswa values ('','$npm','$nama','$email','$jurusan','$gambar')";
    mysqli_query($koneksi,$query);
    return mysqli_affected_rows($koneksi);
 }
 function hapus($id){
     global $koneksi;
     mysqli_query ($koneksi,"DELETE From mahasiswa where id=$id");
     return mysqli_affected_rows($koneksi);
    }
function ubah ($data){
    global $koneksi;
    $id=$data['id'];
    $nama=htmlspecialchars ($data['nama']);
    $npm=htmlspecialchars($data['npm']);
    $jurusan=htmlspecialchars ($data['jurusan']);
    $email=htmlspecialchars ($data['email']);
    $gambarLama=htmlspecialchars ($data['gambarLama']);


    //cek apakah user pilih gambar baru??
    if ($_FILES['gambar']['error']=== 4){
        $gambar=$gambarLama;
    }else{
        $gambar=upload();
    }
   
  

    $query="UPDATE mahasiswa SET 
        npm='$npm',
        nama='$nama',
        jurusan='$jurusan',
        email='$email',
        gambar='$gambar'
        
        where id=$id";
    mysqli_query($koneksi,$query);
    return mysqli_affected_rows($koneksi);
}
function cari($keyword){
    $query="SELECT * FROM mahasiswa WHERE
                nama LIKE '%$keyword%' OR
                email LIKE '%$keyword%' OR
                jurusan LIKE '%$keyword%' OR
                npm LIKE '%$keyword%'
    ";
    return query ($query);
}
function upload(){
     $namaFile=$_FILES['gambar']['name'];
     $ukuranFile=$_FILES['gambar']['size'];
     $error=$_FILES['gambar']['error'];
     $tmpName=$_FILES['gambar']['tmp_name'];

     if ($error === 4){
         echo "<script>
                 alert('Pilih Gambar Terlebih Dahulu');
              </script>";
              return false;
     }

//     //cek apakah yang diupload adalah gambar
     $ekstensiGambarValid=['jpg','jpeg','png'];
     $ekstensiGambar=explode('.',$namaFile);
     $ekstensiGambar=strtolower(end($ekstensiGambar));

    if (!in_array($ekstensiGambar,$ekstensiGambarValid)){
        echo "<script>
                alert('Yang anda upload bukan gambar');
             </script>";
              return false;
    }

    if ($ukuranFile > 1000000){
        echo "<script>
                alert('ukuran gambar terlalu besar');
             </script>";
             return false;
    }

    //lolos pengecekan,gambar siap diupload
    //generate nama file baru
    $namaFileBaru=uniqid();
    $namaFileBaru .='.';
    $namaFileBaru .=$ekstensiGambar;

    move_uploaded_file($tmpName,'img/'.$namaFileBaru);
    return $namaFileBaru;

}
function registrasi($data){
    global $koneksi;
    $username=strtolower(stripcslashes($data['username']));
    $password=mysqli_real_escape_string($koneksi,$data['password']);
    $password2=mysqli_real_escape_string($koneksi,$data['password2']);

    //cek konfirmasi password
    if ($password !==  $password2){
        echo "<script>
                alert('konfirmasi password tidak sesuai');
              </script>";
              return false;
    }
    //cek username sudah ada atau belum
    $result=mysqli_query($koneksi,"SELECT username FROM user WHERE username='$username'");
    if(mysqli_fetch_object($result)){
        echo "<script>
                alert('username sudah terdaftar');
            </script>";
            return false;
    }
    //enkripsi password
    $password=password_hash( $password,PASSWORD_DEFAULT);
    //tambahkan user baru ke database
    mysqli_query($koneksi,"INSERT INTO user VALUES ('','$username','$password')");
    return mysqli_affected_rows($koneksi);
}

?>