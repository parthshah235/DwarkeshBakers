<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <!--<link rel="stylesheet" href="./css/materialize.css" />-->
        <link rel="stylesheet" href="./css/materialize.min.css" />
        <!--<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">-->
        <link href="./iconfont/material-icons.css" rel="stylesheet">
        <script type="text/javascript" src="./js/jquery-3.0.0.js"></script>
        <script type="text/javascript" src="./js/materialize.js"></script>
        <script type="text/javascript">
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

            function register()
            {
                var fname = $("#first_name").val();
                var lname = $("#last_name").val();
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
                            var response = (xmlhttp.responseText).trim();//alert(response);
                            if (response == 1)
                            {
                                Materialize.toast("Registration Successful !!", 2000);
                                window.location = "./profile.php";
                            } else if (response == 0)
                            {
                                Materialize.toast("Registration Failed !!", 2000);
                            }
                        }
                        //$(".main_disp").html(jsonResponse);
                    }
                    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                    xmlhttp.send("fn=" + fname + "&ln=" + lname + "&ps=" + ps + "&mail=" + mail);
                }
            }
        </script>
    </head>
    <body>
        <?php
// put your code here
        include './Head1.php';
        ?>
        <div class="row" style="border: 0px red solid;">
            <div class="col s12 m4 l12">
                <h2>Create An Account</h2>
                <span class="red-text left">(* Marks Field Are Mandatory To Fill !!)</span>
            </div>
            <div class="row">
                <div class="input-field col s12 m4 l3">
                    <i class="material-icons prefix">account_circle</i>
                    <input id="first_name" name="fname" type="text" onkeyup="var a = this.value;if (isNaN(a.substr(-1))){}else{this.value = a.slice(0,-1); Materialize.toast('Characters Only Acceptable !!',2000);}" required>
                    <label for="first_name">First Name<span class="red-text">*</span></label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12 m4 l3">
                    <i class="material-icons prefix">account_circle</i>
                    <input id="last_name" type="text" name="lname" class="validate" onkeyup="var a = this.value;if (isNaN(a.substr(-1))){}else{this.value = a.slice(0,-1); Materialize.toast('Characters Only Acceptable !!',2000);}" required>
                    <label for="last_name">Last Name<span class="red-text">*</span></label>
                </div>
            </div>
            <!--      <div class="row">
                    <div class="input-field col s12">
                      <input disabled value="I am not editable" id="disabled" type="text" class="validate">
                      <label for="disabled">Disabled</label>
                    </div>
                  </div>-->
            <div class="row">
                <div class="input-field col s12 m4 l3">
                    <i class="material-icons prefix">vpn_key</i>
                    <input id="password" type="password" name="password" class="validate" required>
                    <label for="password">Password<span class="red-text">*</span></label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12 m4 l3">
                    <i class="material-icons prefix">email</i>
                    <input id="rg_email" onblur="check_mail()" type="email" name="email" class="validate" required>
                    <label for="rg_email">Email<span class="red-text">*</span></label>
                </div>
                <!--                <div class="row">
                                    <div class="col s12 m8 l8 offset-l2 offset-m2 left">
                                        <span class="red-text left">* Marks Field Are Mandatory To Fill !!</span>
                                    </div>
                                </div>-->
            </div>
            <div class="row">
                <div class="input-field col s12 m4 l4 offset-l1">
                    <input type="Submit"  class="btn disabled" onclick="register()" value="Register" id="rgsubmitbtn" />
                </div>
            </div>
        </div>
        <?php
        include './footer.php';
        ?>
    </body>
</html>
