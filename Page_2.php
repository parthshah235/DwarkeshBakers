<?php
session_start();
include("./connection.php");
include 'src/Instamojo.php';
?>

<?php
$error = false;
if (isset($_POST['donate'])) {

    $name = clean_input($_POST['txt_name']);
    $email = clean_input($_POST['txt_email']);
    $phone = clean_input($_POST['txt_phone']);
    $amount = clean_input($_POST["txt_amt"]);
//    $dob = clean_input($_POST["txt_dob"]);
//    $prof = clean_input($_POST["txt_prof"]);




    if (empty($name)) {
        $error = true;
        $name_error = "Please enter your name";
    } else {
        //name can contain only alpha characters and space
        if (!preg_match("/^[a-zA-Z ]+$/", $name)) {
            $error = true;
            $name_error = "Please enter valid name";
        }
    }


    if (empty($email)) {
        $error = true;
        $email_error = "Please enter your email";
    } else {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error = true;
            $email_error = "Please enter valid email";
        }
    }
    if (empty($phone)) {
        $error = true;
        $phone_error = "Please enter your contact number";
    } else {

        if (!preg_match("/^[1-9][0-9]*$/", $phone)) {
            $error = true;
            $phone_error = "Please enter valid contact number";
        }
    }




//**********************************************************************************
//Submit data

    if ($error) {
        $alertmsg = '<div class="alert alert-danger text-center">  Please fill the fields correctly.</div>';
    }
    if (!$error) {
        //insert to databse

        $insert_applicant = "INSERT INTO webhook "
                . "(imojo_id,reg_date,name,email,contact,dob,prof,amount,payment_id,status)"
                . " VALUES "
                . "('NA',NOW(),'$name','$email','$phone' ,'$amount','NA','NA')";

        $insert_pro = mysqli_query($con, $insert_applicant);
        $donation_no = mysqli_insert_id($con);
        $_SESSION['last_id'] = $donation_no;

        $api = new Instamojo\Instamojo('64d162031744b82fda6af040c5b2862b', '92e52c5f6984a7c69908799a88245bf9', 'https://test.instamojo.com/api/1.1/');
        try {
            $response = $api->paymentRequestCreate(array(
                "purpose" => "Donation",
                "amount" => $amount,
                "buyer_name" => $name,
                "phone" => $phone,
                "send_email" => true,
                "send_sms" => true,
                "email" => $email,
                'allow_repeated_payments' => false,
//        "redirect_url"=>"http://demo1.coregenie.com/instamojo/thankyou.php",
//        "webhook"=>"http://demo1.coregenie.com/instamojo/webhook.php"
                "redirect_url" => "https://dwarkeshbakers.000webhostapp.com/thankyou.php",
                "webhook" => "http://www.appalanche.ooo/sph/webhook.php"
            ));
            //print_r($response);
            $pay_ulr = $response['longurl'];
            //Redirect($response['longurl'],302); //Go to payment page
            header("Location:$pay_ulr");
            exit();
        } catch (Exception $e) {
            print('Error: ' . $e->getMessage());
        }





        //send mail
//            $toemail = "dazypaul@gmail.com";
//            $subject = $name." has been registered.";
//            $body = "Here goes your Message Details: \n\n Name: $name \n Email: $email \nContact No. :$phone \n ";
//            $headers = "From: $email\n";
//            $headers .= "Reply-To: $email";
//
//            if (mail ($toemail, $subject, $body, $headers))
//                $alertmsg  = '<div class="alert alert-success text-center">Message sent successfully.  We will get back to you shortly!</div>';
//            else
//                $alertmsg = '<div class="alert alert-danger text-center">There is error in sending mail.  Please try again later.</div>';
    }
//*************************************************************************************             
}

// function 

function clean_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

//function
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


<?php if (isset($alertmsg)) {
    echo $alertmsg;
} ?>
<?php
if (isset($_SESSION['ud_id'])) {

$sql = "SELECT * FROM user_details WHERE ud_id='" . $_SESSION['ud_id'] . "'";
$result = mysqli_query($con, $sql);
$row = mysqli_fetch_assoc($result);
$ud_fname = $row['ud_fname'];
$ud_lname = $row['ud_lname'];
$ud_mobile = $row['ud_mobile'];
$ud_email = $row['ud_email'];
$qry= "SELECT * FROM cart_details WHERE ud_id='" .$_SESSION['ud_id'] . "'";
$result1= mysqli_query($con, $qry);
$row1 = mysqli_fetch_assoc($result1);
$sql2 = "SELECT * FROM product_details WHERE prd_id=" . $row1["prd_id"] . "";
$result2 = mysqli_query($con, $sql2);
$row2 = mysqli_fetch_assoc($result2);
$prd_mrp=$row2['prd_mrp'];
$cart_qty=$row1['cart_product_qty'];

?>

        <div class="container">
            <form class="center-block" role="form" action="Page_2.php" method="post" accept-charset="utf-8">

                <div class="row">
                    <div class="col-md-6">
                        <label for="exampleInputEmail1"> Name</label>
                        <input type="text" name="txt_name" readonly  value="<?php if ($error) echo $name;else {echo $ud_fname . " " . $ud_lname;} ?>" class="form-control" id="exampleInputEmail1" placeholder=" Name">
                    </div>

                </div>
                <div class="row">
                    <div class="col-md-6">
                        <label for="exampleInputEmail1">Email address</label>
                        <input name="txt_email" type="text" readonly  value="<?php if ($error) echo $email; else { echo $ud_email;}?>" class="form-control" id="exampleInputEmail1" placeholder="Email">
                    </div>

                </div>

                <div class="row">
                    <div class="col-md-6">
                        <label for="exampleInputEmail1">Mobile Number</label>
                        <input name="txt_phone" type="text" readonly value="<?php if ($error) echo $phone; else {echo $ud_mobile;} ?>" class="form-control" id="exampleInputEmail1" placeholder="Contact Number">
                    </div>

                </div>
                <div class="row">
                    <div class="col-md-6">
                        <label for="exampleInputEmail1">Amount</label>
                        <input name="txt_amt" type="text" readonly value="<?php if ($error) echo $amount;else{echo $row2['prd_mrp']*$row1['cart_product_qty'];}  ?>" class="form-control" id="exampleInputEmail1" >
                    </div>

                </div>
<!--                <div class="row">
                    <div class="col-md-6">
                        <label for="exampleInputEmail1">Date of Birth</label>
                        <input name="txt_dob" type="text" value="<?php if ($error) echo $dob; ?>" class="form-control" id="exampleInputEmail1" placeholder="Date of Birth">
                    </div>

                </div>

                <div class="row">
                    <div class="col-md-6">
                        <label for="exampleInputEmail1">Profession</label>
                        <input name="txt_prof" type="text" value="<?php if ($error) echo $prof; ?>" class="form-control" id="exampleInputEmail1" placeholder="Profession">
                    </div>

                </div>
                <br/><br/>-->
                <input type="submit" name="donate" class="btn btn-large btn-primary" value="Click Here to pay "/> 
            </form>
        </div>





















        <!-- script references -->
        <script src="js/jquery.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/nav-hover.min.js"></script>
        <script type="text/javascript" src="js/jquery.bxslider.min.js"></script>
        <script type="text/javascript" src="js/main.js"></script>
        <!-- Place in the <head>, after the three links -->

<?php
include_once 'footer.php'; // put your code here
?>
    </body>
</html>

<?php }
else
{
    header("Location:./404.html");
}
?>