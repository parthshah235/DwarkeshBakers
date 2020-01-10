<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Dwarkesh Bakers | Bread Store</title><meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1, maximum-scale=1, minimum-scale=1" />
        <script type="text/javascript" src="./js/materialize.js"></script>
        <script type="text/javascript" src="./js/materialize.min.js"></script>
        <link rel="stylesheet" href="./css/materialize.min.css">

<!--/*****************************------------------  Fonts  ------------------*****************************/-->

        <link href="https://fonts.googleapis.com/css?family=Josefin+Sans:300,400" rel="stylesheet">
        <link href='https://fonts.googleapis.com/css?family=Product+Sans:400,700' rel='stylesheet' type='text/css'>
        <link href="https://fonts.googleapis.com/css?family=Pacifico" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Assistant:300,400,600&amp;subset=hebrew" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Sansita:400,400i" rel="stylesheet">
        
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
    </head>
    <body>
        
        <?php include './connection.php'; ?>
        <?php include './Navbar.php'; $res = mysqli_query($con, "select * from product_details where cat_id=21");
        ?>
        <?php include './js/common.php'?>
        
        <div class="parallax-container">
            <div class="parallax"><img class="heading-img-effect" src="Images/Image16.jpg" width="100%"></div>
            <div class="Page-Heading-parallax">
                <div class="opacity-section">
                    <center>
                        <span class="page-heading">Bread Store</span>
                        <span class="heading-divider-big"><b>. <span>.</span> .</b></span>
                    </center>
                </div>
            </div>
        </div> 
        
        <div class="section" id="section-margin">
            <div class="row">
                <?php while ($row = mysqli_fetch_array($res)) {?> 
                        <div class="col s12 m6 l4">
                            <div class="card">
                                <div class="card-image" style="border-radius: 10px">
                                    <a href='./product_1.php?id=<?php echo $row["prd_id"] ?>'><center><img class='activator' width="400px" height="400px" src='./Admin_Panel/<?php echo $row["prd_image"] ?>'></center></a>
                                </div>
                                <div class="card-content">
                                    <center><span class="product-detail-css">&#8377; <?php echo $row["prd_mrp"] ?> &nbsp;&nbsp;<span>|</span>&nbsp;&nbsp; <a class="product-name-css" href='./product.php?id=<?php echo $row["prd_id"] ?>'><?php echo $row["prd_name"] ?></a></span></center>
                                </div>
                                <div class="col s3 m2 l2" id="row-margin">
                                <button class="quantiy-button" hidden="" onclick="qtyupdm(<?php echo $row["prd_id"]; ?>)"><i class="fa fa-minus" aria-hidden="true"></i></button>
                            </div>
                            <div class="col s3 m2 l2" id="row-margin">
                                <input id="qty<?php echo $row["prd_id"] ?>" hidden="" type="number" class="disabled validate"  value="1" style="color: #000">  <label for="qty" class="red-text"></label>
                            </div>
                            <div class="col s2 m2 l2" id="row-margin">
                                <span class="quantity-unit"></span>
                            </div>
                            <div class="col s4 m3 l3" id="row-margin">
                                <button class="quantiy-button" hidden="" onclick="qtyupdp(<?php echo $row["prd_id"]; ?>)"><i class="fa fa-plus" aria-hidden="true"></i></button>
                            </div>
                                
                                <div class="card-action" style="padding: 25px;">
                                    <center><span style="color: #515151"> <button class="product-fotter-button-css" value='<?php echo $row["prd_name"] ?>' id='<?php echo $row["prd_id"] ?>' onclick="add_wl(this)" type='submit'><i class="fa fa-heart" aria-hidden="true"></i></button> &nbsp;&nbsp;&nbsp;&nbsp;<span>|</span>&nbsp;&nbsp;&nbsp;&nbsp; <button class="product-fotter-button-css" value='<?php echo $row["prd_name"] ?>' id='<?php echo $row["prd_id"] ?>' onclick="add_cart(this)" type='submit'><i class="fa fa-shopping-bag" aria-hidden="true"></i></button></span></center>
                                </div>
                            </div>
                        </div>
                <?php }?>
            </div>
            <div class="row center" style="padding-top: 100px;padding-left: 90px;padding-right: 90px">
                <div class="col s3 m4 l4" style="margin-top: 30px;border: 0px solid #000000;">
                    <hr>
                </div>
                <div class="col s6 m4 l4" style="border: 0px solid #000000;">
                    <span class="end">That's All Folks!</span>
                </div>
                <div class="col s3 m4 l4" style="margin-top: 30px;border: 0px solid #000000;">
                    <hr>
                </div>
            </div>
        </div>
    
        <?php include './Footer_Page.php'; ?>

        <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.3/js/materialize.min.js"></script>
        <script type="text/javascript">
    $(document).ready(function(){
      $('.parallax').parallax();
    });
        </script>
    </body>
</html>
