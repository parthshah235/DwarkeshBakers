<?php
session_start();
if (!isset($_SESSION['ud_id'])) {
    header("Location:../404.html");
} else {
$con=mysqli_connect("localhost","root","","dwarkesh_bakery");
$name = $_GET['validation'];
if($name=="prd_name_validation")
{
    $prd_name = $_GET['prd_name'];
    //echo $prd_name;
    $qry = mysqli_query($con,"select count(prd_name) from product_details where prd_name='$prd_name'");
    while ($row = mysqli_fetch_array($qry))
    {
        echo $row[0];
    }
}
else if($name=="ofr_name_validation")
{
    $ofr_name = $_GET['ofr_name'];
    $qry = mysqli_query($con,"select count(ofd_name) from offer_details where ofd_name='$ofr_name'");
    while ($row = mysqli_fetch_array($qry))
    {
        echo $row[0];
    }
}
if($name=="img_name_validation")
{
    $img_name = $_GET['img_name'];
    //echo $prd_name;
    $qry = mysqli_query($con,"SELECT COUNT( img_name ) FROM image_details WHERE img_name =  '$img_name'");
    while ($row = mysqli_fetch_array($qry))
    {
        echo $row[0];
    }
}
else
{
    echo "No Valiadtion!!";
}
}
?>
