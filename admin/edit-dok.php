<?php
    
    

    //import database
    include("../koneksi.php");



    if($_POST){
        //print_r($_POST);
        $result= $database->query("select * from webpengguna");
        $nama=$_POST['nama'];
        $nik=$_POST['nik'];
        $oldemail=$_POST["oldemail"];
        $spec=$_POST['spec'];
        $email=$_POST['email'];
        $tele=$_POST['Tele'];
        $katasandi=$_POST['katasandi'];
        $cpassword=$_POST['cpassword'];
        $id=$_POST['id00'];
        
        if ($password==$cpassword){
            $error='3';
            $result= $database->query("select dokter.dokid from dokter inner join webpengguna on dokter.dokemail=webpengguna.email where webpengguna.email='$email';");
            //$resultqq= $database->query("select * from dokter where dokid='$id';");
            if($result->num_rows==1){
                $id2=$result->fetch_assoc()["dokid"];
            }else{
                $id2=$id;
            }
            
            echo $id2."jdfjdfdh";
            if($id2!=$id){
                $error='1';
                //$resultqq1= $database->query("select * from dokter where docemail='$email';");
                //$did= $resultqq1->fetch_assoc()["dokid"];
                //if($resultqq1->num_rows==1){
                    
            }else{

                //$sql1="insert into dokter(docemail,doknama,docpassword,docnic,doctel,specialties) values('$email','$nama','$password','$nic','$tele',$spec);";
                $sql1="update dokter set dokemail='$email',doknama='$nama',dokkatasandi='$katasandi',doknik='$nik',doktel='$tele',spesialis=$spec where dokid=$id ;";
                $database->query($sql1);
                
                $sql1="update webpengguna set email='$email' where email='$oldemail' ;";
                $database->query($sql1);
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
    

    header("location: dokter.php?action=edit&error=".$error."&id=".$id);
    ?>
    
   

</body>
</html>
