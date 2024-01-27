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
        .dashbord-tables{
            animation: transitionIn-Y-over 0.5s;
        }
        .filter-container{
            animation: transitionIn-Y-bottom  0.5s;
        }
        .sub-table,.anime{
            animation: transitionIn-Y-bottom 0.5s;
        }
    </style>
    
    
</head>
<body>
    <?php

    //learn from w3schools.com

    session_start();

    if(isset($_SESSION["user"])){
        if(($_SESSION["user"])=="" or $_SESSION['tipepengguna']!='p'){
            header("location: ../masuk.php");
        }else{
            $useremail=$_SESSION["user"];
        }

    }else{
        header("location: ../masuk.php");
    }
    

    //import database
    include("../koneksi.php");
    $userrow = $database->query("select * from pasien where pemail='$useremail'");
    $userfetch=$userrow->fetch_assoc();
    $userid= $userfetch["pid"];
    $username=$userfetch["pnama"];


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
                                    <a href="../keluar.php" ><input type="button" value="Log out" class="logout-btn btn-primary-soft btn"></a>
                                </td>
                            </tr>
                    </table>
                    </td>
                </tr>
                <tr class="menu-row" >
                    <td class="menu-btn menu-icon-home menu-active menu-icon-home-active" >
                        <a href="index.php" class="non-style-link-menu non-style-link-menu-active"><div><p class="menu-text">Dashboard</p></a></div></a>
                    </td>
                </tr>
                <tr class="menu-row">
                    <td class="menu-btn menu-icon-doctor">
                        <a href="dokter.php" class="non-style-link-menu"><div><p class="menu-text">Daftar Semua Dokter</p></a></div>
                    </td>
                </tr>
                
                <tr class="menu-row" >
                    <td class="menu-btn menu-icon-session">
                        <a href="jadwal.php" class="non-style-link-menu"><div><p class="menu-text">Jadwal Sesi</p></div></a>
                    </td>
                </tr>
                <tr class="menu-row" >
                    <td class="menu-btn menu-icon-appoinment">
                        <a href="janjitemu.php" class="non-style-link-menu"><div><p class="menu-text">Pemesanan Saya</p></a></div>
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
                                    Tanggal Hari ini
                                </p>
                                <p class="heading-sub12" style="padding: 0;margin: 0;">
                                    <?php 
                                date_default_timezone_set('Asia/Kolkata');
        
                                $hari_ini = date('Y-m-d');
                                echo $hari_ini;


                                $pasienrow = $database->query("select  * from  pasien;");
                                $dokterrow = $database->query("select  * from  dokter;");
                                $janjitemurow = $database->query("select  * from  janjitemu where janjitgl>='$hari_ini';");
                                $jadwalrow = $database->query("select  * from  jadwal where jadwaltgl='$hari_ini';");


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
                    <table class="filter-container doctor-header patient-header" style="border: none;width:95%" border="0" >
                    <tr>
                        <td >
                            <h3>Selamat Datang!</h3>
                            <h1><?php echo $username  ?>.</h1>
                            <p>belum ada gambaran tentang dokter? tidak masalah, anda bisa lihat ke
                                <a href="dokter.php" class="non-style-link"><b>"Daftar semua dokter"</b></a> Bagian atau
                                <a href="jadwal.php" class="non-style-link"><b>"Sesi-Sesi"</b> </a><br>
                                Lihat janji temu kamu yang dulu dan yang akan datang.<br>Dan cari jam kedatangan dokter kamu atau konsultan medis.<br><br>
                            </p>
                            
                            <h3>Terhubung dengan dokter disini</h3>
                            <form action="jadwal.php" method="post" style="display: flex" class="header-search">

                                <input type="search" name="search" class="input-text " placeholder="Cari Dokter dan kita akan carikan sesi yang tersedia " list="dokter" style="width:45%;">&nbsp;&nbsp;
                                
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
                                
                           
                                <input type="Submit" value="Search" class="login-btn btn-primary btn" style="padding-left: 25px;padding-right: 25px;padding-top: 10px;padding-bottom: 10px;">
                            
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
                                                                    Pemesanan baru &nbsp;&nbsp;
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
                                                                    Sesi Hari ini
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


                            
                                    <p style="font-size: 20px;font-weight:600;padding-left: 40px;" class="anime">Pemesanan Kamu</p>
                                    <center>
                                        <div class="abc scroll" style="height: 250px;padding: 0;margin: 0;">
                                        <table width="85%" class="sub-table scrolldown" border="0" >
                                        <thead>
                                            
                                        <tr>
                                        <th class="table-headin">
                                                    
                                                
                                                    Nomer. JanjiTemu
                                                    
                                                    </th>
                                                <th class="table-headin">
                                                    
                                                
                                                Judul Sesi
                                                
                                                </th>
                                                
                                                <th class="table-headin">
                                                    Dokter
                                                </th>
                                                <th class="table-headin">
                                                    
                                                    Tanggal dan Waktu Jadwal
                                                    
                                                </th>
                                                    
                                                </tr>
                                        </thead>
                                        <tbody>
                                        
                                            <?php
                                            $nextweek=date("Y-m-d",strtotime("+1 week"));
                                                $sqlmain= "select * from jadwal inner join janjitemu on jadwal.jadwalid=janjitemu.jadwalid inner join pasien on pasien.pid=janjitemu.pid inner join dokter on jadwal.dokid=dokter.dokid  where  pasien.pid=$userid  and jadwal.jadwaltgl>='$hari_ini' order by jadwal.jadwaltgl asc";
                                                //echo $sqlmain;
                                                $result= $database->query($sqlmain);
                
                                                if($result->num_rows==0){
                                                    echo '<tr>
                                                    <td colspan="4">
                                                    <br><br><br><br>
                                                    <center>
                                                    <img src="../img/notfound.svg" width="25%">
                                                    
                                                    <br>
                                                    <p class="heading-main12" style="margin-left: 45px;font-size:20px;color:rgb(49, 49, 49)">Nothing to show here!</p>
                                                    <a class="non-style-link" href="jadwal.php"><button  class="login-btn btn-primary-soft btn"  style="display: flex;justify-content: center;align-items: center;margin-left:20px;">&nbsp; Channel a Doctor &nbsp;</font></button>
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
                                                    $janjinom=$row["janjinom"];
                                                    $doknama=$row["doknama"];
                                                    $jadwaltgl=$row["jadwaltgl"];
                                                    $jadwalwaktu=$row["jadwalwaktu"];
                                                   
                                                    echo '<tr>
                                                        <td style="padding:30px;font-size:25px;font-weight:700;"> &nbsp;'.
                                                        $janjinom
                                                        .'</td>
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
                        </table>
                    </td>
                <tr>
            </table>
        </div>
    </div>


</body>
</html>