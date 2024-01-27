<?php

    session_start();

    if(isset($_SESSION["user"])){
        if(($_SESSION["user"])=="" or $_SESSION['tipepengguna']!='a'){
            header("location: ../masuk.php");
        }

    }else{
        header("location: ../masuk.php");
    }
    
    
    if($_POST){
        //import database
        include("../koneksi.php");
        $title=$_POST["title"];
        $dokid=$_POST["dokid"];
        $nop=$_POST["nop"];
        $date=$_POST["date"];
        $time=$_POST["time"];
        $sql="insert into jadwal (dokid,title,jadwaltgl,jadwalwaktu,nop) values ($dokid,'$title','$date','$time',$nop);";
        $result= $database->query($sql);
        header("location: jadwal.php?action=session-added&title=$title");
        
    }
    ?>