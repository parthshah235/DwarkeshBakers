<?php
error_reporting(E_ERROR | E_PARSE);
include './connection.php';
?>
<!DOCTYPE html>
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
            input[type=number]::-webkit-inner-spin-button,
            input[type=number]::-webkit-outer-spin-button {
                -webkit-appearance: none;
                -moz-appearance: none;
                appearance: none;
                margin: 0;
            }
            .cnt {
                overflow-y: scroll;
            }

            .cnt::-webkit-scrollbar { 
                /* This is the magic bit */
                display: none;
            }
        </style>
        <script type="text/javascript">
            function validate(obj)
            {
                var id = obj.id;
                var val = obj.value;
                if (id == "product_name" || obj == "product_name")
                {
                    var xmlhttp = new XMLHttpRequest();
                    xmlhttp.open("POST", "logic.php?page=valid_prd_name", true);
                    xmlhttp.onreadystatechange = function ()
                    {
                        if (xmlhttp.readyState == 4 && xmlhttp.status == 200)
                        {
                            var response = (xmlhttp.responseText).trim();//alert(response);
                            if (response == "1")
                            {
                                parent.Materialize.toast("(" + val + ") Product Already There !!", 1000);
                                $("#product_name").addClass("invalid");
                                $("#product_name").focus();
                                $("#add_prd_btn").attr("disabled", true);
                            } else if (response == "0")
                            {
                                if (val == "" || null)
                                {
                                    parent.Materialize.toast("Blank Field Not Acceptable !!", 1000);
                                    $("#product_name").addClass("invalid");
                                    $("#product_name").focus();
                                    $("#add_prd_btn").attr("disabled", true);
                                } else {
                                    $("#product_name").removeClass("invalid");
                                    $("#add_prd_btn").attr("disabled", false);
                                }
                            }
                        }
                    }
                    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                    xmlhttp.send("name=" + val);
                }
            }
        </script>
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
    </head>
    <body class="cnt">
        
        <?php
        ?>
        
        <div class="section">
            <div class="container">
                <form enctype='multipart/form-data' method='POST' action='logic.php?page=add_prd'>
                    <div class="table-heading-css">
                        <center><span>Add Product</span></center>
                        <center><span class="tagli-css">* Marks Field Are Mandatory To Fill !!</span></center>
                    </div>
                    <center class="table-content-css">
                        <div class="row" style="padding-left:150px;padding-right:150px;margin-top: 100px;">
                            <div class='input-field col s12 m12 l12'>
                                <input id='product_name' name='product_name' type='text' onblur="validate(this)" onkeyup="var a = this.value;if (isNaN(a.substr(-1))){}else{this.value = a.slice(0,-1); Materialize.toast('Characters Only Acceptable !!',2000);}" class='validate' required>
                                <label for='help'>Product Name <span class="red-text"> *</span></label>
                            </div>

                            <div class='input-field col s12 m12 l12' style="margin-top:50px">
                                <select name="cat_name" required>
                                    <option value="" selected disabled>Select Category</option>
                                    <?php
                                    $qry = mysqli_query($con, "select * from category");
                                    while ($row = mysqli_fetch_array($qry)) {
                                        ?>
                                        <option value="<?php echo $row['cat_name']; ?>"><?php echo $row['cat_name']; ?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                                <label>Select Category <span class="red-text"> *</span></label>
                            </div>

                            <div class='input-field col s12 m12 l12' style="margin-top:50px">
                                <input id='product_quantity' name='product_quantity' type='number' onblur='validate(this)' class='validate' required>
                                <label for='help'>Quantity(In KG or Packets) <span class="red-text"> *</span></label>
                            </div>
                            
                            <div class='input-field col s12 m12 l12' style="margin-top:50px">
                                <input id='product_mrp' name='product_mrp' type='number' onblur='validate(this)' class='validate' required>
                                <label for='help'>MRP (As 500 GM or Packets)<span class="red-text"> *</span></label>
                            </div>
                            
                            <div class='input-field col s12 m12 l12' style="margin-top:50px">
                                <textarea id='product_desc' name='product_desc' class='materialize-textarea' length='1000' required></textarea>
                                <label for='desc'>Product Description <span class="red-text"> *</span></label>
                            </div>
                            
                            <div class="file-field input-field col s12 m12 l12" style="margin-top:50px">
                                <div class="btn">
                                    <span>Image</span>
                                    <input type="file" id="file" name="file" required>
                                    <span class="red-text"> *</span>
                                </div>
                                <div class="file-path-wrapper">
                                    <input class="file-path validate" type="text">
                                </div>
                            </div>
                            
                            <div class='row'>
                                <div class='input-field col s12 m12 l12' style="margin-top: 80px;margin-bottom: 50px">
                                    <button class='add-product-button' type='submit' disabled name='action' id="add_prd_btn">Add Product</button>
                                </div>
                            </div>
                            
                            <input type='hidden' name='form_name' value='help' />
                        </div>
                    </center>
                </form>
            </div>
        </div>
        
<!--        <div class="container hoverable">
            <form enctype='multipart/form-data' method='POST' action='logic.php?page=add_prd'>
                <h3 class='center-align'>Add Product</h3>
                <hr/>
                <div class='row'>
                    <div class='input-field col s12 m8 l8 offset-l2 offset-m2'>
                        <input id='product_name' name='product_name' type='text' onblur="validate(this)" onkeyup="var a = this.value;if (isNaN(a.substr(-1))){}else{this.value = a.slice(0,-1); Materialize.toast('Characters Only Acceptable !!',2000);}" class='validate' required>
                        <label for='help'>Product Name <span class="red-text">*</span></label>
                    </div>
                </div>

                <div class='row'>
                    <div class='input-field col s12 m8 l8 offset-l2 offset-m2'>
                        <select name="cat_name" required>
                            <option value="" selected disabled>Select Category</option>
                            <?php
                            $qry = mysqli_query($con, "select * from category");
                            while ($row = mysqli_fetch_array($qry)) {
                                ?>
                                <option value="<?php echo $row['cat_name']; ?>"><?php echo $row['cat_name']; ?></option>
                                <?php
                            }
                            ?>
                        </select>
                        <label>Select Category <span class="red-text">*</span></label>
                    </div>
                </div>

                <div class='row'>
                    <div class='input-field col s12 m8 l8 offset-l2 offset-m2'>
                        <input id='product_quantity' name='product_quantity' type='number' onblur='validate(this)' class='validate' required>
                        <label for='help'>Quantity(In KG or Packets) <span class="red-text">*</span></label>
                    </div>
                </div>

                <div class='row'>
                    <div class='input-field col s12 m8 l8 offset-l2 offset-m2'>
                        <input id='product_mrp' name='product_mrp' type='number' onblur='validate(this)' class='validate' required>
                        <label for='help'>MRP (As 500 GM or Packets)<span class="red-text">*</span></label>
                    </div>
                </div>

                <div class='row'>
                    <div class='input-field col s12 m8 l8 offset-l2 offset-m2'>
                        <textarea id='product_desc' name='product_desc' class='materialize-textarea' length='1000' required></textarea>
                        <label for='desc'>Product Description <span class="red-text">*</span></label>
                    </div>
                </div>

                
                                                <div class="file-field input-field col s12 m8 l8 offset-l2 offset-m2">
                                                    <label>Product Photo</label>
                                                    <input class="file-path validate" type="text">
                                                    <input id="prod_img" name="image" type="file">
                                                </div>

                <div class="file-field input-field col s12 m8 l8 offset-l2 offset-m2">
                    <div class="btn">
                        <span>Image</span>
                        <input type="file" id="file" name="file" required>
                        <span class="red-text">*</span>
                    </div>
                    <div class="file-path-wrapper">
                        <input class="file-path validate" type="text">
                    </div>
                </div>
                <div class="row">
                    <div class="col s12 m8 l8 offset-l2 offset-m2 center">
                        <span class="red-text center">* Marks Field Are Mandatory To Fill !!</span>
                    </div>
                </div>
                <div class='row'>
                    <div class='input-field col s12 m8 l8 offset-l2 offset-m2 center'>
                        <button class='btn waves-effect waves-light' type='submit' disabled name='action' id="add_prd_btn">Add Product</button>
                    </div>
                </div>
                <input type='hidden' name='form_name' value='help' />
            </form>
        </div>-->
    </body>
    <script>
        $(document).ready(function () {
            $('select').material_select();
        });
    </script>
</html>
<?php
if ($_GET['e'] == "0") {
    ?>
    <script>
        parent.Materialize.toast("Product Succesfuly Inserted !!", 1000);
    </script>
    <?php
} else {
    ?>
    <script>
            //Materialize.toast("Error While Inserting Product !!", 1000);
    </script>
    <?php
}
?>
