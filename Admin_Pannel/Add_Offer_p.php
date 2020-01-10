<?php
include './connection.php';
?>
<html>
    <head>
        <meta charset="UTF-8">
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
    </head>
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
        .tagli-css {
            font-family: 'Lato', sans-serif;
            -webkit-font-smoothing: antialiased;
            font-weight: 700;
            font-size: 12px;

            padding: 12px;
            border-radius: 4px;
            background: rgba(0,0,0,0.5);
            color: #fff;
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

        .add-product-button {
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
        .add-product-button:hover {
            background: #4682B4;
            color: #fff;
        }
    </style>
    <body>
        <?php
        
        ?>

        <div class="section">
            <div class="container">
                <form enctype='multipart/form-data' name="vatsal" method='POST' action='logic.php?page=add_off'>
                    <div class="table-heading-css">
                        <center><span>Add Offer</span></center>
                        <center><span class="tagli-css">* Marks Field Are Mandatory To Fill !!</span></center>
                    </div>
                    <center class="table-content-css">
                        <div class="row" style="padding-left:150px;padding-right:150px;margin-top: 100px;">
                            <div class='input-field col s12 m12 l12'>
                                <input id='offer_name' name='offer_name' type='text' onblur="validate(this)" onkeyup="var a = this.value;if (isNaN(a.substr(-1))) {
                                        } else {
                                            this.value = a.slice(0, -1);
                                            Materialize.toast('Characters Only Acceptable !!', 2000);
                                        }" class='validate' required>
                                <label for='help'>Offer Name <span class="red-text"> *</span></label>
                            </div>

                            <div class='input-field col s12 m12 l12'>
                                <input id='offer_code' name='offer_code' type='text' readonly value="<?php echo(rand(1, 1000000)); ?>"  onblur="validate(this)"  required>
                                <label for='help'>Offer Code <span class="red-text"> *</span></label>
                            </div>

                            <div class='input-field col s12 m12 l12' style="margin-top:50px">
                                <input id='offer_amt' name='offer_amt' type='number' onblur='validate(this)' class='validate' required>
                                <label for='help'>Offer Amount<span class="red-text"> *</span></label>
                            </div>

                            <div class='input-field col s12 m12 l12' style="margin-top:50px">
                                <select id="pro_name" name="pro_name" required>
                                    <option value="" selected disabled>Select Product</option>
                                    <?php
                                    $qry = mysqli_query($con, "select * from product_details");
                                    while ($row = mysqli_fetch_array($qry)) {
                                        ?>
                                        <option value="<?php echo $row['prd_name']; ?>"><?php echo $row['prd_name']; ?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </div>

                            <div class='row'>
                                <div class='input-field col s12 m12 l12' style="margin-top: 80px;margin-bottom: 50px">
                                    <input type="submit" class='add-product-button' value="Add Offer"  name='action' id="add_prd_btn">
                                </div>
                            </div>

                            <input type='hidden' name='form_name' value='help' />
                        </div>
                    </center>
                </form>
            </div>
        </div>
    </body>
    <script>
        $(document).ready(function () {
            $('select').material_select();
        });

    </script>
</html>
