<?php
    session_start();
    include ('function.php');
    if (isset($_COOKIE['id']) && isset($_COOKIE['key'])){
        $id=$_COOKIE['id'];
        $key=$_COOKIE['key'];

        //ambil username berdasatkan id
        $result=mysqli_query($koneksi,"SELECT username FROM user WHERE id=$id");
        $row=mysqli_fetch_assoc($result);
        //cek cookie dan username
        if ($key === hash ('sha256',$row['username'])){
            $_SESSION['login']=true;
        }
    }
    if (isset($_SESSION['login'])){
    header("location:index.php");
    exit;
}
    
        if (isset($_POST['login'])){
            $username=$_POST['username'];
            $password=$_POST['password'];


            $result=mysqli_query($koneksi,"SELECT * FROM user WHERE username='$username'");
            if (mysqli_num_rows($result)=== 1){
                $row=mysqli_fetch_assoc($result);
                if(password_verify($password,$row['password'])){
                    //set session
                    $_SESSION["login"]=true;
                    if (isset($_POST['remember'])){
                        setcookie('id',$row['id'],time()+60);
                        setcookie('key',hash('sha256',$row['username']),time()+60);
                        //setcookie('login','true',time()+60);
                    }
                    header("location:index.php");
                    exit;
                }
            }
            $error=true;
        }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Login</title>
</head>
<body>
    <form action="" method="POST" >
    <h1 width="30%" align="center">Halaman Login</h1>
        <table width="30%" align="center" >
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
                    <td></td>
                    <td></td>
                    <td>
                        <input type="checkbox" name="remember">
                        <label for="">Remember Me</label>
                    </td>
                </tr>             
                <tr>
                    <td></td>
                    <td></td>
                    <td>  
                        <a href="registrasi.php">Registrasi</a>
                        <button type="submit" name="login">Login</button>
                    </td>
                </tr>
                <tr>
                    <td colspan=3 align="center">
                        <?php if(isset($error)): ?>
                            <p style="color:red;font-style:italic;">Username/Password salah</p>
                        <?php endif; ?>
                    </td>
                </tr>
        </table>
    </form>
</body>
</html>