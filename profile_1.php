<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->

<?php
error_reporting(E_ERROR | E_PARSE);
session_start();
if (!isset($_SESSION['ud_fname'])) { header("Location: ./Home.php"); } else {
//print_r($_SESSION);
    include './connection.php';
    
    ?>
    <html>
        <head>
            <style type="text/css">
                body {
                        display: flex;
                        min-height: 100vh;
                        flex-direction: column;
                    }
                main {
                        flex: 1 0 auto;
                    }
                #section-margin {
                padding-top: 8rem;
                padding-bottom: 8rem;
                }
                .Form-Heading {
                    font-size: 35px;
                    font-family: 'Josefin Sans', sans-serif;
                    -webkit-font-smoothing: antialiased;
                    font-weight: 300;
                    color: #888b8d;
                }
                .Form-Heading span:nth-child(2) {
                    color: #DC143C;
                }
                .collapsibleh-header-text-css {
                    font-size: 18px;
                    color: #616161;
                    font-family:'Product Sans', Arial, sans-serif;
                    -webkit-font-smoothing: antialiased;
                    letter-spacing: 1px;
                }
                .profile-mobile-container-css {
                    padding-top: 30px
                }
                .icon-font-text-css {
                    font-size: 18px;
                    color: #616161;
                    font-family:'Product Sans', Arial, sans-serif;
                    -webkit-font-smoothing: antialiased;
                    letter-spacing: 1px;
                }
                .icon-font-text-css span:nth-child(2){
                    color: #1e78f0;
                }
                .profile-mobile-input-css {
                    font-family: 'Josefin Sans', sans-serif;
                    -webkit-font-smoothing: antialiased;
                    font-weight: 700;
                    letter-spacing: 1px;
                }
                .profile-button-row span {
                    color: #DC143C;
                }
                
                .profile-button {
                    margin-top: 50px;
                    border: 1px solid #1366c4;
                    background-color: transparent;
                    padding: 10px 20px;
                    width: 200px;
                    height: 50px;
                    border-radius: 4px;
                    color: #1366c4;
                    font-size: 18px;
                    font-family: 'Lato', sans-serif;
                    -webkit-font-smoothing: antialiased;
                    letter-spacing: 1px;
                }
                .profile-button:hover {
                    background-color: #1366c4;
                    color: #fff;
                }
            </style>
            <meta charset="UTF-8">
            <title></title>
            <script type="text/javascript" src="./js/materialize.js"></script>
            <script type="text/javascript" src="./js/materialize.min.js"></script>
            <link rel="stylesheet" href="./css/materialize.min.css" />
            <link href="./iconfont/material-icons.css" rel="stylesheet">
            <script type="text/javascript" src="./js/materialize.js"></script>
            <script>
                function set_details()
                {
                    var phn = $("#txtnumber").val();
                    var add = $("#txtaddress1").val();
                    var add1 = $("#txtaddress2").val();
                    var xmlhttp = new XMLHttpRequest();
                    xmlhttp.open("POST", "./logic.php?page=set_details", true);
                    xmlhttp.onreadystatechange = function ()
                    {
                        if (xmlhttp.readyState == 4 && xmlhttp.status == 200)
                        {
                            var response = xmlhttp.responseText.trim();//alert(response);
                            if (response == 0)
                            {
                                Materialize.toast("Details Currently Not Saved !!", 2000);
                            } else if (response == 1)
                            {
                                Materialize.toast("Details Saved !!", 2000);
                                //location.href = "./Home.php";
                            } else {
                                Materialize.toast("Some Error !!", 2000);
                            }
                        }
                        //$(".main_disp").html(jsonResponse);
                    }
                    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                    xmlhttp.send("phn=" + encodeURIComponent(phn) + "&add=" + encodeURIComponent(add) + "&add1=" + encodeURIComponent(add1)+ "&id=<?php echo $_SESSION['ud_id']; ?>");
                }
            </script>
        </head>
        <body>
            
            <?php include './Navbar.php'; $user = $_SESSION['ud_email']; $query1 = mysqli_query($con, "select * from user_details where ud_email='$user'"); while ($row = mysqli_fetch_array($query1)) { ?>
            
            <main>
                
                <div class="section" id="section-margin">
                    <div class="container Form-Heading">
                        <div class="divider" style="background-color: #D3D3D3"></div><br>
                        <span style="margin-left: 50px"><i class="fa fa-user" aria-hidden="true"></i> <span> &nbsp; | &nbsp; </span> <span><strong>Personal Details</strong></span></span>
                        <br><br><div class="divider" style="background-color: #D3D3D3"></div><br><br>
                    
                        <div class="row" style="">
                            <div class="input-field col s4 m4 l4 icon-font-text-css" style="padding-left: 80px">
                                <i class="fa fa-phone" aria-hidden="true"></i> <span> &nbsp; | &nbsp; </span> <span> Mobile Number </span>
                            </div>
                            <div class="input-field col s8 m8 l8 profile-mobile-input-css">
                                <input id="txtnumber" type="text" name="txtnumber" placeholder="Enter Your Mobile Number" onkeyup="var a = this.value;if (is(a.substr(-1))) {
                                        } else {
                                            this.value = a.slice(0, -1);
                                            Materialize.toast('Numbers Only Acceptable !!', 2000);
                                        }" value="<?php echo $row['ud_mobile']; ?>" class="validate">
                                <label for="txtnumber">Mobile Number</label>
                            </div>
                        </div>
                        
                        <div class="row" style="padding-top: 30px">
                            <div class="input-field col s4 m4 l4 icon-font-text-css" style="padding-left: 80px">
                                <i class="fa fa-home" aria-hidden="true"></i> <span> &nbsp; | &nbsp; </span> <span> Address </span>
                            </div>
                            <div class="input-field col s8 m8 l8 profile-mobile-input-css">
                                <input id="txtaddress1" placeholder="Enter Your Delivery Address" value="<?php echo $row['ud_address']; ?>" type="text" name="txtaddress1" class="validate">
                                <label for="txtaddress1">Address</label>
                            </div>
                        </div>
                        
                        <div class="row" style="padding-top: 30px">
                            <div class="input-field col s4 m4 l4 icon-font-text-css" style="padding-left: 80px">
                                <i class="fa fa-shopping-bag" aria-hidden="true"></i> <span> &nbsp; | &nbsp; </span> <span> Shipping Address </span>
                            </div>
                            <div class="input-field col s8 m8 l8 profile-mobile-input-css">
                                <input id="txtaddress1" placeholder="Enter Your Delivery Address" value="<?php echo $row['ud_address1']; ?>" type="text" name="txtaddress2" class="validate">
                                <label for="txtaddress1">Shipping Address</label>
                            </div>
                        </div>
                        
                        <br><br><div class="divider" style="background-color: #D3D3D3"></div>
                    </div>
                    <?php if ($row['ud_mobile'] == "" && $row['ud_address'] == ""&& $row['ud_address1']) { ?>
                        
                        <div class="row">
                            <div class="col s12 m12 l12 profile-button-row">
                                <center>
                                    
                                    <button class="profile-button" onclick="set_details()">Save Details</button> <span style="margin-left: 30px;margin-right: 30px"> | </span>
                                    
                                    <button class="profile-button" onclick="window.location.href = './Home.php'">Skip Now</button>
                                </center>
                    <?php } else { ?>
                                <center>
                                     <button class="profile-button" onclick="set_details()">Update Details</button>
                                </center>
                            </div>
                        </div>
                    <?php } ?>
                </div>
                
<!--                <div class="section" id="section-margin">
                <div class="container">
                    <ul class="collapsible popout" data-collapsible="expandable">
                        <li>
                            <div class="collapsible-header active collapsibleh-header-text-css"> <i class="fa fa-user" aria-hidden="true" style="font-size: 15px"></i> Personal Details</div>
                            <div class="collapsible-body center">
                                <div class="container profile-mobile-container-css">
                                    <div class="row">
                                        <div class="input-field col s4 m4 l4 icon-font-text-css">
                                            <i class="fa fa-mobile" aria-hidden="true" style="font-size: 5px"></i> <span> &nbsp; | &nbsp; </span> <span>Mobile Number</span>
                                        </div>
                                        <div class="input-field col s8 m8 l8 profile-mobile-input-css">
                                            <input id="txtnumber" type="text" name="txtnumber" placeholder="Enter Your Mobile Number" onkeyup="var a = this.value;if (is(a.substr(-1))) {
                                                    } else {
                                                        this.value = a.slice(0, -1);
                                                        Materialize.toast('Numbers Only Acceptable !!', 2000);
                                                    }" value="<?php echo $row['ud_mobile']; ?>" class="validate">
                                            <label for="txtnumber">Mobile Number</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="collapsible-header active"><i class="material-icons">list</i>Address</div>
                            <div class="collapsible-body center row">
                                <div class="input-field col s11 m12 l8 offset-l2">
                                    <i class="material-icons prefix">home</i>
                                    <input id="txtaddress1" value="<?php echo $row['ud_address']; ?>" type="text" name="txtaddress1" class="validate">
                                    <label for="txtaddress1">Address</label>
                                </div>
                            </div>
                        </li>
                    </ul>
        <?php
        if ($row['ud_mobile'] == "" && $row['ud_address'] == "") {
            ?>
                        <div class="row center">
                            <div class="col s12 m6 l6">
                                <a class="waves-effect waves-light btn" onclick="set_details()">Save Details</a>
                            </div>
                            <div class="col s12 m6 l6">
                                <a class="waves-effect waves-light btn" onclick="window.location.href = './Home.php'">Skip Now</a>
                            </div>
                        </div>
            <?php
        } else {
            ?>
                        <div class="row center">
                            <div class="col s12 m12 l12">
                                <a class="waves-effect waves-light btn" onclick="set_details()">Update Details</a>
                            </div>
                        </div>
            <?php
        }
        ?>
                </div>
                </div>-->
            </main>
            </body>
        </html>
        <?php
    }
// put your code here
    include './footer.php';
}
?>