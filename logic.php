<?php

session_start();
error_reporting(E_ERROR | E_PARSE);
//$con = mysqli_connect("localhost", "root", "", "nfa");
include './connection.php';
$page = $_REQUEST['page'];

if ($page == "login") {
    $user = $_POST['user'];
    $pass = md5($_POST['pass']);

    $query1 = mysqli_query($con, "select * from user_details where ud_email='$user'");
    $msg = 0;
    $row = mysqli_fetch_array($query1);
    //print_r($row);
    if ($row["ud_email"] == "admin@bakery.com" && $row['ud_password'] == "21232f297a57a5a743894a0e4a801fc3") {
        session_start();
        $_SESSION['ud_fname'] = $row["ud_fname"];
        $_SESSION['ud_id'] = $row['ud_id'];
        $_SESSION['ud_email'] = $row['ud_email'];
        $_SESSION['ud_lname'] = $row['ud_lname'];
        $msg = 4;
    } elseif ($row["ud_email"] == $user && $row['ud_password'] == $pass) {
        //print_r($row);
        if ($row['ud_type'] == 1) {
            $msg = 5;
        } else {
            session_start();
            $_SESSION['ud_fname'] = $row["ud_fname"];
            $_SESSION['ud_id'] = $row['ud_id'];
            $_SESSION['ud_email'] = $row['ud_email'];
            $_SESSION['ud_lname'] = $row['ud_lname'];
            $msg = 1;
        }
    } else {
        $msg = 2;
    }
    echo $msg;
} elseif ($page == "check_mail") {
    $email = $_POST['mail'];
    $qry = mysqli_query($con, "select ud_email from user_details where ud_email='$email'");
    $msg = 0;
    if (mysqli_affected_rows($con) > 0) {
        $msg = 1;
    } else {
        $msg = 0;
    }
    echo $msg;
} elseif ($page == "registration") {
    $fn = $_POST['fn'];
    $ln = $_POST['ln'];
    $city = $_POST['city'];
    $ps = md5($_POST['ps']);
    $email = $_POST['mail'];
    $qry2 = mysqli_query($con, "INSERT INTO `user_details`(`ud_fname`, `ud_lname`,`ud_city`, `ud_password`, `ud_email`, `verified`) VALUES ('$fn','$ln','$city','$ps','$email', 'false')");
    $msg = 0;
    
    $res= mysqli_query($con, "SELECT * FROM user_details ORDER BY ud_id DESC");
    $row= mysqli_fetch_array($res);
    $md5Id = md5($row['ud_id']);
    $id = $row['ud_id'];
    
    require './PHPMailer-master/PHPMailerAutoload.php';

    //Create a new PHPMailer instance
    $mail = new PHPMailer;

    //Tell PHPMailer to use SMTP
    $mail->isSMTP();

    //Enable SMTP debugging
    // 0 = off (for production use)
    // 1 = client messages
    // 2 = client and server messages
    $mail->SMTPDebug = 0;

    //Ask for HTML-friendly debug output
    $mail->Debugoutput = 'html';

    //Set the hostname of the mail server
    $mail->Host = 'smtp.gmail.com';
    // use
    // $mail->Host = gethostbyname('smtp.gmail.com');
    // if your network does not support SMTP over IPv6
    //Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
    $mail->Port = 587;

    //Set the encryption system to use - ssl (deprecated) or tls
    $mail->SMTPSecure = 'tls';

    //Whether to use SMTP authentication
    $mail->SMTPAuth = true;

    //Username to use for SMTP authentication - use full email address for gmail
    $mail->Username = "dwarkeshbakers@gmail.com";

    //Password to use for SMTP authentication
    $mail->Password = "dwarkeshbakers!@#$%^";

    //Set who the message is to be sent from
    $mail->setFrom('dwarkeshbakers@gmail.com', 'DwarkeshBakers');

    //Set an alternative reply-to address
    $mail->addReplyTo('dwarkeshbakers@gmail.com', 'DwarkeshBakers');

    //Set who the message is to be sent to
    $mail->addAddress($email);

    //Set the subject line
    $mail->Subject = 'DwarkeshBakers Registration';

    //Read an HTML message body from an external file, convert referenced images to embedded,
    //convert HTML into a basic plain-text alternative body
//        $mail->msgHTML(file_get_contents('contents.html'), dirname(__FILE__));


    $txt = "<body>"
            . "<center>"
            . "<div style='border: 4px #ee6e73 solid;' width='250px'>"
            . "<table style='border:2px white solid;'>"
            . "<tr>"
            . "<td><center><b style='font-size: 35px'>DwarkeshBakers</b></center></td>"
            . "</tr>"
            . "<tr>"
            . "<td><hr/></td>"
            . "</tr>"
            . "<tr>"
            . "<td><div style='background-color: white;'><br/>"
            . "<center style='font-size: 25px'>Welcome To Dwarkesh Bakers</center><hr/><br/>"
            . "<font style='font-size: 22px;'>Click below link to verify this email</font><br/>"
            . "<font style='font-size: 20px;'>Verification Link : </font><font style='font-color:red;font-size: 20px'><a href = 'localhost/DwarkeshBakers/logic.php?page=verify&53d670af9bb16ea=$md5Id$id'>Click Here</a></font><br/>"
            . "</div>"
            . "</td>"
            . "</tr>"
            . "<tr>"
            . "<td><hr/></td>"
            . "</tr>"
            . "<tr>"
            . "<td>"
            . "<center><h3 style='background-color: whitesmoke'>"
            . "<font color='black'>From DwarkeshBakers <br/> (Real TASTE OF Bakery Products)</font>"
            . "</h3></center>"
            . "</td>"
            . "</tr>"
            . "</table>"
            . "</center></body>";
    $mail->msgHTML($txt);

    //Replace the plain text body with one created manually
    $mail->AltBody = 'This is a plain-text message body';

    //Attach an image file
//        $mail->addAttachment('images/phpmailer_mini.png');
    //send the message, check for errors
    if (!$mail->send()) {
        echo "Mailer Error: " . $mail->ErrorInfo;
    } else {
//        $sql1 = "update user_details set ud_code='" . $codee . "' where ud_email='" . $email . "'";
//        mysqli_query($con, $sql1);
        //header("location:./Sign_Up.php");
//        echo "Mail Sent Please check mail";
        if (mysqli_affected_rows($con) != 0) {
        $qry3 = mysqli_query($con, "select * from user_details where ud_email='$email'");
        if (mysqli_affected_rows($con) != 0) {
            session_start();
            while ($row = mysqli_fetch_array($qry3)) {
                $_SESSION['ud_fname'] = $row["ud_fname"];
                $_SESSION['ud_id'] = $row['ud_id'];
                $_SESSION['ud_city'] = $row ['ud_city'];
                $_SESSION['ud_email'] = $row['ud_email'];
                $_SESSION['ud_lname'] = $row['ud_lname'];
            }
               echo $msg = 1;
            }
        } else {
            echo $msg = 0;
        }
    }        
//    echo $msg;
} elseif ($_GET['page'] == "verify") {
    echo "in";
    if(isset($_GET['53d670af9bb16ea'])) {
        $md5Id = $_GET['53d670af9bb16ea'];
        echo $id = substr($md5Id, 32);
        mysqli_query($con, "UPDATE user_details SET `verified`='true' WHERE ud_id= '$id'");
        if (mysqli_affected_rows($con) == 0) {
            $msg = 0;
            echo "not Verified";
        } else {
            echo $msg = "done";
            header("Location: Sign_In.php");
        }
    }
} elseif ($_GET['value'] == 'logout') {
    session_start();
    session_unset();
    session_destroy();
    header("Location:./home.php");
} elseif ($page == 'set_details') {
    $phn = $_POST['phn'];
    $add = $_POST['add'];
    $add1=$_POST['add1'];
    $id = $_POST['id'];
    mysqli_query($con, "UPDATE `user_details` SET `ud_mobile`='$phn',`ud_address`='$add',`ud_address1`='$add1' where ud_id=$id");
    if (mysqli_affected_rows($con) == 0) {
        $msg = 0;
    } else {
        $msg = 1;
    }
    //header("Location:./home.php");
    echo $msg;
} elseif ($page == 'add_wl') {
    $ud_id = $_POST['user_id'];
    $prd_id = $_POST['prd_id'];

    mysqli_query($con, "SELECT * FROM `wishlist_details` WHERE `ud_id`=$ud_id and `prd_id`=$prd_id");
    if (mysqli_affected_rows($con) == 0) {
        mysqli_query($con, "INSERT INTO `wishlist_details`(`ud_id`, `prd_id`) VALUES ($ud_id,$prd_id)");
        if (mysqli_affected_rows($con) == 0) {
            $msg = 0;
        } else {
            $msg = 1;
        }
    } else {
        $msg = 2;
    }
    //header("Location:./home.php");
    echo $msg;
} elseif ($page == 'add_cart_wl') {
    $ud_id = $_POST['user_id'];
    $prd_id = $_POST['prd_id'];
    $qty = $_POST['qty'];

    mysqli_query($con, "SELECT * FROM `cart_details` WHERE `ud_id`=$ud_id and `prd_id`=$prd_id");
    if (mysqli_affected_rows($con) == 0) {
        mysqli_query($con, "INSERT INTO `cart_details`(`ud_id`, `prd_id`, `cart_product_qty`) VALUES ($ud_id,$prd_id,'$qty')");
        if (mysqli_affected_rows($con) == 0) {
            $msg = 0;
        } else {
            mysqli_query($con, "DELETE FROM `wishlist_details` WHERE `ud_id`=$ud_id and `prd_id`=$prd_id");
            $msg = 1;
        }
    } else {
        $msg = 2;
    }
    //header("Location:./home.php");
    echo $msg;
} elseif ($page == 'rem_cart') {
    $ud_id = $_POST['user_id'];
    $prd_id = $_POST['prd_id'];

    mysqli_query($con, "SELECT * FROM `cart_details` WHERE `ud_id`=$ud_id and `prd_id`=$prd_id");
    if (mysqli_affected_rows($con) == 0) {
        $msg = 0;
    } else {
        mysqli_query($con, "DELETE FROM `cart_details` WHERE `ud_id`=$ud_id and `prd_id`=$prd_id");
        $msg = 1;
    }
    //header("Location:./home.php");
    echo $msg;
} elseif ($page == 'empty_cart') {
    $ud_id = $_POST['user_id'];

    $sql = "DELETE FROM cart_details WHERE ud_id=" . $ud_id . "";
    if (mysqli_query($con, $sql)) {
        $product = 'productempty';
    } else {
        $product = 'productfailed';
    }
    echo $product;
} elseif ($page == 'update_cart') {
    $user_id = $_POST['ud_id'];
    $prd_id = $_POST['prd_id'];
    $quantity = $_POST['quantity'];

    if ($quantity > 0) {
        $sql = "UPDATE cart_details SET cart_product_qty='" . $quantity . "' WHERE prd_id='" . $prd_id . "' AND ud_id='" . $user_id . "'";
        if (mysqli_query($con, $sql)) {
            $product = 'productupdated' . $quantity;
        } else {
            $product = 'productfailed';
        }
    }
    echo $product;
} else if ($page == "qtyupd") {
    $id = $_POST['id'];
    $qty = $_POST['qty'];
    $uid = $_SESSION['ud_id'];
    $total = 0;
    mysqli_query($con, "UPDATE cart_details SET cart_product_qty=" . $qty . " WHERE prd_id=" . $id . " AND ud_id=" . $uid . " ");
    $query = mysqli_query($con, "SELECT prd_id,cart_product_qty FROM cart_details WHERE ud_id='" . $uid . "' ");
    while ($row = mysqli_fetch_array($query)) {
        $query1 = mysqli_query($con, "SELECT prd_mrp FROM product_details WHERE prd_id='" . $row['prd_id'] . "'");
        $row1 = mysqli_fetch_array($query1);
        $total = $total + $row1['prd_mrp'] * $row['cart_product_qty'];
    }
    echo $total;
} elseif ($_GET['value'] == 'retrieve') {
    $email = $_POST['txtemail'];
    $codee = rand(0, 9999999999);
    $get_Mailer_Name_q = "SELECT ud_fname,ud_lname FROM user_details WHERE ud_email='$email'";
    $Mailer_Data = mysqli_query($con, $get_Mailer_Name_q);
    while ($mailRow = mysqli_fetch_array($Mailer_Data)) {
        $Mail_fname = $mailRow['ud_fname'];
        $Mail_lname = $mailRow['ud_lname'];
    }
    $Maile_name = $Mail_fname . " " . $Mail_lname;

    require './PHPMailer-master/PHPMailerAutoload.php';

    //Create a new PHPMailer instance
    $mail = new PHPMailer;

    //Tell PHPMailer to use SMTP
    $mail->isSMTP();

    //Enable SMTP debugging
    // 0 = off (for production use)
    // 1 = client messages
    // 2 = client and server messages
    $mail->SMTPDebug = 0;

    //Ask for HTML-friendly debug output
    $mail->Debugoutput = 'html';

    //Set the hostname of the mail server
    $mail->Host = 'smtp.gmail.com';
    // use
    // $mail->Host = gethostbyname('smtp.gmail.com');
    // if your network does not support SMTP over IPv6
    //Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
    $mail->Port = 587;

    //Set the encryption system to use - ssl (deprecated) or tls
    $mail->SMTPSecure = 'tls';

    //Whether to use SMTP authentication
    $mail->SMTPAuth = true;

    //Username to use for SMTP authentication - use full email address for gmail
    $mail->Username = "dwarkeshbakers@gmail.com";

    //Password to use for SMTP authentication
    $mail->Password = "dwarkeshbakers!@#$%^";

    //Set who the message is to be sent from
    $mail->setFrom('dwarkeshbakers@gmail.com', 'DwarkeshBakers');

    //Set an alternative reply-to address
    $mail->addReplyTo('dwarkeshbakers@gmail.com', 'DwarkeshBakers');

    //Set who the message is to be sent to
    $mail->addAddress($email);

    //Set the subject line
    $mail->Subject = 'DwarkeshBakers Forget Password';

    //Read an HTML message body from an external file, convert referenced images to embedded,
    //convert HTML into a basic plain-text alternative body
//        $mail->msgHTML(file_get_contents('contents.html'), dirname(__FILE__));


    $txt = "<body>"
            . "<center>"
            . "<div style='border: 4px #ee6e73 solid;' width='250px'>"
            . "<table style='border:2px white solid;'>"
            . "<tr>"
            . "<td><center><b style='font-size: 35px'>DwarkeshBakers</b></center></td>"
            . "</tr>"
            . "<tr>"
            . "<td><hr/></td>"
            . "</tr>"
            . "<tr>"
            . "<td><div style='background-color: white;'><br/>"
            . "<center style='font-size: 25px'>Welcome To Dwarkesh Bakers</center><hr/><br/>"
            . "<font style='font-size: 22px;'>Your Login Details</font><br/>"
            . "<font style='font-size: 20px;'>Name : " . $Maile_name . "</font><br/>"
            . "<font style='font-size: 20px;'>Email : " . $email . "</font><br/>"
            . "<font style='font-size: 20px;'>Activation Code : " . $codee . "</font><br/>"
            . "<font style='font-size: 20px;'>Reset Link : </font><font style='font-color:red;font-size: 20px'><a href = 'localhost/DwarkeshBakers/retrive.php?type=mail'>Visit Link</a></font><br/>"
            . "</div>"
            . "</td>"
            . "</tr>"
            . "<tr>"
            . "<td><hr/></td>"
            . "</tr>"
            . "<tr>"
            . "<td>"
            . "<center><h3 style='background-color: whitesmoke'>"
            . "<font color='black'>From DwarkeshBakers <br/> (Real TASTE OF Bakery Products)</font>"
            . "</h3></center>"
            . "</td>"
            . "</tr>"
            . "</table>"
            . "</center></body>";
    $mail->msgHTML($txt);

    //Replace the plain text body with one created manually
    $mail->AltBody = 'This is a plain-text message body';

    //Attach an image file
//        $mail->addAttachment('images/phpmailer_mini.png');
    //send the message, check for errors
    if (!$mail->send()) {
        echo "Mailer Error: " . $mail->ErrorInfo;
    } else {
        $sql1 = "update user_details set ud_code='" . $codee . "' where ud_email='" . $email . "'";
        mysqli_query($con, $sql1);
        header("location:./retrive.php?type=mail");
    }
//    
//   
//               
//                if (!mail($to, $subject, $txt, $headers)) {
//        echo "Error not sent " . $mail->ErrorInfo;
//    } else {
//         $sql1 = "update user_details set ud_code='" . $codee . "' where ud_email='" . $email . "'";
//        mysqli_query($con, $sql1);
//        header("location:./retrive.php?type=mail");
//    }
} elseif ($_GET['value'] == 'activate') {
    $email = $_POST['txtemail'];
    $code = $_POST['txtcode'];
    $mobile = $_POST['no'];
    $pass = md5($_POST['txtpass']);
    if ($email != '') {
        $sql = "select * from user_details where ud_email='" . $email . "'";
        $res = mysqli_query($con, $sql);
        $row = mysqli_fetch_array($res);
        if ($row['ud_code'] == $code) {

            $sql1 = "update user_details set ud_password='" . $pass . "' where ud_email='" . $email . "'";
            if (mysqli_query($con, $sql1)) {
                echo "1";
//            echo "<a href=home.php>Click here</a> to Login";
                //header("Location:./Home.php");
            } else {
                echo "error" . mysqli_error($con);
            }
        } else {
            echo "wrong";
        }
    } elseif ($mobile != '') {
        $sql = "select * from user_details where ud_mobile='" . $mobile . "'";
        $res = mysqli_query($con, $sql);
        $row = mysqli_fetch_array($res);
        if ($row['ud_code'] == $code) {
            $sql1 = "update user_details set ud_password='" . $pass . "' where ud_mobile='" . $mobile . "'";
            if (mysqli_query($con, $sql1)) {
                echo "1";
//            echo "<a href=home.php>Click here</a> to Login";
            } else {
                echo "error" . mysqli_error($con);
            }
        } else {
            echo "wrong";
        }
    }
} elseif ($_GET['value'] == 'motp') {
//Your authentication key
    $authKey = "98956AsgF3iFHz1MG565ab3ec";
//Multiple mobiles numbers separated by comma
    $mobileNumber = $_POST['no'];
//Sender ID,While using route4 sender id should be 6 characters long.
    $senderId = "BAKERY";
    $otp = rand(123456, 999999);
//Your message to send, Add URL encoding here.
    $message = urlencode("Welcome To Dwarkesh Bakers \n Your OTP :$otp");
//Define route
    $route = "4";
//Prepare you post parameters
    $postData = array(
        'authkey' => $authKey,
        'mobiles' => $mobileNumber,
        'message' => $message,
        'sender' => $senderId,
        'route' => $route
    );

//API URL
    $url = "https://control.msg91.com/sendhttp.php";

// init the resource
    $ch = curl_init();
    curl_setopt_array($ch, array(
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_POST => true,
        CURLOPT_POSTFIELDS => $postData
//,CURLOPT_FOLLOWLOCATION => true
    ));

//Ignore SSL certificate verification
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

//get response
    $output = curl_exec($ch);

//Print error if any
    if (curl_errno($ch)) {
        echo 'error:' . curl_error($ch);
    }

    curl_close($ch);

//echo $output;
    echo $otp;

    $sql = "update user_details set ud_code='" . $otp . "' where ud_mobile='" . $_POST['no'] . "'";
    mysqli_query($con, $sql);
    header("location:./retrive.php?type=motp");
} elseif ($_GET['value'] == 'placeorder') {
//    echo '1';
    $last_id;

    $udid = $_POST['ud_id'];
//    echo $udid;
    //$delivery_type=$_POST['deliverygap'];
//    $codeamt = $_POST['code_amt'];
//    echo $codeamt;
    //echo '<script>alert($codeamt);</script>';
//    $pincode=$_POST['pincode'];
//    $pincode_qry="SELECT pin_id FROM pincode_details WHERE pin_pincode=".$pincode;
//    $pincode_result=  mysqli_query($con, $pincode_qry);
//    while($pincode_row=  mysqli_fetch_array($pincode_result))
//    {
//        $pincode=$pincode_row['pin_id'];
//    }
//    if($delivery_type=='normal')
//    {
//        $delivery_type='0';
//    }
//    elseif($delivery_type=='fast')
//    {
//        $delivery_type='1';
//    }
    $cart_query = "SELECT * FROM cart_details WHERE ud_id=$udid";
    $cart_query_result = mysqli_query($con, $cart_query);

    $user_query = "SELECT * FROM user_details WHERE ud_id=$udid";
    $user_query_result = mysqli_query($con, $user_query);
    $date = date('Y-m-d');
    $shipdate = date('Y-m-d', strtotime('+2 hours'));

    while ($user_row = mysqli_fetch_array($user_query_result)) {
        $udaddress = $user_row['ud_address'];
//        echo $udaddress;
        $order_detials_query = "INSERT INTO order_details (ord_date,ord_shipping_date,ord_shipping_address,ud_id) VALUES(Now(),'$shipdate','$udaddress','$udid')";
        if (mysqli_query($con, $order_detials_query)) {
            $last_id = mysqli_insert_id($con);
            while ($cart_row = mysqli_fetch_array($cart_query_result)) {
                $prd_id = $cart_row['prd_id'];
//                echo $prd_id;
                $qty = $cart_row['cart_product_qty'];
//                echo $qty;
                $prd_detials = mysqli_query($con, "SELECT * FROM product_details WHERE prd_id='$prd_id'");
                $prd_detials_row = mysqli_fetch_array($prd_detials);
                $prd_sell_rate = $prd_detials_row['prd_mrp'];
//echo $prd_sell_rate;
                $total = $qty * $prd_sell_rate;
                $order_prd_query = "INSERT INTO order_products (ord_id,prd_id,oprd_qty,oprd_unit_price,oprd_total_amount) VALUES('$last_id','$prd_id','$qty','$prd_sell_rate','$total')";
                $insert_oprd = mysqli_query($con, $order_prd_query);
                if (!$insert_oprd) {
                    echo 'error' . mysqli_error($con);
                } else {
                    mysqli_query($con, "UPDATE product_details SET prd_quantity=prd_quantity-'" . $qty . "' WHERE prd_id='" . $prd_id . "' ");
                    mysqli_query($con, "DELETE FROM cart_details WHERE ud_id='$udid'");
                    header("location:./orders.php?v=ok&id=" . $last_id);
                }
            }
        }
    }
    echo mysqli_error($con);
} elseif ($_GET['value'] == 'inquiry') {
    $inquiry_typ = $_POST['group1'];
    if ($inquiry_typ == 'feedback') {
        $contact_message = $_POST['contact_message'];
        $udId = $_POST['ud_id'];
        $feedback_insert_query = "INSERT INTO feedback_details (fdbk_description, ud_id) VALUES('$contact_message', '$udId')";
        if (mysqli_query($con, $feedback_insert_query)) {
            echo "<script type='text/javascript'>alert('We Received Your Feedback Thank You');"
            . "window.location.href='./inquiry.php'</script>";
        } else {
            echo "<script type='text/javascript'>alert('Error Inserting Feedback');</script>" . mysqli_error($con);
        }
    } elseif ($inquiry_typ == 'inquiry' || $inquiry_typ == 'bulkorder') {
        $contact_name = $_POST['contact_name'];
        $contact_subject = $_POST['contact_subject'];
        $contact_email = $_POST['contact_email'];
        $contact_message = $_POST['contact_message'];
        $contact_mobile = $_POST['no'];
        if ($contact_mobile == '') {
            $contact_mobile = 0;
        }
        $inquiry_insert_query = "INSERT INTO inquiry_details (inq_email,inq_mobile,inq_subject,inq_desription) VALUES ('$contact_email','$contact_mobile','$contact_subject','$contact_message')";
        if (mysqli_query($con, $inquiry_insert_query)) {
            echo "<script type='text/javascript'>alert('We Received Your Query will contact within 72hrs');"
            . "window.location.href='./inquiry.php'</script>";
        } else {
            echo "<script type='text/javascript'>alert('Error Inserting Inquiry');</script>" . mysqli_error($con);
        }
    }
}
?>