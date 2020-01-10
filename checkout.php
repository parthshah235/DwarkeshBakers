<?php
session_start();
include './connection.php';
if (!isset($_SESSION['ud_id'])) {
    header("Location:./404.html");
} else {
    $amt;
    ?>  
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
            <title>DwarkeshBakers Checkout</title>
            <script type="text/javascript" src="./js/materialize.js"></script>
            <script type="text/javascript" src="./js/materialize.min.js"></script>
            <link rel="stylesheet" href="./css/materialize.css"> 
            <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
            <script type="text/javascript" src="./js/jquery-3.0.0.js"></script>
            <script type="text/javascript" src="./js/materialize.js"></script>

            <!--/*****************************------------------  Fonts  ------------------*****************************/-->

            <link href="https://fonts.googleapis.com/css?family=Josefin+Sans:300,400" rel="stylesheet">
            <link href='https://fonts.googleapis.com/css?family=Product+Sans:400,700' rel='stylesheet' type='text/css'>
            <link href="https://fonts.googleapis.com/css?family=Pacifico" rel="stylesheet">
            <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet">
            <link href="https://fonts.googleapis.com/css?family=Assistant:300,400,600&amp;subset=hebrew" rel="stylesheet">
            <link href="https://fonts.googleapis.com/css?family=Sansita:400,400i" rel="stylesheet">


            <style>
                i.is {
                    font-size: 1.5em;
                </style>
                
                <script src="js/lol.js">
//                    <script src="js/lol1.js">
                    //                function promodisplay() {
                    //                    $('#mypromo').hide();
                    //                    $("#promocode").show();
                    //                }
                    //                function promo(obj) {
                    //                    var total_amount = obj.id;
                    //                    var promo_code = $("#promo_code" + total_amount).val();
                    //                    var xmlhttp = new XMLHttpRequest();
                    //                    xmlhttp.open("POST", "./checkout/checkout_promo.php", true);
                    //                    xmlhttp.onreadystatechange = function ()
                    //                    {
                    //                        if (xmlhttp.readyState == 4 && xmlhttp.status == 200)
                    //                        {
                    //                            var response = xmlhttp.responseText;
                    //                            var ajaxoutput = response.slice(0, 8);
                    //                            if (response == "fail")
                    //                            {
                    //                                Materialize.toast("Cart does not meet Minimum Offer Amount!", 4000);
                    //                            } else if (response == "faildate")
                    //                            {
                    //                                Materialize.toast("Offer has expired!", 4000);
                    //                            } else if (response == "invalid")
                    //                            {
                    //                                Materialize.toast("Please enter a valid Promo Code!", 4000);
                    //                            } else
                    //                            {
                    //                                var responseafter = response.slice(7);
                    //                                total_amount = total_amount - parseInt(responseafter);
                    //                                $("#promocode").hide();
                    //                                $("#afterpromo").html(responseafter);
                    //                                $("#afterpromoin").attr("value", responseafter);
                    //                                $("#afterpromomaster").show();
                    //                                $("#total_amount_output").html(total_amount);
                    //                                Materialize.toast("Promo Code applied successfully!", 4000);
                    //                            }
                    //                        }
                    //                    }
                    //                    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                    //                    xmlhttp.send("total_amount=" + total_amount + "&promo_code=" + promo_code);
                    //                }
                    
                </script>
                <script src="lol1.js"></script>
                <style type="text/css">

                    th.tdspacing{
                        /*               padding: 0px 0px;*/
                        text-align: center;
                        /*               border-bottom: 1px black solid;*/
                        font-size: 15px;

                    }
                    body {
                        background: #A0B9D0;
                    }
                    #section-margin {
                        padding-top: 7rem;
                        padding-bottom: 7rem;
                    }
                    .shooping-cart-col-css {
                        background: #fff;
                        height: 100%;
                    }
                    .shopping-cart-col-heading-css {
                        width: 100%;
                        display: block;
                        font-size: 30px;
                        color: #616161;
                        padding: 20px;
                        font-family: 'Josefin Sans', sans-serif;
                        -webkit-font-smoothing: antialiased;
                        font-weight: 400;
                        letter-spacing: 1px;
                        text-align: center;
                        border-bottom: 1px solid #A9A9A9;
                    }
                    .order-summary-heading-css {
                        background: #DC143C;
                        font-size: 35px;
                        color: #fff;
                        font-family: 'Lato', sans-serif;
                        -webkit-font-smoothing: antialiased;
                        font-weight: 300;
                        display: block;
                        padding: 20px;
                    }
                    .table-css {
                        color: #515151;
                        font-size: 17px;
                        font-family: 'Josefin Sans', sans-serif;
                        -webkit-font-smoothing: antialiased;
                        font-weight: 400;
                        letter-spacing: 1px;
                    }
                    .product-name-css {
                        color: #616161;
                    }
                    .invoice-col-css {
                        background: #303874;
                        height: 100%;
                    }
                    .invoice-col-row-col-css {
                        width: 100%
                    }
                    .col-heading-css {
                        width: 100%;
                        display: block;
                        font-size: 30px;
                        color: #fff;
                        padding: 20px;
                        font-family: 'Josefin Sans', sans-serif;
                        -webkit-font-smoothing: antialiased;
                        font-weight: 400;
                        letter-spacing: 1px;
                        text-align: center;
                        border-bottom: 1px solid #181d44;

                    }
                    .invoice-row-heading {
                        color: #1EADD5;
                        font-size: 13px;
                        font-family: 'Lato', sans-serif;
                        -webkit-font-smoothing: antialiased;
                        font-weight: 400;
                        letter-spacing: 1px;
                        display: block;
                        float: left;
                    }
                    .invoice-row-content {
                        color: #fff;
                        display: block;
                        font-size: 13px;
                        font-family: 'Lato', sans-serif;
                        -webkit-font-smoothing: antialiased;
                        letter-spacing: 1px;
                        font-weight: 400;
                        float: left;
                        text-align: left;
                    }
                    .col-padding {
                        padding-top: 20px;
                        border-bottom: 1.5px solid #242a56;
                    }
                    .tr-css {
                        color: #616161;
                        font-size: 15px;
                        font-family: 'Lato', sans-serif;
                        -webkit-font-smoothing: antialiased;
                        letter-spacing: 1px;
                        font-weight: 300;
                    }

                    /*<!--****************************------------------  Buttons  ------------------****************************-->*/

                    .proceed-to-pay-button {
                        border: 1px solid #fff;
                        color: #fff;
                        padding: 10px 15px;
                        border-radius: 4px;
                        background: none;
                        width: 200px;
                        height: 50px;
                    }
                    .proceed-to-pay-button:hover {
                        border: 1px solid #fff;
                        color: #303874;
                        padding: 10px 15px;
                        border-radius: 4px;
                        background: #fff;

                    }

                </style>
            </head>
            <body>
                <?php include './Navbar.php'; ?>
                <main>
                    <div class="section" id="section-margin"> 
                        <div class="container" style="width: 100%">
                            <?php
                            $sql = "SELECT * FROM user_details WHERE ud_id='" . $_SESSION['ud_id'] . "'";
                            $result = mysqli_query($con, $sql);
                            $row = mysqli_fetch_assoc($result);
                            $ud_fname = $row['ud_fname'];
                            $ud_lname = $row['ud_lname'];
                            $ud_mobile = $row['ud_mobile'];
                            $ud_address = $row['ud_address'];
                            $ud_shipping_address = $row['ud_address1'];
                            //                $ud_pincode = $row['ud_pincode'];
                            $ud_city = $row['ud_city'];
                            ?>
                                <div class="row">
                                    <!--<span class="center-align order-summary-heading-css">Your Order Summary</span>-->
                                    <?php
                                    $total_price = 0;
                                    $sql1 = "SELECT * FROM cart_details WHERE ud_id='" . $_SESSION['ud_id'] . "'";
                                    $result1 = mysqli_query($con, $sql1);
                                    $num = mysqli_affected_rows($con);
                                    if ($num > 0) {
                                        ?>
                                        <div class="col s12 m8 l8 shooping-cart-col-css">
                                            <div class="row">
                                                <div class="col s12 m12 l12">
                                                    <span class="shopping-cart-col-heading-css">Shopping Cart</span>
                                                </div>
                                            </div>
                                            <table class="highlight responsive-table">
                                                <thead>
                                                    <tr class="tr-css">
                                                        <th class="center-align">Image</th>
                                                        <th class="center-align">Name</th>
                                                        <th class="center-align">Price</th>
                                                        <th class="center-align">Quantity</th>
                                                        <th class="center-align"></th>
                                                        <th class="center-align">Subtotal</th>
                                                    </tr>
                                                </thead>
                                                <tbody style="padding-top: 40px;">
                                                    <?php
                                                    while ($row1 = mysqli_fetch_assoc($result1)) {
                                                        if ($row1['ud_id'] == $_SESSION['ud_id']) {
                                                            $sql2 = "SELECT * FROM product_details WHERE prd_id=" . $row1["prd_id"] . "";
                                                            $result2 = mysqli_query($con, $sql2);
                                                        }
                                                        while ($row2 = mysqli_fetch_assoc($result2)) {
                                                            $chck_ofr_prd = mysqli_query($con, "SELECT p.*,o.* from offer_details o inner join product_details p on p.prd_id = o.prd_id where o.prd_id='" . $row2['prd_id'] . "'");
                                                            $num = mysqli_affected_rows($con);
                                                            ?>

                                                        <tr class="table-css">
                                                            <td><center><img width="100px" height="100px" class=" materialboxed" src="./Admin_Panel<?php echo $row2["prd_image"]; ?>"></center></td>
                                                    <td class="center-align"><?php echo "<a href='./product.php? class='product-name-css' id=" . $row2["prd_id"] . "'>" . $row2["prd_name"] . "</a>"; ?></td>
                                                    <?php if ($num <= 0) { ?>
                                                        <td class="center-align"><?php echo $row2["prd_mrp"]; ?></td>
                                                        <td class="center-align"><?php echo $row1["cart_product_qty"]; ?></td>
                                                        <!--<td>/ kg</td>-->
                                                        <td class="center-align">
                                                            <?php
                                                            echo $row2['prd_mrp'] * $row1['cart_product_qty'];
                                                            $total_price = $total_price + ($row2['prd_mrp'] * $row1['cart_product_qty']);

                                                            //                                                        $subtotal = $row2["prd_mrp"] * $row1["cart_product_qty"];
                                                            ?>
                                                        </td>
                                                        <?php
                                                        //                                                } else {
                                                        //                                                    while ($row7 = mysqli_fetch_array($chck_ofr_prd)) {
                                                        //                                                        $dc_percent = $row7['ofd_discount'];
                                                        //                                                        $mrp = $row7['prd_mrp'];
                                                        //                                                        $dis1 = $mrp * $dc_percent;
                                                        //                                                        $disfinal = $dis1 / 100;
                                                        //                                                        $discount = $mrp - $disfinal;
                                                        ?>
                                                        <td class="center-align"><?php // echo $discount;      ?></td>
                                                        <td class="center-align"><?php // echo $row1["cart_product_qty"];       ?></td>
                                                        <td class="center-align"><?php
                                                            //                                                            $subtotal = $discount * $row1["cart_product_qty"];
                                                            //                                                            echo $subtotal;
                                                            ?></td>
                                                        <?php
                                                    }
                                                }
                                                ?>
                                                </tr>
                                                <?php
                                                $total_price;
                                            }
                                        }
                                        ?>
                                        </tbody>
                                    </table>
                                <?php } ?>
                            </div>

                            <div class="col s12 m4 l4 invoice-col-css">
                                <form action="logic.php?value=placeorder" method="POST">
                                    <div class="row">
                                        <div class="col s12 m12 l12">
                                            <span class="col-heading-css">Invoice</span>
                                        </div>
                                    </div>
                                    <div class="row" style="padding-left: 20px;padding-right: 20px;">
                                        <center class="col-padding">
                                            <div class="row invoice-col-row-col-css">
                                                <div class="col s5 m5 l5">
                                                    <span class="invoice-row-heading">Full Name</span>
                                                </div>
                                                <div class="col s7 m7 l7">
                                                    <span class="invoice-row-content"><?php echo $ud_fname . " " . $ud_lname; ?></span>
                                                </div>
                                            </div>
                                        </center>

                                        <center class="col-padding">
                                            <div class="row invoice-col-row-col-css">
                                                <div class="col s5 m5 l5">
                                                    <span class="invoice-row-heading">Contact No</span>
                                                </div>
                                                <div class="col s7 m7 l7">
                                                    <span class="invoice-row-content"><?php echo $ud_mobile; ?></span>
                                                </div>
                                            </div>
                                        </center>

                                        <center class="col-padding">
                                            <div class="row invoice-col-row-col-css">
                                                <div class="col s5 m5 l5">
                                                    <span class="invoice-row-heading">Billing Address</span>
                                                </div>
                                                <div class="col s7 m7 l7">
                                                    <span class="invoice-row-content"><?php echo $ud_address; ?></span>
                                                    <!--<a href="#modal1" onclick=""><i class='fa fa-pencil' aria-hidden='true' style='color:#DC143C'></i></a>-->
                                                    </div>
                                                </div>
                                            </center>

                                            <!-- Modal Structure -->
                                            <div id="modal1" class="modal">
                                                <div class="modal-content">
                                                    <h4>Modal Header</h4>
                                                    <p>A bunch of text</p>
                                                </div>
                                                <div class="modal-footer">
                                                    <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat">Agree</a>
                                                </div>
                                            </div>    



                                            <center class="col-padding">
                                                <div class="row invoice-col-row-col-css">
                                                    <div class="col s5 m5 l5">
                                                        <span class="invoice-row-heading">Shipping Address</span>
                                                    </div>
                                                    <div class="col s7 m7 l7">
                                                        <span class="invoice-row-content"><?php echo $ud_shipping_address; ?></span>
                                                    </div>
                                                </div>
                                            </center>


                                            <center class="col-padding">
                                                <div class="row invoice-col-row-col-css">
                                                    <div class="col s5 m5 l5">
                                                        <span class="invoice-row-heading">City</span>
                                                    </div>
                                                    <div class="col s7 m7 l7">
                                                        <span class="invoice-row-content"><?php echo "Vadodara"; ?></span>
                                                    </div>
                                                </div>
                                            </center>

                                            <center class="col-padding">
                                                <div class="row invoice-col-row-col-css">
                                                    <div class="col s5 m5 l5">
                                                        <span class="invoice-row-heading">Cart Total</span>
                                                    </div>
                                                    <div class="col s7 m7 l7">
                                                        <span class="invoice-row-content"><?php echo $total_price; ?></span>
                                                    </div>
                                                </div>
                                            </center>

                                            <center class="col-padding">
                                                <div class="row invoice-col-row-col-css">
                                                    <div class="col s5 m5 l5">
                                                        <span class="invoice-row-heading">To Pay</span>
                                                    </div>
                                                    <div class="col s7 m7 l7">
                                                        <span id="total_amount_output" class="invoice-row-content">
                                                            <?php
                                                            if ($total_price < 300) {
                                                                $total_price = $total_price + 50;
                                                                echo $total_price;
                                                                echo '(Additional Shipping Charge Rs.50)';
                                                            } else {
                                                                echo $total_price;
                                                            }
                                                            +amt;
                                                            ?>
                                                        </span>
                                                    </div>
                                                </div>
                                            </center>

                                            <center class="col-padding">
                                                <div class="row invoice-col-row-col-css">
                                                    <div class="col s5 m5 l5">
                                                        <span class="invoice-row-heading">Delivery Till</span>
                                                    </div>
                                                    <div class="col s7 m7 l7">
                                                        <span id="total_amount_output" class="invoice-row-content">
                                                            <?php
                                                            $dateplus2 = date('d-m-Y', strtotime('+2 hours'));
                                                            echo $dateplus2 . "<br>Cash On Delivery (COD)";
                                                            ?>
                                                        </span>
                                                    </div>
                                                </div>
                                            </center>

                                            <center>
                                                <div class="col s12 m12 l12" style="padding: 50px">
                                                    <button id="cash" class="proceed-to-pay-button" type="submit" onclick="xyz();"><i class='material-icons left'>receipt</i>Pay by Cash</button>
                                                    <br><br>
                                                    <!--<a href="Page_2.php"><input type="button" value="Pay By Card" onclick="pay();" class="proceed-to-pay-button"></button></a>-->
                                                    <button id="card" class="proceed-to-pay-button" type="submit" onclick="pay();"><i class='material-icons left'>receipt</i>Pay by Card</button>
                                                
                                                    <input type="hidden" value="<?php echo $_SESSION['ud_id']; ?>" name="ud_id">
                                                    <input type="hidden" id="afterpromoin" name="code_amt">
                                                    <input type="hidden" value="<?php // echo$ud_pincode;       ?>" name="pincode">
                                                </div>
                                            </center>

<!--                                        <tr>
        <td>
            <span><b>Contact No : </b><?php echo $ud_mobile; ?></span>

        </td>
    </tr>
    <tr>
        <td>
            <span><b>Shipping Address : </b><?php echo $ud_address; ?></span>
        </td>
    </tr>
    <tr>
        <td>
            <span><b>Delivery Address : </b><?php echo $ud_address1; ?></span>
        </td>
    </tr>
    <tr>
        <td>
            <span><b>City : </b><?php echo "Vadodara"; ?></span>
        </td>
    </tr>-->


<!--                                    <tr>
    <td>
        <span><b>Pincode : </b><?php // echo $ud_pincode;       ?></span>
    </td>
</tr>-->


<!--                                        <tr>
    <td>
        <span> <b>Cart Total : </b></span>
        <span><?php echo $total_price; ?></span>
    </td>
</tr>-->


<!--                                    <tr class="center-align">
    <td>
        <button id="mypromo" onclick='promodisplay();' class="waves-effect waves-light btn" type="button"><i class='material-icons left'>spellcheck</i>Have a Promo Code?</button>
        <style>#promocode{display:none;}</style>
        <style>#afterpromomaster{display:none;}</style>
        <span id="promocode" class="center-align">
            <span class="input-field col s12">
                <input id="promo_code<?php // echo $total_price;       ?>" type="text" autocomplete="off">
                <label for="promo_code">Enter Promocode</label>
                <button id="<?php // echo $total_price;       ?>" onclick='promo(this);' class="waves-effect waves-light btn" type="button"><i class='material-icons left'>spellcheck</i>Apply</button>
            </span>
        </span>
        <span id="afterpromomaster"><b>You Save :</b>(-) 
            <span id="afterpromo">
            </span>
        </span>
    </td>
</tr>-->

<!--                                        <tr>
        <td>
            <span><b>To Pay : </b></span>
            <span id="total_amount_output"><?php
                                            if ($total_price < 300) {
                                                $total_price = $total_price + 50;
                                                echo $total_price;
                                                echo ' (Additional Shipping Charge Rs.50) ';
                                            } else {
                                                echo $total_price;
                                            }
                                            +amt;
                                            ?>
            </span>
        </td>
    </tr>-->


<!--                                        <tr>
        <td>
            <span><b>Delivery Till: </b></span>
            <b>
                                            <?php
                                            $dateplus2 = date('d-m-Y', strtotime('+2 hours'));
                                            echo $dateplus2 . "<br>Cash On Delivery (COD)";
                                            ?>
            </b>
        </td>
    </tr>
    <tr>
        <td>

            <button class="waves-effect waves-light btn" type="submit"><i class='material-icons left'>receipt</i>Proceed to Pay</button>
            <input type="hidden" value="<?php echo $_SESSION['ud_id']; ?>" name="ud_id">
            <input type="hidden" id="afterpromoin" name="code_amt">
            <input type="hidden" value="<?php // echo$ud_pincode;       ?>" name="pincode">

        </td>
    </tr>-->
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
                <script>
                    $(document).ready(function())
                    {
                    $.('.modal').modal();
                    }
                </script>
<!--    <center><font class="red-text">* Note We Currently Provide Service In Vadodara Only.</font></center>
                <?php include './test.php'; ?> -->
            </body>
        </html><?php
//}?>