<?php
session_start();
include './connection.php';
if (!isset($_SESSION['ud_id'])) {
    header("Location:../404.html");
} else {
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title></title>
        <link rel="stylesheet" href="./css/materialize.css" />
        <link rel="stylesheet" href="./css/materialize.min.css" />
        <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <!--<script type="text/javascript" src="js/jquery-2.1.1.min.js"></script>-->
        <script type="text/javascript" src="./js/jquery-3.0.0.js"></script>
        <script type="text/javascript" src="./js/materialize.min.js"></script>
        <script type="text/javascript" src="./js/my/uniqueModal.js"></script>
        <!--<script type="text/javascript" src="js/my/uniqueModal.min.js"></script>-->
        <script>
            function set_offers()
            {
                var jsonResponse = "<table class='responsive-table striped centered'>\n\
                                        <thead>\n\
                                            <tr>\n\
                                                <th data-field='id'>No</th>\n\
                                                <th data-field='offer_name'>Offer Name</th>\n\
                                                <th data-field='Offer_type'>Offer Type</th>\n\
                                                <th data-field='Promo/Discount'>Promo/Discount</th>\n\
                                                <th data-field='Product Name'>Product Name</th>\n\
                                                \n\
                                                <th data-field='Promo/Discount'>Delete</th>\n\
                                            </tr>\n\
                                        </thead>\n\
                                    <tbody>";
                var xmlhttp =  new XMLHttpRequest();
                xmlhttp.open("GET","setpage.php?page=offer",true);
                xmlhttp.onreadystatechange = function()
                {
                    if(xmlhttp.readyState==4 && xmlhttp.status==200)
                    {
                        var response = xmlhttp.responseText;//alert(response);
                        var myArr = JSON.parse(response);
                        var type = '';
                        var pd = '';
                        if(myArr.length==0)
                                    {
                                        jsonResponse +="<tr><td colspan='6'><center>No Offers!!</center></td></tr>";
                                    }
                                    else
                                    {
                        for(var i=0;i<=myArr.length-1;i++)
                            {
                                if(myArr[i].ofd_type=="0") {
                                    type = "Discount";
                                    pd = myArr[i].ofd_discount+"%";
                                }
                                else if(myArr[i].ofd_type=="1") {
                                    type = "Promo Code";
                                    pd = myArr[i].ofd_code;
                                }
                                jsonResponse += "<tr id='up"+myArr[i].ofd_id+"'><td>"+(i+1)+"</td><td>"+myArr[i].ofd_name+"</td><td>"+type+"</td><td>"+pd+"</td><td>"+myArr[i].ofd_product+"</td><td><i style='padding-top: 12px;' id='"+myArr[i].ofd_id+"' onclick='del_ofr(this);' class='small material-icons btn-floating btn-large waves-effect waves-light red'>clear</i></td>\n\
                                                 \
                                                 <div id='modal1' class='modal modal-fixed-footer'>\
                                                 <div class='modal-content'>\
                                                 <h4><center></center></h4>\
                                                 <p id='ofr_details' class='ofr_details'>\
                                                  </p>\
                                                  </div>\
                                                  <div class='modal-footer'>\
                                                  \
                                                  </div>\
                                                  </div></td>\n\
                                                  \n\
                                                  </tr>";
                                     }
                            }
                    }
                    $("#show").html(jsonResponse);
                }
                xmlhttp.send();
            }

            function openModalProductDetailFromSearch(obj) {
                uniqueModal.init();
                uniqueModal.setTitle("Offer Details");
                uniqueModal.setAction([
//                    uniqueModal.createAction("Update Details", "$(\"#update_form\").submit();"),
                    uniqueModal.createAction('Cancel', 'uniqueModal.close()')
                ]);
                return set_ofr_details(obj);
            }

            function set_ofr_details(obj)
            {
                var a = obj.id;//alert(a);
                var req = obj.name;
                //alert("setpage.php?page=Update_offer&req="+req+"&ofdname="+a);
                var jsonResponse = "";
                var xmlhttp =  new XMLHttpRequest();
                    xmlhttp.open("GET","setpage.php?page=Update_offer&req="+req+"&ofdname="+a,true);
                    xmlhttp.onreadystatechange = function()
                    {
                        if(xmlhttp.readyState==4 && xmlhttp.status==200)
                        {
                            var response = xmlhttp.responseText;//alert(response);
                            var myArr = JSON.parse(response);//alert(myArr[1]);
                            var type = '';
                            var pd = '';
                            if(myArr[0].ofd_type=="0") {
                                    type = "Discount";
                                    pd = myArr[0].ofd_discount;
                                    minamt = myArr[0].ofd_min_amount;

                                    jsonResponse += "<form id='update_form' action='update_offers.php' method='GET'><table cellpadding='0' width='800px' class='td-spacing' style='border: 0px red solid;'>\n\
                                                    <input type='hidden' name='ofd_id' id='"+myArr[0].ofd_id+"' value='"+myArr[0].ofd_id+"' />\n\
                                                             <table class='centered'>\n\
                                                                    <tr>\n\
                                                                            <td>Offer Name</td>\n\
                                                                            <td><input type='text' id='ofd_name' name='ofd_name' value='"+myArr[0].ofd_name+"' readonly /></td>\n\
                                                                    </tr>\n\
                                                                    <tr>\n\
                                                                            <td>Offer "+type+"</td>\n\
                                                                            <td><input type='text' id='ofd_dis' name='ofd_dis' value='"+pd+"' readonly /></td>\n\
                                                                    </tr>\n\
                                                                    <tr>\n\
                                                                            <td width='200px'>Offer Minimum Amount</td>\n\
                                                                            <td><input type='text' id='ofd_min' name='ofd_min' value='"+minamt+"' readonly /></td>\n\
                                                                    </tr>\n\
                                                                    <tr>\n\
                                                                            <td>Offer Start Date</td>\n\
                                                                            <td><input id='ofd_start' name='ofd_start' type='date' class='datepicker' value='"+myArr[0].ofd_start_date+"' readonly /></td>\n\
                                                                    </tr>\n\
                                                                    <tr>\n\
                                                                            <td>Offer End Date</td>\n\
                                                                            <td><input id='ofd_end' name='ofd_end' type='date' class='datepicker' value='"+myArr[0].ofd_end_date+"' readonly /></td>\n\
                                                                    </tr>\n\
                                                                    <tr id='prd'>\n\
                                                                            <td>Product</td>\n\
                                                                            <td>\n\
                                                                            <div id='set_option'><input type='text' id='ofd_prd' onclick='set_main_cat_ofr(this);' name='ofd_prd' value='"+myArr[0].prd_name+"' readonly /></div>\n\
                                                                            <div id='set_option2' class='sub_cat'></div>\
                                                                            <div id='set_option3' class='sub_cat'></div>\
                                                                            <div id='set_option4' class='prd_name'></div>\
                                                                            </td>\
                                                                    </tr>\n\
                                                             </table>\n\
                                                    <input type='hidden' name='search_update' value='search_update'>\n\
                                                        </td>\n\
                                                    </tr>\n\
                                             </table>";

                                }
                                else if(myArr[0].ofd_type=="1") {
                                    type = "Promo Code";
                                    pd = myArr[0].ofd_code;
                                    minamt = myArr[0].ofd_amount;
                                    pro=myArr[0].ofd_product;

                                    jsonResponse += "<form id='update_form'  method='GET'><table cellpadding='0' width='800px' class='td-spacing' style='border: 0px red solid;'>\n\
                                                    <input type='hidden' name='ofd_id' id='"+myArr[0].ofd_id+"' value='"+myArr[0].ofd_id+"' />\n\
                                                             <table class='centered'>\n\
                                                                    <tr>\n\
                                                                            <td>Offer Name</td>\n\
                                                                            <td><input type='text' id='ofd_name' name='ofd_name' value='"+myArr[0].ofd_name+"' readonly /></td>\n\
                                                                    </tr>\n\
                                                                    <tr>\n\
                                                                            <td>Offer "+type+"</td>\n\
                                                                            <td><input type='text' id='ofd_code' name='ofd_code' value='"+pd+"' readonly /></td>\n\
                                                                    </tr>\n\
                                                                    <tr>\n\
                                                                            <td width='200px'>Offer Amount</td>\n\
                                                                            <td><input type='text' id='ofd_min' name='ofd_min' value='"+minamt+"' readonly /></td>\n\
                                                                    </tr>\n\
                                                                    <tr>\n\
                                                                            <td>Offer Product</td>\n\
                                                                            <td><input id='ofd_product' name='ofd_product' type='text'  value='"+pro+"' readonly /></td>\n\
                                                                    </tr>\n\
                                                                    <tr>\n\
                                                                            \n\
                                                                            \n\
                                                                    </tr>\n\
                                                                    <tr id='uses'>\n\
                                                                            \n\
                                                                            \n\
                                                                    </tr>\n\
                                                                    <tr id='uses'>\n\
                                                                            \n\
                                                                            \n\
                                                                    </tr>\n\
                                                             </table>\n\
                                                    \n\
                                                        </td>\n\
                                                    </tr>\n\
                                             </table>";

                                }
                            //alert(jsonResponse);
                        }
                        //console.log("1");
                        uniqueModal.setContent(jsonResponse);
                        uniqueModal.open({dismissible: false});
                    }
                    xmlhttp.send();
            }

            function del_ofr(obj)
            {
                var id = obj.id;//alert(id);
                var xmlhttp =  new XMLHttpRequest();
                    xmlhttp.open("GET","setpage.php?page=del_ofr&id="+id,true);
                    xmlhttp.onreadystatechange = function()
                    {
                        if(xmlhttp.readyState==4 && xmlhttp.status==200)
                        {
                            var response = xmlhttp.responseText;//alert(response);
                            if(response=="1")
                                {
                                    $("#up"+id).slideUp();
                                    Materialize.toast("Offer Deleted!!", 3000);
                                }
                                else
                                    {
                                        $("#up"+id).effect( "shake", { direction: "up", times: 4, distance: 10}, 1000 );
                                        Materialize.toast("Offer Failed To Deleted!!", 3000);
                                    }
                        }
                    }
                    xmlhttp.send();
            }

            function set_main_cat_ofr(obj)
            {   
                $("#set_option").slideUp();
                var xmlhttp =  new XMLHttpRequest();
                    xmlhttp.open("GET","setpage.php?page=get_set_main_cat",true);
                    xmlhttp.onreadystatechange = function()
                    {
                        if(xmlhttp.readyState==4 && xmlhttp.status==200)
                        {
                            var response = xmlhttp.responseText;//alert(response);
                            var myArr = JSON.parse(response);
                            var jsonResponse = "<select name='cat_name' id='product_cat' onchange='set_sub_option_ofr(this)'  required>\
                                                      <option value='' disabled selected>Choose Main Category</option>"
                            for(var i=0;i<=(myArr.length-1);i++)
                                {
                                   jsonResponse += "<option value='"+myArr[i].cat_name+"'>"+myArr[i].cat_name+"</option>";
                                }
                                jsonResponse +="</select><div id='set_sub_get_opt' />";
                        }
                        //alert(jsonResponse);
                        $("#set_option2").html(jsonResponse);
                        $('select').material_select();
                    }
                    xmlhttp.send();
            }

            function set_sub_option_ofr(obj)
            {   
                var xmlhttp =  new XMLHttpRequest();
                    xmlhttp.open("GET","setpage.php?page=set options&cat="+encodeURIComponent(obj.value),true);
                    xmlhttp.onreadystatechange = function()
                    {
                        if(xmlhttp.readyState==4 && xmlhttp.status==200)
                        {
                            var response = xmlhttp.responseText;//alert(response);
                            var myArr = JSON.parse(response);//alert(myArr[1]);
                            var jsonResponse = "<select name='cat_sub_name' onchange='set_prd_option_ofr(this)'>\n\
                                                <option value='' disabled selected>Choose your option</option>";
                                                for(var i=0;i<=(myArr.length-1);i++)
                                                {
                                                    jsonResponse += "<option value='"+myArr[i].cat_sub_name+"'>"+myArr[i].cat_sub_name+"</option>";
                                                }

                                                jsonResponse += "</select>";
                        }
                        $("#set_option3").html(jsonResponse);
                        $('select').material_select();
                    }
                    xmlhttp.send();
            }

            function set_prd_option_ofr(obj)
            {   
                Materialize.toast("Now Select Product For Discount!!", 4000);
                var a = obj.value;//alert(a);
                var jsonResponse = "<select name='prd_name' required><option value='' disabled selected>Choose Product</option>";
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
                    $("#set_option4").html(jsonResponse);
                    $('select').material_select();
                }
                xmlhttp.send();
            }

    </script>
    </head>
    <body onload="set_offers()">
        <?php
        // put your code here
        ?>
        <center>
            <div id="show"> <!--class="z-depth-1"-->

            </div>
        </center>
    </body>
    <script>
       $(document).ready(function(){
    // the "href" attribute of .modal-trigger must specify the modal ID that wants to be triggered
    $('.modal-trigger').leanModal(
    {
        dismissible: true,
    }
    );
  });
  </script>
</html>
<?php
error_reporting(E_ERROR | E_PARSE);
$ofd_id = $_GET['ofd_id'];
$ofd_type=$_GET['ofd_dis'];
$ofd_cat_name = $_GET["cat_name"];
$ofd_cat_sub_name = $_GET['cat_sub_name'];
$ofd_prd_name = $_GET['prd_name'];
if(strlen($ofd_type) <= 2)
{
    $qry = mysqli_query($con,"select p.*, ct.* from `product_details` p LEFT JOIN `category` ct ON ct.`cat_id` = p.`cat_id` where p.`prd_name`='$ofd_prd_name'");
    while($row=mysqli_fetch_array($qry))
    {
        $catid = $row['cat_id'];
        $prd_id = $row['prd_id'];
    }
    $qry2 = mysqli_query($con,"UPDATE `offer_details` SET `cat_id`='$catid',`prd_id`='$prd_id' WHERE ofd_id='$ofd_id'");
    if(!$qry2)
    {
        //$msg2 = "Offer Not Updated!!";
        header("refresh:0; url= Update_Offer.php");
    }
    else
    {
        $msg2 = "Offer Updated Successfully!!";
        header("refresh:0; url= Update_Offer.php");
    }
}
}
    ?>
        <script>
            Materialize.toast("<?php echo $msg2; ?>", 4000);
        </script>