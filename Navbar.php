<?php
error_reporting(E_ERROR | E_PARSE);
session_start();
?>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title></title>
        <script type="text/javascript" src="./js/materialize.js"></script>
        <script type="text/javascript" src="./js/jquery-3.0.0.js"></script>
        <!--<link rel="stylesheet" href="./css/materialize.css" />-->
        <link rel="stylesheet" href="./css/materialize.min.css" />
        <!--<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">-->
        <link href="./iconfont/material-icons.css" rel="stylesheet">        
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        
        <!--/*****************************------------------  Fonts  ------------------*****************************/-->

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link href="https://fonts.googleapis.com/css?family=Josefin+Sans:300,400" rel="stylesheet">
        <link href='https://fonts.googleapis.com/css?family=Product+Sans:400,700' rel='stylesheet' type='text/css'>
        <link href="https://fonts.googleapis.com/css?family=Pacifico" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Assistant:300,400,600&amp;subset=hebrew" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Sansita:400,400i" rel="stylesheet">
        
        <script>

            function search(obj)
            {
                //alert("1")
                var a = obj.value;//alert(a);
                var opt = [];
                var pattern = new RegExp(/[~`!#$@%\^.&*+=\-\[\]\\';,/{}()|\\":<>\?]/); //unacceptable chars
                if (pattern.test(a) == true || a == "" || a == " " || a == null || a == "\s" || a == "/\S/")
                {
                    $("#result").hide();
                } else
                {
                    var jsonResponse = "<table width='480px;'>";
                    //alert(jsonResponse)
                    var xmlhttp = new XMLHttpRequest();
                    xmlhttp.open("GET", "./fSearch.php?page=search&value=" + a, true);
                    xmlhttp.onreadystatechange = function ()
                    {
                        if (xmlhttp.readyState == 4 && xmlhttp.status == 200)
                        {
                            var response = xmlhttp.responseText;//alert(response);
                            var myArr = JSON.parse(response);
                            for (var i = 0; i <= myArr.length - 1; i++)
                            {
                                //console.log(myArr[i].prd_name);


                                //opt.push(myArr[i].prd_name+"<br/>");
                                jsonResponse += "<tr><td valign='top' width='428px;'><a href='product.php?id=" + myArr[i].prd_id + "' style='color: black;font-size: 15px;'>" + myArr[i].prd_name + "</a></td><td width='52px' height=''><font style='float: right;font-size: 17px;color: red;'>&#8377;&nbsp;" + myArr[i].prd_mrp + "</font></td></tr>";
                                //jsonResponse += myArr[i] + "<br/>";
                                //alert(jsonResponse)

                            }
                        }
                        //$(".search-results").removeAttr("hidden");
                        if (response == 0)
                        {
//                            $("#search-head").slideUp();
//                            $("#search-result").slideUp();
//                            $("#search-head").attr("hidden", "true");
//                            $("#search-result").attr("hidden", "true");
//                            $("#random_prd_ajax").slideDown();
//                            $("#feature-prd").slideDown();
                            $("#result").hide();
                        } else
                        {
//                            $("#feature-prd").slideUp();
//                            $("#random_prd_ajax").slideUp();
//                            $("#search-head").show();
//                            $("#search-result").show();
//                            $("#search-head").html("Search Results");
//                            $("#search-result").html(jsonResponse);
                            $("#result").show();
                            $("#result").html(jsonResponse);
                        }
                        //console.log(opt);
                    }
                    xmlhttp.send();
                }
            }
        </script>

        <style>
            .nav-wrapper ul li a {
                font-size: 16px;
                font-family: 'Josefin Sans', sans-serif;
                font-weight: 400;
                letter-spacing: 1px;
            }
            .dropdown1-css{
                color: #515151;
            }
            .dropdown1-css:hover {
                color: #DC143C;
            }
            .productd-dropdown-font-css {
                color: #616161;
            }
            .productd-dropdown-font-css:hover {
                color: #DC143C;
            }
            
        </style>    </head>
    <body>
        <div class="navbar-fixed">
            <nav>
                <div class="nav-wrapper">
                    <!--<a href="#" data-activates="mobile-demo" class="button-collapse"><i class="material-icons">menu</i></a>-->
                    <!--<a href="./Home.php" class="brand-logo right">FruitKart</a>-->

                    <ul class="right hide-on-med-and-down" style="font-family: 'Josefin Sans', sans-serif;">                    
                        <li>
                            <div class="input-field col s12">
                                <input type="text" name="search" id="search" onkeyup="search(this);" onkeydown="search(this);" autocomplete="off" style="min-width: 250px;margin-top: 12px; height: 40px; width: auto;color: white;margin-left: 200px;" results="5" placeholder="Search Products . . .">
                                <label for="search" style="margin-left: 160px; margin-top: 0.1px"><i class="material-icons" style="font-size: 20px;margin-left: 20px;color: white;">search</i></label> <div class="search-results" style="min-width: 280px;position: fixed;z-index: 2;background-color: rgba(255,255,255,0.8);border-radius: 0px 0px 5px 5px;color: #fff;margin-top: -2px;margin-left: 200px;font-size: 15px;" id="result"></div>
                            </div>
                        </li>
                    </ul>

                    <ul class="left hide-on-med-and-down">
        <!--                <li><a href="#login-signup" class="modal-trigger"><i class="material-icons left">perm_identity</i>Login/SignUp</a></li>-->

                        <!--                <li><a class="login" href="Sign_Up.php">Sign Up</a></li>
                                        <li><a class="login" href="Sign_In.php" data-toggle="modal" data-target="#myModal">Sign In</a>
                                        </li>-->

                        <!--<li><a href="feedback.php">Feedback</a></li>-->

                        <!--<li><a href="./We_Are.php">We Are</a></li>-->
                        <li><a class="active" href="./Home.php">Home</a></li>
                        <li><a href="#" class="dropdown-button" data-activates="Product-dropdown">Products&nbsp;&nbsp;&nbsp;<i class="fa fa-caret-down" aria-hidden="true"></i></a></li>
                        <li><a href="Custom_Cake.php">Custom Cake</a></li>
                        <li><a href="#">Offers</a></li>
                        <li><a href="inquiry.php">Inquiry</a></li>
<!--                        <li><a href="#">Support</a></li>-->
<!--                        <li><a href="./Service.php">Services</a></li>-->
                        <li><a style="color: #fff" href="#">|</a></li>
                        
                        
                        <ul id="Product-dropdown" class="dropdown-content" style="background-color: rgba(255,255,255,0.8)">  
                           <li><center><a href="./Pastry_Store.php" class="productd-dropdown-font-css"><br>Pastry<br><br></a></center></li>
                            <li class="divider"></li>
                            <li><center><a href="./Cake_Store.php" class="productd-dropdown-font-css"><br>Cake<br><br></a></center></li>
                            <li class="divider"></li>
                            <li><center><a href="./Cookie_Store.php" class="productd-dropdown-font-css"><br>Cookies<br><br></a></center></li>
                            <li class="divider"></li>
                            <li><center><a href="./Bread_Store.php" class="productd-dropdown-font-css"><br>Bread<br><br></a></center></li>
<!--                            <li class="divider"></li>
                            <li><center><a href="./Custom_Cake.php" class="productd-dropdown-font-css"><br><img src="./Images/bread.svg" width="60px" height="60px"> <br>CustomizeCakes<br><br></a></center></li>-->
                        </ul>
                        
                        <?php
                        if (!isset($_SESSION['ud_fname'])) {
                            echo "<li><a class='login' href='Sign_In.php'>Sign In</a></li>"
                            . "<li><a class='login' href='Sign_Up.php' data-toggle='modal' data-target='#myModal'>Sign Up</a></li>";
                        } else {
                            ?>
                        <li class="dropdown-button" data-activates="dropdown1"><a>Welcome <span style="text-transform: capitalize;color: #DC143C"><?php echo $_SESSION['ud_fname']; ?></span>&nbsp;&nbsp;&nbsp;<i class="fa fa-caret-down" aria-hidden="true"></i></a></li>
                        <ul id="dropdown1" class="dropdown-content">
                            <li><a class="dropdown1-css" href="./profile.php"><i class="fa fa-user" aria-hidden="true"></i> &nbsp;&nbsp;&nbsp;&nbsp;<span style="color:#DC143C">|</span>&nbsp;&nbsp;&nbsp;Profile</a></li>
                            <li class="divider"></li>
                            <li><a class="dropdown1-css" href="./wishlist.php"><i class="fa fa-heart" aria-hidden="true"></i> &nbsp;&nbsp;&nbsp;<span style="color:#DC143C">|</span>&nbsp;&nbsp;&nbsp;Wishlist</a></li>
                            <li class="divider"></li>
                            <li><a class="dropdown1-css" href="./orders.php"><i class="fa fa-shopping-bag" aria-hidden="true"></i> &nbsp;&nbsp;&nbsp;<span style="color:#616161">|</span>&nbsp;&nbsp;&nbsp;Orders</a></li>
                            <li class="divider"></li>
                            <li><a class="dropdown1-css" href="./logic.php?value=logout"><i class="fa fa-sign-out" aria-hidden="true"></i> &nbsp;&nbsp;&nbsp;<span style="color:#616161">|</span>&nbsp;&nbsp;&nbsp;Logout</a></li>
                        </ul>
                        
<!--                            <li style="margin-left: 5px" id="dtl" onclick="$('#u1').css('width', ($(this).width() + 'px')), $('#u1').slideDown(), this.style = 'background-color: white;', $('#usrbtn').css('color', 'red');">
                                <a id="usrbtn">
                                    Welcome <span style="text-transform: uppercase;"><?php echo $_SESSION['ud_fname']; ?></span><i style="margin-left: 15px" class="fa fa-angle-down" aria-hidden="true"></i>
                                </a>
                                <div id="u1" style="text-align: -webkit-center;margin-top: -12px;width: 130px;border-bottom: 2px red solid;border-top: 0px red solid;position: fixed;z-index: 5;background-color: white;font-size: 15px;" hidden>
                                    <a href="./profile.php" style="color: red;margin-top: -12px;margin-left: -6px;width: inherit;"><i class="material-icons prefix" style="margin-bottom: -64px;margin-left: -102px;">account_circle</i>Profile</a><br/>
                                    <a href="./cart.php" style="color: red;"><i class="material-icons left">shopping_cart</i>My Cart</a>
                                    <a href="./wishlist.php" style="color: red;margin-top: -12px;margin-left: -6px;width: inherit;"><i class="material-icons prefix" style="margin-bottom: -64px;margin-left: -102px;">favorite border</i>Wishlist</a><br/>
                                    <a href="./orders.php" style="color: red;margin-top: -23px;margin-left: -4px;width: inherit;"><i class="material-icons prefix" style="margin-bottom: -64px;margin-left: -102px;">local_shipping</i>Orders</a><br/>
                                    <a href="./cart.php" style="color: red;margin-top: -22px;margin-left: -4px;">Cart</a>
                                    <a href="./logic.php?value=logout" style="color: red;margin-top: -23px;margin-left: 0px;width: inherit;"><i class="material-icons prefix" style="margin-bottom: -64px;margin-left: -102px;">exit_to_app</i>Logout</a>
                                </div>
                            </li>-->
                            <?php
                        }if (isset($_SESSION['ud_fname'])) {
                            ?>
                            <li><a style="color: #808080" href="#">|</a></li>
                            <li><a href="./cart.php">My Cart &nbsp;&nbsp;&nbsp;<i class="fa fa-shopping-cart" aria-hidden="true"></i></a></li>
                                <?php
                            }
                            ?>




                    </ul>  

                    <!--                    <ul class="side-nav" id="mobile-demo" class="teal lighten-2">
                                                            <li>
                                                                <a href="#login-signup" class="modal-trigger"><i class="material-icons left">perm_identity</i>Login/SignUp</a>
                                                            </li>
                    
                    <?php
                    if (!isset($_SESSION['ud_fname'])) {
                        echo"<li style=' margin-left:0px;'> Modal Trigger 
                            <a href='#login-signup' class='modal-trigger'><i class='material-icons left'>perm_identity</i>Login/SignUp</a>
                        </li> ";
                    } else {
                        ?>
                                                            <li style="margin-left: 5px" id="dtl" onclick="$('#u1').slideDown(), this.style = 'background-color: white;', $('#usrbtn').css('color', 'red');">
                                                                <a id="usrbtn">
                                                                    Welcome <span style="text-transform: uppercase;"><?php echo $_SESSION['ud_fname']; ?></span><i  style="margin-left:0px;" class="material-icons right">arrow_drop_down</i>
                                                                </a>
                                                                <div id="u1" style="text-align: -webkit-center;margin-top: -12px;width: 130px;border-bottom: 2px red solid;border-top: 0px red solid;position: fixed;z-index: 2;background-color: white;font-size: 15px;" hidden>
                                                                    <a href="./profile.php" style="color: red;margin-top: -14px;margin-left: -6px;">Profile</a>
                                                                    <a href="./orders.php" style="color: red;margin-top: -23px;margin-left: -4px;">Orders</a>
                                                                    <a href="./cart.php" style="color: red;margin-top: -22px;margin-left: -4px;">Cart</a>
                                                                    <a href="./logic.php?value=logout" style="color: red;margin-top: -23px;margin-left: 0px;">Logout</a>
                                                                </div>
                                                            </li>
                        <?php
                    }
                    ?>
                                            <li><a href = "#"><i class = "material-icons left">shopping_cart</i>My Cart</a></li>
                                            <li><a href = "product.php"><i class = "material-icons left">shopping_basket</i>Products</a></li>
                                            <li><a href = "about.php"><i class = "material-icons left">description</i>AboutUs</a></li>
                                            <li><a href = "faq.php"><i class = "material-icons left">question_answer</i>FAQs</a></li>
                                            <li><a href="./Home.php"><i class="material-icons left">store</i>Home</a></li>
                                        </ul>-->
                                        <!--<center>
                                        <div class = "input-field" align = "center">
                                        <input id = "search" type = "text" onkeyup = "" onkeydown = "" autocomplete = "off" style = "width: 380px;max-width: 380px;min-width: 380px;background-color: white;margin-top: 12px; height: 40px; width: auto;border-radius: 10px 10px 0px 0px;border-bottom-left-radius: 0px;color: red;" results = "8" placeholder = "  Search Over Many Products">
                                        <label for = "search" style = "margin-top: 1px;margin-left:139px;"><i class = "material-icons" style = "color: black;">search</i></label>
                                        <div class = "search-results" style = "color: black;min-width: 400px; width: 400px;position: fixed;z-index: 2;background-color: white;color: black;margin-top: -18px;border-bottom-left-radius: 10px;border-bottom-right-radius: 10px;font-size: 15px;" id = "result">
                                        </div>
                                        </div>
                                        </center> -->
                    <!--<div class = "input-field">
                    <input id = "search" type = "search" required>
                    <label for = "search"><i class = "material-icons">search</i></label>
                    <i class = "material-icons">close</i>
                    </div> -->
                </div>

            </nav>
        </div>
        <?php
//include './slider.php';
        ?>
        <!-- Modal Structure -->
        <!--        <div id="login-signup" class="modal" style=" max-height: 390px; max-width: 450px; overflow-y: hidden;">
                    <div class="modal-content" style="margin-top: -20px;">
                        <div class="row section">
                            <center><h5 class="red-text">Login</h5></center>
                            <div class="row divider"></div>
        
                            <div>
                                <div class="row">
                                    <div class="input-field col s12">
                                        <input id="email"  name="txtemail_mobile" type="text"  autofocus required>
                                        <label for="user-email">Email</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="input-field col s12">
                                        <input id="pwd" name="txtpassword" type="password" required>
                                        <label for="user-password">Password</label>
                                    </div>
                                    <div class="col s12">
                                        <span id='err' class="red-text" hidden>
                                        </span><a href="forgot_password.php" class="right">Forgot Password ?</a> 
                                    </div>
                                </div> 
                                <div class="row"><center>
                                        <button class="modal-action btn waves-effect waves-light red " id='login_sub' onclick="submit_data();" type="button">Login
                                            <i class="material-icons right">send</i></button>&nbsp;&nbsp;&nbsp;
                                        <a href="registration.php" class="modal-action modal-close waves-effect waves-light btn ">Sign Up</a>
                                    </center></div>
                                <div class="row center">
                                    <span id="msg_usr" class="red-text">
        
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>-->
    </body>
    <script>
        $(document).ready(function () {
            $(".button-collapse").sideNav();
            $('.modal-trigger').leanModal({
                dismissible: true, // Modal can be dismissed by clicking outside of the modal
                opacity: .3, // Opacity of modal background
            });
            $('.dropdown-button').dropdown();
            $("#u1").mouseleave(function () {
                $("#usrbtn").css("color", "white");
                $("#dtl").css("background-color", "#ee6e73");
                $(this).slideUp();
            });
        });
    </script>
</html>