<!DOCTYPE html>
<?php
error_reporting(E_ERROR | E_PARSE);
?>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title></title>
        <link rel="stylesheet" href="./css/materialize.min.css" />
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <script type="text/javascript" src="./js/jquery-3.0.0.js"></script>
        <script type="text/javascript" src="./js/materialize.min.js"></script>
        <script type="text/javascript" src="./js/functions.js"></script>
        
        <!--/*****************************------------------  Fonts  ------------------*****************************/-->

        <link href="https://fonts.googleapis.com/css?family=Josefin+Sans:300,400" rel="stylesheet">
        <link href='https://fonts.googleapis.com/css?family=Product+Sans:400,700' rel='stylesheet' type='text/css'>
        <link href="https://fonts.googleapis.com/css?family=Pacifico" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Assistant:300,400,600&amp;subset=hebrew" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Sansita:400,400i" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
        
        <style>
            .table-heading-css {
                border: 1px solid #DC143C;
                border-top-left-radius: 5px;
                border-top-right-radius: 5px;
                background-color: #DC143C;
                width: 100%;
                font-size: 40px;
                font-family: 'Josefin Sans', sans-serif;
                -webkit-font-smoothing: antialiased;
                font-weight: 400;
                color: #fff;
                letter-spacing: 1px;
                padding-top: 30px;
                padding-bottom: 20px;
            }
            .table-content-css {
                border: 1px solid #DC143C;
                border-bottom-left-radius: 5px;
                border-bottom-right-radius: 5px;
                background-color: transparent;
                font-family: 'Lato', sans-serif;
                -webkit-font-smoothing: antialiased;
                font-weight: 400;
            }
            
            .add-category-button {
                border:1px solid #4682B4;
                border-radius: 5px;
                background-color: transparent;
                padding: 15px 40px;
                font-family: 'Lato', sans-serif;
                -webkit-font-smoothing: antialiased;
                font-weight: 400;
                color: #4682B4;
                letter-spacing: 1px;
                font-size: 17px;
            }
            .add-category-button:hover {
                background: #4682B4;
                color: #fff;
            }
        </style>
    </head>
    <body>
        <?php
        // put your code here
        ?>
        <!--        <form method='POST' name='help' action='logic.php?page=add_cat'>-->
        <div class="section">
            <div class="container table-heading-css">
                <center><span>Add Category</span></center>
            </div>
            <center class="table-content-css">
                <div class="row" style="padding-left:150px;padding-right:150px">
                    <div class="input-field col s12 m12 l12" style="margin-top: 100px;margin-bottom: 50px">
                        <input id='name_cat' name='cat_name' type='text' onblur='validate(this)' onkeyup="var a = this.value;if (isNaN(a.substr(-1))){}else{this.value = a.slice(0,-1); Materialize.toast('Characters Only Acceptable !!',2000);}" class='validate' required>
                        <label for='name_cat'>Category Name</label>
                    </div>
                </div>
                <div class='row'>
                    <div class='input-field col s12 m12 l12' style="margin-top: 50px;margin-bottom: 100px">
                        <button class='add-category-button' id="add_cat_btn" onclick="add_cat()" disabled type='submit' name='action'>Add Category</button>
                    </div>
                </div>          
            </center>
        </div>

        <div class='row'>
<!--            <div class='input-field col s12 m8 l8 offset-l2 offset-m2 center'>
                <input id='name_cat' name='cat_name' type='text' onblur='validate(this)' onkeyup="var a = this.value;if (isNaN(a.substr(-1))){}else{this.value = a.slice(0,-1); Materialize.toast('Characters Only Acceptable !!',2000);}" class='validate' required>
                <label for='name_cat'>Category Name</label>
            </div>-->

<!--            <div class='row'>
                <div class='input-field col s12 m8 l8 offset-l2 offset-m2 center'>
                    <button class='btn waves-effect waves-light' id="add_cat_btn" onclick="add_cat()" disabled type='submit' name='action'>Add Category</button>
                </div>
            </div>      -->
        </div>
        <!--</form>-->
    </body>
    <script>
        $('.alphaonly').bind('keyup blur', function () {
            var node = $(this);
            node.val(node.val().replace(/[^A-Za-z]/g, ''));
//            if (isNaN($(this)))
//            {
//                //Materialize.toast("Characters Allowed Only !!", 2000);
//            } else {
//                Materialize.toast("Characters Allowed Only !!", 2000);
//            }
        }
        );

    </script>
</html>
