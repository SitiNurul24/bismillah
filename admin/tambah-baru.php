<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/animations.css">  
    <link rel="stylesheet" href="../css/main.css">  
    <link rel="stylesheet" href="../css/admin.css">
        
    <title>Dokter</title>
    <style>
        .popup{
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



    if($_POST){
        //print_r($_POST);
        $result= $database->query("select * from webpengguna");
        $name=$_POST['name'];
        $nik=$_POST['nik'];
        $spec=$_POST['spec'];
        $email=$_POST['email'];
        $tele=$_POST['Tele'];
        $password=$_POST['password'];
        $cpassword=$_POST['cpassword'];
        
        if ($password==$cpassword){
            $error='3';
            $result= $database->query("select * from webpengguna where email='$email';");
            if($result->num_rows==1){
                $error='1';
            }else{

                $sql1="insert into dokter(dokemail,doknama,dokkatasandi,doknik,doktel,spesialis) values('$email','$name','$password','$nik','$tele',$spec);";
                $sql2="insert into webpengguna values('$email','d')";
                $database->query($sql1);
                $database->query($sql2);

                //echo $sql1;
                //echo $sql2;
                $error= '4';
                
            }
            
        }else{
            $error='2';
        }
    
    
        
        
    }else{
        //header('location: signup.php');
        $error='3';
    }
    

    header("location: dokter.php?action=add&error=".$error);
    ?>
    
   

</body>
</html>