<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

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


    if($_POST){
        if(isset($_POST["booknow"])){
            $janjinom=$_POST["janjinom"];
            $jadwalid=$_POST["jadwalid"];
            $date=$_POST["date"];
            $jadwalid=$_POST["jadwalid"];
            $sql2="insert into janjitemu(pid,janjinom,jadwalid,janjitgl) values ($userid,$janjinom,$jadwalid,'$date')";
            $result= $database->query($sql2);
            //echo $apponom;
            header("location: janjitemu.php?action=booking-added&id=".$janjinom."&titleget=none");

        }
    }
 ?>