<?php
session_start();
if(isset($_POST['submit']))
{
$rno=$_SESSION['otp'];
$urno=$_POST['otpNo'];
if(!strcmp($rno,$urno))
{
//For admin if he want to know who is register
echo "<p>Thank you for show our Demo.</p>";
//For admin if he want to know who is register
}
else{
echo "<p>Invalid OTP</p>";
}
}
//resend OTP
if(isset($_POST['resend']))
{
$message="<p class='w3-text-green'>Sucessfully send OTP to your mail.</p>";
$rno=$_SESSION['otp'];
$to=$_SESSION['email'];
$subject = "OTP";
$txt = "OTP: ".$rno."";
$headers = "From: abhishek.vishwakarma9@gmail.com";
mail($to,$subject,$txt,$headers);
$message="<p class='w3-text-green w3-center'><b>Sucessfully resend OTP to your mail.</b></p>";
}
?>