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
        $result001= $database->query("select * from dokter where dokid=$id;");
        $email=($result001->fetch_assoc())["dokemail"];
        $sql= $database->query("delete from webpengguna where email='$email';");
        $sql= $database->query("delete from dokter where dokemail='$email';");
        //print_r($email);
        header("location: dokter.php");
    }


?>