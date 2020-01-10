<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title></title>
        <link rel="stylesheet" href="./css/materialize.min.css" />
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <script type="text/javascript" src="./js/jquery-3.0.0.js"></script>
        <!--<script type="text/javascript" src="./js/materialize.min.js"></script>-->
        <script type="text/javascript" src="./js/functions.js"></script>
        
        <!--/*****************************------------------  Fonts  ------------------*****************************/-->

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link href="https://fonts.googleapis.com/css?family=Josefin+Sans:300,400" rel="stylesheet">
        <link href='https://fonts.googleapis.com/css?family=Product+Sans:400,700' rel='stylesheet' type='text/css'>
        <link href="https://fonts.googleapis.com/css?family=Pacifico" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Assistant:300,400,600&amp;subset=hebrew" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Sansita:400,400i" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
        
        <script type="text/javascript">
            function abc()
            {

                var xmlhttp = new XMLHttpRequest();
                xmlhttp.open("POST", "logic.php?page=update_prd", true);
                xmlhttp.onreadystatechange = function ()
                {
                    if (xmlhttp.readyState == 4 && xmlhttp.status == 200)
                    {
                        var response = xmlhttp.responseText;//alert(response);
                        var json = JSON.parse(response);
                        var disp = "<table class='striped centered'><tr><th>No</th><th>Name</th><th>About</th><th>Mrp</th><th>Quantity</th><th>Image</th><th>Update</th><th>Delete</th></tr>";
                        for (var i = 0; i <= json.length - 1; i++)
                        {
                            disp += "<tr><td>" + (i + 1) + "</td><td>" + json[i].prd_name + "</td><td>" + json[i].prd_about + "</td><td>" + json[i].prd_mrp + "</td><td>" + json[i].prd_quantity + "</td><td><center><img height='50px' width='50px' class='materialboxed responsive-img' src='" + json[i].prd_image + "' /></center></td><td><a href='#' onclick='parent.$(\"#upd_prd\").openModal(),parent.$(\"#prd_id_hide\").val(this.id),window.parent.set_id()' id='" + json[i].prd_id + "' class='tooltipped' data-position='right' data-delay='50' data-tooltip='Update/Edit This Product'><i class='fa fa-pencil' aria-hidden='true' style='color:#DC143C'></i></a></td><td><a href='#' onclick='parent.$(\"#del_prd\").openModal(),parent.$(\"#prd_id_hide\").val(this.id)' id='" + json[i].prd_id + "' class='tooltipped' data-position='left' data-delay='50' data-tooltip='Delete/Remove This Product'><i class='fa fa-trash-o' aria-hidden='true' style='color:#DC143C'></i><a></td></tr>";
                        }
                        disp += "</table>";
                    }
                    document.getElementById("res").innerHTML = disp;
                    $('.materialboxed').materialbox();
                    $('.tooltipped').tooltip({delay: 50});
                }
                xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                xmlhttp.send();
            }
        </script>
        <style>
            input[type=number]::-webkit-inner-spin-button,
            input[type=number]::-webkit-outer-spin-button {
                -webkit-appearance: none;
                -moz-appearance: none;
                appearance: none;
                margin: 0;
            }
            th,tr,td.tdspacing{
                /*               padding: 0px 0px;*/
                text-align: center;
                /*               border-bottom: 1px black solid;*/
                font-size: 15px;

            }
            
             .cnt {
                overflow-y: scroll;
            }

            .cnt::-webkit-scrollbar { 
                 /*This is the magic bit*/ 
                display: none;
            }
            
            .table-heading-css {
                display: inline-block;
                font-size: 40px;
                font-family: 'Josefin Sans', sans-serif;
                -webkit-font-smoothing: antialiased;
                font-weight: 400;
                color: #fff;
                letter-spacing: 1px;
                padding-top: 30px;
                padding-bottom: 20px;
            }
            .table-text-css {
                font-family: 'Lato', sans-serif;
                -webkit-font-smoothing: antialiased;
                font-weight: 400;
                color: #444;
                letter-spacing: 1px;
            }
            .view-user-table-css {
                border: 1px solid #DC143C;
                background-color: transparent;
                width: 100%;
            }
            .table-heading-container {
                background-color: #DC143C;
                width:100%;
            }

        </style>
    </head>
    <body onload="abc()" class="cnt">
        <?php ?>
        <div class="section">
            <div class="container view-user-table-css">
                <form method='POST' name='help'>
                    <div class="container table-heading-container">
                        <center><span class='center-align table-heading-css'>Update Product</span></center>
                    </div>
                    <div id="res" class="table-text-css"></div>
                </form>
            </div>
        </div>
    </body>
    <script>
        $(document).ready(function () {
            // the "href" attribute of .modal-trigger must specify the modal ID that wants to be triggered
//            $('.modal-trigger').leanModal({
//                dismissible: true, // Modal can be dismissed by clicking outside of the modal
//                opacity: .3, // Opacity of modal background
//            });
            $('select').material_select();
        });
    </script>
</html>
