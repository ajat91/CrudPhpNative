<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Registrasi</title>
</head>
<body>
    <form action="" method="POST" >
    <h1 width="30%" align="center">Halaman Registrasi</h1>
        <table width="30%" align="center">
                <tr>
                    <td>Username</td>
                    <td>:</td>
                    <td><input type="text" name="username" required></td>
                </tr>
                <tr>
                    <td>Password</td>
                    <td>:</td>
                    <td><input type="password" name="password" required></td>
                </tr>                
                <tr>
                    <td>Konfirmasi Password</td>
                    <td>:</td>
                    <td><input type="password" name="password2" required></td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td>
                        <a href="login.php">Login</a>
                        <button type="submit" name="register">Registrasi</button>
                    </td>
                </tr>
        </table>
    </form>
    <?php
    include ('function.php');
        if (isset($_POST['register'])){
            if(registrasi($_POST)>0){
                echo "<script>
                        alert('User baru berhasil ditambahkan')
                     </script>
                ";
            }else {
                echo mysqli_error($koneksi);
            }
        } 
    ?>
</body>
</html>