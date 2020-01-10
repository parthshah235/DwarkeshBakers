<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Dwarkesh Bakers | Home Page</title>
        <script type="text/javascript" src="./js/materialize.js"></script>
        <script type="text/javascript" src="./js/materialize.min.js"></script>
        <link rel="stylesheet" href="./css/materialize.min.css">
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1, maximum-scale=1, minimum-scale=1" />

        <!--/*****************************------------------  Fonts  ------------------*****************************/-->

        <link href="https://fonts.googleapis.com/css?family=Josefin+Sans:300,400" rel="stylesheet">
        <link href='https://fonts.googleapis.com/css?family=Product+Sans:400,700' rel='stylesheet' type='text/css'>
        <link href="https://fonts.googleapis.com/css?family=Pacifico" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Assistant:300,400,600&amp;subset=hebrew" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Sansita:400,400i" rel="stylesheet">


        <style>

            #section-margin {
                padding-top: 7rem;
                padding-bottom: 7rem;
            }
            .heading {
                font-size: 3rem;
                font-family: 'Sansita', sans-serif;
                -webkit-font-smoothing: antialiased;
                color: #616161;
                display: block;
            }
            .heading-divider {
                font-size: 4rem;
                font-family:'Product Sans', Arial, sans-serif;
                -webkit-font-smoothing: antialiased;
                display: block;
                color: #888B8D;
                margin-top: -1.5rem;
            }
            .heading-divider span{
                color: #DC143C;
            }
            .tagline {
                font-size: 1.5rem;
                color:#888B8D;
                font-family: 'Product Sans', Arial, sans-serif;
                -webkit-font-smoothing: antialiased;
                font-weight: 300;
                margin-left: 15%;
                margin-right: 15%;
                padding-bottom: 5rem;
            }
            .products {
                margin: 40px;
                border-radius:5px;
                height:300px;
            }

            .product-span {
                font-size:1.8rem;
                font-family: 'Josefin Sans', sans-serif;
                -webkit-font-smoothing: antialiased;
                font-weight: 400;
                letter-spacing: 5px;
                display: block;
                color: #515151;
                padding-top: 2.5rem;
                -webkit-filter: grayscale(100%); /* Safari 6.0 - 9.0 */
                filter: grayscale(100%);
            }
            .product-span:hover {
                color: #DC143C;
                -webkit-filter: grayscale(0%); /* Safari 6.0 - 9.0 */
                filter: grayscale(0%);
            }
            .news-letter-input {
                color: #DC143C;
            }
            .opacity-section-1 {
                width: 100%;
                height: 100%;
                background: rgba(0,0,0,0.7); /* For browsers that do not support gradients */        
                background: -webkit-linear-gradient(90deg, rgba(0,0,0,0.7), transparent); /* For Safari 5.1 to 6.0 */
                background: -o-linear-gradient(90deg, rgba(0,0,0,0.7), transparent); /* For Opera 11.1 to 12.0 */
                background: -moz-linear-gradient(90deg, rgba(0,0,0,0.7), transparent); /* For Firefox 3.6 to 15 */
                background: linear-gradient(90deg, rgba(0,0,0,0.7), transparent); /* Standard syntax (must be last) */
            }
            .opacity-section-2 {
                width: 100%;
                height: 100%;
                background: transparent; /* For browsers that do not support gradients */        
                background: -webkit-linear-gradient(90deg, transparent, rgba(0,0,0,0.7)); /* For Safari 5.1 to 6.0 */
                background: -o-linear-gradient(90deg, transparent, rgba(0,0,0,0.7)); /* For Opera 11.1 to 12.0 */
                background: -moz-linear-gradient(90deg, transparent, rgba(0,0,0,0.7)); /* For Firefox 3.6 to 15 */
                background: linear-gradient(90deg, transparent, rgba(0,0,0,0.7)); /* Standard syntax (must be last) */
            }
            .parallax-quotations {
                font-size: 55px;
                color: #515151;
                display: block;
                font-family: 'Tangerine', cursive;
                -webkit-font-smoothing: antialiased;
                text-shadow: 0px 5px 10px rgba(0,0,0,0.5);
            }
            .parallax-quotations-name {
                display: block;
                float: right;
            }
            .download-app-section-heading {
                font-family: 'Josefin Sans', sans-serif;
                -webkit-font-smoothing: antialiased;
                font-weight: 400;
                font-size: 1.8rem;
                letter-spacing: 2px;
                color: #DC143C;
                display: block;
                padding-bottom: 1rem;
                padding-left: 5rem;
                padding-right: 5rem;
            }
            .android-container-css {
                width: 100%;
                height: 100%;
                padding-top: 10rem;
                border-radius: 1.5rem; 
            } 
            input[type=find] 
            {
                width: 100%;
                padding: 12px 20px;
                margin: 18px 0;
                box-sizing: border-box;
                border:1px solid #A9A9A9;
                border-radius:5px;
                color: #DC143C;
                font-family: 'Josefin Sans', sans-serif;
                -webkit-font-smoothing: antialiased;
                font-weight: 400;
            }
            input[type=find]:focus
            {
                outline: none;
                border: 1px solid #DC143C;
            }
            .input
            {
                width: 100%;
                padding: 12px 20px;
                margin: 18px 0;
                box-sizing: border-box;
                border:1px solid #A9A9A9;
                border-radius:5px
            }
            .input:focus
            {
                outline: none;
            }
            input::-webkit-input-placeholder { /* Chrome/Opera/Safari */
                color: #A9A9A9;
            }
            .select-css {
                color: #DC143C;
            }
            .search-col {
                height: 100%;
                padding: 50px;
                border: 1px solid #000000;
                vertical-align: middle;
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

            /*<!--****************************------------------  Buttons  ------------------****************************-->*/


            #news-letter-button {
                font-size: 1rem;
                letter-spacing: 2px;
                color: #DC143C;
                font-family:'Product Sans', Arial, sans-serif;
                -webkit-font-smoothing: antialiased;
                font-weight: 300;
                border: 1px solid #DC143C;
                background-color: transparent;
                padding: 15px 50px;
                border-radius: 5px;
            }
            #news-letter-button:hover {
                color: #ffffff;
                background-color: #DC143C;
            }

            #search-button {
                font-size: 1rem;
                letter-spacing: 2px;
                color: #DC143C;
                font-family:'Product Sans', Arial, sans-serif;
                -webkit-font-smoothing: antialiased;
                font-weight: 300;
                border: 1px solid #DC143C;
                background-color: transparent;
                padding: 12px 30px;
                border-radius: 5px;
            }
            #search-button:hover {
                color: #ffffff;
                background-color: #DC143C;
            }
            .customize-cake-button-css {
                display: inline-block;
                width: 200px;
                border: 1px solid #515151;
                color: #515151;
                font-family:'Product Sans', Arial, sans-serif;
                -webkit-font-smoothing: antialiased;
                padding: 15px 20px;
                border-radius: 5px;
                letter-spacing: 1px;
                background-color: transparent;
            }
            .customize-cake-button-css:hover {
                color: #fff;
                background-color: #515151;
            }

        </style>
    </head>
    <body>

        <!--****************************------------------  Header  ------------------****************************-->

        <?php include './connection.php'; ?>
        <?php include './Navbar.php'; $res = mysqli_query($con, "select * from product_details where Cat_id=1"); ?>
        <?php include './js/common.php'?>

        <!--****************************------------------  Parallax 1  ------------------****************************-->

        <div class="parallax-container">
            <div class="parallax"><img src="Images/Image10.jpg" style="z-index: -1"></div>
            <div class="parallax-quotations" style="padding-left: 5%;padding-right: 65%;padding-top: 10%">
                <span>" All the world is birthday <span style="color:#DC143C">cake</span>, so take a piece, but not too much. "</span><br>
                <span class="parallax-quotations-name"></span>
            </div>
        </div> 

        <!--****************************------------------  Products  ------------------****************************-->


        <div class="section white " id="section-margin">
            <div class="row container">
                <center>
                    <span class="heading">Product Categories</span>
                    <span class="heading-divider"><b>. <span>.</span> .</b></span>
                    <p class="tagline">Select from our wide range of bakery products delivered fresh at your doorstep directly from our bakery.</p>
                </center>
            </div>            
            <div class="row">
                <div class="col s12 m6 l3 product-span">
                    <center>
                        <a href='Pastry_Store.php'><img src="./Images/pastry.svg" width="50%" height="50%"></a>
                        <p>Pastries</p>
                    </center>
                </div>
                <div class="col s12 m6 l3 product-span">
                    <center>
                        <a href='Cake_Store.php'><img src="./Images/cake.svg" width="50%" height="50%"></a>
                        <p>Cakes</p>
                    </center>
                </div>
                <div class="col s12 m6 l3 product-span">
                    <center><a href='Cookie_Store.php'><img src="./Images/Chocolate chip Cookies.svg" width="50%" height="50%"></a></center>
                    <center><p>Cookies</p></center>
                </div>
                <div class="col s12 m6 l3 product-span">
                    <center><a href='Bread_Store.php'><img src="./Images/bread.svg" width="50%" height="50%"></a></center>
                    <center><p>Breads</p></center>
                </div> 
                
            </div>
        </div>

        <!--****************************------------------  Parallax 2  ------------------****************************-->

        <div class="parallax-container">
            <div class="parallax"><img src="Images/Image11.jpg" width="100%"></div>
            <div class="parallax-quotations" style="z-index: -1;padding-left: 60%;padding-right: 5%;padding-top: 11%;text-align: right">
                <span style="color:#fff">" Chocolate chips were developed specifically for use in the <span style="color:#DC143C">cookies.</span> "</span><br>
                <span class="parallax-quotations-name" style="color: #fff">-Fact</span>
            </div>
        </div>

        <!--****************************------------------  Customize Cakes  ------------------****************************-->

        <div class="section white" id="section-margin">
            <div class="row container">
                <center>
                    <span class="heading">Customize Cakes</span>
                    <span class="heading-divider"><b>. <span>.</span> .</b></span>
                    <p class="tagline">Give a personalize touch to your cake or select some ready customize cakes from our store.</p>
                </center>
            </div>
            <div class="row container" style="padding-bottom: 80px;">
                <div class="col s12 m12 l12">
                    <center><a href="#" class="customize-cake-button-css">Visit Store</a> <span style="color: #DC143C">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; | &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><a href="#" class="customize-cake-button-css">Customize Cake</a></center>
                </div>
            </div>
            <div class="row">
                <?php while ($row = mysqli_fetch_array($res)) {?> 
                        <div class="col s12 m6 l4">
                            <div class="card">
                                <div class="card-image" style="border-radius: 10px">
                                    <a href='./Product.php?id=<?php echo $row["prd_id"] ?>'><center><img class='activator' width="400px" height="400px" src='./Admin_Panel/<?php echo $row["prd_image"] ?>'></center></a>
                                </div>
                                <div class="card-content">
                                    <center><span class="product-detail-css">&#8377; <?php echo $row["prd_mrp"] ?> &nbsp;&nbsp;<span>|</span>&nbsp;&nbsp; <a class="product-name-css" href='./Product.php?id=<?php echo $row["prd_id"] ?>'><?php echo $row["prd_name"] ?></a></span></center>
                                </div>
                                <div class="card-action" style="padding: 25px;">
                                    <center><span style="color: #515151"> <button class="product-fotter-button-css" value='<?php echo $row["prd_name"] ?>' id='<?php echo $row["prd_id"] ?>' onclick="add_wl(this)" type='submit'><i class="fa fa-heart" aria-hidden="true"></i></button> &nbsp;&nbsp;&nbsp;&nbsp;<span>|</span>&nbsp;&nbsp;&nbsp;&nbsp; <button class="product-fotter-button-css" value='<?php echo $row["prd_name"] ?>' id='<?php echo $row["prd_id"] ?>' onclick="add_cart(this)" type='submit'><i class="fa fa-shopping-bag" aria-hidden="true"></i></button></span></center>
                                </div>
                            </div>
                        </div>
                <?php }?>
            </div>
        </div>

        <!--****************************------------------  Parallax 3  ------------------****************************-->

        <div class="parallax-container">
            <div class="parallax"><img src="Images/Image03.jpg"></div>
            <div class="opacity-section-1">
                <div class="parallax-quotations" style="padding-left: 5%;padding-right: 60%;padding-top: 5%">
                    <span style="color:#fff">" <span style="color:#DC143C"><b>Pastries</b></span> were first brought to Europe during the Muslim invasion"</span><br>
                    <span class="parallax-quotations-name" style="color: #fff">-Fact</span>
                </div>
            </div>
        </div>

        <!--****************************------------------  Android Available  ------------------****************************-->

<!--        <div class="section" id="section-margin" style="background-color: #fff;">
            <div class="row">
                <div class="col s12 m6 l6" style="padding-left:300px">
                    <img src="./Images/Android.png" width="90%">
                </div>
                <div class="col s12 m6 l6" style="  padding:3rem">
                    <div class="contianer android-container-css">
                        <div style="float: left;">
                            <center>
                                <p class="download-app-section-heading">Download and order on our app.</p><br>
                                <a href="#"><img src="Images/Android app on google play.png" width="50%"></a>
                            </center>
                        </div>
                    </div>
                </div>
            </div>
        </div>      -->

        <!--****************************------------------  Parallax 4  ------------------****************************-->

<!--        <div class="parallax-container">
            <div class="parallax"><img src="Images/Image12.jpg"></div>
            <div class="parallax-quotations" style="padding-left: 5%;padding-right: 60%;padding-top: 7%;">
                <span style="color:#616161">" <span style="color:#DC143C"><b>Cake</b></span> symbolises the importance of the person you bought it for."</span><br>
                <span class="parallax-quotations-name" style="color:#616161">-Fact</span>
            </div>
        </div>-->

        <!--****************************------------------  Stay in touch  ------------------****************************-->

<!--        <div class="section" id="section-margin">
            <center>
                <span class="heading">Stay in touch</span>
                <span class="heading-divider"><b>. <span>.</span> .</b></span>
                <p class="tagline">In Future you can join our email list to get every updates and offers straight to your inbox.</p>
            </center>
            <form>
                <div class="row container" style="width: 100%;padding-left: 20rem;padding-right: 15rem">
                    <div class="input-field col s12 m6 l6">
                        <input id="email" type="email" class="validate news-letter-input" placeholder="Enter your Email Id to subscribe to our Newsletter">
                        <label for="email" data-error="wrong" data-success="right">Email</label>
                    </div>
                    <div class="input-field col s12 m6 l6">
                        <center><input type="button" id="news-letter-button" value="submit" name="news-letter-button"></center>
                    </div>
                </div>
            </form>
        </div>-->

        <!--****************************------------------  Parallax 5  ------------------****************************-->

<!--        <div class="parallax-container">
            <div class="parallax"><img src="Images/Image13.jpg" width="100%"></div>
            <div class="opacity-section-2">
                <div class="parallax-quotations" style="padding-left: 60%;padding-right: 5%;padding-top: 10%;text-align: right">
                    <span style="color:#fff">" Good <span style="color:#DC143C"><b>cakes</b></span> isn't cheap, Cheap <span style="color:#DC143C"><b>cakes</b></span> isn't good. "</span><br>
                    <span class="parallax-quotations-name" style="color:#fff">-Quote</span>
                </div>
            </div>
        </div>-->


        <!--****************************------------------  Footer  ------------------****************************-->

        <br><br><br><br><br><br><br>
        <?php //include 'Footer.php'; ?>

        <!--****************************------------------  Scripts  ------------------****************************-->
<!--        <div class="fixed-action-btn">
            <a class="btn-floating btn-large red">
                <i class="material-icons left">shopping_cart</i>
            </a>-->
<!--            <ul>
                <li><a class="btn-floating red"><i class="material-icons">insert_chart</i></a></li>
                <li><a class="btn-floating yellow darken-1"><i class="material-icons">format_quote</i></a></li>
                <li><a class="btn-floating green"><i class="material-icons">publish</i></a></li>
                <li><a class="btn-floating blue"><i class="material-icons">attach_file</i></a></li>
            </ul>-->
        <!--</div>-->

        <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.3/js/materialize.min.js"></script>
        <script type="text/javascript">
            $(document).ready(function () {
                $('.parallax').parallax();
            });

            $(document).ready(function () {
                $('select').material_select();
            });

            $('.fixed-action-btn').openFAB();
            $('.fixed-action-btn').closeFAB();
            $('.fixed-action-btn.toolbar').openToolbar();
            $('.fixed-action-btn.toolbar').closeToolbar();
        </script>

    </body>
</html>
