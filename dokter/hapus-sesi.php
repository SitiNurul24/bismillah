<?php

    session_start();

    if(isset($_SESSION["user"])){
        if(($_SESSION["user"])=="" or $_SESSION['tipepengguna']!='a'){
            header("location: ../masuk.php");
        }

    }else{
        header("location: ../masuk.php");
    }
    
    
    if($_GET){
        //import database
        include("../koneksi.php");
        $id=$_GET["id"];
        //$result001= $database->query("select * from jadwal where jadwalid=$id;");
        //$email=($result001->fetch_assoc())["docemail"];
        $sql= $database->query("delete from jadwal where jadwalid='$id';");
        //$sql= $database->query("delete from dokter where docemail='$email';");
        //print_r($email);
        header("location: jadwal.php");
    }


?>