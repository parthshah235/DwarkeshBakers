<?php
session_start();
if (!isset($_SESSION['ud_id'])) {
    header("Location:../404.html");
} else {
    $ud_Id = $_SESSION['ud_id'];
    ?>
    <!DOCTYPE html>
    <!--
    To change this license header, choose License Headers in Project Properties.
    To change this template file, choose Tools | Templates
    and open the template in the editor.
    -->
    <?php include './connection.php'; ?>
    <html>
        <head>
              <style>
                body {
                        display: flex;
                        min-height: 100vh;
                        flex-direction: column;
                    }
                main {
                        flex: 1 0 auto;
                    }

            </style>
            <meta charset="UTF-8">
            <!-- Compiled and minified CSS -->
            <link rel="stylesheet" href="../css/materialize.css">
            <!--Import Google Icon Font-->
            <link href="../iconfont/material-icons.css" rel="stylesheet">
            <script type="text/javascript" src="../js/jquery-2.2.1.js"></script>
            <script type="text/javascript" src="../js/materialize.js"></script>
            <style>  i.is {font-size: 1.5em;}</style>
            <title>Order's</title>
            <script type="text/javascript">
                $(document).ready(function () {
                    $('.collapsible').collapsible({
                        accordion: false // A setting that changes the collapsible behavior to expandable instead of the default accordion style
                    });
                });
                
                function cncl_odr(obj)
                {
                    var id = obj.value;
                    var xmlhttp =  new XMLHttpRequest();
                    xmlhttp.open("GET","logic.php?value=cancel_ord&ord_id="+id,true);
                    xmlhttp.onreadystatechange = function()
                    {
                        if(xmlhttp.readyState==4 && xmlhttp.status==200)
                        {
                            var response = xmlhttp.responseText;//alert(response);
                            if(response=='0')
                            {
                                Materialize.toast('Sorry Order Cant Able To Cancel!!',3000);
                            }
                            else if(response=='1')
                            {
                                Materialize.toast('Order Cancelled!!',3000);
                                $("#status"+id).html("cancelled");
                            }
                        }
                    }
                    xmlhttp.send();
                }
            </script>
        </head>
        <body>
    <?php include './Navbar.php'; ?>
            <main>
       <center><h4 style="font-size: 40px;color: red" >My Orders/Order History</h4></center><br>
        <div class="container">

            <?php
            if ($_GET['v'] == 'ok') {
                echo "<script>  Materialize.toast('Order Has Been Place ORDER-ID (" . $_GET['id'] . ") ',5000);</script>";
            } elseif ($_GET['v'] == 'cnl') {
                echo "<script>  Materialize.toast('Order Has Been Cancel ORDER-ID (" . $_GET['id'] . ") ',5000);</script>";
            } elseif ($_GET['v'] == 'error') {
                echo "<script>  Materialize.toast('System Error Try Again ',5000);</script>";
            }
            $ord_status;
            $discamt;
            $ord_id;
            $pin_id;
            $pin_amt;
            $ord_details_qry = "SELECT * FROM order_details WHERE ud_id=$ud_Id ORDER BY STR_TO_DATE(ord_shipping_date,'%d-%m-%Y') ASC";
            $ord_qry_result = mysqli_query($con, $ord_details_qry);
            $num = mysqli_affected_rows($con);
            if ($num <= 0) {
                echo "<br/>";
                echo "<br/>";
                echo "<center><h3>Please Place any order &#9786;</h3></center>";
                echo "<br/>";
                echo "<br/>";
                echo "<br/>";
            }
            else {
            while ($ord_row = mysqli_fetch_array($ord_qry_result)) {
                ?>
                <ul class="collapsible popout" data-collapsible="accordion">
                    <li>
                        <div class="collapsible-header blue-text" >ORDER-ID: <?php
                            $ord_id = $ord_row['ord_id'];
//                            $pin_id = $ord_row['pin_id'];
                            $ord_status = $ord_row['ord_status'];
                            echo $ord_row['ord_id'];
                            ?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;DATE: <?php
                            if ($ord_row['ord_status'] == '4') {
                                echo'N/A';
                            } else {
                                echo $ord_row['ord_date'];
                            }
                            ?>
                            
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;STATUS:<text class="red-text"><span id='status<?php echo $ord_id; ?>'><?php
                            if ($ord_row['ord_status'] == '0') {
                                echo 'Pending';
                            } elseif ($ord_row['ord_status'] == '1') {
                                echo 'Approved';
                            } elseif ($ord_row['ord_status'] == '2') {
                                echo 'Dispatched';
                            } elseif ($ord_row['ord_status'] == '3') {
                                echo 'Delivered';
                            } elseif ($ord_row['ord_status'] == '4') {
                                echo 'cancelled';
                            }
                            ?></span></text></div>
                        <div class="collapsible-body"> <?php
//                            if ($ord_row['ord_ord_required_date'] == NULL) {
//                                echo 'N/A';
//                            } else {
//                                echo $ord_row['ord_ord_required_date'];
//                            }
                            ?><br>
                            <table class="highlight">
                                <thead>
                                    <tr>
                                        <th data-field="id">ID</th>
                                        <th data-field="name">Product Name</th>
                                        <th data-field="price">Quantity</th>
                                        <th data-field="price">Price(Per 500gm)</th>
        <!--                                    <th data-field="price">Discount</th>-->
                                        <th data-field="price">Total Amount</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $ord_id = $ord_row['ord_id'];
                                    $ord_oprd = "SELECT * FROM order_products WHERE ord_id=$ord_id";
                                    $ord_oprd_result = mysqli_query($con, $ord_oprd);
                                    $total_amt = 0;
                                    $in = 1; 
                                    while ($ord_oprd_row = mysqli_fetch_array($ord_oprd_result)) {
                                        $prd_id = $ord_oprd_row['prd_id'];
                                        $prd_name = "SELECT prd_id,prd_name FROM product_details WHERE prd_id=$prd_id";
                                        $prd_name_result = mysqli_query($con, $prd_name);
                                        while ($prd_name_row = mysqli_fetch_array($prd_name_result)) {

                                            $prd_name_char = $prd_name_row['prd_name'];
                                            $prd_my_id = $prd_name_row['prd_id'];
                                        }
                                        ?> 
                                    <tr>
                                            <td><?php echo $in; ?></td>
                                            <td><?php echo "<a href='./product.php?id=" . $prd_my_id . "'>" . $prd_name_char . "</a>"; ?></td>
                                            <td><?php echo $ord_oprd_row['oprd_qty']." kg"; ?></td>
                                            <td><?php echo "&#8377; " . $ord_oprd_row['oprd_unit_price']; ?></td>
                                        <?php // $discamt = $ord_oprd_row['oprd_discount']; ?>
                                            <td><?php echo "&#8377; " . $ord_oprd_row['oprd_total_amount']; ?></td>
                                        <?php $total_amt +=$ord_oprd_row['oprd_total_amount']; ?>
                                        </tr>
                                        <?php
                                        $in++;
                                    } 
                                    ?>
                                        <tr><td></td><td></td><td></td><td></td><td class="red-text" style="text-align: right;">Total:   &#8377; <?php echo $total_amt; ?><br>(+) Shipping Charges &#8377;<?php
//                                         if ($total_price < 300) {
//                                                $total_price = $total_price + 50;
//                                                echo $total_price ;
//                                                echo ' (Additional Shipping Charge Rs.50) ';
//                                            } else {
//                                                echo $total_price;
//                                            }
                                        if ($total_amt < 300) {
                                            $total_amt=$total_amt+50;
                                            echo ' 50: ';
                                            echo $total_amt;
                                            
                                        } else {
                                            echo $total_amt;
                                        }
                                        ?> <br>To Pay: &#8377;<?php $final = $total_amt;
                                        echo $final ?></td></tr>                           
                                        <!--<tr><td class="red-text" colspan="5" style="text-align: right;"> &nbsp;&nbsp;&nbsp;Cash On Delivery (COD)</td>-->
        <?php if ($ord_status == '4' || $ord_status == '3' || $ord_status == '2') {
            
        } else {
            ?><tr>
<!--                    <td>
                        <button type="submit" class="btn" onclick="cncl_odr(this);" name="ord_id" value="<?php echo $ord_id; ?>">Cancel Order</button>
                    </td>-->
              </tr><?php } ?>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </li>
            </ul>   <?php } } ?>
        </div>
            </main>
    <?php //include './test.php';?>
    <?php include 'footer.php'; ?>
    </body>
    </html>
<?php
}?>