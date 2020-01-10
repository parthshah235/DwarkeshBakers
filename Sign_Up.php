<html>
    <head>
        <meta charset="UTF-8">
        <title>Dwarkesh Bakers | Sign Up</title>
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1, maximum-scale=1, minimum-scale=1" />
        <script type="text/javascript" src="./js/jquery-3.0.0.js"></script>
        <script type="text/javascript" src="./js/materialize.js"></script>
        <script type="text/javascript" src="./js/materialize.min.js"></script>
        <link rel="stylesheet" href="./css/materialize.min.css">        
        <script type="text/javascript" src="./js/angular.js"></script>
        <script type="text/javascript" src="./js/angular-local-storage.min.js"></script>
        <script type="text/javascript" src="./js/login.js"></script>
        <script>
            function register()
            {
                var fname = $("#first_name").val();
                var lname = $("#last_name").val();
                var city = $("#city").val();
                var ps = $("#password").val();
                var mail = $("#rg_email").val();//alert(mail);
                if (fname == "" || null || lname == "" || null || ps == "" || null || mail == "" || null)
                {
                    Materialize.toast("Please Fill Required Fields !!");
                } else {
                    var xmlhttp = new XMLHttpRequest();
                    xmlhttp.open("POST", "logic.php?page=registration", true);
                    xmlhttp.onreadystatechange = function ()
                    {
                        if (xmlhttp.readyState == 4 && xmlhttp.status == 200)
                        {
                            var response = (xmlhttp.responseText).trim();alert(response);
                            if (response == 1)
                            {
                                Materialize.toast("Registration Successful !! Please check mail for verification", 2000);
                                setTimeout(function(){window.location.href = "./Sign_Up.php";}, 3000);
                            } else if (response == 0)
                            {
                                Materialize.toast("Registration Failed !!", 2000);
                            }
                        }
                        //$(".main_disp").html(jsonResponse);
                    }
                    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                    xmlhttp.send("fn=" + fname + "&ln=" + lname + "&city=" + city + "&ps=" + ps + "&mail=" + mail);
                }
            }

            function check_mail() //this function is for check mail is already exist or not ?
            {
                var mail = $("#rg_email").val();// $("#rg_email") it is jquery which was used against javascript 
                // document.getElementById('rg_email').value = $('#rg_email').val()
                // $() use for refrence || # is used for "id"
                if (mail == "" || null)
                {
                    $("#submitbtn").addClass("disabled");
                } else {
                    var xmlhttp = new XMLHttpRequest();
                    xmlhttp.open("POST", "logic.php?page=check_mail", true);
                    xmlhttp.onreadystatechange = function ()
                    {
                        if (xmlhttp.readyState == 4 && xmlhttp.status == 200)
                        {
                            var response = (xmlhttp.responseText).trim();//alert(response);
                            if (response == 1)
                            {
                                $("#rg_email").addClass("invalid");
                                $("#rgsubmitbtn").addClass("disabled");
                                $("#rg_email").focus();
                                $("#rgsubmitbtn").prop("disabled", true);
                                Materialize.toast("Email Already Exist !!", 2000);
                            } else if (response == 0)
                            {
                                if ($('#rg_email').hasClass("invalid")) {
                                    $("#rgsubmitbtn").prop("disabled", true);
                                    Materialize.toast("E-Mail Format (Ex. abc@xyz.com) !!", 2000);
                                    $("#rg_email").focus();
                                } else {
                                    $("#rg_email").addClass("valid");
                                    $("#rgsubmitbtn").prop("disabled", false);
                                    $("#rgsubmitbtn").removeClass("disabled");
                                }
                            }
                        }
                        //$(".main_disp").html(jsonResponse);
                    }
                    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                    xmlhttp.send("mail=" + mail);
                }
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
                -webkit-font-smoothing: antialiased;
                font-size: 12px;
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
                    height: 80%;
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
                    height: 90%;
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
    <?php include './Navbar.php';?>
    <body ng-app="loginApp" ng-controller="loginController">
        <div class="section background">
            <div class="col s12 m12 l12 z-depth-4 hoverable login-container">
                <center><span class="login-heading">Sign Up</span></center>
                <div class="divider"></div>
                <div class="row form-container">
                    <!--<form class="col s12 m12 l12">-->
                        <div class="row">
                            <div class="input-field inline col s12 m6 l6">
                                <input id="first_name" name="fname" type="text" class="validate" onkeyup="var a = this.value;if (isNaN(a.substr(-1))) {
                            } else {
                                this.value = a.slice(0, -1);
                                Materialize.toast('Characters Only Acceptable !!', 2000);
                            }" >
                                <label for="email" data-error="wrong" data-success="right">First Name *</label>
                            </div>
                            <div class="input-field col s12 m6 l6">
                                <input id="last_name" type="text" name="lname" class="validate" onkeyup="var a = this.value;if (isNaN(a.substr(-1))) {
                            } else {
                                this.value = a.slice(0, -1); Materialize.toast('Characters Only Acceptable !!', 2000);
                            }">
                                <label for="password">Last Name *</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s12 m6 l6">
                                <input id="rg_email" onblur="check_mail()" type="email" name="email" class="validate" required="">
                                <label for="E-mail">E-mail</label>
                            </div>
                            <div class="input-field col s12 m6 l6">
                                <input id="password" type="password" name="password" class="validate" >
                                <label for="password">Password</label>
                            </div>
                             <div class="input-field col s12 m6 l6">
                                 <input readonly value="Vadodara" id="city" type="text" class="validate">
                                <label for="disabled">City</label>
                            </div>
                  
                        </div>
                        <div class="row">
                            <center>
                                <div class="col s12 m12 l12">
                                    <input type="Submit" class='sign-up-button' onclick="register()" value="Register" id="rgsubmitbtn" >
                                </div>
                            </center>
                        </div>
                     
                    <!--</form>-->
                </div>

                <!--<div class="divider"></div>-->

                <!--<center><span class="note">By signing here, you agree to our Terms of Service and Privacy Policy.</span></center>-->

                <!--<div class="divider"></div>-->

<!--                <div class="row tandc">
                    <div class="col s12 m12 l12">
                        <span class="nmsu" style="color:#888B8D">Already had an account ? &nbsp;&nbsp;|&nbsp;&nbsp;</span><a class="nmsu" href="./Sign_In.php"> Sign In</a>
                    </div>
                </div>-->
            </div>
        </div>
    </body>
</html>
