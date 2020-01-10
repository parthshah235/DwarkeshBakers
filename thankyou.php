<?php
session_start();
include "connection.php";
//include 'src/Instamojo.php';
$donation_no=$_SESSION['last_id'];
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8">
        <meta charset="utf-8">
        <title>DwarkeshBakers</title>
        <meta name="generator" content="Bootply" />
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <!--[if lt IE 9]>
            <script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->
        <link href="css/styles.css" rel="stylesheet">
        <link rel="stylesheet" href="css/demo.css" />
        <link rel="stylesheet" href="css/testimonial.css" />
        <link rel="stylesheet" href="css/font-awesome.min.css">
        <link href='http://fonts.googleapis.com/css?family=Poiret+One' rel='stylesheet' type='text/css'>
    </head>
    <body style="background-color: #DEF0F1">
        <?php
     include_once './Navbar.php';   // put your code here
?>
        
        
       <div class="container">
            <div class="page-header">
                <h1><a href="index.php">Donation Process</a></h1>
                <p class="lead">A test payment integration for instamojo payment gateway. </p>
            </div><!--page-header-->
            
            <h3>Thank you, Payment is done!</h3>
            
            <?php
include 'src/Instamojo.php';
 $api = new Instamojo\Instamojo('64d162031744b82fda6af040c5b2862b', '92e52c5f6984a7c69908799a88245bf9', 'https://test.instamojo.com/api/1.1/');
$payid=$_GET["payment_request_id"];
try{
    $response=$api->paymentRequestStatus($payid);
    echo"<h4>Payment Id:".$response['payments'][0]['payment_id']."</h4>";
    echo"<h4>Payment Request Id:".$_GET['payment_request_id']."</h4>";
     echo"<h4>Payment name:".$response['payments'][0]['buyer_name']."</h4>";
     echo"<h4>Payment Email:".$response['payments'][0]['buyer_email']."</h4>"; 
     //print_r($response);
}catch(Exception $e){
    print('Error:'.$e->getMessage());
}
?>
<?php

//echo "<h4>LAST INSERTED ID:</h4>".$donation_no;
//echo $imojoid=$response['payments'][0]['payment_id'];
//echo $pay_req_id=$_GET['payment_request_id'];
//echo $pay_status=$response['payments'][0]['status'];
//echo $update_brand="UPDATE webhook SET imojo_id='$imojoid',payment_id='$pay_req_id',status='$pay_status' WHERE //id='$donation_no'";
//$run_brand=mysqli_query($con,$update_brand);
   
  /*  if($response['payments'][0]['status'] == "Credit"){
    echo $update_brand="UPDATE webhook SET imojo_id='$imojoid',payment_id='$pay_req_id',status='$pay_status' WHERE id='$donation_no'";
$run_brand=mysqli_query($con,$update_brand);
    }*/
?>
        </div>  
        
        
        
        
        
        
        
        
        

  <!-- script references -->
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/nav-hover.min.js"></script>
    <script type="text/javascript" src="js/jquery.bxslider.min.js"></script>
    <script type="text/javascript" src="js/main.js"></script>
    <!-- Place in the <head>, after the three links -->
    
    <?php
        include_once 'footer.php';// put your code here
?>
  </body>
</html>

