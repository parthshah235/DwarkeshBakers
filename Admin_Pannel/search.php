<?php
error_reporting(E_ERROR | E_PARSE);
include '../connection.php';
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
        <script type="text/javascript">
            function result(obj)
            {
                if (obj == null)
                {
                    $("#res").slideUp();
                    $("#res").html("");
                } else {
                    var key = obj.value;//console.log(key);
                    if (key == "" || null && dkey == "" || null)
                    {
                        $("#res").slideUp();
                        $("#res").html("");
                    } else {
                        var val = $("#cat_sel").is(":checked");//alert(val);
                        if (val == true)
                        {
                            if (obj == "newv")
                            {
                                key = $("#search").val();
                            }
                            var cat = $("#cat_check").val();
                            var min = $("#min").val();
                            var max = $("#max").val();
                            var xmlhttp = new XMLHttpRequest();
                            xmlhttp.open("POST", "logic.php?page=search", true);
                            xmlhttp.onreadystatechange = function ()
                            {
                                if (xmlhttp.readyState == 4 && xmlhttp.status == 200)
                                {
                                    var response = xmlhttp.responseText;//alert(response);
                                    var json = JSON.parse(response);
                                    var disp = "<table class='striped centered'><tr><th>No</th><th>Name</th><th>About</th><th>Mrp</th><th>Quantity</th><th>Image</th><th>Update</th><th>Delete</th></tr>";
                                    if (json.length == 0)
                                    {
                                        disp += "<tr><td colspan='8'>No Product Found !!</td></tr>";
                                    } else {
                                        for (var i = 0; i <= json.length - 1; i++)
                                        {
                                            disp += "<tr class='hoverable'><td>" + (i + 1) + "</td><td>" + json[i].prd_name + "</td><td>" + json[i].prd_about + "</td><td>" + json[i].prd_mrp + "</td><td>" + json[i].prd_quantity + "</td><td><img height='20px' width='20px' class='materialboxed responsive-img' src='" + json[i].prd_image + "' /></td><td><a href='#' onclick='parent.$(\"#upd_prd\").openModal(),parent.$(\"#prd_id_hide\").val(this.id),window.parent.set_id()' id='" + json[i].prd_id + "' class='tooltipped' data-position='left' data-delay='50' data-tooltip='Update/Edit This Product'><i class='material-icons'>mode_edit</i></a></td><td><a href='#' onclick='parent.$(\"#del_prd\").openModal(),parent.$(\"#prd_id_hide\").val(this.id)' id='" + json[i].prd_id + "' class='tooltipped' data-position='left' data-delay='50' data-tooltip='Delete/Remove This Product'><i class='material-icons'>delete</i><a></td></tr>";
                                        }
                                    }
                                    disp += "</table>";

                                }
                                $("#res").slideDown();
                                $("#res").html(disp);
                                $('.materialboxed').materialbox();
                                $('.tooltipped').tooltip({delay: 50});
                            }
                            xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                            xmlhttp.send("key=" + key + "&cat=" + cat + "&min=" + min + "&max=" + max);
                        } else {

                            var val2 = $("#mrp_sel").is(":checked");//alert(val2);
                            if (val2 == true)
                            {
                                var min = $("#min").val();
                                var max = $("#max").val();
                                var xmlhttp = new XMLHttpRequest();
                                xmlhttp.open("POST", "logic.php?page=search", true);
                                xmlhttp.onreadystatechange = function ()
                                {
                                    if (xmlhttp.readyState == 4 && xmlhttp.status == 200)
                                    {
                                        var response = xmlhttp.responseText;//alert(response);
                                        var json = JSON.parse(response);
                                        var disp = "<table class='striped centered center'><tr><th>No</th><th>Name</th><th>About</th><th>Mrp</th><th>Quantity</th><th>Image</th><th>Update</th><th>Delete</th></tr>";
                                        if (json.length == 0)
                                        {
                                            disp += "<tr><td colspan='8'>No Product Found !!</td></tr>";
                                        } else {
                                            for (var i = 0; i <= json.length - 1; i++)
                                            {
                                                disp += "<tr class='hoverable'><td>" + (i + 1) + "</td><td>" + json[i].prd_name + "</td><td>" + json[i].prd_about + "</td><td>" + json[i].prd_mrp + "</td><td>" + json[i].prd_quantity + "</td><td><img height='20px' width='20px' class='materialboxed responsive-img' src='" + json[i].prd_image + "' /></td><td><a href='#' onclick='parent.$(\"#upd_prd\").openModal(),parent.$(\"#prd_id_hide\").val(this.id),window.parent.set_id()' id='" + json[i].prd_id + "' class='tooltipped' data-position='left' data-delay='50' data-tooltip='Update/Edit This Product'><i class='material-icons'>mode_edit</i></a></td><td><a href='#' onclick='parent.$(\"#del_prd\").openModal(),parent.$(\"#prd_id_hide\").val(this.id)' id='" + json[i].prd_id + "' class='tooltipped' data-position='left' data-delay='50' data-tooltip='Delete/Remove This Product'><i class='material-icons'>delete</i><a></td></tr>";
                                            }
                                        }
                                        disp += "</table>";
                                    }
                                    $("#res").slideDown();
                                    $("#res").html(disp);
                                    $('.materialboxed').materialbox();
                                    $('.tooltipped').tooltip({delay: 50});
                                }
                                xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                                xmlhttp.send("key=" + key + "&min=" + min + "&max=" + max);

                            } else {

                                var xmlhttp = new XMLHttpRequest();
                                xmlhttp.open("POST", "logic.php?page=search", true);
                                xmlhttp.onreadystatechange = function ()
                                {
                                    if (xmlhttp.readyState == 4 && xmlhttp.status == 200)
                                    {
                                        var response = xmlhttp.responseText;//alert(response);
                                        var json = JSON.parse(response);
                                        var disp = "<table class='striped centered center'><tr><th>No</th><th>Name</th><th>About</th><th>Mrp</th><th>Quantity</th><th>Image</th><th>Update</th><th>Delete</th></tr>";
                                        if (json.length == 0)
                                        {
                                            disp += "<tr><td colspan='8'>No Product Found !!</td></tr>";
                                        } else {
                                            for (var i = 0; i <= json.length - 1; i++)
                                            {
                                                disp += "<tr class='hoverable'><td>" + (i + 1) + "</td><td>" + json[i].prd_name + "</td><td>" + json[i].prd_about + "</td><td>" + json[i].prd_mrp + "</td><td>" + json[i].prd_quantity + "</td><td><img height='20px' width='20px' class='materialboxed responsive-img' src='" + json[i].prd_image + "' /></td><td><a href='#' onclick='parent.$(\"#upd_prd\").openModal(),parent.$(\"#prd_id_hide\").val(this.id),window.parent.set_id()' id='" + json[i].prd_id + "' class='tooltipped' data-position='left' data-delay='50' data-tooltip='Update/Edit This Product'><i class='material-icons'>mode_edit</i></a></td><td><a href='#' onclick='parent.$(\"#del_prd\").openModal(),parent.$(\"#prd_id_hide\").val(this.id)' id='" + json[i].prd_id + "' class='tooltipped' data-position='left' data-delay='50' data-tooltip='Delete/Remove This Product'><i class='material-icons'>delete</i><a></td></tr>";
                                            }
                                        }
                                        disp += "</table>";
                                    }
                                    $("#res").slideDown();
                                    $("#res").html(disp);
                                    $('.materialboxed').materialbox();
                                    $('.tooltipped').tooltip({delay: 50});
                                }
                                xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                                xmlhttp.send("key=" + key);
                            }
                        }
                    }
                }
            }

            function set_cat()
            {
                var val = $("#cat_sel").is(":checked");//alert(val);
                if (val == true)
                {
                    $(".cat_div").slideDown();
                    var xmlhttp = new XMLHttpRequest();
                    xmlhttp.open("POST", "logic.php?page=get_cat", true);
                    xmlhttp.onreadystatechange = function ()
                    {
                        if (xmlhttp.readyState == 4 && xmlhttp.status == 200)
                        {
                            var response = xmlhttp.responseText;//alert(response);
                            var myArr = JSON.parse(response);
                            var jsonResponse = "<label class='active'>Choose Category</label>\
                                                <select name='cat_name' id='cat_check' onchange='result(\"newv\")' required class='black-text'>\
                                                <option value='' disabled selected>Choose your option</option>";
                            for (var i = 0; i <= myArr.length - 1; i++)
                            {
                                jsonResponse += "<option value='" + myArr[i].cat_name + "'>" + myArr[i].cat_name + "</option>";
                            }
                            jsonResponse += "</select>";
                        }
                        $(".cat_div").html(jsonResponse);
                        $('select').material_select();
                    }
                    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                    xmlhttp.send();
                } else if (val == false)
                {
                    $(".cat_div").html("");
                    $(".cat_div").slideUp();
                    $("#res").slideUp();
                    $("#res").html("");
                }
            }

            function set_mrp()
            {
                var val = $("#mrp_sel").is(":checked");//alert(val);
                if (val == true)
                {
                    $(".mrp_div").slideDown();
                } else if (val == false)
                {
                    $("#min").val("");
                    $("#max").val("");
                    $(".mrp_div").slideUp();
                }
            }

        </script>
    </head>
    <body>
        <?php
        // put your code here
        ?>
        <div class="">
            <h3 class='center-align'>Search Product</h3>
            <br/>
            <nav>
                <div class="nav-wrapper">
                    <div class="input-field">
                        <input id="search" placeholder="Search Product" type="search" autocomplete="off" required onkeyup="result(this)" style="height: 64px;">
                        <label for="search"><i class="material-icons">search</i></label>
                        <i class="material-icons" onclick="$('#search').val(''), result(null)">close</i>
                    </div>
                </div>
            </nav>
            <div class="row center" style="margin-top: 10px;">
                <div class="col s12 m3 l3 red-text" style="margin-top: 15px;">
                    <input type="checkbox" id="cat_sel" onchange="set_cat()" />
                    <label for="cat_sel">Search By Category:</label>
                </div>
                <div class="input-field col s12 m9 l3 cat_div" hidden>

                </div>
            </div>
            <div class="row center" style="margin-top: 10px;">
                <div class="col s12 m3 l3 red-text" style="margin-top: 15px;margin-right: 27px;padding-right: 39px;">
                    <input type="checkbox" id="mrp_sel" onchange="set_mrp()" />
                    <label for="mrp_sel">Search By Mrp:</label>
                </div>
                <div class="input-field col s12 m3 l3 offset-m1 mrp_div" hidden>
                    <input id="min" type="number" class="validate">
                    <label for="min">Minimum</label>
                </div>
                <div class="input-field col s12 m3 l3 offset-m1 mrp_div" hidden>
                    <input id="max" type="number" class="validate">
                    <label for="max">Maximum</label>
                </div>
            </div>
            <div id="res" hidden> <!--style="color: black;min-width: 400px; width: 400px;position: fixed;z-index: 2;background-color: white;color: black;margin-top: -18px;border-bottom-left-radius: 10px;border-bottom-right-radius: 10px;font-size: 15px;"-->

            </div>
        </div>
    </body>
    <script>
        $(document).ready(function () {
            $('select').material_select();
        });
    </script>
</html>
