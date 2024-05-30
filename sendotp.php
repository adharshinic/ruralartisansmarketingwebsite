<?php
session_start();
$otp = rand(100001,999999);
$cstname = $_GET['cstname'];
$mblnum = $_GET['mblnum'];
$msg = "Hello $cstname,\n
Your One-Time-Password (OTP) for Zimcrafts Registration.\n
Your OTP Code is : $otp\n
Do not share your OTP with anyone.";
//include("phpmailer.php");
//sendmail($emailid, $cstname , "OTP for Account Verification", $msg);
include('smsapi.php');
send_sms($mblnum,$msg);
echo $otp;
?>