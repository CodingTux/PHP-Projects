
<?php

    $svrName = "localhost";
    $usrName = "root";
    $usrPass = "9329025673*";
    $dbName = "logInf";

    $conn = new mysqli($svrName, $usrName, $usrPass, $dbName);
    $mail = $_POST['email'];
    $sql = "SELECT * FROM sgnUp WHERE EMAIL='$mail'";
    $result = $conn->query($sql);
    $user = mysqli_fetch_assoc($result);

    
  
    if ($user) { // if user exists
      
      if ($user['EMAIL'] == $mail) {

        $rndno=rand(100000, 999999);//OTP generate
        $to = $mail;
        $subject = "OTP";
        $txt = "OTP: ".$rndno."";
        $headers = "From: abhishek.vishwakarma9@gmail.com";
        mail($to,$subject,$txt,$headers);
        
      }else{
        echo "<script type='text/javascript'>alert('Email not exist');</script>";
      }

    }
    



?>