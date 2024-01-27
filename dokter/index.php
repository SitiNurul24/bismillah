<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/animations.css">  
    <link rel="stylesheet" href="../css/main.css">  
    <link rel="stylesheet" href="../css/admin.css">
        
    <title>Dashboard</title>
    <style>
        .dashbord-tables,.doctor-heade{
            animation: transitionIn-Y-over 0.5s;
        }
        .filter-container{
            animation: transitionIn-Y-bottom  0.5s;
        }
        .sub-table,#anim{
            animation: transitionIn-Y-bottom 0.5s;
        }
        .doctor-heade{
            animation: transitionIn-Y-over 0.5s;
        }
    </style>
    
    
</head>
<body>
    <?php

    //learn from w3schools.com

    session_start();

    if(isset($_SESSION["user"])){
        if(($_SESSION["user"])=="" or $_SESSION['tipepengguna']!='d'){
            header("location: ../masuk.php");
        }else{
            $useremail=$_SESSION["user"];
        }

    }else{
        header("location: ../masuk.php");
    }
    

    //import database
    include("../koneksi.php");
    $userrow = $database->query("select * from dokter where dokemail='$useremail'");
    $userfetch=$userrow->fetch_assoc();
    $userid= $userfetch["dokid"];
    $username=$userfetch["doknama"];


    //echo $userid;
    //echo $username;
    
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
                                    <p class="profile-title"><?php echo substr($username,0,13)  ?>..</p>
                                    <p class="profile-subtitle"><?php echo substr($useremail,0,22)  ?></p>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <a href="../keluar.php" ><input type="button" value="Keluar" class="logout-btn btn-primary-soft btn"></a>
                                </td>
                            </tr>
                    </table>
                    </td>
                </tr>
                <tr class="menu-row" >
                    <td class="menu-btn menu-icon-dashbord menu-active menu-icon-dashbord-active" >
                        <a href="index.php" class="non-style-link-menu non-style-link-menu-active"><div><p class="menu-text">Dashboard</p></a></div></a>
                    </td>
                </tr>
                <tr class="menu-row">
                    <td class="menu-btn menu-icon-appoinment">
                        <a href="janji_temu.php" class="non-style-link-menu"><div><p class="menu-text">Janji Temu Saya</p></a></div>
                    </td>
                </tr>
                
                <tr class="menu-row" >
                    <td class="menu-btn menu-icon-session">
                        <a href="jadwal.php" class="non-style-link-menu"><div><p class="menu-text">Sesi Saya</p></div></a>
                    </td>
                </tr>
                <tr class="menu-row" >
                    <td class="menu-btn menu-icon-patient">
                        <a href="pasien.php" class="non-style-link-menu"><div><p class="menu-text">Pasien</p></a></div>
                    </td>
                </tr>
                <tr class="menu-row" >
                    <td class="menu-btn menu-icon-settings">
                        <a href="pengaturan.php" class="non-style-link-menu"><div><p class="menu-text">Pengaturan</p></a></div>
                    </td>
                </tr>
                
            </table>
        </div>
        <div class="dash-body" style="margin-top: 15px">
            <table border="0" width="100%" style=" border-spacing: 0;margin:0;padding:0;" >
                        
                        <tr >
                            
                            <td colspan="1" class="nav-bar" >
                            <p style="font-size: 23px;padding-left:12px;font-weight: 600;margin-left:20px;">Dashboard</p>
                          
                            </td>
                            <td width="25%">

                            </td>
                            <td width="15%">
                                <p style="font-size: 14px;color: rgb(119, 119, 119);padding: 0;margin: 0;text-align: right;">
                                   Hari ini
                                </p>
                                <p class="heading-sub12" style="padding: 0;margin: 0;">
                                    <?php 
                                date_default_timezone_set('Asia/jakarta');
        
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
                    <td colspan="4" >
                        
                    <center>
                    <table class="filter-container doctor-header" style="border: none;width:95%" border="0" >
                    <tr>
                        <td >
                            <h3>Selamat Datang!</h3>
                            <h1><?php echo $username  ?>.</h1>
                            <p>Terima kasih telah bergabung dengan kami. Kami selalu berusaha memberi Anda layanan lengkap<br><br>
                            </p>
                            <a href="janji_temu.php" class="non-style-link"><button class="btn-primary btn" style="width:30%">Lihat janji </button></a>
                            <br>
                            <br>
                        </td>
                    </tr>
                    </table>
                    </center>
                    
                </td>
                </tr>
                <tr>
                    <td colspan="4">
                        <table border="0" width="100%"">
                            <tr>
                                <td width="50%">
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
                                                                    Semua Dokter &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
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
                                                                   Semua Pasien &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                                </div>
                                                        </div>
                                                                <div class="btn-icon-back dashboard-icons" style="background-image: url('../img/icons/patients-hover.svg');"></div>
                                                    </div>
                                                </td>
                                                </tr>
                                                <tr>
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
                                                    <div  class="dashboard-items"  style="padding:20px;margin:auto;width:95%;display: flex;padding-top:21px;padding-bottom:21px;">
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
                                <td>

                                    <p id="anim" style="font-size: 20px;font-weight:600;padding-left: 40px;">Sesi Anda Yang Akan Datang hingga Minggu depan</p>
                                    <center>
                                        <div class="abc scroll" style="height: 250px;padding: 0;margin: 0;">
                                        <table width="85%" class="sub-table scrolldown" border="0" >
                                        <thead>
                                            
                                        <tr>
                                                <th class="table-headin">
                                                    JadwaL Sesi         
                                                </th>
                                                <th class="table-headin">
                                                    Jadwal Waktu
                                                </th>
                                                <th class="table-headin">       
                                                     Waktu
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
                                                    <p class="heading-main12" style="margin-left: 45px;font-size:20px;color:rgb(49, 49, 49)">Kami tidak bisa menemukan yang sesuai dengan kata kunci kamu</p>
                                                    <a class="non-style-link" href="jadwal.php"><button  class="login-btn btn-primary-soft btn"  style="display: flex;justify-content: center;align-items: center;margin-left:20px;">&nbsp; Lihat semua sesi &nbsp;</font></button>
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
                                                        <td style="padding:20px;font-size:13px;">
                                                        '.substr($jadwaltgl,0,10).'
                                                        </td>
                                                        <td style="text-align:center;">
                                                            '.substr($jadwalwaktu,0,5).'
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
                        </table>
                    </td>
                <tr>
            </table>
        </div>
    </div>


</body>
</html>