<?php 
session_start();
if(isset($_SESSION['ud_id'])){    header("Location:./404.html");} else{
error_reporting(E_ERROR | E_PARSE);
$reqType = $_GET['type'];
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
        <meta charset="UTF-8">
        <title>Account Recovery</title>
        <!-- Compiled and minified CSS -->
        <link rel="stylesheet" href="./css/materialize.css">
        <!--Import Google Icon Font-->
        <link href="./iconfont/material-icons.css" rel="stylesheet">
        <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <script type="text/javascript" src="./js/jquery-3.0.0.js"></script>
        <script type="text/javascript" src="./js/materialize.js"></script>
        <style>  i.is {font-size: 1.5em;}</style>
        <script type="text/javascript">

            function verfymc()
            {
                var xmlhttp = new XMLHttpRequest();
                var code = document.getElementById("txtcode").value;
               // alert(code);
                var pass = document.getElementById("txtpass").value;
                var email = document.getElementById("txtemail").value;
                var key = document.getElementById("key").value;
                var mcmobile = document.getElementById("no").value;
                var otpstart = document.getElementById("otpstart").value;
                //alert("txtcode=" + code + "&txtemail=" + email + "&txtpass=" + pass + "&key=" + key + "&otpstart=" + otpstart + "&mcno=" + mcmobile);
                xmlhttp.open("POST", "logic.php?value=mc", true);
                xmlhttp.onreadystatechange = function ()
                {
                    if (xmlhttp.readyState == 4 && xmlhttp.status == 200)
                    {
                        var status = xmlhttp.responseText;
                        alert(status);
                        regal(status);
                    }
                }
                xmlhttp.setRequestHeader("content-type", "application/x-www-form-urlencoded");
                xmlhttp.send("txtcode=" + code + "&txtemail=" + email + "&txtpass=" + pass + "&key=" + key + "&otpstart=" + otpstart + "&mcno=" + mcmobile);
            }
            function codeerr()
            {
                var xmlhttp = new XMLHttpRequest();
                var code = document.getElementById("txtcode").value;
                var pass = document.getElementById("txtpass").value;
                var email = document.getElementById("txtemail").value;
                var mobile = document.getElementById("no").value;
                xmlhttp.open("POST", "logic.php?value=activate", true);
                xmlhttp.onreadystatechange = function ()
                {
                    if (xmlhttp.readyState == 4 && xmlhttp.status == 200)
                    {
                         if (xmlhttp.responseText==1)
                         {
                            Materialize.toast("Password Changed!!",700);
//                            setTimeout(function(){window.location="http://www.fruitkart.tk";},1000);
                               window.location.href="./Home.php";
                         }
                        else if (xmlhttp.responseText==2)
                        {
                           Materialize.toast("Invalid Code!!",3000);
                        }
                         else
                        {
                           Materialize.toast(xmlhttp.responseText,3000);
                        }
                      
                    }
                }
                xmlhttp.setRequestHeader("content-type", "application/x-www-form-urlencoded");
                xmlhttp.send("txtcode=" + code + "&txtemail=" + email + "&txtpass=" + pass + "&no=" + mobile);
            }
            function chkmail()
            {
                var xmlhttp = new XMLHttpRequest();
                var mail = document.getElementById("txtemail").value;
                xmlhttp.open("GET", "checkdata.php?retrieveemail=" + mail, true);
                xmlhttp.onreadystatechange = function ()
                {
                    if (xmlhttp.readyState == 4 && xmlhttp.status == 200)
                    {
                        var mydiv = document.getElementById("erremail");
                        var response = xmlhttp.responseText.split("||");
                        mydiv.innerHTML = response[0];
                        mydiv.valid = response[1];
                    }
                }
                xmlhttp.send();
            }
            function chkmobile()
            {
                var xmlhttp = new XMLHttpRequest();
                var mob = document.getElementById("no").value;
                xmlhttp.open("GET", "checkdata.php?mobile=" + mob, true);
                xmlhttp.onreadystatechange = function ()
                {
                    if (xmlhttp.readyState == 4 && xmlhttp.status == 200)
                    {
                        var mydiv = document.getElementById("errmobile");
                        var response = xmlhttp.responseText.split("||");
                        mydiv.innerHTML = response[0];
                        mydiv.valid = response[1];
                    }                }
                xmlhttp.send();
            }
            function btn()
            {
                return document.getElementById("erremail").valid;
                return document.getElementById("errmobile").valid;
            }
            function checkfld(f)
            {
                var myfield = f;
                var xmlhttp = new XMLHttpRequest();
                xmlhttp.open("GET", "checkdata.php?" + myfield.id + "=" + myfield.value, true);
                xmlhttp.onreadystatechange = function ()
                {
                    if (xmlhttp.readyState == 4 && xmlhttp.status == 200)
                    {
                        var divname = "err" + myfield.id.substring(3);
                        var mydiv = document.getElementById(divname);
                        var response = xmlhttp.responseText.split("||");
                        mydiv.innerHTML = response[0];
                        mydiv.valid = response[1];
                    }
                }
                xmlhttp.send();
            }
            function submitchk()
            {
                a4 = document.getElementById("errpass");
                return (a4.valid);
            }
            function reqType() {
                var motp = 'motp';
                var mail = 'mail';
                var mc = 'mc';
                if (<?php echo$reqType; ?> == motp) {
                    $('#reemail').slideUp();
                    $('#txtemail').removeAttr("required");
                    Materialize.toast("Code Sent To Your Mobile ", 9000);
                    $('#remobile').slideDown();
                    $('#no').attr("required", "true");
                }
                else if (<?php echo$reqType; ?> == mc) {
                    $('#reemail').slideUp();
                    $('#txtemail').removeAttr("required");
                    Materialize.toast("Misscall is in Way Check Your Mobile", 9000);
                    $('#remobile').slideDown();
                    $('#no').attr("required", "true");
                }
                else if (<?php echo$reqType; ?> == mail) {
                    Materialize.toast("Mail Sent Please Check Your (Inbox OR Spam )", 9000);
                }
            }
        </script>
    </head>
    <body onload="reqType()">
<?php include './Navbar.php'; ?>
        <main>
    <center>
        <!--        <form name="retrieve_form" action="logic.php?value=activate" method="POST">-->
        <div class="row" style>
            <div class="input-field col s4">
                <h4>Change Password</h4>
                <h5 id="type"></h5>
            </div>
            <br>        
            <div class="input-field col s10" id="reemail">
                <input  type="email" name="txtemail" id="txtemail" onchange="chkmail()" style="width: 200px;margin-left: -501px;" required autocomplete="off">

                <label for="txtemail" style="margin-left: 200px;">Enter Registred Email</label>    
            </div>
            <div class="col s5">
                <span id="erremail" class="red-text"></span>
            </div>
            <div class="input-field col s10" id="remobile" hidden  >
                <input type="text"  name="no" id="no"  onchange="chkmobile()"  oninput="if(this.value.length > 10) {this.value = this.value.slice(0,10);}" class="validate"  style="width: 200px;margin-left: -501px;" pattern="(7|8|9)\d{9}" title="Enter 10 Digit Mobile No" oninput="if(this.value.length > 10) {this.value = this.value.slice(0,10);}" />
                <label for="mobilemc" style="margin-left: 200px;">Enter Mobile No. </label>  
            </div>
            <div class="col s5">
                <span id="errmobile" class="red-text"></span>
            </div>
            <div class="input-field col s10">
                <input id="txtpass" name="txtpass" type="password" onblur="checkfld(this)" style="width: 200px;margin-left: -501px;">
                <label for="password" style="margin-left: 200px;">Enter New Password</label>

            </div>
            <div class="col s5">
                <span id="errpass" class="red-text"></span>
            </div>

            <div class="input-field col s10">
                <?php
                $o = $_GET['otpstart'];
                $k = $_GET['keymatch'];
                if ($o != null && $k != null) {
                    echo "<input  type='hidden' id='otpstart' style='margin-left=-700px;' value='".$_GET['otpstart']."'>"; 
                    echo "<input id='txtcode' name='txtcode' type='text' title='Enter last 5 Digits Of Missed Call Number'  style='width: 200px;margin-left: -530px;'>";
                    echo "<label for='code' style='margin-left: 210px;'>Enter Last 5 Digit</label><br>";
                    echo "<div class='input-field col s12'><input type='button' name='submitbtn' id='submitbtn' style='margin-left: -501px;' class='btn' value='Submit' onclick='verfymc()' /> </div>";
                    echo "<input type='hidden' id='key' value='" . $_GET['keymatch'] . "'>";
                } elseif ($reqType == 'mail' || $reqType = 'motp') {
                    echo"<input id='txtcode' name='txtcode' type='text' style='width: 200px;margin-left: -501px;'>";
                    echo"<label for='code' style='margin-left: 200px;'>Enter Code</label><br>";
                    echo "<div class='input-field col s12'><input type='button' name='submitbtn' id='submitbtn' style='margin-left: -501px;' class='btn' value='Submit' onclick='codeerr()' />  </div>";
                }
                ?>
            </div>

        </div>      
        <!--        </form>-->
    </center>
        </main>
<?php //include './test.php';?>
<?php include 'footer.php'; ?>
</body>
</html><?php }?>
