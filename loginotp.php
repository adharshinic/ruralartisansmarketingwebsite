<?php
session_start();
include("dbconnection.php");
if($_POST['logintype'] == "Customer") {
	$otp = rand(100001,999999);
	$sql = "SELECT * FROM customer WHERE email_id='$_POST[emailid]' AND password='$_POST[password]' AND status='Active' ";
	$qsql = mysqli_query($con,$sql);
	if(mysqli_num_rows($qsql) == 1){
		$rslogin = mysqli_fetch_array($qsql);
		$cstname = $rslogin['customer_name'];
		$mblnum = $rslogin['mobile_no'];
		$msg = "Hello $cstname,\nYour One-Time-Password (OTP) for Zimcrafts Login.\nYour OTP Code is : $otp\nDo not share your OTP with anyone.";
		//include("phpmailer.php");
		//sendmail($emailid, $cstname , "OTP for Account Verification", $msg);
		include('smsapi.php');
		send_sms($mblnum,$msg);
		$arr = array("status" => "Success","cstname" => $cstname, "mblnum" => $mblnum, "otp" => $otp);
		echo json_encode($arr);
	}
	else {
		$arr = array("status" => "Failed");
		echo json_encode($arr);
	}
}
if($_POST['logintype'] == "artist") {
	$otp = rand(100001,999999);
	$sql = "SELECT * FROM artist WHERE email_id='$_POST[emailid]' AND password='$_POST[password]' AND status='Active' ";
	$qsql = mysqli_query($con,$sql);
	if(mysqli_num_rows($qsql) == 1){
		$rslogin = mysqli_fetch_array($qsql);
		$cstname = $rslogin['artist_name'];
		$mblnum = $rslogin['mobile_no'];
		$msg = "Hello $cstname,\nYour One-Time-Password (OTP) for Zimcrafts Login.\nYour OTP Code is : $otp\nDo not share your OTP with anyone.";
		//include("phpmailer.php");
		//sendmail($emailid, $cstname , "OTP for Account Verification", $msg);
		include('smsapi.php');
		send_sms($mblnum,$msg);
		$arr = array("status" => "Success","cstname" => $cstname, "mblnum" => $mblnum, "otp" => $otp);
		echo json_encode($arr);
	}
	else {
		$arr = array("status" => "Failed");
		echo json_encode($arr);
	}
}
if($_POST['logintype'] == "Worker") {
	$otp = rand(100001,999999);
	$sql = "SELECT * FROM worker WHERE login_id='$_POST[emailid]' AND password='$_POST[password]' AND status='Active' ";
	$qsql = mysqli_query($con,$sql);
	if(mysqli_num_rows($qsql) == 1){
		$rslogin = mysqli_fetch_array($qsql);
		$cstname = $rslogin['name'];
		$mblnum = $rslogin['contactno'];
		$msg = "Hello $cstname,\nYour One-Time-Password (OTP) for Zimcrafts Login.\nYour OTP Code is : $otp\nDo not share your OTP with anyone.";
		//include("phpmailer.php");
		//sendmail($emailid, $cstname , "OTP for Account Verification", $msg);
		include('smsapi.php');
		send_sms($mblnum,$msg);
		$arr = array("status" => "Success","cstname" => $cstname, "mblnum" => $mblnum, "otp" => $otp);
		echo json_encode($arr);
	}
	else {
		$arr = array("status" => "Failed");
		echo json_encode($arr);
	}
}
?>