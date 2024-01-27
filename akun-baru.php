<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/animations.css">  
    <link rel="stylesheet" href="css/main.css">  
    <link rel="stylesheet" href="css/signup.css">
        
    <title>Akun Baru</title>
    <style>
        .container{
            animation: transitionIn-X 0.5s;
        }
    </style>
</head>
<body>
<?php

session_start();

$_SESSION["user"]="";
$_SESSION["usertype"]="";

// Set the new timezone
date_default_timezone_set('Asia/Kolkata');
$date = date('Y-m-d');

$_SESSION["date"]=$date;

//import database
include("koneksi.php");
if($_POST){

    $result= $database->query("select * from webpengguna");

    $fname=$_SESSION['personal']['fname'];
    $lname=$_SESSION['personal']['lname'];
    $name=$fname." ".$lname;
    $address=$_SESSION['personal']['address'];
    $nic=$_SESSION['personal']['nic'];
    $dob=$_SESSION['personal']['dob'];
    $email=$_POST['newemail'];
    $tele=$_POST['tele'];
    $newpassword=$_POST['newpassword'];
    $cpassword=$_POST['cpassword'];
    
    if ($newpassword==$cpassword){
        $sqlmain= "select * from webpengguna where email=?;";
        $stmt = $database->prepare($sqlmain);
        $stmt->bind_param("s",$email);
        $stmt->execute();
        $result = $stmt->get_result();
        if($result->num_rows==1){
            $error='<label for="promter" class="form-label" style="color:rgb(255, 62, 62);text-align:center;">Sudah memiliki akun untuk alamat email ini</label>';
        }else{
            //TODO
            $database->query("insert into pasien(pemail,pnama,pkatasandi, palamat, pnik,pdob,ptel) values('$email','$name','$newpassword','$address','$nic','$dob','$tele');");
            $database->query("insert into webpengguna values('$email','p')");

            //print_r("insert into patient values($pid,'$email','$fname','$lname','$newpassword','$address','$nic','$dob','$tele');");
            $_SESSION["user"]=$email;
            $_SESSION["usertype"]="p";
            $_SESSION["username"]=$fname;

            header('Location: pasien/index.php');
            $error='<label for="promter" class="form-label" style="color:rgb(255, 62, 62);text-align:center;"></label>';
        }
    }else{
        $error='<label for="promter" class="form-label" style="color:rgb(255, 62, 62);text-align:center;">Kesalahan konfirmasi kata sandi! konfirmasi ulang kata sandi</label>';
    }    
}else{
    //header('location: daftar.php');
    $error='<label for="promter" class="form-label"></label>';
}
?>
    <center>
    <div class="container">
        <table border="0" style="width: 69%;">
            <tr>
                <td colspan="2">
                    <p class="header-text">Mari kita mulai</p>
                    <p class="sub-text">Tidak masalah, buatlah akun pengguna sekarang</p>
                </td>
            </tr>
            <tr>
                <form action="" method="POST" >
                <td class="label-td" colspan="2">
                    <label for="newemail" class="form-label">Email: </label>
                </td>
            </tr>
            <tr>
                <td class="label-td" colspan="2">
                    <input type="email" name="newemail" class="input-text" placeholder="Alamat Email" required>
                </td>
            </tr>
            <tr>
                <td class="label-td" colspan="2">
                    <label for="tele" class="form-label">Nomor ponsel: </label>
                </td>
            </tr>
            <tr>
                <td class="label-td" colspan="2">
                    <input type="text" name="tele" class="input-text"  placeholder="contoh: 0812345678">
                </td>
            </tr>
            <tr>
                <td class="label-td" colspan="2">
                    <label for="katasandibaru" class="form-label">Buat Kata Sandi Baru: </label>
                </td>
            </tr>
            <tr>
                <td class="label-td" colspan="2">
                    <input type="password" name="katasandibaru" class="input-text" placeholder="Kata Sandi baru" required>
                </td>
            </tr>
            <tr>
                <td class="label-td" colspan="2">
                    <label for="kkatasandi" class="form-label">Konfirmasi Kata sandi: </label>
                </td>
            </tr>
            <tr>
                <td class="label-td" colspan="2">
                    <input type="password" name="kkatasandi" class="input-text" placeholder="Konfirmasi Kata Sandi" required>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <?php echo $error ?>
                </td>
            </tr>
            <tr>
                <td>
                    <input type="reset" value="Atur Ulang" class="login-btn btn-primary-soft btn" >
                </td>
                <td>
                    <input type="submit" value="Daftar" class="login-btn btn-primary btn">
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <br>
                    <label for="" class="sub-text" style="font-weight: 280;">Sudah memiliki akun&#63; </label>
                    <a href="masuk.php" class="hover-link1 non-style-link">Masuk</a>
                    <br><br><br>
                </td>
            </tr>
                    </form>
            </tr>
        </table>
    </div>
</center>
</body>
</html>