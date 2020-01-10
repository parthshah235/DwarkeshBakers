<?php
error_reporting(E_ERROR | E_PARSE);
session_start();
if (!isset($_SESSION['ud_id'])) {
    header("Location:./Home.php");
} else {
    $ud_id = $_SESSION['ud_id'];
    include './connection.php';
    ?>
    <!DOCTYPE html>
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
            <title></title>
            <link rel="stylesheet" href="./css/materialize.min.css" />
            <link href="./iconfont/material-icons.css" rel="stylesheet">
            <script type="text/javascript" src="./js/jquery-3.0.0.js"></script>
            <script type="text/javascript" src="./js/materialize.js"></script>
            <script type="text/javascript">

                function rem_cart(obj)
                {
                    var ud_id = "<?php echo $_SESSION['ud_id']; ?>";
                    var prd_name = obj.value;
                    var prd_id = obj.id;
                    var total_price = $('#tot').text();//alert(total_price);
                    var sub_total = $('#sub' + prd_id).text();//alert(sub_total);
                    var ctot = total_price - sub_total;//alert(ctot);
                    if (ud_id == "")
                    {
                        Materialize.toast("Login to add in cart!", 4000);
                    } else {
                        //var qty = $("#num" + prd_id).val();
                        var xmlhttp = new XMLHttpRequest();
                        xmlhttp.open("POST", "./logic.php?page=rem_cart", true);
                        xmlhttp.onreadystatechange = function ()
                        {
                            if (xmlhttp.readyState == 4 && xmlhttp.status == 200)
                            {
                                var response = xmlhttp.responseText;
                                if (response == "0")
                                {
                                    Materialize.toast(prd_name + " Failed To Remove From Your Cart !", 4000);
                                } else if (response == "1")
                                {
                                    Materialize.toast(prd_name + " Succesfully Removed From Your Cart !", 4000);
                                    $("#prd_row" + prd_id).remove();
                                    $("#tot").html("");
                                    $("#tot").html(ctot);
                                }
                            }
                        }
                        xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                        xmlhttp.send("user_id=" + encodeURIComponent(ud_id) + "&prd_id=" + encodeURIComponent(prd_id));
                    }
                }

                function empty_cart()
                {
                    var ud_id = "<?php echo $_SESSION['ud_id']; ?>";
                    var xmlhttp = new XMLHttpRequest();
                    xmlhttp.open("POST", "./logic.php?page=empty_cart", true);
                    xmlhttp.onreadystatechange = function ()
                    {
                        if (xmlhttp.readyState == 4 && xmlhttp.status == 200)
                        {
                            var response = xmlhttp.responseText;
                            if (response == "productempty")
                            {
                                window.location.reload(true);
                            } else if (response == "productfailed")
                            {
                                Materialize.toast("Failed to empty the cart!", 4000);
                            }
                        }
                    }
                    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                    xmlhttp.send("user_id=" + ud_id);
                }

                function update_cart(obj)
                {
                    var ud_id = "<?php echo $_SESSION['ud_id']; ?>";
                    var prd_name = obj.data('p_name');
                    var prd_price = obj.data('p_price');
                    var ctotal_price = document.getElementById('total_price_output').innerHTML;
                    var prd_id = obj.attr('id');
                    var csub_total = document.getElementById('qtychange' + prd_id).innerHTML;
                    var qty = obj.val();
                    if (qty <= "0")
                    {
                        Materialize.toast("Quantity Not Acceptable!!", 4000);
                    } else {
                        var xmlhttp = new XMLHttpRequest();
                        xmlhttp.open("POST", "./logic.php?page=update_cart", true);
                        xmlhttp.onreadystatechange = function ()
                        {
                            if (xmlhttp.readyState == 4 && xmlhttp.status == 200)
                            {
                                var response = xmlhttp.responseText;
                                var ajaxoutput = response.slice(0, 14);
                                if (ajaxoutput == "productupdated")
                                {
                                    var quantity = response.slice(14);
                                    if (prd_price === parseInt(prd_price))
                                    {
                                        quantity = quantity * parseInt(prd_price);
                                    } else
                                    {
                                        quantity = quantity * parseFloat(prd_price);
                                    }
                                    $("#qtychange" + prd_id).html(quantity);
                                    var total_price = ((parseInt(ctotal_price) - parseInt(csub_total)) + quantity);
                                    $("#total_price_output").html(total_price);
                                    Materialize.toast(prd_name + " quantity was updated!", 4000);
                                } else if (ajaxoutput == "productfailedd")
                                {
                                    Materialize.toast(prd_name + " Invalid Response Value Detected!", 4000);
                                }
                            }
                        }
                        xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                        xmlhttp.send("ud_id=" + ud_id + "&prd_id=" + prd_id + "&quantity=" + qty);
                    }
                }

                function checkout()
                {
                    //                    alert("1")
                    var ud_id = "<?php echo $_SESSION['ud_id']; ?>";
                    //                    alert(ud_id)
                    var xmlhttp = new XMLHttpRequest();
                    xmlhttp.open("POST", "./cart_checkout.php", true);
                    xmlhttp.onreadystatechange = function ()
                    {
                        if (xmlhttp.readyState == 4 && xmlhttp.status == 200)
                        {
                            var response = xmlhttp.responseText;
                            if (response == "incomplete profile")
                            {
                                Materialize.toast("Please complete your profile details before ordering any product!", 4000);
                            } else if (response == "empty cart")
                            {
                                Materialize.toast("No products found in your cart!", 4000);
                            } else if (response == "ok")
                            {
                                window.location.assign("./checkout.php");
                            }
                        }
                    }
                    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                    xmlhttp.send("user_id=" + ud_id);
                }

            </script>
            <style type="text/css">
                #section-margin {
                    padding-top: 8rem;
                    padding-bottom: 8rem;
                }
                .shopping-cart-col-heading-css {
                    width: 100%;
                    display: block;
                    font-size: 40px;
                    color: #fff;
                    padding: 20px;
                    font-family: 'Josefin Sans', sans-serif;
                    -webkit-font-smoothing: antialiased;
                    font-weight: 400;
                    letter-spacing: 1px;
                    text-align: center;
                    /*border-bottom: 1px solid #DC143C;*/
                    background: #DC143C;
                }
                .tagli-css {
                    font-family: 'Lato', sans-serif;
                    -webkit-font-smoothing: antialiased;
                    font-weight: 700;
                    font-size: 12px;
                    padding: 12px;
                    border-radius: 4px;
                    background: rgba(0,0,0,0.5);
                    color: #fff;
                }
                .tr-css {
                    background-color: #DC143C;
                    color: #fff;
                    font-size: 15px;
                    font-family: 'Lato', sans-serif;
                    -webkit-font-smoothing: antialiased;
                    letter-spacing: 1px;
                    font-weight: 300;
                }
                .table-css {
                    color: #515151;
                    font-size: 17px;
                    font-family: 'Josefin Sans', sans-serif;
                    -webkit-font-smoothing: antialiased;
                    font-weight: 700;
                    letter-spacing: 1px;
                }
                .note-css {
                    font-family:'Product Sans', Arial, sans-serif;
                    -webkit-font-smoothing: antialiased;
                    letter-spacing: 1px;
                    font-weight: 400;
                    color: #DC143C
                }
                
                .cart-button-css {
                    font-size: 17px;
                    font-family:'Product Sans', Arial, sans-serif;
                    letter-spacing: 1px;
                    -webkit-font-smoothing: antialiased;
                    font-weight: 400;
                    border: 1px solid #515151;
                    color: #515151;
                    border-radius: 4px;
                    background: none;
                    width: 200px;
                    height: 55px;
                }
                .cart-button-css:hover {
                    border: 1px solid #515151;
                    color: #fff;
                    padding: 10px 15px;
                    border-radius: 4px;
                    background: #515151;
                }
                .action-button-css {
                    border: none;
                    background: none;
                    color: #DC143C;
                }
                .action-button-css:hover {
                    border: none;
                    background: none;
                    color: #616161;
                }
                .add-button-css {
                    border: none;
                    background: none;
                    color: #616161;
                }
                .add-button-css:hover {
                    border: none;
                    background: none;
                    color: #DC143C;
                }
                .remove-button-css {
                    border: none;
                    background: none;
                    color: #616161;
                }
                .remove-button-css:hover {
                    border: none;
                    background: none;
                    color: #DC143C;
                }
            </style>
        </head>
        <body>
            <main>
                
                <?php include './Navbar.php'; ?>
                
                <div class="section" id="section-margin">
                    <div class="container" style="width: 100%">
                        <div class="row">
                            <div class="col s12 m12 l12">
                                <div class="shopping-cart-col-heading-css">
                                    <center><span>My Cart</span></center>
                                    <center><span class="tagli-css"><b>* Note : </b>For orders below Rs.300 additional shipping charge of Rs.50</span></center>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col s12 m12 l12">
                                <table class="centered">
                                    <thead>
                                        <tr class="tr-css">
                    <!--                            <th data-field="no">No</th>-->
                                            <th data-field="img">Image</th>
                                            <th data-field="name">Name</th>
                                            <th></th>
                                            <th data-field="name" style="width: 75px;margin-top: 0px;margin-left: -15px;">Quantity</th>
                                            <th></th>
                                            <th></th>
                                            <th data-field="name">Price</th>
                                            <th data-field="name">Sub-Total</th>
                                            <th data-field="name">Action</th>
                                        </tr>
                                    </thead>

                                    <tbody class="table-css">
                                        <?php
                                        $no = 0;
                                        $res = mysqli_query($con, "SELECT p.*,c.* FROM `product_details` p JOIN `cart_details` c on c.prd_id = p.prd_id  where c.ud_id = $ud_id");
                                        $total = 0;
                                        while ($row = mysqli_fetch_array($res)) {
                                            $no++;
                                            ?>
                                            <tr id="prd_row<?php echo $row["prd_id"] ?>">
                                <!--                                <td><?php echo $no; ?></td>-->
                                                <td><center><img height=50px" width="50px" class='responsive-img materialboxed' data-caption="<?php echo $row['prd_name']; ?>" src='./Admin_Panel/<?php echo $row["prd_image"] ?>'></center></td>
                                                <td><a href='./product.php?id=<?php echo $row["prd_id"] ?>'><?php echo $row["prd_name"] ?></a></td>
                                                <!--minus product quantity-->
                                                <td>
                                                        <?php 
                                                        if($row['cat_id']==20 || $row['cat_id']==17 || $row['cat_id']==21)
                                                        {?>
                                                            <div class="col s2 m2 l2">
                                                        <a class="remove-button-css" onclick="qtyupdm(<?php echo $row["prd_id"]; ?>)"><i class="fa fa-minus" aria-hidden="true"></i></a>
                                                       <?php
                                                        }
                                                        else
                                                        {?>

                                                            <div class="col s2 m2 l2">
                                                        <a class="remove-button-css" onclick="qtyupdm1(<?php echo $row["prd_id"]; ?>)"><i class="fa fa-minus" aria-hidden="true"></i></a>
                                                      <?php  }
                                                        ?>

                                                      <!--                                        <a class="waves-effect waves-teal btn-floating waves-light disabled" style="margin-left: -15px;" id="rem<?php //echo $row["prd_id"]   ?>"><i class="material-icons">remove</i></a>-->
                                                    </div></td>
                                                <!--quantity update-->
                                                <td><div class="col s2 m2 l2" style="width: 75px;margin-top: 0px;margin-left: -15px;">
                                                        <input placeholder="Quantity" id="qty<?php echo $row["prd_id"] ?>" type="text" class="disabled validate red-text" disabled="disabled" value="<?php echo $row["cart_product_qty"]; ?>">
                                                    </div></td>
                                                <td>
                                                    <div class="col s2 m2 l2 red-text" style="width:30px;margin-top: 9px;">
                                                        <?php 
                                                        if($row['cat_id']==20 || $row['cat_id']==17 || $row['cat_id']==21)
                                                        {
                                                            echo "pc";
                                                        }
                                                        else
                                                        {
                                                            echo "kg";
                                                        }
                                                        ?>
                                                    </div></td>
                                                <!--add product quantity-->
                                                <td>
                                                        <?php  if($row['cat_id']==20 || $row['cat_id']==17 || $row['cat_id']==21) {?>

                                                    <div class="col s2 m2 l2" style="margin-left: -7px;">
                                                        <a class="waves-effect waves-teal btn-floating waves-light" onclick="qtyupdp(<?php echo $row["prd_id"]; ?>)"><i class="fa fa-plus" aria-hidden="true"></i></a>
                                                    </div>
                                                 <?php } else { ?>
                                                    <div class="col s2 m2 l2" style="margin-left: -7px;">
                                                        <a class="add-button-css" onclick="qtyupdp1(<?php echo $row["prd_id"]; ?>)"><i class="fa fa-plus" aria-hidden="true"></i></a>
                                                    </div>

                                                      <?php  } ?>

                                                </td>
                                                <?php
                                                $price = $row['prd_mrp'] * $row['cart_product_qty']- $row['ofd_amount'];
                                                $total += $price;
                                                ?>
                                                <td id="mr<?php echo $row["prd_id"] ?>"><?php echo $row['prd_mrp']; ?></td>
                                                <td id="sub<?php echo $row["prd_id"] ?>"><?php echo $row['prd_mrp'] * $row['cart_product_qty']; ?></td>
                                                <td>
                                                    <button id="<?php echo $row["prd_id"]; ?>" value="<?php echo $row["prd_name"]; ?>" onclick="rem_cart(this)" class="action-button-css" type="submit"><i class="fa fa-times" aria-hidden="true"></i></button>
                                                </td>
                                            </tr>
                                            <?php
                                        }
                                        ?>
                                            <tr style="background: rgb(48,56,116); color:#fff;">
                                            <td>Total</td>
                                            <td id="tot"><?php echo $total; ?></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        
                            <div class="divider" style="background: #DC143C;margin-bottom: 40px;margin-top: 30px"></div>
                            
                        <div class="row">
                            <div class="col s12 m4 l4">
                                <center><button class="cart-button-css" onclick="window.top.location.href='./Home.php'"><i class="fa fa-shopping-bag" aria-hidden="true"></i> &nbsp;&nbsp;&nbsp;Shop More</button></center>
                            </div>
                            <div class="col s12 m4 l4 hide-on-med-and-up">
                                <br/>
                            </div>
                            <div class="col s12 m4 l4">
                                <center><button onclick="empty_cart();" class="cart-button-css" type="submit"><i class="fa fa-trash" aria-hidden="true"></i> &nbsp;&nbsp;&nbsp;Empty Cart</button></center>
                            </div>
                            <div class="col s12 m4 l4 hide-on-med-and-up">
                                <br/>
                            </div>
                            <div class="col s12 m4 l4">
                                <center><button onclick="checkout();" class="cart-button-css" type="submit"><i class='material-icons'>receipt</i> &nbsp;&nbsp;Place Order</button></center>
                            </div>
                        </div>
                    </div>
                        
<!--                    <div class="container" style="width: 100%">
                        <div class="row">
                            <div class="col s12 m12 l12">
                                <span class="shopping-cart-col-heading-css">My Cart</span>
                            </div>
                        </div>
                        <table class="centered highlight">
                            <thead>
                                <tr class="tr-css">
                                        <th data-field="no">No</th>
                                    <th data-field="img">Image</th>
                                    <th data-field="name">Name</th>
                                    <th></th>
                                    <th data-field="name" style="width: 75px;margin-top: 0px;margin-left: -15px;">Quantity</th>
                                    <th></th>
                                    <th></th>
                                    <th data-field="name">Price</th>
                                    <th data-field="name">Sub-Total</th>
                                    <th data-field="name">Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php
                                $no = 0;
                                $res = mysqli_query($con, "SELECT p.*,c.* FROM `product_details` p JOIN `cart_details` c on c.prd_id = p.prd_id  where c.ud_id = $ud_id");
                                $total = 0;
                                while ($row = mysqli_fetch_array($res)) {
                                    $no++;
                                    ?>
                                    <tr id="prd_row<?php echo $row["prd_id"] ?>">
                                                        <td><?php echo $no; ?></td>
                                        <td><img height=50px" width="50px" class='responsive-img materialboxed' data-caption="<?php echo $row['prd_name']; ?>" src='./Admin_Panel/<?php echo $row["prd_image"] ?>'></td>
                                        <td><a href='./product.php?id=<?php echo $row["prd_id"] ?>'><?php echo $row["prd_name"] ?></a></td>
                                        minus product quantity
                                        <td>
                                                <?php 
                                                if($row['cat_id']==20 || $row['cat_id']==17 || $row['cat_id']==21)
                                                {?>
                                                    <div class="col s2 m2 l2">
                                                <a class="remove-button-css" onclick="qtyupdm(<?php echo $row["prd_id"]; ?>)"><i class="fa fa-minus" aria-hidden="true"></i></a>
                                               <?php
                                                }
                                                else
                                                {?>

                                                    <div class="col s2 m2 l2">
                                                <a class="remove-button-css" onclick="qtyupdm1(<?php echo $row["prd_id"]; ?>)"><i class="fa fa-minus" aria-hidden="true"></i></a>
                                              <?php  }
                                                ?>

                                                                                      <a class="waves-effect waves-teal btn-floating waves-light disabled" style="margin-left: -15px;" id="rem<?php //echo $row["prd_id"]   ?>"><i class="material-icons">remove</i></a>
                                            </div></td>
                                        quantity update
                                        <td><div class="col s2 m2 l2" style="width: 75px;margin-top: 0px;margin-left: -15px;">
                                                <input placeholder="Quantity" id="qty<?php echo $row["prd_id"] ?>" type="text" class="disabled validate red-text" disabled="disabled" value="<?php echo $row["cart_product_qty"]; ?>">
                                            </div></td>
                                        <td>
                                            <div class="col s2 m2 l2 red-text" style="width:30px;margin-top: 9px;">
                                                <?php 
                                                if($row['cat_id']==20 || $row['cat_id']==17 || $row['cat_id']==21)
                                                {
                                                    echo "pc";
                                                }
                                                else
                                                {
                                                    echo "kg";
                                                }
                                                ?>
                                            </div></td>
                                        add product quantity
                                        <td>
                                                <?php 
                                                if($row['cat_id']==20 || $row['cat_id']==17 || $row['cat_id']==21)
                                                {?>

                                            <div class="col s2 m2 l2" style="margin-left: -7px;">
                                                <a class="waves-effect waves-teal btn-floating waves-light" onclick="qtyupdp(<?php echo $row["prd_id"]; ?>)"><i class="material-icons">add</i></a>
                                            </div>
                                         <?php
                                                }
                                                else
                                                {?>
                                               <div class="col s2 m2 l2" style="margin-left: -7px;">
                                                <a class="waves-effect waves-teal btn-floating waves-light" onclick="qtyupdp1(<?php echo $row["prd_id"]; ?>)"><i class="material-icons">add</i></a>
                                            </div>

                                              <?php  }
                                                ?>









                                        </td>
                                        <?php
                                        $price = $row['prd_mrp'] * $row['cart_product_qty'];
                                        $total += $price;
                                        ?>
                                        <td id="mr<?php echo $row["prd_id"] ?>"><?php echo $row['prd_mrp']; ?></td>
                                        <td id="sub<?php echo $row["prd_id"] ?>"><?php echo $row['prd_mrp'] * $row['cart_product_qty']; ?></td>
                                        <td>
                                            <button id="<?php echo $row["prd_id"]; ?>" value="<?php echo $row["prd_name"]; ?>" onclick="rem_cart(this)" class="btn-floating red waves-effect waves-light" type="submit"><i class='material-icons small'>clear</i></button>
                                        </td>
                                    </tr>
                                    <?php
                                }
                                ?>
                                <tr>
                                    <td colspan="5">Total</td>
                                    <td id="tot"><?php echo $total; ?></td>
                                    <td></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="row center">
                        <div class="col s12 m4 l4">
                            <button class="waves-effect waves-light btn" href="./Home.php"><i class="material-icons left">shop_two</i>Shop More</a>
                        </div>
                        <div class="col s12 m4 l4 hide-on-med-and-up">
                            <br/>
                        </div>
                        <div class="col s12 m4 l4">
                            <button onclick="empty_cart();" class="btn waves-effect waves-light" type="submit"><i class='material-icons left' type="submit">shopping_cart</i>Empty Cart</button>
                        </div>
                        <div class="col s12 m4 l4 hide-on-med-and-up">
                            <br/>
                        </div>
                        <div class="col s12 m4 l4">
                            <button onclick="checkout();" class="waves-effect waves-light btn" type="submit"><i class="material-icons right">forward</i>Place Order</button>
                        </div>
                        <div>
                            <center><span class="note-css"> <b>*Note:</b>For orders below Rs.300 additional shipping charge of Rs.50</span></center>
                        </div>
                    </div>                        
                </div>  -->
                <script>
                    function qtyupdm(str)
                {
                   var a=document.getElementById("qty"+str).value;
                   if(a<1 || a>21)
                   {
                       exit();
                   }
                   else
                   {
                       document.getElementById("qty"+str).value=a-1;
                   }
                   a=document.getElementById("qty"+str).value;
                   var b=document.getElementById("mr"+str).innerHTML;
                   document.getElementById("sub"+str).innerHTML=a*parseInt(b);
                   var xmlhttp=new XMLHttpRequest();
                   xmlhttp.onreadystatechange = function ()
                    {
                        if (xmlhttp.readyState == 4 && xmlhttp.status == 200)
                        {
                            document.getElementById("tot").innerHTML=xmlhttp.responseText;
                        }
                    }
                    xmlhttp.open("POST","logic.php?page=qtyupd",true);
                    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                    xmlhttp.send("id="+str+"&qty="+a);
                    a=null,b=null,str=null;
                }

      function qtyupdm1(str)
                {
                   var a=document.getElementById("qty"+str).value;
                   if(a<1 || a>5)
                   {
                       exit();
                   }
                   else
                   {
                       document.getElementById("qty"+str).value=a-0.5;
                   }
                   a=document.getElementById("qty"+str).value;
                   var b=document.getElementById("mr"+str).innerHTML;
                   document.getElementById("sub"+str).innerHTML=a*parseInt(b);
                   var xmlhttp=new XMLHttpRequest();
                   xmlhttp.onreadystatechange = function ()
                    {
                        if (xmlhttp.readyState == 4 && xmlhttp.status == 200)
                        {
                            document.getElementById("tot").innerHTML=xmlhttp.responseText;
                        }
                    }
                    xmlhttp.open("POST","logic.php?page=qtyupd",true);
                    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                    xmlhttp.send("id="+str+"&qty="+a);
                    a=null,b=null,str=null;
                }

              
                     function qtyupdp1(str)
                    {
                        var a = document.getElementById("qty" + str).value;
                        if (a == 5)
                        {
                            exit();
                        }
                        else
                        {
                            document.getElementById("qty" + str).value = (+a + 0.5);
                        }
                        a = document.getElementById("qty" + str).value;
                        var b = document.getElementById("mr" + str).innerHTML;
                        document.getElementById("sub" + str).innerHTML = a * parseInt(b);
                        var xmlhttp = new XMLHttpRequest();
                        xmlhttp.onreadystatechange = function ()
                        {
                            if (xmlhttp.readyState == 4 && xmlhttp.status == 200)
                            {
                                document.getElementById("tot").innerHTML = xmlhttp.responseText;
                            }
                        }
                        xmlhttp.open("POST", "logic.php?page=qtyupd", true);
                        xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                        xmlhttp.send("id=" + str + "&qty=" + a);
                        a = null, b = null, str = null;
                    }
                    function qtyupdp(str)
                    {
                        var a = document.getElementById("qty" + str).value;
                        if (a == 20)
                        {
                            exit();
                        }
                        else
                        {
                            document.getElementById("qty" + str).value = (+a + 1);
                        }
                        a = document.getElementById("qty" + str).value;
                        var b = document.getElementById("mr" + str).innerHTML;
                        document.getElementById("sub" + str).innerHTML = a * parseInt(b);
                        var xmlhttp = new XMLHttpRequest();
                        xmlhttp.onreadystatechange = function ()
                        {
                            if (xmlhttp.readyState == 4 && xmlhttp.status == 200)
                            {
                                document.getElementById("tot").innerHTML = xmlhttp.responseText;
                            }
                        }
                        xmlhttp.open("POST", "logic.php?page=qtyupd", true);
                        xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                        xmlhttp.send("id=" + str + "&qty=" + a);
                        a = null, b = null, str = null;
                    }



                </script>
            </main>
    <?php
    include './footer.php';
    ?>
        </body>
    </html>
    <?php
}
?>