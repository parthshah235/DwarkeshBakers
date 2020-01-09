<?php
session_start();
if(!isset($_SESSION['ud_email'])){session_destroy;header("Location:..\Home.php");}else{unset($_SESSION['sort']);} 
$_SESSION['datefrom']=$_POST['datefrom'];
$_SESSION['dateto']=$_POST['dateto'];
$_SESSION['a1']=$_POST['a1'];
header("Location:vieworder.php");
?>