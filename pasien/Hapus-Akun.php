<?php

    session_start();

    if(isset($_SESSION["user"])){
        if(($_SESSION["user"])=="" or $_SESSION['usertype']!='p'){
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

    
    if($_GET){
        //import database
        include("../koneksi.php");
        $id=$_GET["id"];
        $result001= $database->query("select * from pasien where pid=$id;");
        $email=($result001->fetch_assoc())["pemail"];
        $sql= $database->query("delete from webpengguna where email='$email';");
        $sql= $database->query("delete from pasien where pemail='$email';");
        //print_r($email);
        header("location: ../keluar.php");
    }


?>