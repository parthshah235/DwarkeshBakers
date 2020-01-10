<?php
include './connection.php';
$a = "";
$v = false;
if (isset($_GET['fname'])) {
    if (ctype_alpha($_GET['fname'])) {
        $a = "";
        $v = true;
        if (strlen($_GET['fname']) < 3) {
            $a = "( Must be greater than 3 characters )";
            $v = false;
        }
    } else {
        $a = "Only Characters Allowed";
        $v = false;
    }
} elseif (isset($_GET['lname'])) {
    if (ctype_alpha($_GET['lname'])) {
        $a = "";
        $v = true;
        if (strlen($_GET['lname']) < 3) {
            $a = "( Must be greater than 3 characters )";
            $v = false;
        }
    } else {
        $a = "Only Characters Allowed";
        $v = false;
    }
} elseif (isset($_GET['mobile'])) {

    $sql = "select ud_mobile from user_details where ud_mobile='" . $_GET['mobile'] . "'";
    $res = mysqli_query($con, $sql);
    $row = mysqli_fetch_array($res);
    if ($row['ud_mobile'] == $_GET['mobile']) {
        $a = "";
        $v = true;
    } else {
        $a = "Mobile No. Not Found";
        $v = false;
    }
} elseif (isset($_GET['mobileexist'])) {
    $orgmobile=$_GET['orgmobile'];
    $sql = "select ud_mobile from user_details where ud_mobile='" . $_GET['mobileexist'] . "'";
    $res = mysqli_query($con, $sql);
    $row = mysqli_fetch_array($res);
    
   
    if ($_GET['mobileexist'] == $orgmobile) {
        $a = "";
        $v = true;
    } elseif($_GET['mobileexist'] != $orgmobile) {
       $sql = "select ud_mobile from user_details where ud_mobile='" . $_GET['mobileexist'] . "'";
        $res = mysqli_query($con, $sql);
        $row = mysqli_fetch_array($res);
        if ($row['ud_mobile'] == $_GET['mobileexist']) {
            $a = "( Number already exists ! )";
            $v = false;
        } else {
            $a = "";
            $v = true;
        }
    } 
    
//    if ($orgmobile==$_GET['mobileexist']) {
//    $a = "";
//        $v = true;
//}
//elseif ($row['ud_mobile'] == $_GET['mobileexist']) {
//        $a = "Mobile Number Already Used";
//        $v = false;
//    }
//    else {
//        $a = "";
//        $v = true;
//    }
   
}

elseif (isset($_GET['pin'])) {  
     $sql = "SELECT pin_pincode FROM pincode_details where pin_pincode='" . $_GET['pin'] . "'";
    $res = mysqli_query($con, $sql);
    $row=  mysqli_fetch_array($res);
    if ($row['pin_pincode'] == $_GET['pin']) {
        $a = "";
        $v = true;
    } else {
        $a = "We Dont Delivery On this Pincode";
        $v = false;
    }
}
elseif (isset($_GET['password'])) {
    if (strlen($_GET['password']) < 6) {
        $a = "( Password must be greater than 6 characters )";
        $v = false;
    } elseif ($_GET['password'] == null) {
        $a = "Empty";
        $v = false;
    } else {
        $a = "";
        $v = true;
    }
} elseif (isset($_GET['txtemail'])) {
    if (filter_var($_GET['txtemail'], FILTER_VALIDATE_EMAIL)) {
        $sql = "select ud_email from user_details where ud_email='" . $_GET['txtemail'] . "'";
        $res = mysqli_query($con, $sql);
        $row = mysqli_fetch_array($res);
        if ($row['ud_email'] == $_GET['txtemail']) {
            $a = "( Email already exists ! )";
            $v = false;
        } else {
            $a = "";
            $v = true;
        }
    } else {
        $a = "( Invalid email ! )";
        $v = false;
    }
} elseif (isset($_GET['profileemail'])) {
    $orgmail = $_GET['orgmail'];
    if ($_GET['profileemail'] == $orgmail) {
        $a = "";
        $v = true;
    } elseif (filter_var($_GET['profileemail'], FILTER_VALIDATE_EMAIL)) {
        $sql = "select ud_email from user_details where ud_email='" . $_GET['profileemail'] . "'";
        $res = mysqli_query($con, $sql);
        $row = mysqli_fetch_array($res);
        if ($row['ud_email'] == $_GET['profileemail']) {
            $a = "( Email already exists ! )";
            $v = false;
        } else {
            $a = "";
            $v = true;
        }
    } else {
        $a = "( Invalid email ! )";
        $v = false;
    }
} elseif (isset($_GET['retrieveemail'])) {
    if (filter_var($_GET['retrieveemail'], FILTER_VALIDATE_EMAIL)) {
        $sql = "select ud_email from user_details where ud_email='" . $_GET['retrieveemail'] . "'";
        $res = mysqli_query($con, $sql);
        $row = mysqli_fetch_array($res);
        if ($row['ud_email'] == $_GET['retrieveemail']) {
            $a = "";
            $v = true;
        } else {
            $a = "Email Not Found";
            $v = false;
        }
    } else {
        $a = "Invalid email";
        $v = false;
    }
}
echo $a . "||" . $v;
