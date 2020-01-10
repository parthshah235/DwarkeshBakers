<?php
include './connection.php';
$user_id = $_POST['user_id'];

$sql1 = "SELECT * FROM cart_details WHERE ud_id = " . $user_id . "";
$result1 = mysqli_query($con, $sql1);
$num1 = mysqli_affected_rows($con);
if ($num1 == 0) {
    $product = 'empty cart';
} else {
    $sql2 = "SELECT * FROM user_details WHERE ud_id = " . $user_id . " ";
    $result2 = mysqli_query($con, $sql2);
    $row2 = mysqli_fetch_array($result2);
    $ud_mobile = $row2['ud_mobile'];
    $ud_address = $row2['ud_address'];
//    $ud_pincode = $row2['ud_pincode'];
    $ud_city = $row2['ud_city'];
    if ($ud_mobile == "0" || $ud_address == "0" || $ud_city == "0") {
        $product = 'incomplete profile';
    } else {
        $product = 'ok';
    }
}
echo $product;
?>