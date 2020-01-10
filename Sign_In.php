<?php
include './Navbar.php';
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Dwarkesh Bakers | Sign In</title>
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1, maximum-scale=1, minimum-scale=1" />
        <script type="text/javascript" src="./js/jquery-3.0.0.js"></script>
        <script type="text/javascript" src="./js/materialize.js"></script>
        <!--<script type="text/javascript" src="./js/materialize.min.js"></script>-->
        <link rel="stylesheet" href="./css/materialize.min.css">        
        <script type="text/javascript" src="./js/angular.js"></script>
        <script type="text/javascript" src="./js/angular-local-storage.min.js"></script>
        <!--<script type="text/javascript" src="./js/login.js"></script>-->
        <script>

            function submit_data()
            {
                var user = $("#email").val();
                var pass = $("#pwd").val();
                var xmlhttp = new XMLHttpRequest();
                xmlhttp.open("POST", "logic.php?page=login", true);
                xmlhttp.onreadystatechange = function ()
                {
                    if (xmlhttp.readyState == 4 && xmlhttp.status == 200)
                    {
                        var response = xmlhttp.responseText;//alert(response);
                        //alert(response.length);
                        response = response.trim();
                        if (response == "4")
                        {
                            Materialize.toast("Welcome Admin!!", 2000);
                            window.location = "./Admin_panel/Panel.php"; //link ur url or if possible do in logic only ok ?
                        } else if (response == "1")
                        {
                            Materialize.toast("Welcome!!", 2000);
                            window.location = "./Home.php"; //link ur url or if possible do in logic only ok ?ok
                        } else if (response == "2")
                        {
                            Materialize.toast("Username Or Password Incorrect!!", 2000);
                        } else if (response == "5")
                        {
                            $("#msg_usr").show();
                            $("#msg_usr").html("Contact Admin By Having <a href='#'>Inquiry</a> About It !!");
                            Materialize.toast("You Are Disabled By Admin !!", 2000);
                            $('#msg_usr').delay(5000).fadeOut('slow');
                        } else {
                            Materialize.toast("Some Error!!", 2000);
                        }
                    }
                    //$(".main_disp").html(jsonResponse);
                }
                xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                xmlhttp.send("user=" + user + "&pass=" + pass);
            }

        </script>


        <!--/*****************************------------------  Fonts  ------------------*****************************/-->

        <link href="https://fonts.googleapis.com/css?family=Josefin+Sans:300,400" rel="stylesheet">
        <link href='https://fonts.googleapis.com/css?family=Product+Sans:400,700' rel='stylesheet' type='text/css'>
        <link href="https://fonts.googleapis.com/css?family=Pacifico" rel="stylesheet">


        <style type="text/css">
            .background {
                background-image: url('./Images/Sign in background.jpg');
                position: fixed;
                background-repeat: no-repeat;
                -webkit-background-size: cover;
                -moz-background-size: cover;
                -o-background-size: cover;
                background-size: cover;
                width: 100%;
                height: 100%;
            }
            .login-container {
                margin-left: 2.5rem;
                margin-top: 0rem;
                width: 80%;
                height: 80%;
                border-radius: 10px;
                background-color: #FFFAFA;
            }
            .login-heading {
                font-size: 2rem;
                padding-top: 1.5rem;
                padding-bottom: 1rem;
                display: block;
                color: #616161;
                font-family: 'Josefin Sans', sans-serif;
                -webkit-font-smoothing: antialiased;
            }
            .form-container {
                padding-top: 1rem;
                padding-left: 1rem;
                padding-right: 1rem;
            }

            /*<!--****************************------------------  Email validation  ------------------****************************-->*/


            .input-field {
                color: #616161;
                font-family:'Product Sans', Arial, sans-serif;  
                -webkit-font-smoothing: antialiased;
            }
            .input-field:active {
                border-bottom: 1px solid #3b5998;
            }

            .button-divider-section {
                padding-top: 0.1rem;
            }

            /*<!--****************************------------------  Login Buttons  ------------------****************************-->*/

            .sign-up-button {
                font-family: 'Product Sans', Arial, sans-serif;
                -webkit-font-smoothing: antialiased;
                color:#515151;
                border: 1px solid #515151;
                border-radius: 5px;
                padding: 10px 5px;
                background-color: transparent;
                width: 100%;
            }
            .sign-up-button:hover {
                color: #fff;
                background-color: #515151;
            }
            .facebook-button {
                font-family: 'Product Sans', Arial, sans-serif;
                -webkit-font-smoothing: antialiased;
                color: #3b5998;
                border: 1px solid #3b5998;
                border-radius: 6px;
                padding : 12px 15px;
                background-color: transparent;
                width: 100%;
                word-wrap: break-word;


            }
            .facebook-button:hover {
                color: #fff;
                background-color: #3b5998;
            }
            .google-button {
                font-family: 'Product Sans', Arial, sans-serif;
                -webkit-font-smoothing: antialiased;
                color: #dd4b39;
                border: 1px solid #dd4b39;
                border-radius: 6px;
                padding : 12px 12px;
                background-color: transparent;
                width: 100%;
                word-wrap: break-word;
            }
            .google-button:hover {
                color: #fff;
                background-color: #dd4b39;
            }
            .button-divider {
                font-family: 'Product Sans', Arial, sans-serif;
                -webkit-font-smoothing: antialiased;
                color: #888B8D;
            }

            /*<!--****************************------------------  Footer  ------------------****************************-->*/


            .note {
                color: #888B8D;
                font-family: 'Product Sans', Arial, sans-serif;
                -webkit-font-smoothing: antialiased;  
                padding-top: 1.5rem;
                padding-left: 3rem;
                padding-right: 3rem;
                display: block;
            }
            .tandc {
                padding-left: 1rem;
                padding-right: 1rem;
                padding-top: 2rem;
            }
            .nmsu {
                color: #515151;
                font-family: 'Product Sans', Arial, sans-serif;
                font-size: 12px;
                -webkit-font-smoothing: antialiased;              
            }
            .nmsu:hover {
                color: #da3939;
            }
            .forgot-password {
                color: #515151;
                font-family: 'Product Sans', Arial, sans-serif;
                font-size: 12px;
                -webkit-font-smoothing: antialiased;
                float: right;
                display: inline;
            }
            .forgot-password:hover {
                color: #da3939;
            }
        </style>
        <style type="text/css">
            @media screen and (max-width: 350px) {
                .login-container {
                    width: 84%;
                    height: 90%;
                    margin-top: 3rem;
                }
                .login-heading {
                    font-size: 2.5rem;
                    padding-top: 2rem;
                    padding-bottom: 1.5rem;
                }

                /*<!--****************************------------------  Login Buttons  ------------------****************************-->*/


                .sign-up-button {
                    padding: 20px 5px;
                }
                .facebook-button {
                    padding : 12px 30px;
                }
                .google-button {
                    padding : 12px 30px;
                }

            }
            /*        @media screen and (min-width: 400px) {
                        
                        .login-container {
                            width: 84%;
                            height: 90%;
                            margin-top: 3rem;
                            
                        }
                            .login-heading {
                            font-size: 2.5rem;
                            padding-top: 2rem;
                            padding-bottom: 1.5rem;
                        }
                        .form-container {
                            padding-top: 1.5rem;
                            padding-left: 2rem;
                            padding-right: 2rem;
                        }
                        
                        <!--****************************------------------  Login Buttons  ------------------****************************-->
                        
                        
                        .facebook-button {
                            padding : 12px 33px;
                        }
                        .google-button {
                            padding : 12px 30px;
                        }
                        
                        <!--****************************------------------  Footer  ------------------****************************-->
                        
                        
                        .note { 
                            padding-top: 2rem;
                            padding-bottom: 3rem;
                            padding-left: 5rem;
                            padding-right: 5rem;
              
                        }
                    }*/

            @media screen and (min-width: 750px) {

                .login-container {
                    margin-left: 13rem;
                    margin-top: 10rem;
                    width: 60%;
                    height: 60%;
                    margin-top: 3rem;

                }
                .login-heading {
                    font-size: 2.5rem;
                    padding-top: 2rem;
                    padding-bottom: 1.5rem;
                }
                .form-container {
                    padding-top: 1.5rem;
                    padding-left: 2rem;
                    padding-right: 2rem;
                }

                /*<!--****************************------------------  Login Buttons  ------------------****************************-->*/


                .facebook-button {
                    padding : 12px 33px;
                }
                .google-button {
                    padding : 12px 30px;
                }

                /*<!--****************************------------------  Footer  ------------------****************************-->*/


                .note { 
                    padding-top: 2rem;
                    padding-bottom: 1rem;
                    padding-left: 5rem;
                    padding-right: 5rem;

                }
            }

            @media screen and (min-width: 1000px) {

                .login-container {
                    margin-left: 50rem;
                    margin-top: 10rem;
                    width: 35%;
                    height: 80%;
                    margin-top: 3rem;

                }
                .login-heading {
                    font-size: 2rem;
                    padding-top: 2rem;
                    padding-bottom: 1.5rem;
                }
                .form-container {
                    padding-top: 2rem;
                    padding-left: 3rem;
                    padding-right: 3rem;
                }
                .button-divider-section {
                    padding-top: 1rem;
                    padding-bottom: 1rem;
                }

                /*<!--****************************------------------  Login Buttons  ------------------****************************-->*/


                .sign-up-button {
                    padding: 20px 15px;
                }
                .facebook-button {
                    padding : 20px 15px;
                }
                .google-button {
                    padding : 20px 15px;
                }

                /*<!--****************************------------------  Footer  ------------------****************************-->*/


                .note { 
                    padding-top: 2rem;
                    padding-bottom: 2rem;
                    padding-left: 2rem;
                    padding-right: 2rem;
                }    
                .tandc {
                    padding-left: 5rem;
                    padding-right: 5rem;

                }            
            }
        </style>
    </head>
    <body ng-app="loginApp" ng-controller="loginController">
        <div class="section background">
            <div class="col s12 m12 l12 z-depth-4 hoverable login-container">
                <center><span class="login-heading">Sign In</span></center>
                <div class="divider"></div>
                <div class="row form-container">
                    <form class="col s12 m12 l12">
                        <div class="row">
                            <div class="input-field inline col s12 m12 l12">
                                <input id="email" name="txtemail_mobile" type="email" class="validate">
                                <label for="email" data-error="wrong" data-success="right">Email</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s12 m12 l12">
                                <input id="pwd" name="txtpassword" type="password" class="validate">
                                <label for="password">Password</label>
                            </div>
                        </div>
                        <div class="row">
                            <center>
                                <div class="col s12 m12 l12">
                                    <input type="button" class='sign-up-button' type='submit' name="submit" value="Sign In" id='login_sub' onclick="submit_data();">
                                </div>
                            </center>
                        </div>
                 
                    </form>
                </div>

                <!--<div class="divider"></div>-->

                <!--<center><span class="note">By signing here, you agree to our Terms of Service and Privacy Policy.</span></center>-->

                <!--<div class="divider"></div>-->

                <div class="row tandc">
                    <div class="col s6 m6 l6">
                        <span class="nmsu" style="color:#888B8D">New User ? &nbsp;&nbsp;|&nbsp;&nbsp;</span><a class="nmsu" href="#"> Sign Up</a>
                    </div>
                    <div class="col s6 m6 l6">
                        <a class="forgot-password" href="forgot_password.php">Forgot Password ?</a>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
