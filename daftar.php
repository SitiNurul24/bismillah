<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/animations.css">  
    <link rel="stylesheet" href="css/main.css">  
    <link rel="stylesheet" href="css/signup.css">
        
    <title>Daftar</title>
    
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
if($_POST){
    $_SESSION["personal"]=array(
        'fname'=>$_POST['fname'],
        'lname'=>$_POST['lname'],
        'address'=>$_POST['address'],
        'nic'=>$_POST['nic'],
        'dob'=>$_POST['dob']
    );

    print_r($_SESSION["personal"]);
    header("location: akun-baru.php");
}
?>
    <center>
    <div class="container">
        <table border="0">
            <tr>
                <td colspan="2">
                    <p class="header-text">Mari Kita Mulai</p>
                    <p class="sub-text">Tambahkan data pribadi anda untuk melanjutkan</p>
                </td>
            </tr>
            <tr>
                <form action="" method="POST" >
                <td class="label-td" colspan="2">
                    <label for="nama" class="form-label">Nama: </label>
                </td>
            </tr>
            <tr>
                <td class="label-td">
                    <input type="text" name="dname" class="input-text" placeholder="Nama Depan" required>
                </td>
                <td class="label-td">
                    <input type="text" name="bname" class="input-text" placeholder="Nama Belakang" required>
                </td>
            </tr>
            <tr>
                <td class="label-td" colspan="2">
                    <label for="alamat" class="form-label">Alamat: </label>
                </td>
            </tr>
            <tr>
                <td class="label-td" colspan="2">
                    <input type="text" name="alamat" class="input-text" placeholder="Alamat" required>
                </td>
            </tr>
            <tr>
                <td class="label-td" colspan="2">
                    <label for="nik" class="form-label">NIK: </label>
                </td>
            </tr>
            <tr>
                <td class="label-td" colspan="2">
                    <input type="text" name="nik" class="input-text" placeholder="Nomor NIK" required>
                </td>
            </tr>
            <tr>
                <td class="label-td" colspan="2">
                    <label for="tl" class="form-label">Tanggal Lahir: </label>
                </td>
            </tr>
            <tr>
                <td class="label-td" colspan="2">
                    <input type="date" name="tl" class="input-text" required>
                </td>
            </tr>
            <tr>
                <td class="label-td" colspan="2">
                </td>
            </tr>
            <tr>
                <td>
                    <input type="reset" value="atur Ulang" class="login-btn btn-primary-soft btn" >
                </td>
                <td>
                    <input type="submit" value="berikutnya" class="login-btn btn-primary btn">
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