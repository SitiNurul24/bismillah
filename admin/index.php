<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/animations.css">  
    <link rel="stylesheet" href="../css/main.css">  
    <link rel="stylesheet" href="../css/admin.css">
        
    <title>Beranda</title>
    <style>
        .dashbord-tables{
            animation: transitionIn-Y-over 0.5s;
        }
        .filter-container{
            animation: transitionIn-Y-bottom  0.5s;
        }
        .sub-table{
            animation: transitionIn-Y-bottom 0.5s;
        }
    </style>
    
    
</head>
<body>
    <?php

    //learn from w3schools.com

    session_start();

    if(isset($_SESSION["user"])){
        if(($_SESSION["user"])=="" or $_SESSION['tipepengguna']!='a'){
            header("location: ../masuk.php");
        }

    }else{
        header("location: ../masuk.php");
    }
    

    //import database
    include("../koneksi.php");

    
    ?>
    <div class="container">
        <div class="menu">
            <table class="menu-container" border="0">
                <tr>
                    <td style="padding:10px" colspan="2">
                        <table border="0" class="profile-container">
                            <tr>
                                <td width="30%" style="padding-left:20px" >
                                    <img src="../img/user.png" alt="" width="100%" style="border-radius:50%">
                                </td>
                                <td style="padding:0px;margin:0px;">
                                    <p class="profile-title">Administrasi</p>
                                    <p class="profile-subtitle">admin@safecareline.com</p>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <a href="../keluar.php" ><input type="button" value="Log out" class="logout-btn btn-primary-soft btn"></a>
                                </td>
                            </tr>
                    </table>
                    </td>
                </tr>
                <tr class="menu-row" >
                    <td class="menu-btn menu-icon-dashbord menu-active menu-icon-beranda-active" >
                        <a href="index.php" class="non-style-link-menu non-style-link-menu-active"><div><p class="menu-text">Beranda</p></a></div></a>
                    </td>
                </tr>
                <tr class="menu-row">
                    <td class="menu-btn menu-icon-doctor ">
                        <a href="dokter.php" class="non-style-link-menu "><div><p class="menu-text">Dokter</p></a></div>
                    </td>
                </tr>
                <tr class="menu-row" >
                    <td class="menu-btn menu-icon-schedule">
                        <a href="jadwal.php" class="non-style-link-menu"><div><p class="menu-text">jadwal</p></div></a>
                    </td>
                </tr>
                <tr class="menu-row">
                    <td class="menu-btn menu-icon-appoinment">
                        <a href="janji-temu.php" class="non-style-link-menu"><div><p class="menu-text">Janji Temu</p></a></div>
                    </td>
                </tr>
                <tr class="menu-row" >
                    <td class="menu-btn menu-icon-patient">
                        <a href="pasien.php" class="non-style-link-menu"><div><p class="menu-text">Pasien</p></a></div>
                    </td>
                </tr>
            </table>
        </div>
        <div class="dash-body" style="margin-top: 15px">
            <table border="0" width="100%" style=" border-spacing: 0;margin:0;padding:0;" >
                        
                        <tr >
                            
                            <td colspan="2" class="nav-bar" >
                                
                                <form action="dokter.php" method="post" class="header-search">
        
                                    <input type="search" name="search" class="input-text header-searchbar" placeholder="Search dokter name or Email" list="dokter">&nbsp;&nbsp;
                                    
                                    <?php
                                        echo '<datalist id="dokter">';
                                        $list11 = $database->query("select  doknama,dokemail from  dokter;");
        
                                        for ($y=0;$y<$list11->num_rows;$y++){
                                            $row00=$list11->fetch_assoc();
                                            $d=$row00["doknama"];
                                            $c=$row00["dokemail"];
                                            echo "<option value='$d'><br/>";
                                            echo "<option value='$c'><br/>";
                                        };
        
                                    echo ' </datalist>';
                                    ?>
                                    
                               
                                    <input type="Submit" value="Search" class="login-btn btn-primary-soft btn" style="padding-left: 25px;padding-right: 25px;padding-top: 10px;padding-bottom: 10px;">
                                
                                </form>
                                
                            </td>
                            <td width="15%">
                                <p style="font-size: 14px;color: rgb(119, 119, 119);padding: 0;margin: 0;text-align: right;">
                                    Tanggal Hari Ini
                                </p>
                                <p class="heading-sub12" style="padding: 0;margin: 0;">
                                    <?php 
                                date_default_timezone_set('Asia/Jakarta');
        
                                $today = date('Y-m-d');
                                echo $today;


                                $pasienrow = $database->query("select  * from  pasien;");
                                $dokterrow = $database->query("select  * from  dokter;");
                                $janjitemurow = $database->query("select  * from  janjitemu where janjitgl>='$today';");
                                $jadwalrow = $database->query("select  * from  jadwal where jadwaltgl='$today';");


                                ?>
                                </p>
                            </td>
                            <td width="10%">
                                <button  class="btn-label"  style="display: flex;justify-content: center;align-items: center;"><img src="../img/calendar.svg" width="100%"></button>
                            </td>
        
        
                        </tr>
                <tr>
                    <td colspan="4">
                        
                        <center>
                        <table class="filter-container" style="border: none;" border="0">
                            <tr>
                                <td colspan="4">
                                    <p style="font-size: 20px;font-weight:600;padding-left: 12px;">Status</p>
                                </td>
                            </tr>
                            <tr>
                                <td style="width: 25%;">
                                    <div  class="dashboard-items"  style="padding:20px;margin:auto;width:95%;display: flex">
                                        <div>
                                                <div class="h1-dashboard">
                                                    <?php    echo $dokterrow->num_rows  ?>
                                                </div><br>
                                                <div class="h3-dashboard">
                                                    dokter &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                </div>
                                        </div>
                                                <div class="btn-icon-back dashboard-icons" style="background-image: url('../img/icons/doctors-hover.svg');"></div>
                                    </div>
                                </td>
                                <td style="width: 25%;">
                                    <div  class="dashboard-items"  style="padding:20px;margin:auto;width:95%;display: flex;">
                                        <div>
                                                <div class="h1-dashboard">
                                                    <?php    echo $pasienrow->num_rows  ?>
                                                </div><br>
                                                <div class="h3-dashboard">
                                                    pasien &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                </div>
                                        </div>
                                                <div class="btn-icon-back dashboard-icons" style="background-image: url('../img/icons/patients-hover.svg');"></div>
                                    </div>
                                </td>
                                <td style="width: 25%;">
                                    <div  class="dashboard-items"  style="padding:20px;margin:auto;width:95%;display: flex; ">
                                        <div>
                                                <div class="h1-dashboard" >
                                                    <?php    echo $janjitemurow ->num_rows  ?>
                                                </div><br>
                                                <div class="h3-dashboard" >
                                                Pemesanan Baru &nbsp;&nbsp;
                                                </div>
                                        </div>
                                                <div class="btn-icon-back dashboard-icons" style="margin-left: 0px;background-image: url('../img/icons/book-hover.svg');"></div>
                                    </div>
                                </td>
                                <td style="width: 25%;">
                                    <div  class="dashboard-items"  style="padding:20px;margin:auto;width:95%;display: flex;padding-top:26px;padding-bottom:26px;">
                                        <div>
                                                <div class="h1-dashboard">
                                                    <?php    echo $jadwalrow ->num_rows  ?>
                                                </div><br>
                                                <div class="h3-dashboard" style="font-size: 15px">
                                                    Sesi Hari Ini
                                                </div>
                                        </div>
                                                <div class="btn-icon-back dashboard-icons" style="background-image: url('../img/icons/session-iceblue.svg');"></div>
                                    </div>
                                </td>
                                
                            </tr>
                        </table>
                    </center>
                    </td>
                </tr>






                <tr>
                    <td colspan="4">
                        <table width="100%" border="0" class="dashbord-tables">
                            <tr>
                                <td>
                                <p style="padding:10px;padding-left:48px;padding-bottom:0;font-size:23px;font-weight:700;color:var(--primarycolor);">
    jadwal janji mendatang sampai hari <?php  
        // Menggunakan format "l" untuk mendapatkan nama hari dalam bahasa Indonesia
        $nextWeekDay = date("l", strtotime("+1 week"));

        // Mengganti nama hari dalam bahasa Inggris menjadi bahasa Indonesia
        switch ($nextWeekDay) {
            case 'Monday':
                $nextWeekDay = 'Senin';
                break;
            case 'Tuesday':
                $nextWeekDay = 'Selasa';
                break;
            case 'Wednesday':
                $nextWeekDay = 'Rabu';
                break;
            case 'Thursday':
                $nextWeekDay = 'Kamis';
                break;
            case 'Friday':
                $nextWeekDay = 'Jumat';
                break;
            case 'Saturday':
                $nextWeekDay = 'Sabtu';
                break;
            case 'Sunday':
                $nextWeekDay = 'Minggu';
                break;
            default:
                $nextWeekDay = 'Hari tidak valid';
        }

        echo $nextWeekDay;
    ?>
</p>

                                    <p style="padding-bottom:19px;padding-left:50px;font-size:15px;font-weight:500;color:#212529e3;line-height: 20px;">
                                    Berikut akses cepat ke janji temu yang akan datang hingga 7 hari<br>
                                    Informasi lebih lanjut tersedia di bagian janjitemu.
                                    </p>

                                </td>
                                <td>
                                <p style="text-align:right;padding:10px;padding-right:48px;padding-bottom:0;font-size:23px;font-weight:700;color:var(--primarycolor);">
    jadwal sesi mendatang hingga hari
    <?php  
    // Menggunakan format "l" untuk mendapatkan nama hari dalam bahasa Indonesia
    $nextWeekDay = date("l", strtotime("+1 week"));

    switch ($nextWeekDay) {
        case 'Monday':
            $nextWeekDay = 'Senin';
            break;
        case 'Tuesday':
            $nextWeekDay = 'Selasa';
            break;
        case 'Wednesday':
            $nextWeekDay = 'Rabu';
            break;
        case 'Thursday':
            $nextWeekDay = 'Kamis';
            break;
        case 'Friday':
            $nextWeekDay = 'Jumat';
            break;
        case 'Saturday':
            $nextWeekDay = 'Sabtu';
            break;
        case 'Sunday':
            $nextWeekDay = 'Minggu';
            break;
        default:
            $nextWeekDay = 'Hari tidak valid';
    }
    echo $nextWeekDay;
?>

</p>
                                    <p style="padding-bottom:19px;text-align:right;padding-right:50px;font-size:15px;font-weight:500;color:#212529e3;line-height: 20px;">
                                    Berikut akses cepat ke Sesi Mendatang yang dijadwalkan hingga 7 hari ke depan<br>
                                    Fitur Tambah, Hapus dan Banyak tersedia di bagian jadwal.
                                    </p>
                                </td>
                            </tr>
                            <tr>
                                <td width="50%">
                                    <center>
                                        <div class="abc scroll" style="height: 200px;">
                                        <table width="85%" class="sub-table scrolldown" border="0">
                                        <thead>
                                        <tr>    
                                                <th class="table-headin" style="font-size: 12px;">
                                                        
                                                   Nomor janji temu 
                                                    
                                                </th>
                                                <th class="table-headin">
                                                    Nama Pasien
                                                </th>
                                                <th class="table-headin">
                                                    
                                                
                                                    Dokter
                                                    
                                                </th>
                                                <th class="table-headin">
                                                    
                                                
                                                    Sesi
                                                    
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        
                                            <?php
                                            $nextweek=date("Y-m-d",strtotime("+1 week"));
                                            $sqlmain= "select janjitemu.janjiid,jadwal.jadwalid,jadwal.judul,dokter.doknama,pasien.pnama,jadwal.jadwaltgl,jadwal.jadwalwaktu,janjitemu.janjinom,janjitemu.janjitgl from jadwal inner join janjitemu on jadwal.jadwalid=janjitemu.jadwalid inner join pasien on pasien.pid=janjitemu.pid inner join dokter on jadwal.dokid=dokter.dokid  where jadwal.jadwaltgl>='$today'  and jadwal.jadwaltgl<='$nextweek' order by jadwal.jadwaltgl desc";

                                                $result= $database->query($sqlmain);
                
                                                if($result->num_rows==0){
                                                    echo '<tr>
                                                    <td colspan="3">
                                                    <br><br><br><br>
                                                    <center>
                                                    <img src="../img/notfound.svg" width="25%">
                                                    
                                                    <br>
                                                    <p class="heading-main12" style="margin-left: 45px;font-size:20px;color:rgb(49, 49, 49)">We  couldnt find anything related to your keywords !</p>
                                                    <a class="non-style-link" href="janji-temu.php"><button  class="login-btn btn-primary-soft btn"  style="display: flex;justify-content: center;align-items: center;margin-left:20px;">&nbsp; Show all janjitemus &nbsp;</font></button>
                                                    </a>
                                                    </center>
                                                    <br><br><br><br>
                                                    </td>
                                                    </tr>';
                                                    
                                                }
                                                else{
                                                for ( $x=0; $x<$result->num_rows;$x++){
                                                    $row=$result->fetch_assoc();
                                                    $janjiid=$row["ajanjiid"];
                                                    $jadwalid=$row["jadwalid"];
                                                    $judul=$row["judul"];
                                                    $doknama=$row["doknama"];
                                                    $jadwaltgl=$row["jadwaltgl"];
                                                    $jadwalwaktu=$row["jadwalwaktu"];
                                                    $pnama=$row["pnama"];
                                                    $janjinom=$row["janjinom"];
                                                    $janjitgl=$row["ajanjitgl"];
                                                    echo '<tr>


                                                        <td style="text-align:center;font-size:23px;font-weight:500; color: var(--btnnicetext);padding:20px;">
                                                            '.$janjinom.'
                                                            
                                                        </td>

                                                        <td style="font-weight:600;"> &nbsp;'.
                                                        
                                                        substr($pnama,0,25)
                                                        .'</td >
                                                        <td style="font-weight:600;"> &nbsp;'.
                                                        
                                                            substr($doknama,0,25)
                                                            .'</td >
                                                           
                                                        
                                                        <td>
                                                        '.substr($judul,0,15).'
                                                        </td>

                                                    </tr>';
                                                    
                                                }
                                            }
                                                 
                                            ?>
                 
                                            </tbody>
                
                                        </table>
                                        </div>
                                        </center>
                                </td>
                                <td width="50%" style="padding: 0;">
                                    <center>
                                        <div class="abc scroll" style="height: 200px;padding: 0;margin: 0;">
                                        <table width="85%" class="sub-table scrolldown" border="0" >
                                        <thead>
                                        <tr>
                                                <th class="table-headin">
                                                    
                                                
                                                Judul Sesi
                                                
                                                </th>
                                                
                                                <th class="table-headin">
                                                    dokter
                                                </th>
                                                <th class="table-headin">
                                                    
                                                Tanggal & Waktu yang Dijadwalkan
                                                    
                                                </th>
                                                    
                                                </tr>
                                        </thead>
                                        <tbody>
                                        
                                            <?php
                                            $nextweek=date("Y-m-d",strtotime("+1 week"));
                                            $sqlmain= "select jadwal.jadwalid,jadwal.judul,dokter.doknama,jadwal.jadwaltgl,jadwal.jadwalwaktu,jadwal.nop from jadwal inner join dokter on jadwal.dokid=dokter.dokid  where jadwal.jadwaltgl>='$today' and jadwal.jadwaltgl<='$nextweek' order by jadwal.jadwaltgl desc"; 
                                                $result= $database->query($sqlmain);
                
                                                if($result->num_rows==0){
                                                    echo '<tr>
                                                    <td colspan="4">
                                                    <br><br><br><br>
                                                    <center>
                                                    <img src="../img/notfound.svg" width="25%">
                                                    
                                                    <br>
                                                    <p class="heading-main12" style="margin-left: 45px;font-size:20px;color:rgb(49, 49, 49)">We  couldnt find anything related to your keywords !</p>
                                                    <a class="non-style-link" href="jadwal.php"><button  class="login-btn btn-primary-soft btn"  style="display: flex;justify-content: center;align-items: center;margin-left:20px;">&nbsp; Show all Sessions &nbsp;</font></button>
                                                    </a>
                                                    </center>
                                                    <br><br><br><br>
                                                    </td>
                                                    </tr>';
                                                    
                                                }
                                                else{
                                                for ( $x=0; $x<$result->num_rows;$x++){
                                                    $row=$result->fetch_assoc();
                                                    $jadwalid=$row["jadwalid"];
                                                    $judul=$row["judul"];
                                                    $doknama=$row["doknama"];
                                                    $jadwaltgl=$row["jadwaltgl"];
                                                    $jadwalwaktu=$row["jadwalwaktu"];
                                                    $nop=$row["nop"];
                                                    echo '<tr>
                                                        <td style="padding:20px;"> &nbsp;'.
                                                        substr($judul,0,30)
                                                        .'</td>
                                                        <td>
                                                        '.substr($doknama,0,20).'
                                                        </td>
                                                        <td style="text-align:center;">
                                                            '.substr($jadwaltgl,0,10).' '.substr($jadwalwaktu,0,5).'
                                                        </td>

                
                                                       
                                                    </tr>';
                                                    
                                                }
                                            }
                                                 
                                            ?>
                 
                                            </tbody>
                
                                        </table>
                                        </div>
                                        </center>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <center>
                                        <a href="janji-temu.php" class="non-style-link"><button class="btn-primary btn" style="width:85%">Tampilkan Semua Janji Temu</button></a>
                                    </center>
                                </td>
                                <td>
                                    <center>
                                        <a href="jadwal.php" class="non-style-link"><button class="btn-primary btn" style="width:85%">Tampilkan Semua Sesi</button></a>
                                    </center>
                                </td>
                            </tr>
                        </table>
                    </td>

                </tr>
                        </table>
                        </center>
                        </td>
                </tr>
            </table>
        </div>
    </div>


</body>
</html>