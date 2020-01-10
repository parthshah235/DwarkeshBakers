<?php
ob_start("ob_gzhandler");
session_start();
if (isset($_SESSION['log_id']) && !empty($_SESSION['log_id'])) { //&& $_SESSION['log_id'] == 'Admin'
    header("Location: ../Admin_Panel/panel.php");
} else {
    ?>
    <!DOCTYPE html>
    <html>
        <head>
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <title></title>
            <link rel="stylesheet" href="../css/materialize.min.css" />
            <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
            <script type="text/javascript" src="../js/jquery-3.0.0.js"></script>
            <script type="text/javascript" src="../js/materialize.min.js"></script>
            <script type="text/javascript" src="./js/functions.js"></script>
        </head>
        <body class="#424242 grey darken-3">
            <?php
            // put your code here
            ?>
            <div class="row container center">
                <br/>
                <br/>
                <br/>
                <br/>
                <br/>
                <br/>
                <div id="div" class="col s12 m12 l10 z-depth-1 offset-l1 white">
                    <form method='POST' name='login' action='logic.php'>
                        <h3 class='center-align'>Login</h3>
                        <hr/>
                        <div class='row'>
                            <div class='input-field col s12 m8 l8 offset-l2 offset-m2'>
                                <i class="material-icons prefix" style="margin-top: 8px;">account_circle</i>
                                <input id="username" name="unm" type="text" class="validate black-text">
                                <label for="icon_prefix" class="black-text">Username</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s12 m8 l8 offset-l2 offset-m2">
                                <i class="material-icons prefix" style="margin-top: 8px;">vpn_key</i>
                                <input id="pass" name="pass" type="password" class="validate black-text">
                                <label for="icon_prefix" class="black-text">Password</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col s12 m8 l8 offset-l2 offset-m2">
                                <button class="btn waves-effect waves-light" type="submit" name="action">
                                    Login
                                </button>
                            </div>
                        </div>
                        <input type='hidden' name='form_name' value='login' />
                    </form>
                </div>
            </div>
        </body>
    </html>
    <?php
}
?>