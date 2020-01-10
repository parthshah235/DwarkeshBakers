<?php
if (!isset($_GET['id'])) {
//    header("Location: ./Home_Page.php");
} else {
    $id = $_GET['id'];
    include './connection.php';  
?>
<!DOCTYPE html>
<html>
    
        <head>
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
            <!--<link rel="stylesheet" href="./css/materialize.css" />-->
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">        
        </head>
        <body>
            <?php include './Navbar.php'; ?>
            <?php include './js/common.php'?>
            <main>
            <br/>
            <?php
            $qry4 = mysqli_query($con, "select * from product_details where `prd_id`=$id");

            if (mysqli_affected_rows($con) > 0) {
                while ($row = mysqli_fetch_array($qry4)) {
                    ?>

            <div class="section" id="section-margin">
                <div class="row">
                        <div class="col s12 m5 l5 offset-l1 offset-m1">
                            <center><img height="400px" width="400px" src='./Admin_Panel/<?php echo $row["prd_image"] ?>' class=" responsive-img materialboxed" data-caption="<?php echo$row["prd_name"]; ?>" /></center>
                        </div>
                    <div class="col s12 m5 l5 offset-l1 offset-m1 pull-l1 pull-m1" style="padding-right: 100px">
                            <div class="row">
                                <div class="col s12 m12 l12">
                                    <span class="product-name" ><?php echo $row['prd_name']; ?> <span class="divide"> &nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp; </span> <span class="product-price"><strong><span>&#8377;</span><?php echo $row['prd_mrp']; ?>/- INR</strong></span></span>
                                </div>
                                <div class="col s12 m12 l12">
                                    <hr>
                                </div>
                                <div class="col s12 m12 l12">
                                    <button class="bts"><i class="fa fa-angle-double-left"  onclick="my_backfunction()"></i> BACK TO STORE</button>
                                </div>
                                <div class="col s12 m3 l3" id="row-margin">
                                    <span class="product-quantiy">Quantity : </span>
                                </div>
                                <div class="col s3 m2 l2" id="row-margin">
                                    <button class="quantiy-button" onclick="qtyupdm(<?php echo $row["prd_id"]; ?>)"><i class="fa fa-minus" aria-hidden="true"></i></button>
                                </div>
                                <div class="col s3 m2 l2" id="row-margin">
                                    <input id="qty<?php echo $row["prd_id"] ?>" type="number" class="disabled validate" disabled="disabled" value="0.5" style="color: #000">  <label for="qty" class="red-text"></label>
                                </div>
                                <div class="col s2 m2 l2" id="row-margin">
                                    <span class="quantity-unit">/ kg</span>
                                </div>
                                <div class="col s4 m3 l3" id="row-margin">
                                    <button class="quantiy-button" onclick="qtyupdp(<?php echo $row["prd_id"]; ?>)"><i class="fa fa-plus" aria-hidden="true"></i></button>
                                </div>
                                <div class="col s12 m6 l6" id="" style="margin-top: 15px;margin-bottom: 30px;">
                                    <button class="buy-add-to-cart-button" value='<?php echo $row["prd_name"] ?>' id='<?php echo $row["prd_id"] ?>' onclick="add_wl(this)"><i class="fa fa-heart" aria-hidden="true"></i> &nbsp;&nbsp;Add to Wishlist</button>
                                </div>
                                <div class="col s12 m6 l6" id="" style="margin-top: 15px;margin-bottom: 30px;">
                                    <button class="buy-add-to-cart-button" value='<?php echo $row["prd_name"] ?>' id='<?php echo $row["prd_id"] ?>' onclick="add_cart(this)"><i class="fa fa-shopping-bag" aria-hidden="true"></i> &nbsp;&nbsp;Add to Cart</button>
                                </div>
                                
                                <div class="col s12 m12 l12">
                                    <hr>
                                </div>
                                <div class="col s12 m12 l12">
                                    <span class="feature-heading">FEATURES</span>
                                </div>
                                <div class="col s12 m12 l12">
                                    <hr>
                                </div>
                                <div class="col s12 m12 l12">
                                    <span class="feature-content"><?php echo $row['prd_about']; ?></span>
                                </div>
                            </div>
                            
<!--                            <div class="row">
                              <div class="col s2 m2 l2">
                                <a class="waves-effect waves-teal btn-floating waves-light" onclick="qtyupdm(<?php echo $row["prd_id"]; ?>)"><i class="material-icons">remove</i></a>
                            </div>
                            <div class="input-field col s2 m2 l2" style="width: 45px;margin-top: 0px;margin-left: -15px;">
                                <input placeholder="Quantity" id="qty<?php echo $row["prd_id"] ?>" type="text" class="disabled validate red-text" disabled="disabled" value="1">
                                <label for="qty" class="red-text">Quantity</label>
                            </div>
                            <div class="col s2 m2 l2 red-text" style="width:30px;margin-top: 9px;">
                                /kg
                            </div>
                            <div class="col s2 m2 l2" style="margin-left: -7px;">
                                <a class="waves-effect waves-teal btn-floating waves-light" onclick="qtyupdp(<?php echo $row["prd_id"]; ?>)"><i class="material-icons">add</i></a>
                            </div>
                            </div>
                            <div class="row">
                                <div class="col s6 m3 l3">
                                    <button value='<?php echo $row["prd_name"] ?>' id='<?php echo $row["prd_id"] ?>' style='/*margin-left:86px;/* margin-top:-53px;*/' onclick="add_wl(this)" class='btn-floating btn-small red' type='submit'><i class='tiny material-icons' style="margin-top: 2px;margin-right: -13px;">favorite border</i></button>
                                </div>
                                <div class="col s6 m3 l3">
                                    <button value='<?php echo $row["prd_name"] ?>' id='<?php echo $row["prd_id"] ?>' style='/*margin-left:131px;/* margin-top:-53px;*/' onclick="add_cart(this)" class='btn-floating btn-small red' type='submit'><i class='tiny material-icons'>shopping_cart</i></button>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <h5><b class="red-text left">About</b></h5>
                                    <br/>
                                    <span class="section left"><?php echo $row['prd_about']; ?></span>
                                </div>
                            </div>-->
                        </div>
                    </div>
            </div>
                    <?php
                }
            } 
            else {
               header("Location: ./Home.php");
            }
            ?>
            
            <br/>
            <div class="container">
                <hr/>
                <div class="row">
                    <div class="col s12 m12 l12 center">
                        <span class="pas"><b>People Also Search</b></span>
                    </div>
                </div>
                <hr/>
            </div>
            
            <div class="row" style="margin-top:100px">
                <?php
                $qry5 = mysqli_query($con, "select * from product_details where `prd_id`!=$id ORDER BY RAND() LIMIT 3");
                while ($row2 = mysqli_fetch_array($qry5)) {
                    ?>
                

                <div class="col s12 m6 l4" style="margin-top:50px">
                        
<!--                        <div class="parallax"><img class="heading-img-effect" src="Images/Image05.jpg" style="z-index: -1"></div>
                        <div class="Page-Heading-parallax">
                            <div class="opacity-section">
                                <center>
                                    <span class="page-heading">Cake Store</span>
                                    <span class="heading-divider-big"><b>. <span>.</span> .</b></span>
                                </center>
                            </div>
                        </div>-->
                        
                            <div class="card">
                                <div class="card-image">
                                    <center><img width="400px" height="400px" class="activator " src='./Admin_Panel/<?php echo $row2["prd_image"] ?>'</center>
                                </div>
                                <div class="card-content">
                                    <center><span class="product-detail-css">&#8377; <?php echo $row2["prd_mrp"] ?> &nbsp;&nbsp;<span>|</span>&nbsp;&nbsp; <a class="product-name-css" href='./Product.php?id=<?php echo $row2["prd_id"] ?>'><?php echo $row2["prd_name"] ?></a></span></center>
                                </div>
                                <div class="card-action" style="padding: 25px;">
                                    <center><span style="color: #515151"> <button class="product-fotter-button-css" value='<?php echo $row2["prd_name"] ?>' id='<?php echo $row2["prd_id"] ?>' onclick="add_wl(this)" type='submit'><i class="fa fa-heart" aria-hidden="true"></i></button> &nbsp;&nbsp;&nbsp;&nbsp;<span>|</span>&nbsp;&nbsp;&nbsp;&nbsp; <button class="product-fotter-button-css" value='<?php echo $row2["prd_name"] ?>' id='<?php echo $row2["prd_id"] ?>' onclick="add_cart(this)" type='submit'><i class="fa fa-shopping-bag" aria-hidden="true"></i></button></span></center>
                                </div>
                            </div>

                        
<!--                        <div class='card sticky-action small hoverable'>
                            <div class='card-image waves-effect waves-light'>
                                <img height='205px'  class='activator' src='./Admin_Panel/<?php echo $row2["prd_image"] ?>'>
                                <span class='card-title red-text'></span>
                            </div>
                            <div class='card-content' height='320px'>
                                <a href='./Product.php?id=<?php echo $row2["prd_id"] ?>'><?php echo $row2["prd_name"] ?></a>
                            </div>
                            <div class='card-action row' style='height:60px;'>
                                <div class="col s2 m2 l2 red-text" style="margin-left: -18px;width: 60px;margin-top: 9px;">
                                    &#8377; <?php echo $row2["prd_mrp"] ?>
                                </div>
                                <div class="col s2 m2 l2">
                                    <a class="waves-effect waves-teal btn-floating waves-light disabled" style="margin-left: -15px;" id="rem<?php echo $row2["prd_id"] ?>"><i class="material-icons">remove</i></a>
                                </div>
                                <div class="input-field col s2 m2 l2" style="width: 75px;margin-top: 0px;margin-left: -15px;">
                                    <input placeholder="Quantity" disabled="disabled" id="qty<?php echo $row2["prd_id"] ?>" type="text" class="validate red-text" value="1 kg">
                                    <label for="qty" class="red-text">Quantity</label>
                                </div>
                                <div class="col s2 m2 l2" style="margin-left: -20px;">
                                    <a class="waves-effect waves-teal btn-floating waves-light" id="add<?php echo $row2["prd_id"] ?>" onclick="setval(this)"><i class="material-icons">add</i></a>
                                </div>
                                <div class="col s2 m2 l2" style="margin-left: -1px;">
                                    <button value='<?php echo $row2["prd_name"] ?>' id='<?php echo $row2["prd_id"] ?>' onclick="add_wl(this)" class='btn-floating btn-small waves-light red' type='submit'><i class='tiny material-icons' style="margin-right: -11px;margin-top: 2px">favorite border</i></button>
                                </div>
                                <div class="col s2 m2 l2" style="margin-left: -1px;">
                                    <button value='<?php echo $row2["prd_name"] ?>' id='<?php echo $row2["prd_id"] ?>' onclick="add_cart(this)" class='btn-floating btn-small waves-light red' type='submit'><i class='tiny material-icons'>shopping_cart</i></button>
                                </div>
                            </div>
                            <div class="card-reveal">
                                <span class="card-title grey-text text-darken-4"><?php echo $row2["prd_name"] ?><i class="material-icons right">close</i></span>
                                <hr/>
                                <p><?php echo $row2["prd_name"] ?></p>
                            </div>
                        </div>-->
                    </div>
                    <?php
                }
                ?>
            </div>
            </main>
            
            <br><br><br><br><br><br><br><br><?php include './footer.php'; ?>
        
        <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.3/js/materialize.min.js"></script>
        <script type="text/javascript">
    $(document).ready(function(){
      $('.parallax').parallax();
    });
        </script>
        <script>
                function qtyupdm(str)
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
                function qtyupdp(str)
                {
                   var a=document.getElementById("qty"+str).value;
                   if(a==5)
                   {
                       exit();
                   }
                   else
                   {
                        document.getElementById("qty"+str).value=(+a+0.5);
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
                
            </script>
</body>
</html>
<?php
}

//include './js/common.php';
?>
