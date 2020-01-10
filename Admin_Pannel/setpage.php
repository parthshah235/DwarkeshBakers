<?php

session_start();
if (!isset($_SESSION['ud_id'])) {
    header("Location:../404.html");
} else {
    include './connection.php';
    error_reporting(E_ERROR | E_PARSE);
    $page = $_GET['page'];
    if ($page == 'View User') {
        $qry = mysqli_query($con, "select * from user_details where ud_id != '1'");
        $json = array();
        while ($row = mysqli_fetch_array($qry)) {
            $json[] = array(
                'ua_id' => $row['ud_id'],
                'ua_fname' => $row['ud_fname'],
                'ua_lname' => $row['ud_lname'],
                'ua_email' => $row['ud_email'],
                'ua_mobile' => $row['ud_mobile'],
                'ua_city' => $row['ud_city'],
                'ua_address' => $row['ud_address1'],
                'ua_joindate' => $row['ud_joindate'],
                'ua_status' => $row['ud_status']
            );
        }
        $jsonstring = json_encode($json);
        echo $jsonstring;
    } else if ($page == 'Disable User') {
        $qry = mysqli_query($con, "select * from user_details where ud_id != '1'");
        $json = array();
        while ($row = mysqli_fetch_array($qry)) {
            $json[] = array(
                'ua_id' => $row['ud_id'],
                'ua_fname' => $row['ud_fname'],
                'ua_lname' => $row['ud_lname'],
                'ua_email' => $row['ud_email'],
                'ua_mobile' => $row['ud_mobile'],
                'ua_city' => $row['ud_city'],
                'ua_address' => $row['ud_address1'],
                'ua_pincode' => $row['ud_pincode'],
                'ua_joindate' => $row['ud_joindate'],
                'ua_status' => $row['ud_status']
            );
        }
        $jsonstring = json_encode($json);
        echo $jsonstring;
    } else if ($page == 'new_inq') {
        $qry = mysqli_query($con, "select * from inquiry_details where inq_status='0'");
        $json = array();
        while ($row = mysqli_fetch_array($qry)) {
            $json[] = array(
                'inq_id' => $row['inq_id'],
                'inq_email' => $row['inq_email'],
                'inq_mobile' => $row['inq_mobile'],
                'inq_subject' => $row['inq_subject'],
                'inq_desc' => $row['inq_desription'],
                'inq_status' => $row['inq_status']
            );
        }
        $jsonstring = json_encode($json);
        echo $jsonstring;
    } else if ($page == 'inq') {
        $qry = mysqli_query($con, "select * from inquiry_details where inq_status='0'");
        $json = array();
        while ($row = mysqli_fetch_array($qry)) {
            $json[] = array(
                'inq_id' => $row['inq_id'],
                'inq_email' => $row['inq_email'],
                'inq_mobile' => $row['inq_mobile'],
                'inq_subject' => $row['inq_subject'],
                'inq_desc' => $row['inq_desription'],
                'inq_reply' => $row['inq_reply'],
                'inq_status' => $row['inq_status']
            );
        }
        $jsonstring = json_encode($json);
        echo $jsonstring;
    } else if ($page == 'fdbck') {
        $qry = mysqli_query($con, "SELECT f.*,u.* from feedback_details f LEFT JOIN user_details u ON u.ud_id=f.ud_id;");
        $json = array();
        while ($row = mysqli_fetch_array($qry)) {
            $json[] = array(
                'fdbk_id' => $row['fdbk_id'],
                'fdbk_desc' => $row['fdbk_description'],
                'ud_id' => $row['ud_id'],
                'ud_fname' => $row['ud_fname'],
                'ud_lname' => $row['ud_lname'],
                'ud_email' => $row['ud_email'],
                'ud_mobile' => $row['ud_mobile'],
            );
        }
        $jsonstring = json_encode($json);
        echo $jsonstring;
    } else if ($page == 'offer') {
        $qry = mysqli_query($con, "select * from offer_details");
        $json = array();
        while ($row = mysqli_fetch_array($qry)) {
            $json[] = array(
                'ofd_id' => $row['ofd_id'], 
                'ofd_name' => $row['ofd_name'],
                'ofd_type' => $row['ofd_type'],
                'ofd_code' => $row['ofd_code'],
                'ofd_amount' => $row['ofd_amount'],
                'ofd_product'=> $row['ofd_product']
                //'ofd_discount' => $row['ofd_discount'],
//                'ofd_min_amt' => $row['ofd_min_amount'],
//                'ofd_start_date' => $row['ofd_start_date'],
//                'ofd_end_date' => $row['ofd_end_date'],
//                'ofd_uses' => $row['ofd_uses_per_user'],
//                'ofd_count' => $row['ofd_count'],
                //'cat_id' => $row['cat_id'],
                //'prd_id' => $row['prd_id']
            );
        }
       
        $jsonstring = json_encode($json);
        echo $jsonstring;
    } else if ($page == "setstatus") {
        $id = $_GET["id"];
        $value = $_GET["value"];
        if ($value == "Enabled") {
            $qry = mysqli_query($con, "UPDATE user_details SET ud_status='Disabled' where ud_id=$id");
//        while ($row = mysqli_fetch_array($qry))
//        {
//            $status = $row['ua_status'];
//            echo $status;
//        }
        } else {
            $qry = mysqli_query($con, "UPDATE user_details SET ud_status='Enabled' where ud_id=$id");
//        while ($row = mysqli_fetch_array($qry))
//        {
//            $status = $row['ua_status'];
//            echo $status;
//        }
        }
    } else if ($page == "setstatus2") {
        $id = $_GET["id"];
        $value = $_GET["value"];
        if ($value == "Enabled" || $value == "ENABLED") {
            $qry = mysqli_query($con, "UPDATE product_details SET prd_status='Disabled' where prd_id=$id");
            $msg = "Disabled";
        } else {
            $qry = mysqli_query($con, "UPDATE product_details SET prd_status='Enabled' where prd_id=$id");
            $msg = "Enabled";
        }
        echo $msg;
    } else if ($page == 'Update_Product') {
        $prd = $_GET['prd'];
        $qry2 = mysqli_query($con, "select cat_id from product_details where prd_id='$prd'");
        while ($row2 = mysqli_fetch_array($qry2)) {
            $cat_id = $row2['cat_id'];
        }

        $qry3 = mysqli_query($con, "select * from category where cat_id='$cat_id'");
        while ($row3 = mysqli_fetch_array($qry3)) {
            $cat_name = $row3['cat_name'];
            $cat_sub_name = $row3['cat_sub_name'];
        }
        //echo $prd;
        $qry = mysqli_query($con, "select * from product_details where prd_id='$prd'");
        $json = array();
        while ($row = mysqli_fetch_array($qry)) {
            $json[] = array(
                'prd_id' => $row['prd_id'],
                'prd_name' => $row['prd_name'],
                'prd_about' => $row['prd_about'],
                'prd_image' => $row['prd_image'],
                'prd_mrp' => $row['prd_mrp'],
                'prd_sell_rate' => $row['prd_sell_rate'],
                'prd_tax' => $row['prd_tax'],
                'prd_quantity' => $row['prd_quantity'],
                'prd_status' => $row['prd_status'],
                'cat_id' => $row['cat_id'],
                'cat_name' => $cat_name,
                'cat_sub_name' => $cat_sub_name
            );
        }
        $jsonstring = json_encode($json);
        echo $jsonstring;
    } else if ($page == "set_prd_cp") {
        $qry = mysqli_query($con, "select * from product_details");
        $json = array();
        while ($row = mysqli_fetch_array($qry)) {
            $json[] = array(
                'prd_id' => $row['prd_id'],
                'prd_name' => $row['prd_name'],
                'prd_about' => $row['prd_about'],
                'prd_image' => $row['prd_image'],
                'prd_mrp' => $row['prd_mrp'],
                'prd_sell_rate' => $row['prd_sell_rate'],
                'prd_tax' => $row['prd_tax'],
                'prd_quantity' => $row['prd_quantity'],
                'prd_status' => $row['prd_status'],
                'cat_id' => $row['cat_id'],
                'cat_name' => $cat_name,
                'cat_sub_name' => $cat_sub_name
            );
        }
        $jsonstring = json_encode($json);
        echo $jsonstring;
    } else if ($page == "set options") {
        $cat = $_GET['cat'];
        $qry = mysqli_query($con, "select cat_sub_name from category where cat_name='$cat'");
        $json = array();
        while ($row = mysqli_fetch_array($qry)) {
            $json[] = array(
                'cat_sub_name' => $row['cat_sub_name'],
            );
        }
        $jsonstring = json_encode($json);
        echo $jsonstring;
    } else if ($page == "Update_offer") {
        $ofd_name = $_GET['ofdname'];
        $req = $_GET['req'];
        if ($req == "Discount") {
            $qry = mysqli_query($con, "select o.*,p.*,ct.* from offer_details o INNER JOIN `product_details` p on p.prd_id=o.prd_id INNER JOIN `category` ct on ct.cat_id=p.cat_id where ofd_name='$ofd_name';");
            $json = array();
            while ($row = mysqli_fetch_array($qry)) {
                $json[] = array(
                    'ofd_id' => $row['ofd_id'],
                    'ofd_name' => $row['ofd_name'],
                    'ofd_type' => $row['ofd_type'],
                    'ofd_code' => $row['ofd_code'],
                    'ofd_amount' => $row['ofd_amount'],
                    'ofd_discount' => $row['ofd_discount'],
                    'ofd_min_amount' => $row['ofd_min_amount'],
                    'ofd_start_date' => $row['ofd_start_date'],
                    'ofd_end_date' => $row['ofd_end_date'],
                    'ofd_uses_per_user' => $row['ofd_uses_per_user'],
                    'ofd_count' => $row['ofd_count'],
                    'prd_id' => $row['prd_id'],
                    'prd_name' => $row['prd_name'],
                    'prd_about' => $row['prd_about'],
                    'prd_image' => $row['prd_image'],
                    'prd_mrp' => $row['prd_mrp'],
                    'prd_sell_rate' => $row['prd_sell_rate'],
                    'prd_tax' => $row['prd_tax'],
                    'prd_quantity' => $row['prd_quantity'],
                    'prd_status' => $row['prd_status'],
                    'cat_id' => $row['cat_id'],
                    'cat_name' => $row['cat_name'],
                    'cat_sub_name' => $row['cat_sub_name']
                );
            }
            $jsonstring = json_encode($json);
            echo $jsonstring;
        } else {
            $qry = mysqli_query($con, "select * from offer_details where ofd_name='$ofd_name';");
            $json = array();
            while ($row = mysqli_fetch_array($qry)) {
                $json[] = array(
                    'ofd_id' => $row['ofd_id'],
                    'ofd_name' => $row['ofd_name'],
                    'ofd_type' => $row['ofd_type'],
                    'ofd_code' => $row['ofd_code'],
                    'ofd_amount' => $row['ofd_amount'],
                    'ofd_discount' => $row['ofd_discount'],
                    'ofd_min_amount' => $row['ofd_min_amount'],
                    'ofd_start_date' => $row['ofd_start_date'],
                    'ofd_end_date' => $row['ofd_end_date'],
                    'ofd_uses_per_user' => $row['ofd_uses_per_user'],
                    'ofd_count' => $row['ofd_count'],
                );
            }
            $jsonstring = json_encode($json);
            echo $jsonstring;
        }
    } else if ($page == "set_prd_status") {
        echo $id = $_GET["id"];
        echo $value = $_GET["value"];
        if ($value == "Enabled") {
            $qry = mysqli_query($con, "UPDATE product_details SET prd_status='Disabled' where prd_id='$id'");
            if (!$qry) {
                echo "Error!!";
            } else {
                echo "Updated!!";
            }
//        while ($row = mysqli_fetch_array($qry))
//        {
//            $status = $row['ua_status'];
//            echo $status;
//        }
        } else {
            $qry = mysqli_query($con, "UPDATE product_details SET prd_status='Enabled' where prd_id='$id'");
//        while ($row = mysqli_fetch_array($qry))
//        {
//            $status = $row['ua_status'];
//            echo $status;
//        }
        }
    } else if ($page == "del_ofr") {
        $id = $_GET['id'];
        $qry = mysqli_query($con, "DELETE FROM `offer_details` WHERE ofd_id='$id'");
        if (!$qry) {
            $json = 0;
        } else {
            $json = 1;
        }
        $jsonstring = json_encode($json);
        echo $jsonstring;
    } else if ($page == "set_prd_sub_cat") {
        $cat_main = $_GET['cat_main'];
        $qry = mysqli_query($con, "select * from category where cat_name='$cat_main'");
        $json = array();
        while ($row = mysqli_fetch_array($qry)) {
            $json[] = array(
                'cat_id' => $row['cat_id'],
                'cat_name' => $row['cat_name'],
                'cat_sub_name' => $row['cat_sub_name']
            );
        }
        $jsonstring = json_encode($json);
        echo $jsonstring;
    } else if ($page == "get_set_main_cat") {
        $qry = mysqli_query($con, "select DISTINCT cat_name from category");
        $json = array();
        while ($row = mysqli_fetch_array($qry)) {
            $json[] = array(
                'cat_name' => $row['cat_name'],
            );
        }
        $jsonstring = json_encode($json);
        echo $jsonstring;
    } else if ($page == "check_for_new_order_exist") {
        $qry = mysqli_query($con, "SELECT COUNT(*) FROM `order_details` WHERE `ord_status`='0'");
        while ($row = mysqli_fetch_array($qry)) {
            $no_ord = $row[0];
        }
        echo $no_ord;
    } else if ($page == "check_for_new_order_exist2") {
        $qry = mysqli_query($con, "SELECT COUNT(*) FROM `order_details` WHERE `ord_status`='1'");
        while ($row = mysqli_fetch_array($qry)) {
            $no_ord = $row[0];
        }
        echo $no_ord;
    } else if ($page == "check_for_new_order_exist3") {
        $qry = mysqli_query($con, "SELECT COUNT(*) FROM `order_details` WHERE `ord_status`='2'");
        while ($row = mysqli_fetch_array($qry)) {
            $no_ord = $row[0];
        }
        echo $no_ord;
    } else if ($page == "check_for_new_order_exist4") {
        $qry = mysqli_query($con, "SELECT COUNT(*) FROM `order_details` WHERE `ord_status`='4'");
        while ($row = mysqli_fetch_array($qry)) {
            $no_ord = $row[0];
        }
        echo $no_ord;
    } else if ($page == "check_for_new_order_exist5") {
        $qry = mysqli_query($con, "SELECT COUNT(*) FROM `order_details` WHERE `ord_status`='3'");
        while ($row = mysqli_fetch_array($qry)) {
            $no_ord = $row[0];
        }
        echo $no_ord;
    } else if ($page == "setordstatus") {
        $id = $_GET['id'];
        $value = $_GET['value'];
        $json = array();
        if ($value == "0") {
            $qry = mysqli_query($con, "UPDATE `order_details` SET `ord_status`='4' WHERE `ord_id`='$id'");
            if (!$qry) {
                $msg = "Order Cant Able To Disapprove!!";
            } else {
                $msg = "Order Succesfully Disapproved!!";
            }
        } else {
            $qry = mysqli_query($con, "UPDATE `order_details` SET `ord_status`='$value' WHERE `ord_id`='$id'");
            if (!$qry) {
                $msg = "Order Cant Able To Approve!!";
            } else {
                $msg = "Order Succesfully Approved!!";
            }
        }
        $json[] = array(
            'msg' => $msg,
            'id' => $id
        );
        $jsonstring = json_encode($json);
        echo $jsonstring;
    } else if ($page == "setordstatus2") {
        $id = $_GET['id'];
        $json = array();

        $qry = mysqli_query($con, "UPDATE `order_details` SET `ord_status`='2' WHERE `ord_id`='$id'");
        if (!$qry) {
            $msg = "Order Cant Able To Dispatch!!";
        } else {
            $msg = "Order Succesfully Dispatched!!";
        }
        $json[] = array(
            'msg' => $msg,
            'id' => $id
        );
        $jsonstring = json_encode($json);
        echo $jsonstring;
    } else if ($page == "setordstatus3") {
        $id = $_GET['id'];
        $json = array();

        $qry = mysqli_query($con, "UPDATE `order_details` SET `ord_status`='3' WHERE `ord_id`='$id'");
        if (!$qry) {
            $msg = "Order Cant Able To Deliever!!";
        } else {
            $msg = "Order Succesfully Delieverd!!";
        }
        $json[] = array(
            'msg' => $msg,
            'id' => $id
        );
        $jsonstring = json_encode($json);
        echo $jsonstring;
    } else if ($page == "setordstatus4") {
        $id = $_GET['id'];
        //$value = $_GET['value'];
        $json = array();
        $qry = mysqli_query($con, "UPDATE `order_details` SET `ord_status`='1' WHERE `ord_id`='$id'");
        if (!$qry) {
            $msg = "Order Cant Able To Approve!!";
        } else {
            $msg = "Order Succesfully Approved!!";
        }
        $json[] = array(
            'msg' => $msg,
            'id' => $id
        );
        $jsonstring = json_encode($json);
        echo $jsonstring;
    } elseif ($page == "set_prd_name_ofr") {
        $catsubname = $_GET['catsubname'];
        $qry = mysqli_query($con, "SELECT p.*,c.* FROM `category` c LEFT JOIN `product_details` p ON p.`cat_id`=c.`cat_id` where c.`cat_sub_name`='$catsubname'");
        $json = array();
        while ($row = mysqli_fetch_array($qry)) {
            $json[] = array(
                'prd_id' => $row['prd_id'],
                'prd_name' => $row['prd_name'],
                'prd_about' => $row['prd_about'],
                'prd_image' => $row['prd_image'],
                'prd_mrp' => $row['prd_mrp'],
                'prd_sell_rate' => $row['prd_sell_rate'],
                'prd_tax' => $row['prd_tax'],
                'prd_quantity' => $row['prd_quantity'],
                'prd_status' => $row['prd_status']
            );
        }
        $jsonstring = json_encode($json);
        echo $jsonstring;
    } elseif ($page == "get_orders_user") {
        $userid = $_GET['userid'];
        $ordid = $_GET['ordid'];
        $qry = mysqli_query($con, "SELECT op.*,o.*,u.*,p.* from `order_product` op INNER JOIN `order_details` o on o.ord_id=op.ord_id LEFT JOIN `user_details` u ON u.ud_id=o.ud_id RIGHT JOIN `product_details` p ON p.prd_id=op.prd_id where u.ud_id='$userid' and o.ord_id='$ordid'");
        $json = array();
        while ($row = mysqli_fetch_array($qry)) {
            $json[] = array(
                'oprd_id' => $row['oprd_id'],
                'ord_id' => $row['ord_id'],
                'prd_id' => $row['prd_id'],
                'oprd_qty' => $row['oprd_qty'],
                'oprd_per_price' => $row['oprd_unit_price'],
                'oprd_discount' => $row['oprd_discount'],
                'oprd_total_amt' => $row['oprd_total_amount'],
                'ord_type' => $row['ord_shipping_type'],
                'ord_status' => $row['ord_status'], //$ord_status2
                'ord_date' => $row['ord_date'],
                'ord_req_date' => $row['ord_required_date'],
                'ord_shipping_date' => $row['ord_shipping_date'],
                'ord_shipping_address' => $row['ord_shipping_address'],
                'ua_id' => $row['ud_id'],
                'ua_fname' => $row['ud_fname'],
                'ua_lname' => $row['ud_lname'],
                'ua_email' => $row['ud_email'],
                'ua_mobile' => $row['ud_mobile'],
                'ua_city' => $row['ud_city'],
                'ua_address' => $row['ud_address1'],
                'ua_pincode' => $row['ud_pincode'],
                'ua_joindate' => $row['ud_joindate'],
                'ua_status' => $row['ud_status'],
                'prd_name' => $row['prd_name'],
                'prd_about' => $row['prd_about'],
                'prd_image' => $row['prd_image'],
                'prd_mrp' => $row['prd_mrp'],
                'prd_sell_rate' => $row['prd_sell_rate'],
                'prd_tax' => $row['prd_tax'],
                'prd_quantity' => $row['prd_quantity'],
                'prd_status' => $row['prd_status']
            );
        }
        $jsonstring = json_encode($json);
        echo $jsonstring;
    } elseif ($page == 'retrieve') {

        //store variable
        $filename = $_FILES['file']['name'];
        $tempname = $_FILES['file']['tmp_name'];
        $filetype = $_FILES['file']['type'];

        //get extension
        $base = basename($filename);
        $ext = substr($base, strlen($base) - 4, strlen($base));
        //print_r($ext);
        //allowed extensions
        $allowed_ext = array(".doc", "docx", ".pdf", ".png", ".jpg", ".JPG");

        //check extension
        if (in_array($ext, $allowed_ext)) {
            
            //mail essentials
            $from = "info.parasflourmill@gmail.com";
            $to = $_POST['email'];
            $subject = "Paras Flour Mill(Inquiry Reply)";
            //$message = "Testing!!";
            $replyto = "info.parasflourmill@gmail.com";
            $body = "<body>"
                        . "<center>"
                        . "<div style='border: 4px #ee6e73 solid;background-color: #ee6e73;' width='250px'>"
                        . "<table style='border:2px white solid;'>"
                        . "<tr>"
                            . "<td><center><img src='http://parasflourmill.com/devparas/images/para_logo.PNG'/></center></td>"
                        . "</tr>"
                        . "<tr>"
                            . "<td><hr/></td>"
                        . "</tr>"
                        . "<tr>"
                            . "<td><div style='background-color: white;'><br/>"
                                . "<center>Welcome To Paras Flour Mill</center><hr/><br/>Thanks For Your Interest<br/>"
                                . "Email : ".$to."<br/>"
                                . "Message : ".$_POST['msg']."<br/>"
                                . "</div>"
                            . "</td>"
                        . "</tr>"
                        . "<tr>"
                            . "<td><hr/></td>"
                        . "</tr>"
                        . "<tr>"
                            . "<td>"
                                . "<center><h3 style='background-color: #ee6e73;'>"
                                . "<font color='White'>From Paras Flour Mill <br/> (Real TASTE OF GUJARAT)</font>"
                                . "</h3></center>"
                            . "</td>"
                        . "</tr>"
                        . "</table>"
                        . "</center></body>";
            
            $file = $tempname.$filename;
            $file_size = filesize($file);
            $handle = fopen($file, "r");
            $content = fread($handle, $file_size);
            fclose($handle);

            $content = chunk_split(base64_encode($content));
            $uid = md5(uniqid(time()));
            $name = basename($file);

            $eol = PHP_EOL;

            // Basic headers
            $header = "From: ".$from." <info.parasflourmill@gmail.com>".$eol;
            $header .= "Reply-To: ".$replyto.$eol;
            $header .= "MIME-Version: 1.0\r\n";
            $header .= "Content-Type: multipart/mixed; boundary=\"".$uid."\"";

            // Put everything else in $message
            $message = "--".$uid.$eol;
            $message .= "Content-Type: text/html; charset=ISO-8859-1".$eol;
            $message .= "Content-Transfer-Encoding: 8bit".$eol.$eol;
            $message .= $body.$eol;
            $message .= "--".$uid.$eol;
            $message .= "Content-Type: application/pdf; name=\"".$filename."\"".$eol;
            $message .= "Content-Transfer-Encoding: base64".$eol;
            $message .= "Content-Disposition: attachment; filename=\"".$filename."\"".$eol;
            $message .= $content.$eol;
            $message .= "--".$uid."--";

            //send mail
            if(mail($to, $subject,$message, $header))
            {
                //echo "Mail Sent!!";
                //mysqli_query($con,"UPDATE `inquiry_details` SET `inq_status`='1',`inq_reply`='$msg' WHERE `inq_email`='$email'");
                header("refresh:0; url= New_Inquiry.php");
            }
            else 
            {
                echo "Error!!";
                print_r(error_get_last());
            }
            
        } else {
            echo "File Type NOt Allowed!!";
        }
    } elseif ($page == "sl_img") {
        $qry = mysqli_query($con, "select * from image_details where `img_selected`='1' ORDER BY `img_position` ASC");
        $json = array();
        while ($row = mysqli_fetch_array($qry)) {
            $json[] = array(
                'img_id' => $row['img_id'],
                'img_name' => $row['img_name'],
                'img_path' => $row['img_path'],
                'img_selected' => $row['img_selected'],
                'img_position' => $row['img_position']
            );
        }
        $jsonstring = json_encode($json);
        echo $jsonstring;
    } elseif ($page == "sl_img_avl") {
        $qry = mysqli_query($con, "select * from image_details where `img_selected`='0' ORDER BY `img_id` DESC");
        $json = array();
        while ($row = mysqli_fetch_array($qry)) {
            $json[] = array(
                'img_id' => $row['img_id'],
                'img_name' => $row['img_name'],
                'img_path' => $row['img_path'],
                'img_selected' => $row['img_selected'],
                'img_position' => $row['img_position']
            );
        }
        $jsonstring = json_encode($json);
        echo $jsonstring;
    } elseif ($page == "set_img_slider_fn") {
        $id = $_GET['id'];
        $pos = $_GET['pos'];
        $nm = $_GET['nm'];
        $json = array();
        $qry = mysqli_query($con, "UPDATE `image_details` SET `img_selected`='1',`img_position`='$pos' WHERE `img_id`='$id'");
        if (!$qry) {
            echo "0";
        } else {
            $qry2 = mysqli_query($con, "UPDATE `image_details` SET `img_selected`='0',`img_position`='' WHERE `img_name`='$nm'");
            if (!$qry2) {
                echo "1";
            } else {
                echo "2";
            }
        }
    }
}
?>
