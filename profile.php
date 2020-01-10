<?php
error_reporting(E_ERROR | E_PARSE);
session_start();
if (!isset($_SESSION['ud_fname'])) {
    header("Location: ./Home.php");
} else {
//print_r($_SESSION);
    include './connection.php';
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
            <title></title>
            <!--<link rel="stylesheet" href="./css/materialize.css" />-->
            <link rel="stylesheet" href="./css/materialize.min.css" />
            <!--<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">-->
            <link href="./iconfont/material-icons.css" rel="stylesheet">
            <script type="text/javascript" src="./js/jquery-3.0.0.js"></script>
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
            <?php
            // put your code here
            include './Navbar.php';
            $user = $_SESSION['ud_email'];
            $query1 = mysqli_query($con, "select * from user_details where ud_email='$user'");
            while ($row = mysqli_fetch_array($query1)) {
                ?>
                <main>
                    <div class="container">
                        <ul class="collapsible popout" data-collapsible="expandable">
                            <li>
                                <div class="collapsible-header active"><i class="material-icons">list</i>Personal Details</div>
                                <div class="collapsible-body center row">
                                    <div class="input-field col s11 m12 l8 offset-l2">
                                        <i class="material-icons prefix">contact_phone</i>
                                        <input id="txtnumber" type="text" name="txtnumber" onkeyup="var a = this.value;if (is(a.substr(-1))) {
                                                } else {
                                                    this.value = a.slice(0, -1);
                                                    Materialize.toast('Numbers Only Acceptable !!', 2000);
                                                }" value="<?php echo $row['ud_mobile']; ?>" class="validate">
                                        <label for="txtnumber">Mobile Number</label>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="collapsible-header active"><i class="material-icons">list</i>Shipping Address</div>
                                <div class="collapsible-body center row">
                                    <div class="input-field col s11 m12 l8 offset-l2">
                                        <i class="material-icons prefix">home</i>
                                        <input id="txtaddress1" value="<?php echo $row['ud_address']; ?>" type="text" name="txtaddress1" class="validate">
                                        <label for="txtaddress1">Shipping Address</label>
                                    </div>
                                </div>
                            </li>
                            
                            <li>
                                <div class="collapsible-header active"><i class="material-icons">list</i>Delivery Address</div>
                                <div class="collapsible-body center row">
                                    <div class="input-field col s11 m12 l8 offset-l2">
                                        <i class="material-icons prefix">home</i>
                                        <input id="txtaddress2" value="<?php echo $row['ud_address1']; ?>" type="text" name="txtaddress2" class="validate">
                                        <label for="txtaddress1">Delivery Address</label>
                                    </div>
                                </div>
                            </li>
                        </ul>
                        <?php
                        if ($row['ud_mobile'] == "" && $row['ud_address'] == "" && $row['ud_address1']) {
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
                </main>
            </body>
        </html>
        <?php
    }
// put your code here
    include './footer.php';
}
?>