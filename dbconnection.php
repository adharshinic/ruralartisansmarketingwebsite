<?php
if(!isset($_SESSION)) { session_start(); }
error_reporting(E_ALL & ~E_NOTICE  &  ~E_STRICT  &  ~E_WARNING);
$con=mysqli_connect("localhost","root","","zimcrafts","3307");
echo mysqli_connect_error();
?>