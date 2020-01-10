<?php
session_start();
if (!isset($_SESSION['ud_id'])) {
    header("Location:../404.html");
} else {
include './connection.php'; 
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
  <head>
    <title></title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <link rel="stylesheet" href="./css/materialize.css" />
    <link href="./iconfont/material-icons.css" rel="stylesheet">
    <script type="text/javascript" src="./js/chance.js"></script>
<!--    <script type="text/javascript" src="js/jquery-2.1.1.min.js"></script>
    --><style>
            input[type=number]::-webkit-inner-spin-button,
input[type=number]::-webkit-outer-spin-button {
    -webkit-appearance: none;
    -moz-appearance: none;
    appearance: none;
    margin: 0;
}

    </style>
    <script>
        var global_id = "";
//        function validate(obj)
//        {
//            var ofrname= obj.value;   //alert(val);
//            var xmlhttp =  new XMLHttpRequest();
//            xmlhttp.open("GET","validation.php?validation=ofr_name_validation&ofr_name="+ofrname,true);
//            xmlhttp.onreadystatechange = function()
//            {
//                if(xmlhttp.readyState==4 && xmlhttp.status==200)
//                {
//                    var response = xmlhttp.responseText;//alert(response);
//                    if(response=="0")
//                        {
//                            document.getElementById("add_product_submit").className = "waves-effect waves-light btn";
//                            document.getElementById("offer_name").className = "valid";
//                            document.getElementById("offer_name_err").textContent = "";
//                            $(".change_btn").removeClass('waves-effect waves-light btn disabled');
//                            $(".change_btn").addClass('waves-effect waves-light btn');
//                            document.getElementById("add_ofr_submit").disabled=false;
//                        }
//                        else
//                            {
//                                //alert("Product with same name is Already There!!!");
//                                document.getElementById("offer_name_err").style = "Color: Red;"
//                                document.getElementById("offer_name_err").textContent = "Offer with same name is Already There!!!";
//                                Materialize.toast('Offer with same name is Already There!!!', 4000);
//                                document.getElementById("offer_name").className = "invalid"
//                                $("#ofr_name").focus();
//                                $(".change_btn").removeClass('waves-effect waves-light btn');
//                                $(".change_btn").addClass('waves-effect waves-light btn disabled');
//                                document.getElementById("add_ofr_submit").disabled=true;
//                            }
//                }
//            }
//            xmlhttp.send();
//        }
      function set_code_box(obj)
        {   
            var a = obj.value;//alert(a);
            if(a=="Promo Code")
                {
                    $("#options_prd_discount").slideUp();
                    global_id="ofr_amt";
                    var promo = chance.bb_pin();
                    var response = "<div class='row'>\
                                        <div class='col s6 center'><input type='text' name='offer_promo' id='promocode' onblur='set_code_box(this)' oninput='if(this.value.length > 8) {this.value = this.value.slice(0,8);}' class='center' style='color: red;font-size: xx-large;' readonly value='"+promo+"'></input></div>\n\
                                        <div class='col s6 center'><a class='waves-effect waves-light btn' onclick='set_custom(this);'>Custom Code</a></div>\n\
                                        <div class='row'><div class='center col s12' id='promo_code_err'></div>\n\
                                    </div>";
                    //var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
                    //alert(Math.floor(Math.random() * possible.length));
                    document.getElementById("set_div_pos").style="margin-top: -20px;";
                    document.getElementById("set_div_pos2").style="margin-top: -10px;";
                    if($("#ofr_amt") != null)
                        {
                            $("#ofr_dis").attr("id", "ofr_amt");
                        }
                        else
                            {
                                $("#ofr_amt").attr("id", "ofr_dis");
                            }
                            document.getElementById("ofr_amt_dis_lbl").innerText = "Offer Amount";
                    $("#ofr_amt").attr("id", "ofr_amt");
                    $("#promo_code").html(response);
                    $("#ofr_amt").removeAttr("disabled");
                    $("#product_cat").removeAttr("required");
                    $("#set_sub_cat_options").removeAttr("required");
                    $("#set_prd_options").removeAttr("required");
                    $("#ofr_amt").focus();
                }
                else if(a=="Discount")
                {
                    $("#product_cat").attr("required");
                    $("#set_sub_cat_options").attr("required");
                    $("#set_prd_options").attr("required");
                    $("#options_prd_discount").slideDown();
                    global_id="ofr_dis";
                    $("#promo_code").html("");
                    document.getElementById("set_div_pos").style="margin-top: -80px;";
                    document.getElementById("ofr_amt_dis_lbl").innerText = "Offer Discount";
                    $("#ofr_amt").val("");
                    $("#ofr_amt").attr("id", "ofr_dis");
                    $("#ofr_dis").removeAttr('disabled');
                    $("#ofr_dis").focus();
                }
                else
                {
                    var code = obj.value;
                    if (/\s/.test(code) || code=== null)
                    {
                            document.getElementById("promo_code_err").style = "Color: Red;align: center;"
                            document.getElementById("promo_code_err").textContent = "Promo code Does Not Contain Spaces!!!";
                            Materialize.toast('Promo code Does Not Contain Spaces!!!', 4000);
                            document.getElementById("promocode").className = "invalid"
                            $("#promocode").focus();
                            document.getElementById('promocode').focus();
                    }
                    else
                        {
                            if(code.length < 8)
                            {
                                document.getElementById("promo_code_err").style = "Color: Red;align: center;"
                                document.getElementById("promo_code_err").textContent = "Promo code should be equal to 8 Digits or Letters!!!";
                                Materialize.toast('Promo code should be equal to 8 Digits or Letters!!!', 4000);
                                document.getElementById("promocode").className = "invalid"
                                $("#promocode").focus();
                                document.getElementById('promocode').focus();
                            }
                            else
                            {
                                document.getElementById("promocode").style = "Color: Green;text-align: center;font-size: xx-large;"
                                document.getElementById("promo_code_err").textContent = "";
                                document.getElementById("promocode").className = "valid";
                                $("#promocode").attr("readonly","true");
                                $("#ofr_amt").removeAttr("disabled");
                                $("#ofr_min_amt").removeAttr("disabled");
                                //$("#ofr_amt").focus();
                            }
                        }
                }
        }

        function set_custom(obj)
        {
            $("#promocode").removeAttr("readonly");
            document.getElementById('promocode').value = "";
            $("#promocode").focus();
        }

        function check_amt_dis(obj)
        {
            //console.log($("#ofr_amt") != null);
            if(obj.id == "ofr_amt")
                {
                    if(obj.value.length > 5)
                    {
                        obj.value = obj.value.slice(0,5);
                    }
                }
                else
                    {
                        if(obj.value.length > 2)
                        {
                            obj.value = obj.value.slice(0,2);
                        }
                    }
        }

        function check_amt(obj)
        {
                if(obj.id == "ofr_amt")
                {
                    var amt = parseInt($("#ofr_amt").val());
                    if($("#ofr_amt").val() === null || $("#ofr_amt").val() === "")
                        {
                            Materialize.toast("Amount Can't Be Empty!!!", 4000);
                            $("#ofr_amt").focus();
                            //exit();
                        }
                        else
                            {
                                if(amt <= 0)
                                {
                                //alert("Sell Rate Is Greater Than MRP!!");
                                document.getElementById("ofr_amt_err").style = "Color: Red;"
                                document.getElementById("ofr_amt_err").textContent = "Amount Should Be Greater Than 0!!!";
                                Materialize.toast('Amount Should Be Greater Than 0!!!', 4000);
                                document.getElementById("ofr_amt").className = "invalid";
                                $("#ofr_amt").focus();
                                }
                                else
                                {
                                document.getElementById("ofr_amt_err").textContent = "";
                                document.getElementById("ofr_amt").className = "valid";
                                $("#ofr_min_amt").removeAttr("disabled");
                                $("#ofr_min_amt").focus();
                                }
                            }
                }
                else if(obj.id=="ofr_dis")
                    {
                        var amt2 = parseInt($("#ofr_dis").val());
                        if($("#ofr_dis").val() === null || $("#ofr_dis").val() === "")
                        {
                            Materialize.toast("Discount Can't Be Empty!!!", 4000);
                            $("#ofr_dis").focus();
                            //exit();
                        }
                        else
                            {
                                if(amt2 <= 0)
                                {
                                //alert("Sell Rate Is Greater Than MRP!!");
                                document.getElementById("ofr_amt_err").style = "Color: Red;"
                                document.getElementById("ofr_amt_err").textContent = "Discount Should Be Greater Than 0!!!";
                                Materialize.toast('Discount Should Be Greater Than 0!!!', 4000);
                                document.getElementById("ofr_dis").className = "invalid";
                                $("#ofr_dis").focus();
                                }
                                else
                                {
                                document.getElementById("ofr_amt_err").textContent = "";
                                document.getElementById("ofr_dis").className = "valid";
                                $("#ofr_min_amt").removeAttr("disabled");
                                $("#ofr_min_amt").focus();
                                }
                            }
                    }
                else
                    {
                        var amt = parseInt($("#ofr_min_amt").val());
                        if(amt <= 0)
                        {
                            //alert("Sell Rate Is Greater Than MRP!!");
                            document.getElementById("ofr_min_amt_err").style = "Color: Red;"
                            document.getElementById("ofr_min_amt_err").textContent = "Minimum Amount Should Be Greater Than 0!!!";
                            Materialize.toast('Minimum Amount Should Be Greater Than 0!!!', 4000);
                            document.getElementById("ofr_min_amt").className = "invalid";
                            $("#ofr_min_amt").removeAttr('disabled');
                            $("#ofr_min_amt").focus();
                        }
                        else if($("#ofr_min_amt").val() === null || $("#ofr_min_amt").val() === "")
                        {
                            Materialize.toast("Minimum Amount Can't Be Empty!!!", 4000);
                            $("#ofr_min_amt").focus();
                            exit();
                        }
                        else
                        {
                            document.getElementById("ofr_min_amt_err").textContent = "";
                            document.getElementById("ofr_min_amt").className = "valid";
                            Materialize.toast("Now Select Offer Start Date!!!", 4000);
                            $("#ofr_start_date").removeAttr("disabled");
                            //alert("Now Select Offer Start Date!!");
                            //$("#ofr_start_date").focus();
                        }
                    }
        }

        function check_start_date(obj)
        {
            var d = $("#ofr_start_date").val();
            var currentTime = new Date();
            var month = currentTime.getMonth() + 1
            var day = currentTime.getDate()
            var year = currentTime.getFullYear()
            //document.write(month + "/" + day + "/" + year) 19 April, 2016
            var today = day+" "+month+","+year;
            if(d < today)
            {
                document.getElementById("ofr_start_date_err").style = "Color: Red;"
                document.getElementById("ofr_start_date").className = "invalid";
                $("#ofr_start_date_err").html("Start Date Can't Before Today's Date!!");
                Materialize.toast("Start Date Can't Before Today's Date!!", 4000);
                $("#ofr_start_date").focus();
            }
            else
            {
                    document.getElementById("ofr_start_date").className = "valid";
                    $("#ofr_start_date_err").html("");
                    $("#ofr_end_date").removeAttr("disabled");
                    Materialize.toast("Now Select End Date!!", 4000);
                    $("#ofr_end_date").focus();
            }
        }

        function check_dates(obj)
        {
            var start = new Date(document.getElementById("ofr_start_date").value).getTime();//alert(start);
            var End = new Date(document.getElementById("ofr_end_date").value).getTime();//alert(End);
            if(start === End)
                {
                    //alert("Dates Are Same!!");
                    document.getElementById("ofr_end_date_err").style = "Color: Red;"
                    $("#ofr_end_date_err").html("Start & End Date Are Same!!");
                    Materialize.toast("Start & End Date Are Same!!", 4000);
                    document.getElementById("ofr_end_date").className = "invalid";
                    $("#ofr_end_date").focus();
                }
                else if(start > End)
                    {
                        //alert("End Date Can't Before Start Date!!");
                        document.getElementById("ofr_end_date_err").style = "Color: Red;"
                        $("#ofr_end_date_err").html("End Date Can't Before Start Date!!");
                        Materialize.toast("End Date Can't Before Start Date!!", 4000);
                        document.getElementById("ofr_end_date").className = "invalid";
                        $("#ofr_end_date").focus();
                    }
                    else
                        {
                            document.getElementById("ofr_end_date").className = "valid";
                            $("#ofr_end_date_err").html("");
                            $("#ofr_uses_per_user").removeAttr("disabled");
                            if(global_id=="ofr_dis")
                                {
                                    $("#set_div_pos5").slideUp();
                                    $("#ofr_uses_per_user").removeAttr("required");
                                    $("#product_cat").focus();
                                }
                                else
                                    {
                                        $("#set_div_pos5").slideDown();
                                        $("#ofr_uses_per_user").attr("required");
                                        $("#ofr_uses_per_user").focus();
                                    }
                        }

        }

        function set_sub_cat(obj)
        {
            Materialize.toast("Now Select Sub Category!!", 4000);
            var a = obj.value;//alert(a);
            var jsonResponse = "<select name='cat_sub_name' onchange='set_prd_opt(this);' required><option value='' disabled selected>Choose Sub Category</option>";
                var xmlhttp =  new XMLHttpRequest();
                xmlhttp.open("GET","setpage.php?page=set_prd_sub_cat&cat_main="+a,true);
                xmlhttp.onreadystatechange = function()
                {
                    if(xmlhttp.readyState==4 && xmlhttp.status==200)
                    {
                        var response = xmlhttp.responseText;//alert(response);
                        var myArr = JSON.parse(response);//alert(myArr[0].cat_sub_name);
                        for(var i=0;i<=myArr.length-1;i++)
                            {
                                jsonResponse += "<option value='"+myArr[i].cat_sub_name+"'>"+myArr[i].cat_sub_name+"</option>";
                            }
                            jsonResponse +="</select>";
                    }
                    //alert($("#set_sub_cat_options")==null);
                    //alert(jsonResponse);
                    $("#set_sub_cat_options").html(jsonResponse);
                    $('select').material_select();
                }
                xmlhttp.send();
        }

        function set_prd_opt(obj)
        {
            Materialize.toast("Now Select Product For Discount!!", 4000);
            var a = obj.value;//alert(a);
            var jsonResponse = "<select name='prd_name' onchange='set_add_button();' required><option value='' disabled selected>Choose Product</option>";
                var xmlhttp =  new XMLHttpRequest();
                xmlhttp.open("GET","setpage.php?page=set_prd_name_ofr&catsubname="+a,true);
                xmlhttp.onreadystatechange = function()
                {
                    if(xmlhttp.readyState==4 && xmlhttp.status==200)
                    {
                        var response = xmlhttp.responseText;//alert(response);
                        var myArr = JSON.parse(response);//alert(myArr[0].cat_sub_name);
                        for(var i=0;i<=myArr.length-1;i++)
                            {
                                jsonResponse += "<option value='"+myArr[i].prd_name+"'>"+myArr[i].prd_name+"</option>";
                            }
                            jsonResponse +="</select>";
                    }
                    //alert($("#set_sub_cat_options")==null);
                    //alert(jsonResponse);
                    $("#set_prd_options").html(jsonResponse);
                    $('select').material_select();
                }
                xmlhttp.send();
        }

        function set_add_button()
        {
            document.getElementById("add_ofr_submit").disabled=false;
            $(".change_btn").removeClass('waves-effect waves-light btn disabled');
            $(".change_btn").addClass('waves-effect waves-light btn');
            //$("#add_ofr_submit").removeAttr('disabled');
        }

        function set_align_in_button()
        {
            document.getElementById('add_ofr_submit');
            document.getElementById('add_ofr_submit');
        }

        function checkfield()
        {
            //console.log($("#ofr_start_date").val());
            //console.log($("#ofr_end_date").val());
            if($("#ofr_start_date").val() != null&'' || $("#ofr_end_date").val() != null&'')
                {
                    
                }
                else
                    {
                        Materialize.toast("Offer Start or End Date Are Required!!", 3000);
                    }
        }
    </script>
  </head>
  <body>
    <script type="text/javascript" src="./js/jquery-3.0.0.js"></script>
    <script type="text/javascript" src="./js/materialize.min.js"></script>
    <center>
        <table style='width:500px;border:0px red solid;' class='hoverable'><tr><td>
                    <form name="vatsal" action='addcode.php'  method='POST' nonvalidate>
                <table>
                    <tr>
                        <th colspan='2'>
                            <center class='brand-logo center' style='font-size:20px;'>Add Offers</center>
                        </th>
                    </tr>
                    <tr>
                        <td>
                            <div class='input-field col s6'>
                                <input placeholder='Offer Name' name='offer_name' id='offer_name' required type='text'>
                                <label for='offer_name' style='margin-left:-11px;margin-top:2px;'>Offer Name</label>
                            </div>
                                <div id="offer_name_err" style="margin: 0px;" class="center" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="input-field col s12">
                                <select id="offer_type" name="offer_type" onchange="set_code_box(this);" required>
                                    <option value="" disabled selected>Choose Offer Type</option>
                                    <option value="Promo Code">Promo Code</option>
                                    <option value="Discount">Discount</option>
                                </select>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div id="promo_code" style="height: 50px;"/>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="input-field col s12" id="set_div_pos" style="margin-top: -80px;">
                                <input id="ofr_amt" name="offer_amt" type='number' disabled onchange="check_amt(this);" onblur="check_amt(this);" onchange="transfer(this);" oninput="check_amt_dis(this);" class="ofr_amt_dis validate" required>
                                <label for="ofr_amt" id="ofr_amt_dis_lbl" style="margin-left:-11px;margin-top:2px;">Offer Amount</label>
                            </div>
                            <div id="ofr_amt_err" style="margin: 0px;" class="center" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="input-field col s12" id="set_div_pos2" style="margin-top: -30px;">
                                <input id="ofr_min_amt" name="offer_min_amt" type='number' disabled onchange="check_amt(this);" onblur="check_amt(this);" oninput="if(this.value.length > 5) {this.value = this.value.slice(0,5);}" class="validate" required>
                                <label for="ofr_min_amt" style="margin-left:-11px;margin-top:2px;">Offer Minimum Amount</label>
                            </div>
                            <div id="ofr_min_amt_err" style="margin: 0px;" class="center" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="input-field col s12" id="set_div_pos3" style="margin-top: 0px;">
                                <input id="ofr_start_date" name="ofr_start_date" type='date' disabled onchange="check_start_date(this)" class="datepicker validate" required>
                                <label for="ofr_start_date" style="margin-left:-11px;margin-top:2px;">Offer Start Date</label>
                            </div>
                            <div id="ofr_start_date_err" style="margin: 0px;" class="center" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="input-field col s12" id="set_div_pos4" style="margin-top: 0px;">
                                <input id="ofr_end_date" name="ofr_end_date" type='date' disabled onchange="check_dates(this);" class="datepicker Validate" required>
                                <label for="ofr_end_date" style="margin-left:-11px;margin-top:2px;">Offer End Date</label>
                            </div>
                            <div id="ofr_end_date_err" style="margin: 0px;" class="center" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="input-field col s12" id="set_div_pos5">
                                <input id="ofr_uses_per_user" name="uses_per_user" type='number' disabled oninput="if(this.value.length > 1) {this.value = this.value.slice(0,1);}" class="validate" required>
                                <label for="ofr_uses_per_user" style="margin-left:-11px;margin-top:2px;">Offer Uses Per User</label>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td id="options_prd_discount"><center>
                                                  <select name="cat_name" id="product_cat" onchange="set_prd_opt(this)"  required>
                                                      <option value='' disabled selected>Choose Main Category</option>
                                                  <?php
                                                    $qry = mysqli_query($con,"SELECT COUNT(*) FROM category");
                                                    while ($row2 = mysqli_fetch_array($qry))
                                                    {
                                                    $no = $row2[0];
                                                    }
                                                  for($i=0;$i<=$no-1;$i++)
                                                  {
                                                    $qry2 = mysqli_query($con,"SELECT DISTINCT cat_name FROM category");
                                                    while($row = mysqli_fetch_array($qry2))
                                                    {
                                                  ?>
                                                    <!--<input class="with-gap" required name="cat_id" type="radio" id="<?php echo $row['cat_sub_name']; ?>" value="<?php echo $row['cat_sub_name']; ?>"  />
                                                    <label for="<?php echo $row['cat_sub_name']; ?>"><?php echo $row['cat_sub_name']; ?></label>-->
                                                    <option value="<?php echo $row['cat_name'] ?>" ><?php echo $row['cat_name'] ?></option>
                                                    <!--<br/>-->
                                                  <?php
                                                    }
                                                    break;
                                                  }
                                                  ?>
                                                  </select>
                                                  <div id="set_sub_cat_options" class="sub_cat">
                                                  
                                                  </div>
                                                  <div id="set_prd_options" class="sub_cat">

                                                  </div>
                                    </center>
                                    </td>
                    </tr>
                    <tr>
                        <td>
                            <center>
<!--                                <input id='add_ofr_submit' class='change_btn waves-effect waves-light btn disabled' value="Add Offer" />-->
                                 <button class='btn waves-effect waves-light' type='submit'  id="add_prd_btn">Add offer</button>
                     </center>
                        </td>
                    </tr>
                </table>
            </form>
        </td></tr></table>
    </center>
  </body>
  <script>
$(document).ready(function() {
$('select').material_select();
$('.datepicker').pickadate({
    selectMonths: true, // Creates a dropdown to control month
    selectYears: 15 // Creates a dropdown of 15 years to control year
  });
});

  
  </script>

   

</html>