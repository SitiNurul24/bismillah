<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/animations.css">  
    <link rel="stylesheet" href="css/main.css">  
    <link rel="stylesheet" href="css/login.css">
    <style>
        body {
            background-image: url('edoc-doctor-appointment-system-main/img/bg01.jpg');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
        }
    </style>
    <title>Masuk</title>
</head>
<body>
<?php

session_start();

$_SESSION["pengguna"] = "";
$_SESSION["tipepengguna"] = "";

date_default_timezone_set('Asia/Kolkata');
$date = date('Y-m-d');

$_SESSION["date"] = $date;

// Import database
include("koneksi.php");
if ($_POST) {

    $email = $_POST['useremail'];
    $password = $_POST['userpassword'];

    $error = '<label for="promter" class="form-label"></label>';

    $result = $database->query("SELECT * FROM webpengguna WHERE email='$email'");
    if ($result->num_rows == 1) {
        $tipepengguna = $result->fetch_assoc()['tipepengguna'];
        if ($tipepengguna == 'p') {
            // TODO
            $checker = $database->query("SELECT * FROM pasien WHERE pemail='$email' AND pkatasandi='$password'");
            if ($checker->num_rows == 1) {
                // Patient dashboard
                $_SESSION['user'] = $email;
                $_SESSION['tipepengguna'] = 'p';
                header('location: pasien/index.php');
            } else {
                $error = '<label for="promter" class="form-label" style="color:rgb(255, 62, 62);text-align:center;">Kredensial yang tidak valid: Alamat email atau kata sandi tidak benar.</label>';
            }
        } elseif ($tipepengguna == 'a') {
            // TODO
            $checker = $database->query("SELECT * FROM admin WHERE email='$email' AND password='$password'");
            if ($checker->num_rows == 1) {
                // Admin dashboard
                $_SESSION['user'] = $email;
                $_SESSION['tipepengguna'] = 'a';
                header('location: admin/index.php');
            } else {
                $error = '<label for="promter" class="form-label" style="color:rgb(255, 62, 62);text-align:center;">Kredensial yang tidak valid: Alamat email atau kata sandi tidak benar.</label>';
            }
        } elseif ($tipepengguna == 'd') {
            // TODO
            $checker = $database->query("SELECT * FROM dokter WHERE dokemail='$email' AND dokkatasandi='$password'");
            if ($checker->num_rows == 1) {
                // Doctor dashboard
                $_SESSION['user'] = $email;
                $_SESSION['tipepengguna'] = 'd';
                header('location: dokter/index.php');
            } else {
                $error = '<label for="promter" class="form-label" style="color:rgb(255, 62, 62);text-align:center;">Kredensial yang tidak valid: Alamat email atau kata sandi tidak benar.</label>';
            }
        }
    } else {
        $error = '<label for="promter" class="form-label" style="color:rgb(255, 62, 62);text-align:center;">Kami tidak dapat menemukan akun untuk alamat email ini.</label>';
    }
} else {
    $error = '<label for="promter" class="form-label">&nbsp;</label>';
}

?>
<!-- HTML continues... -->

    <center>
    <div class="container">
        <table border="0" style="margin: 0;padding: 0;width: 60%;">
            <tr>
                <td>
                    <p class="header-text">Selamat datang kembali!</p>
                </td>
            </tr>
        <div class="form-body">
            <tr>
                <td>
                    <p class="sub-text">Masuk dengan data Anda untuk melanjutkan</p>
                </td>
            </tr>
            <tr>
                <form action="" method="POST" >
                <td class="label-td">
                    <label for="useremail" class="form-label">Email: </label>
                </td>
            </tr>
            <tr>
                <td class="label-td">
                    <input type="email" name="useremail" class="input-text" placeholder="Alamat Email" required>
                </td>
            </tr>
            <tr>
                <td class="label-td">
                    <label for="userpassword" class="form-label">Kata Sandi: </label>
                </td>
            </tr>

            <tr>
                <td class="label-td">
                    <input type="Kata Sandi" name="userpassword" class="input-text" placeholder="Kata Sandi" required>
                </td>
            </tr>
            <tr>
                <td><br>
                <?php echo $error ?>
                </td>
            </tr>

            <tr>
                <td>
                    <input type="submit" value="Masuk" class="login-btn btn-primary btn">
                </td>
            </tr>
        </div>
            <tr>
                <td>
                    <br>
                    <label for="" class="sub-text" style="font-weight: 280;">Belum memiliki akun&#63; </label>
                    <a href="daftar.php" class="hover-link1 non-style-link">Daftar</a>
                    <br><br><br>
                </td>
            </tr> 
                    </form>
        </table>
    </div>
</center>
</body>
</html>