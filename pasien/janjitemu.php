<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/animations.css">  
    <link rel="stylesheet" href="../css/main.css">  
    <link rel="stylesheet" href="../css/admin.css">
        
    <title>Janji </title>
    <style>
        .popup{
            animation: transitionIn-Y-bottom 0.5s;
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


    $sqlmain= "select janjitemu.janjiid,jadwal.jadwalid,jadwal.judul,dokter.doknama,pasien.pnama,jadwal.jadwaltgl,jadwal.jadwalwaktu,janjitemu.janjinom,janjitemu.janjitgl from jadwal inner join janjitemu on jadwal.jadwalid=janjitemu.jadwalid inner join pasien on pasien.pid=janjitemu.pid inner join dokter on jadwal.dokid=dokter.dokid  where  pasien.pid=$userid ";

    if($_POST){
        //print_r($_POST);
        


        
        if(!empty($_POST["jadwaltgl"])){
            $jadwaltgl=$_POST["jadwaltgl"];
            $sqlmain.=" and jadwal.jadwaltgl='$jadwaltgl' ";
        };

    

        //echo $sqlmain;

    }

    $sqlmain.="order by janjitemu.janjitgl  asc";
    $result= $database->query($sqlmain);
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
                                    <a href="../logout.php" ><input type="button" value="Log out" class="logout-btn btn-primary-soft btn"></a>
                                </td>
                            </tr>
                    </table>
                    </td>
                </tr>
                <tr class="menu-row" >
                    <td class="menu-btn menu-icon-home" >
                        <a href="index.php" class="non-style-link-menu "><div><p class="menu-text">Beranda</p></a></div></a>
                    </td>
                </tr>
                <tr class="menu-row">
                    <td class="menu-btn menu-icon-doctor">
                        <a href="dokter.php" class="non-style-link-menu"><div><p class="menu-text">Daftar Semua Dokter</p></a></div>
                    </td>
                </tr>
                
                <tr class="menu-row" >
                    <td class="menu-btn menu-icon-session">
                        <a href="jadwal.php" class="non-style-link-menu"><div><p class="menu-text">jadwal Sesi</p></div></a>
                    </td>
                </tr>
                <tr class="menu-row" >
                    <td class="menu-btn menu-icon-appoinment  menu-active menu-icon-appoinment-active">
                        <a href="janjitemu.php" class="non-style-link-menu non-style-link-menu-active"><div><p class="menu-text">Pemesanan Saya</p></a></div>
                    </td>
                </tr>
                <tr class="menu-row" >
                    <td class="menu-btn menu-icon-settings">
                        <a href="Pengaturan.php" class="non-style-link-menu"><div><p class="menu-text">Pengaturan</p></a></div>
                    </td>
                </tr>
                
            </table>
        </div>
        <div class="dash-body">
            <table border="0" width="100%" style=" border-spacing: 0;margin:0;padding:0;margin-top:25px; ">
                <tr >
                    <td width="13%" >
                    <a href="index.php" ><button  class="login-btn btn-primary-soft btn btn-icon-back"  style="padding-top:11px;padding-bottom:11px;margin-left:20px;width:125px"><font class="tn-in-text">Back</font></button></a>
                    </td>
                    <td>
                        <p style="font-size: 23px;padding-left:12px;font-weight: 600;">Histori Pemesanan Saya</p>
                                           
                    </td>
                    <td width="15%">
                        <p style="font-size: 14px;color: rgb(119, 119, 119);padding: 0;margin: 0;text-align: right;">
                            Tanggal Hari Ini
                        </p>
                        <p class="heading-sub12" style="padding: 0;margin: 0;">
                            <?php 

                        date_default_timezone_set('Asia/Kolkata');

                        $hari_ini = date('Y-m-d');
                        echo $hari_ini;

                        
                        ?>
                        </p>
                    </td>
                    <td width="10%">
                        <button  class="btn-label"  style="display: flex;justify-content: center;align-items: center;"><img src="../img/calendar.svg" width="100%"></button>
                    </td>


                </tr>
               
                <!-- <tr>
                    <td colspan="4" >
                        <div style="display: flex;margin-top: 40px;">
                        <div class="heading-main12" style="margin-left: 45px;font-size:20px;color:rgb(49, 49, 49);margin-top: 5px;">jadwal a Session</div>
                        <a href="?action=add-session&id=none&error=0" class="non-style-link"><button  class="login-btn btn-primary btn button-icon"  style="margin-left:25px;background-image: url('../img/icons/add.svg');">Add a Session</font></button>
                        </a>
                        </div>
                    </td>
                </tr> -->
                <tr>
                    <td colspan="4" style="padding-top:10px;width: 100%;" >
                    
                        <p class="heading-main12" style="margin-left: 45px;font-size:18px;color:rgb(49, 49, 49)">Pesanan Saya (<?php echo $result->num_rows; ?>)</p>
                    </td>
                    
                </tr>
                <tr>
                    <td colspan="4" style="padding-top:0px;width: 100%;" >
                        <center>
                        <table class="filter-container" border="0" >
                        <tr>
                           <td width="10%">

                           </td> 
                        <td width="5%" style="text-align: center;">
                        Tanggal :
                        </td>
                        <td width="30%">
                        <form action="" method="post">
                            
                            <input type="date" name="jadwaltgl" id="date" class="input-text filter-container-items" style="margin: 0;width: 95%;">

                        </td>
                        
                    <td width="12%">
                        <input type="submit"  name="filter" value=" Filter" class=" btn-primary-soft btn button-icon btn-filter"  style="padding: 15px; margin :0;width:100%">
                        </form>
                    </td>

                    </tr>
                            </table>

                        </center>
                    </td>
                    
                </tr>
                
               
                  
                <tr>
                   <td colspan="4">
                       <center>
                        <div class="abc scroll">
                        <table width="93%" class="sub-table scrolldown" border="0" style="border:none">
                        
                        <tbody>
                        
                            <?php

                                
                                

                                if($result->num_rows==0){
                                    echo '<tr>
                                    <td colspan="7">
                                    <br><br><br><br>
                                    <center>
                                    <img src="../img/notfound.svg" width="25%">
                                    
                                    <br>
                                    <p class="heading-main12" style="margin-left: 45px;font-size:20px;color:rgb(49, 49, 49)">Kami Tidak Bisa Menemukan Kata Pencarian Anda !</p>
                                    <a class="non-style-link" href="janjitemu.php"><button  class="login-btn btn-primary-soft btn"  style="display: flex;justify-content: center;align-items: center;margin-left:20px;">&nbsp; Tunjukkan Semua Janji &nbsp;</font></button>
                                    </a>
                                    </center>
                                    <br><br><br><br>
                                    </td>
                                    </tr>';
                                    
                                }
                                else{

                                    for ( $x=0; $x<($result->num_rows);$x++){
                                        echo "<tr>";
                                        for($q=0;$q<3;$q++){
                                            $row=$result->fetch_assoc();
                                            if (!isset($row)){
                                            break;
                                            };
                                            $jadwalid=$row["jadwalid"];
                                            $judul=$row["judul"];
                                            $doknama=$row["doknama"];
                                            $jadwaltgl=$row["jadwaltgl"];
                                            $jadwalwaktu=$row["jadwalwaktu"];
                                            $janjinom=$row["janjinom"];
                                            $janjitgl=$row["janjitgl"];
                                            $janjiid=$row["janjiid"];
    
                                            if($jadwalid==""){
                                                break;
                                            }
    
                                            echo '
                                            <td style="width: 25%;">
                                                    <div  class="dashboard-items search-items"  >
                                                    
                                                        <div style="width:100%;">
                                                        <div class="h3-search">
                                                                    Tanggal Pemesanan: '.substr($janjitgl,0,30).'<br>
                                                                    Nomer Referensi: OC-000-'.$janjiid.'
                                                                </div>
                                                                <div class="h1-search">
                                                                    '.substr($judul,0,21).'<br>
                                                                </div>
                                                                <div class="h3-search">
                                                                    Nomer Janji:<div class="h1-search">0'.$janjinom.'</div>
                                                                </div>
                                                                <div class="h3-search">
                                                                    '.substr($doknama,0,30).'
                                                                </div>
                                                                
                                                                
                                                                <div class="h4-search">
                                                                    Tanggal Jadwal: '.$jadwaltgl.'<br>Starts: <b>@'.substr($jadwalwaktu,0,5).'</b> (24h)
                                                                </div>
                                                                <br>
                                                                <a href="?action=drop&id='.$janjiid.'&title='.$judul.'&doc='.$doknama.'" ><button  class="login-btn btn-primary-soft btn "  style="padding-top:11px;padding-bottom:11px;width:100%"><font class="tn-in-text">Batalkan</font></button></a>
                                                        </div>
                                                                
                                                    </div>
                                                </td>';
    
                                        }
                                        echo "</tr>";
                           
                                // for ( $x=0; $x<$result->num_rows;$x++){
                                //     $row=$result->fetch_assoc();
                                //     $janjiid=$row["janjiid"];
                                //     $jadwalid=$row["jadwalid"];
                                //     $judul=$row["title"];
                                //     $doknama=$row["doknama"];
                                //     $jadwaltgl=$row["jadwaltgl"];
                                //     $jadwalwaktu=$row["jadwalwaktu"];
                                //     $pnama=$row["pnama"];
                                //     
                                //     
                                //     echo '<tr >
                                //         <td style="font-weight:600;"> &nbsp;'.
                                        
                                //         substr($pnama,0,25)
                                //         .'</td >
                                //         <td style="text-align:center;font-size:23px;font-weight:500; color: var(--btnnicetext);">
                                //         '.$janjinom.'
                                        
                                //         </td>
                                //         <td>
                                //         '.substr($judul,0,15).'
                                //         </td>
                                //         <td style="text-align:center;;">
                                //             '.substr($jadwaltgl,0,10).' @'.substr($jadwalwaktu,0,5).'
                                //         </td>
                                        
                                //         <td style="text-align:center;">
                                //             '.$janjitgl.'
                                //         </td>

                                //         <td>
                                //         <div style="display:flex;justify-content: center;">
                                        
                                //         <!--<a href="?action=view&id='.$janjiid.'" class="non-style-link"><button  class="btn-primary-soft btn button-icon btn-view"  style="padding-left: 40px;padding-top: 12px;padding-bottom: 12px;margin-top: 10px;"><font class="tn-in-text">View</font></button></a>
                                //        &nbsp;&nbsp;&nbsp;-->
                                //        <a href="?action=drop&id='.$janjiid.'&name='.$pnama.'&session='.$judul.'&janjinom='.$janjinom.'" class="non-style-link"><button  class="btn-primary-soft btn button-icon btn-delete"  style="padding-left: 40px;padding-top: 12px;padding-bottom: 12px;margin-top: 10px;"><font class="tn-in-text">Cancel</font></button></a>
                                //        &nbsp;&nbsp;&nbsp;</div>
                                //         </td>
                                //     </tr>';
                                    
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
        </div>
    </div>
    <?php
    
    if($_GET){
        $id=$_GET["id"];
        $action=$_GET["action"];
        if($action=='booking-added'){
            
            echo '
            <div id="popup1" class="overlay">
                    <div class="popup">
                    <center>
                    <br><br>
                        <h2>Booking Successfully.</h2>
                        <a class="close" href="janjitemu.php">&times;</a>
                        <div class="content">
                        Nomer janji mu adalah'.$id.'.<br><br>
                            
                        </div>
                        <div style="display: flex;justify-content: center;">
                        
                        <a href="janjitemu.php" class="non-style-link"><button  class="btn-primary btn"  style="display: flex;justify-content: center;align-items: center;margin:10px;padding:10px;"><font class="tn-in-text">&nbsp;&nbsp;OK&nbsp;&nbsp;</font></button></a>
                        <br><br><br><br>
                        </div>
                    </center>
            </div>
            </div>
            ';
        }elseif($action=='drop'){
            $judul=$_GET["judul"];
            $doknama=$_GET["doknama"];
            
            echo '
            <div id="popup1" class="overlay">
                    <div class="popup">
                    <center>
                        <h2>Are you sure?</h2>
                        <a class="close" href="janjitemu.php">&times;</a>
                        <div class="content">
                           Apakah Kamu Ingin Membatalkan Janji Ini?<br><br>
                            Nama Sesi: &nbsp;<b>'.substr($judul,0,40).'</b><br>
                            dokter name&nbsp; : <b>'.substr($doknama,0,40).'</b><br><br>
                            
                        </div>
                        <div style="display: flex;justify-content: center;">
                        <a href="hapus-janji.php?id='.$id.'" class="non-style-link"><button  class="btn-primary btn"  style="display: flex;justify-content: center;align-items: center;margin:10px;padding:10px;"<font class="tn-in-text">&nbsp;Yes&nbsp;</font></button></a>&nbsp;&nbsp;&nbsp;
                        <a href="janjitemu.php" class="non-style-link"><button  class="btn-primary btn"  style="display: flex;justify-content: center;align-items: center;margin:10px;padding:10px;"><font class="tn-in-text">&nbsp;&nbsp;No&nbsp;&nbsp;</font></button></a>

                        </div>
                    </center>
            </div>
            </div>
            '; 
        }elseif($action=='view'){
            $sqlmain= "select * from dokter where dokid='$id'";
            $result= $database->query($sqlmain);
            $row=$result->fetch_assoc();
            $nama=$row["doknama"];
            $email=$row["doknama"];
            $spe=$row["spesialis"];
            
            $spcil_res= $database->query("select snama from spesialis where id='$spe'");
            $spcil_array= $spcil_res->fetch_assoc();
            $spcil_name=$spcil_array["snama"];
            $nic=$row['doknik'];
            $tele=$row['doctel'];
            echo '
            <div id="popup1" class="overlay">
                    <div class="popup">
                    <center>
                        <h2></h2>
                        <a class="close" href="dokter.php">&times;</a>
                        <div class="content">
                            eDoc Web App<br>
                            
                        </div>
                        <div style="display: flex;justify-content: center;">
                        <table width="80%" class="sub-table scrolldown add-doc-form-container" border="0">
                        
                            <tr>
                                <td>
                                    <p style="padding: 0;margin: 0;text-align: left;font-size: 25px;font-weight: 500;">View Details.</p><br><br>
                                </td>
                            </tr>
                            
                            <tr>
                                
                                <td class="label-td" colspan="2">
                                    <label for="name" class="form-label">Name: </label>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                    '.$nama.'<br><br>
                                </td>
                                
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                    <label for="Email" class="form-label">Email: </label>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                '.$email.'<br><br>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                    <label for="nic" class="form-label">NIC: </label>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                '.$nic.'<br><br>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                    <label for="Tele" class="form-label">Telephone: </label>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                '.$tele.'<br><br>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                    <label for="spec" class="form-label">spesialis: </label>
                                    
                                </td>
                            </tr>
                            <tr>
                            <td class="label-td" colspan="2">
                            '.$spcil_name.'<br><br>
                            </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <a href="dokter.php"><input type="button" value="OK" class="login-btn btn-primary-soft btn" ></a>
                                
                                    
                                </td>
                
                            </tr>
                           

                        </table>
                        </div>
                    </center>
                    <br><br>
            </div>
            </div>
            ';  
    }
}

    ?>
    </div>

</body>
</html>
