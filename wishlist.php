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
            <script>
                function qtyupdm(str)
                {
                    var a = document.getElementById("qty" + str).value;
                    if (a < 1 || a > 5)
                    {
                        exit();
                    } else
                    {
                        document.getElementById("qty" + str).value = a - 0.5;
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
                    if (a == 5)
                    {
                        exit();
                    } else
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

            </script>
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
            <style type="text/css">
                #section-margin {
                    padding-top: 7rem;
                    padding-bottom: 7rem;
                }
                .page-heading {
                    font-size: 4rem;
                    font-family: 'Sansita', sans-serif;
                    -webkit-font-smoothing: antialiased;
                    color: #fff;
                    display: block;
                    padding-top: 13rem;
                    text-shadow: 0px 5px 15px rgba(0,0,0,0.5);
                }
                .heading-divider-big {
                    font-size: 4rem;
                    font-family:'Product Sans', Arial, sans-serif;
                    -webkit-font-smoothing: antialiased;
                    display: block;
                    color: #fff;
                    margin-top: -3rem;
                    text-shadow: 0px 5px 15px rgba(0,0,0,0.5);
                    padding-bottom: 13rem;
                }
                .heading-divider-big span{
                    color: #DC143C;
                }
                .heading-divider-small {
                    font-size: 4rem;
                    font-family:'Product Sans', Arial, sans-serif;
                    -webkit-font-smoothing: antialiased;
                    display: block;
                    color: #fff;
                    margin-top: -3rem;
                    text-shadow: 0px 5px 15px rgba(0,0,0,0.5);
                    padding-bottom: 13rem;
                }
                .heading-divider-small span{
                    color: #DC143C;
                }
                .heading {
                    font-size: 4rem;
                    font-family: 'Sansita', sans-serif;
                    -webkit-font-smoothing: antialiased;
                    color: #616161;
                    display: block;
                }
                .opacity-section {
                    width: 100%;
                    height: 100%;
                    background-color: rgba(0,0,0,0.4);
                }

                /*<-------------------------------------- Product display CSS -------------------------------------->*/

                .product-detail-css {
                    font-family: 'Josefin Sans', sans-serif;
                    -webkit-font-smoothing: antialiased;
                    font-weight: 400;
                    color: #515151;
                    font-size: 20px;
                }
                .product-detail-css span {
                    color: #DC143C;
                }
                .product-detail-css a {
                    letter-spacing: 3px ;
                    color: #515151;
                }
                .product-name-css:hover {
                    color: #DC143C;
                }


                .product-fotter-button-css {
                    border:1px solid #616161;
                    color: #616161;
                    background-color: transparent;
                    padding: 10px 14px;
                    border-radius: 50px;
                }
                .product-fotter-button-css:hover {
                    border:1px solid #DC143C;
                    color: #fff;
                    background-color: #DC143C;

                }
                .end {
                    font-size: 40px;
                    color: #616161;
                    font-family: 'Sansita', sans-serif;
                    -webkit-font-smoothing: antialiased;
                }
                hr {
                    border: 0.9px solid #A9A9A9;
                }

            </style>
            <style>
                #section-margin {
                    padding-top: 5rem;
                    padding-bottom: 7rem;
                }
                body {
                    display: flex;
                    min-height: 100vh;
                    flex-direction: column;
                }
                main {
                    flex: 1 0 auto;
                }


                .product-name {
                    display: block;
                    font-size: 30px;
                    font-family: 'Lato', sans-serif;
                    -webkit-font-smoothing: antialiased;
                    font-weight: 300;
                    color: #515151;
                    letter-spacing: 3px;
                    padding-bottom: 10px;
                }
                .divide {
                    color: #DC143C;
                    font-size: 20px;
                    font-family: 'Lato', sans-serif;
                    -webkit-font-smoothing: antialiased;
                    font-weight: 400;
                }
                .bts {
                    display: block;
                    font-size: 14px;
                    font-family: 'Lato', sans-serif;
                    -webkit-font-smoothing: antialiased;
                    font-weight: 400;
                    color: #DC143C;
                    letter-spacing: 1px;
                    padding-top: 20px;
                    padding-bottom: 15px;
                    background-color: transparent;
                    border: 0px solid #000000;
                }
                .bts:hover {
                    color: #515151;
                }
                .product-price {
                    font-size: 18px;
                    font-family: 'Lato', sans-serif;
                    -webkit-font-smoothing: antialiased;
                    color: #515151;
                    padding-top: 10px;
                }
                .product-quantiy {
                    display: block;
                    font-size: 20px;
                    font-family: 'Lato', sans-serif;
                    -webkit-font-smoothing: antialiased;
                    color: #515151;
                    padding-top: 10px;
                }
                .quantity-unit {
                    display: block;
                    font-size: 18px;
                    font-family: 'Lato', sans-serif;
                    -webkit-font-smoothing: antialiased;
                    color: #515151;
                    margin-top: 13px;   
                }
                .row-margin {
                    padding-top: 2rem;
                    padding-bottom: 2rem;
                }
                .button-row-margin {
                    padding-top: 4rem;
                    padding-bottom: 4rem;
                }
                .feature-heading {
                    display: block;
                    color: #808080;
                    font-size: 15px;
                    font-weight: 700;
                    letter-spacing: 1px;
                    font-family: 'Lato', sans-serif;
                    -webkit-font-smoothing: antialiased;
                    padding-top: 10px;
                    padding-bottom: 10px;

                }
                .feature-content {
                    color: #616161;
                    font-size: 15px;
                    font-weight: 700;
                    letter-spacing: 1px;
                    font-family: 'Lato', sans-serif;
                    -webkit-font-smoothing: antialiased;
                    padding-top: 20px;
                }
                .pas {
                    font-size: 40px;
                    font-family: 'Sansita', sans-serif;
                    -webkit-font-smoothing: antialiased;
                    color: #616161;
                    display: block;
                }

                /*<-------------------------------------- Product Store -------------------------------------->*/

                .product-detail-css {
                    font-family: 'Josefin Sans', sans-serif;
                    -webkit-font-smoothing: antialiased;
                    font-weight: 400;
                    color: #515151;
                    font-size: 20px;
                }
                .product-detail-css span {
                    color: #DC143C;
                }
                .product-detail-css a {
                    letter-spacing: 3px ;
                    color: #515151;
                }
                .product-name-css:hover {
                    color: #DC143C;
                }

                /*<-------------------------------------- Input tag CSS -------------------------------------->*/

                input[type=num] 
                {
                    width: 60px;
                    padding: 5px 20px;
                    margin: 13px 0;
                    box-sizing: border-box;
                    border:1px solid #A9A9A9;
                    border-radius:5px;
                    font-family: 'Lato', sans-serif;
                    -webkit-font-smoothing: antialiased;
                    color: #515151;
                }
                input[type=num]:focus
                {
                    outline: none;
                }
                .input
                {
                    width: 100%;
                    padding: 12px 20px;
                    margin: 18px 0;
                    box-sizing: border-box;
                    border:1px solid #A9A9A9;
                    border-radius:5px;
                }
                .input:focus
                {
                    outline: none;
                }

                hr {
                    border: 0.6px solid #808080;
                }

                /*<-------------------------------------- Buttons -------------------------------------->*/

                .counter-button {
                    box-sizing: border-box;
                    border:1px solid #A9A9A9;
                    padding: 6px 15px;
                    background-color: transparent;
                    border-radius: 5px;
                    color: #808080;
                }
                .counter-button:hover {
                    border-color: #DC143C;
                    color: #DC143C;
                }
                .buy-add-to-cart-button {
                    width: 100%;
                    height: 50px;
                    border: 1px solid #515151;          
                    border-radius: 4px;
                    background-color: transparent;
                    font-family: 'Lato', sans-serif;
                    -webkit-font-smoothing: antialiased;
                    letter-spacing: 2px;
                }
                .buy-add-to-cart-button:hover {
                    color:#fff;
                    background-color: #515151;
                }
                .quantiy-button {
                    display: inline-block;
                    color: #515151;
                    border: 1px solid #515151; 
                    padding: 5px 10px;
                    margin-top: 10px;
                    border-radius: 50px;
                    background-color: transparent;
                }
                .product-fotter-button-css {
                    border:1px solid #616161;
                    color: #616161;
                    background-color: transparent;
                    padding: 10px 14px;
                    border-radius: 50px;
                }
                .product-fotter-button-css:hover {
                    border:1px solid #DC143C;
                    color: #fff;
                    background-color: #DC143C;
                }
                .quantiy-button:hover {
                    color: #fff;
                    border: 1px solid #DC143C;
                    background-color: #DC143C;
                }

            </style>

            <meta charset="UTF-8">
            <title></title>
        </head>
        <body>

            <?php
            include './Navbar.php';

            $res = mysqli_query($con, "SELECT w.*,p.*,u.* FROM `wishlist_details` w JOIN `product_details` p on p.prd_id = w.prd_id JOIN `user_details` u on u.ud_id = w.ud_id where w.ud_id = $ud_id");
            ?>
            <h1 class="center" style="font-size: 50px;">My Wishlist</h1>
            <main>
                <div class="row">
                    <?php
                    while ($row = mysqli_fetch_array($res)) {
                        ?>
                        <div class='col s12 m6 l3' id="wlprd<?php echo $row["prd_id"] ?>" style='/*width:247px;*/'>
                            <div class='card sticky-action small hoverable' style='/*width:230px; height:300px;*/'>
                                <div class='card-image waves-effect waves-light'>
                                    <img height='205px'  class='activator' src='./Admin_Panel/<?php echo $row["prd_image"] ?>'>
                                    <span class='card-title red-text'></span>
                                </div>
                                <div class="card-content">
                                    <center><span class="product-detail-css">&#8377; <?php echo $row["prd_mrp"] ?> &nbsp;&nbsp;<span>|</span>&nbsp;&nbsp; <a class="product-name-css" href='./Product.php?id=<?php echo $row["prd_id"] ?>'><?php echo $row["prd_name"] ?></a></span></center>
                                </div>
<!--                                <div class="col s12 m3 l3" id="row-margin">
                                    <span class="product-quantiy">Quantity : </span>
                                </div>
                                <div class="col s3 m2 l2" id="row-margin">
                                    <button class="quantiy-button" onclick="qtyupdm(<?php echo $row["prd_id"]; ?>)"><i class="fa fa-minus" aria-hidden="true"></i></button>
                                </div>
                                <div class="col s3 m2 l2" id="row-margin">
                                    <input id="qty<?php echo $row["prd_id"] ?>" type="text" class="disabled validate" disabled="disabled" value="0.5" style="color: #000">  <label for="qty" class="red-text"></label>
                                </div>
                                <div class="col s2 m2 l2" id="row-margin">
                                    <span class="quantity-unit">/ kg</span>
                                </div>
                                <div class="col s4 m3 l3" id="row-margin">
                                    <button class="quantiy-button" onclick="qtyupdp(<?php echo $row["prd_id"]; ?>)"><i class="fa fa-plus" aria-hidden="true"></i></button>
                                </div>-->
                                <!--                                <div class="col s2 m2 l2">
                                                                    <a class="waves-effect waves-teal btn-floating waves-light disabled" style="margin-left: -15px;" id="rem<?php echo $row["prd_id"] ?>"><i class="material-icons">remove</i></a>
                                                                </div>-->
                                <!--                                <div class="input-field col s2 m2 l2" style="width: 119px;margin-top: 0px;margin-left: -15px;">
                                                                    <input placeholder="Quantity" disabled="disabled" id="qty<?php echo $row["prd_id"] ?>" type="text" class="validate red-text center" value="500 GM">
                                                                    <label for="qty" class="red-text center" style="margin-left: -11px;">Quantity</label>
                                                                </div>-->
                                <!--                                <div class="col s2 m2 l2" style="margin-left: -10px;">
                                                                    <a class="waves-effect waves-teal btn-floating waves-light" id="add<?php echo $row["prd_id"] ?>" onclick="setval(this)"><i class="material-icons">add</i></a>
                                                                </div>-->
                                <!--                                <div class="col s2 m2 l2" style="margin-left: -2px;">
                                                                    <button value='<?php echo $row["prd_name"] ?>' id='<?php echo $row["prd_id"] ?>' onclick="add_wl(this)" class='btn-floating btn-small waves-light red' type='submit'><i class='tiny material-icons' style="margin-right: -11px;margin-top: 2px">favorite border</i></button>
                                                                </div>-->
                                <!--                                <div class="col s2 m2 l2" style="margin-left: -2px;">
                                                                    <button value='<?php echo $row["prd_name"] ?>' id='<?php echo $row["prd_id"] ?>' onclick="add_cart_wl(this)" class='btn-floating btn-small waves-light red' type='submit'><i class='tiny material-icons'>shopping_cart</i></button>
                                                                </div>-->
                            </div>
<!--                            <div class="card-action" style="padding: 25px;">
                                <center><span style="color: #515151"> <button class="product-fotter-button-css" value='<?php echo $row["prd_name"] ?>' id='<?php echo $row["prd_id"] ?>' onclick="add_wl(this)" type='submit'><i class="fa fa-heart" aria-hidden="true"></i></button> &nbsp;&nbsp;&nbsp;&nbsp;<span>|</span>&nbsp;&nbsp;&nbsp;&nbsp; <button class="product-fotter-button-css" value='<?php echo $row["prd_name"] ?>' id='<?php echo $row["prd_id"] ?>' onclick="add_cart(this)" type='submit'><i class="fa fa-shopping-bag" aria-hidden="true"></i></button></span></center>
                            </div>-->
                        </div>
                    </div>
                    <?php
                }
                ?>
            </div>
        </main>
        <?php
        include './footer.php';
        ?>
    </body>
    </html>
    <?php
}
?>
