<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/animations.css">  
    <link rel="stylesheet" href="../css/main.css">  
    <link rel="stylesheet" href="../css/admin.css">
        
    <title>Sesi</title>
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
session_start();
if(isset($_SESSION["user"])){
    if(($_SESSION["user"])=="" or $_SESSION['tipepengguna']!='p'){
        header("location: '../masuk.php'");
    }else{
        $useremail=$_SESSION["user"];
    }
}else{
    header("location: '../masuk.php'");
}
//import database
include("../koneksi.php");
$sqlmain= "select * from pasien where pemail=?";
$stmt = $database->prepare($sqlmain);
$stmt->bind_param("s",$useremail);
$stmt->execute();
$result = $stmt->get_result();
$userrow = $result->fetch_assoc();
$userid= $userrow["pid"];
$username=$userrow["pnama"];
//echo $userid;
//echo $username;
date_default_timezone_set('Asia/Kolkata');
$hari_ini = date('Y-m-d');

//echo $userid;
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
                <td class="menu-btn menu-icon-home " >
                    <a href="index.php" class="non-style-link-menu "><div><p class="menu-text">Beranda</p></a></div></a>
                </td>
            </tr>
            <tr class="menu-row">
                <td class="menu-btn menu-icon-doctor">
                    <a href="dokter.php" class="non-style-link-menu"><div><p class="menu-text">Semua Dokter</p></a></div>
                </td>
            </tr>
            
            <tr class="menu-row" >
                <td class="menu-btn menu-icon-session menu-active menu-icon-session-active">
                    <a href="jadwal.php" class="non-style-link-menu non-style-link-menu-active"><div><p class="menu-text">Jadwal Sesi</p></div></a>
                </td>
            </tr>
            <tr class="menu-row" >
                <td class="menu-btn menu-icon-appoinment">
                    <a href="janjitemu.php" class="non-style-link-menu"><div><p class="menu-text">Pemesanan saya</p></a></div>
                </td>
            </tr>
            <tr class="menu-row" >
                <td class="menu-btn menu-icon-settings">
                    <a href="pengaturan.php" class="non-style-link-menu"><div><p class="menu-text">Pengaturan</p></a></div>
                </td>
            </tr>
        </table>
    </div>
    <?php
            $sqlmain= "select * from jadwal inner join dokter on jadwal.dokid=dokter.dokid where jadwal.jadwaltgl>='$hari_ini'  order by jadwal.jadwaltgl asc";
            $sqlpt1="";
            $insertkey="";
            $q='';
            $tipepencarian="All";
                    if($_POST){
                    //print_r($_POST);
                    
                    if(!empty($_POST["search"])){
                        /*TODO: make and understand */
                        $keyword=$_POST["search"];
                        $sqlmain= "select * from jadwal inner join dokter on jadwal.dokid=dokter.dokid where jadwal.jadwaltgl>='$hari_ini' and (dokter.doknama='$keyword' or dokter.doknama like '$keyword%' or dokter.doknama like '%$keyword' or dokter.doknama like '%$keyword%' or jadwal.judul='$keyword' or jadwal.judul like '$keyword%' or jadwal.judul like '%$keyword' or jadwal.judul like '%$keyword%' or jadwal.jadwaltgl like '$keyword%' or jadwal.jadwaltgl like '%$keyword' or jadwal.jadwaltgl like '%$keyword%' or jadwal.jadwaltgl='$keyword' )  order by jadwal.jadwaltgl asc";
                        //echo $sqlmain;
                        $insertkey=$keyword;
                        $tipepencarian="Hasil Pencarian : ";
                        $q='"';
                    }
                }
            $result= $database->query($sqlmain)
            ?> 
    <div class="dash-body">
        <table border="0" width="100%" style=" border-spacing: 0;margin:0;padding:0;margin-top:25px; ">
            <tr >
                <td width="13%" >
                <a href="index.php" ><button  class="login-btn btn-primary-soft btn btn-icon-back"  style="padding-top:11px;padding-bottom:11px;margin-left:20px;width:125px"><font class="tn-in-text">Kembali</font></button></a>
                </td>
                <td >
                        <form action="" method="post" class="header-search">

                                    <input type="search" name="search" class="input-text header-searchbar" placeholder="Cari nama dokter, alamat email, atau tanggal (YYYY-MM-DD)" list="doctors" value="<?php  echo $insertkey ?>">&nbsp;&nbsp;
                                    
                                    <?php
                                        echo '<datalist id="doctors">';
                                        $list11 = $database->query("select DISTINCT * from  dokter;");
                                        $list12 = $database->query("select DISTINCT * from  jadwal GROUP BY judul;");

                                        for ($y=0;$y<$list11->num_rows;$y++){
                                            $row00=$list11->fetch_assoc();
                                            $d=$row00["doknama"];
                                           
                                            echo "<option value='$d'><br/>";
                                        };
                                        for ($y=0;$y<$list12->num_rows;$y++){
                                            $row00=$list12->fetch_assoc();
                                            $d=$row00["judul"];
                                           
                                            echo "<option value='$d'><br/>";
                                                                                     };
                                    echo ' </datalist>';
        ?>            
                                    <input type="Submit" value="Cari" class="login-btn btn-primary btn" style="padding-left: 25px;padding-right: 25px;padding-top: 10px;padding-bottom: 10px;">
                                    </form>
                </td>
                <td width="15%">
                    <p style="font-size: 14px;color: rgb(119, 119, 119);padding: 0;margin: 0;text-align: right;">
                        Tanggal hari ini
                    </p>
                    <p class="heading-sub12" style="padding: 0;margin: 0;">
                        <?php 
                            echo $hari_ini;
                    ?>
                    </p>
                </td>
                <td width="10%">
                    <button  class="btn-label"  style="display: flex;justify-content: center;align-items: center;"><img src="../img/calendar.svg" width="100%"></button>
                </td>
            </tr>
            <tr>
                <td colspan="4" style="padding-top:10px;width: 100%;" >
                    <p class="heading-main12" style="margin-left: 45px;font-size:18px;color:rgb(49, 49, 49)"><?php echo $tipepencarian." Sessions"."(".$result->num_rows.")"; ?> </p>
                    <p class="heading-main12" style="margin-left: 45px;font-size:22px;color:rgb(49, 49, 49)"><?php echo $q.$insertkey.$q ; ?> </p>
                </td>
            </tr>
            <tr>
               <td colspan="4">
                   <center>
                    <div class="abc scroll">
                    <table width="100%" class="sub-table scrolldown" border="0" style="padding: 50px;border:none"> 
                    <tbody>
                        <?php
                            if($result->num_rows==0){
                                echo '<tr>
                                <td colspan="4">
                                <br><br><br><br>
                                <center>
                                <img src="../img/notfound.svg" width="25%">
                                
                                <br>
                                <p class="heading-main12" style="margin-left: 45px;font-size:20px;color:rgb(49, 49, 49)">Kami tidak dapat menemukan apa pun yang terkait dengan kata kunci Anda.</p>
                                <a class="non-style-link" href="schedule.php"><button  class="login-btn btn-primary-soft btn"  style="display: flex;justify-content: center;align-items: center;margin-left:20px;">&nbsp; Tampilkan semua sesi &nbsp;</font></button>
                                </a>
                                </center>
                                <br><br><br><br>
                                </td>
                                </tr>';
                            }
                            else{
                                //echo $result->num_rows;
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

                                    if($jadwalid==""){
                                        break;
                                    }

                                    echo '
                                    <td style="width: 25%;">
                                            <div  class="dashboard-items search-items"  >
                                            
                                                <div style="width:100%">
                                                        <div class="h1-search">
                                                            '.substr($judul,0,21).'
                                                        </div><br>
                                                        <div class="h3-search">
                                                            '.substr($doknama,0,30).'
                                                        </div>
                                                        <div class="h4-search">
                                                            '.$jadwaltgl.'<br>Starts: <b>@'.substr($jadwalwaktu,0,5).'</b> (24h)
                                                        </div>
                                                        <br>
                                                        <a href="Pemesanan.php?id='.$jadwalid.'" ><button  class="login-btn btn-primary-soft btn "  style="padding-top:11px;padding-bottom:11px;width:100%"><font class="tn-in-text">Pesan sekarang</font></button></a>
                                                </div>        
                                            </div>
                                        </td>';
                                }
                                echo "</tr>";
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
</div>
</body>
</html>