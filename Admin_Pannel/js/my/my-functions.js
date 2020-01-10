    var response_for_order = "";

    function check_for_orders()
    {
            var xmlhttp =  new XMLHttpRequest();
            xmlhttp.open("GET","setpage.php?page=check_for_new_order_exist",true);
            xmlhttp.onreadystatechange = function()
            {
                if(xmlhttp.readyState==4 && xmlhttp.status==200)
                {
                     response_for_order = xmlhttp.responseText;//alert(response);
                    if(response_for_order == "0")
                    {
                        $("#notify").removeClass("new badge");
                        $("#order_btn").css("width","auto");
                        if($("#notify").text()=="0")
                                {
                                    $("#notify").html("");
                                }
                    }
                    else
                    {
                        $("#order_btn").css("width","197px");
                        $("#notify").style="margin-right: -60px";
                        $("#notify").addClass("new badge");
                        $("#notify").html(response_for_order);
                    }
                    set_order_details();
                }
                //$(".main_disp").html(jsonResponse);
            }
            xmlhttp.send();
    }

//setInterval(check_for_orders(), 1000);

    function set_order_details()
    {
            var ord = response_for_order;
            var xmlhttp =  new XMLHttpRequest();
            xmlhttp.open("GET","Search.php?search=orders&loop="+ord,true);
            var jsonResponse="<center>\n\
                               <table id='ord_dtls' class='responsive-table striped centered' style='border-top: 2px red solid;border-left: 2px red solid;border-right: 2px red solid;'>\n\
                                    <thead>\n\
                                        <tr>\n\
                                            <th data-field='Name'>No.</th>\n\
                                            <th data-field='Name'>Customer Name</th>\n\
                                            <th data-field='Name'>Order Type</th>\n\
                                            <th data-field='Name'>Order Status</th>\n\
                                            <th data-field='Name'>Approve/Disapprove</th>\n\
                               </thead><tbody>";
            xmlhttp.onreadystatechange = function()
            {
                if(xmlhttp.readyState==4 && xmlhttp.status==200)
                {
                    var response = xmlhttp.responseText;//alert(response);
                    var myArr = JSON.parse(response);//alert(myArr.length);
                    if(response_for_order == "0")
                    {
                        jsonResponse += "<tr><td colspan='5'>No New Orders!!</td></tr>";
                    }
                    else
                        {
                            for(var i=0;i<=myArr.length-1;i++)
                                {
                                    //jsonResponse += "<tr id='"+(i+1)+"'><td>"+(i+1)+"</td><td><a href='#!' id='"+myArr[i].ord_id+"&"+myArr[i].ud_id+"' onclick='get_details(this)'>"+myArr[i].ud_fname+" "+myArr[i].ud_lname+"</a></td><td>"+myArr[i].ord_type+"</td><td>"+myArr[i].ord_status+"</td><td class='center'><a href='#1' id='"+myArr[i].ord_id+"' onclick='set_ord_status(this)' value='1'><i class='small material-icons' style='color: #69f0ae;'>thumb_up</i></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href='#0' id='"+myArr[i].ord_id+"' onclick='set_ord_status(this)' value='0'><i class='small material-icons' style='color: #f44336'>thumb_down</i></a></td></tr><tr id='dt"+myArr[i].ord_id+"'><td colspan='5'><div id='p"+myArr[i].ord_id+"' /></td></tr>"; //style='color: black;min-width: 480px;position: fixed;z-index: 2;background-color: white;color: black;margin-top: -18px;border-bottom-left-radius: 10px;border-bottom-right-radius: 10px;font-size: 15px;'
                                    jsonResponse += "<tr id='"+myArr[i].ord_id+"'><td>"+(i+1)+"</td><td><a href='#!' id='"+myArr[i].ord_id+"&"+myArr[i].ud_id+"' onmouseover='get_details(this)'>"+myArr[i].ud_fname+" "+myArr[i].ud_lname+"</a></td><td>"+myArr[i].ord_type+"</td><td>"+myArr[i].ord_status+"</td><td class='center'><a href='#1' id='"+myArr[i].ord_id+"' onclick='set_ord_status(this)' value='1'><i class='small material-icons' style='color: #69f0ae;'>thumb_up</i></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href='#0' id='"+myArr[i].ord_id+"' onclick='set_ord_status(this)' value='0'><i class='small material-icons' style='color: #f44336'>thumb_down</i></a></td></tr><tr id='dt"+myArr[i].ord_id+"' hidden><td colspan='5'><div id='p"+myArr[i].ord_id+"' style='z-index: 10;margin-left: -7px;margin-right: -7px;' class='chkdiv'></div></td></tr>"; //style='position: fixed;z-index: 2;overflow: hidden;background-color: white;margin-left: -7px;width: 544px;'
                                    //jsonResponse += "<tr><td>"+myArr[i].loop+"</td><td>"+myArr[i].user_fname+" "+myArr[i].user_lname+"</td><td>"+myArr[i].ord_shipping_type+"</td><td>"+myArr[i].ord_status+"</td><td><button id='"+myArr[i].ord_id+"' onclick='set_ord_status(this)' value='1'><i class='small material-icons' style='color: #69f0ae;'>thumb_up</i></button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<button id='"+myArr[i].ord_id+"' onclick='set_ord_status(this)' value='0'><i class='small material-icons' style='color: #f44336'>thumb_down</i></button></td></tr>";
                                }
                        }
                        jsonResponse +="</tbody></table></center>";
                }
                $("#ord_details").html(jsonResponse);
             }
             xmlhttp.send();
    }

    function get_details(obj)
    {
        var id = obj.id;//alert(id);
        var ord_id = id.substring(0, id.indexOf('&'));//alert("ord:"+ord_id);
        var ud_id = id.substr(id.lastIndexOf("&")+1);//alert("ud:"+ud_id);
        //$("#dt"+id).slideUp();
        if($("#dt"+ord_id).is(':hidden'))
        {
            var jsonResponse = "<center><h4>Order Summary</h4><hr/></center><table class='responsive-table striped centered' style='border-left: 2px red solid;border-right: 2px red solid;'><thead><th>Product Name</th><th>Quantity<th>Unit Price</th><th>Total<th></thead><tbody>";
            var xmlhttp =  new XMLHttpRequest();
            xmlhttp.open("GET","setpage.php?page=get_orders_user&userid="+ud_id+"&ordid="+ord_id,true);
            xmlhttp.onreadystatechange = function()
            {
                if(xmlhttp.readyState==4 && xmlhttp.status==200)
                {
                    var response = xmlhttp.responseText;
                    var myArr = JSON.parse(response);
                    var tot=0;
                    for(var i=0;i<=myArr.length-1;i++)
                        {
                            jsonResponse += "<td>"+myArr[i].prd_name+"</td><td>"+myArr[i].oprd_qty+"</td><td>&#x20B9; "+myArr[i].oprd_per_price+"</td><td>"+(myArr[i].oprd_qty*myArr[i].oprd_per_price)+"</td></tr>";
                            //  jsonResponse += "";
                        }
                        for(var j=0;j<=myArr.length-1;j++)
                        {
                            tot += Number((myArr[j].oprd_qty*myArr[j].oprd_per_price));
                            //alert(tot);
                        }
                        jsonResponse +="</tbody></table>\n\
                                        <font style='margin-right:-350px;'>\n\
                                        <b>Total: &#x20B9; "+tot+"</b>\n\
                                        </font>\n\
                                        <br/><br/>\n\
                                        <b>Discount :</b> &#x20B9; "+myArr[0].oprd_discount+"<br/>\n\
                                        <b>Shipping Charges:</b> &#x20B9; 0<br/>\n\
                                        <b>Total Bill:</b> &#x20B9; "+parseInt(tot-myArr[0].oprd_discount)+"<br/>\n\
                                        <b>Address:</b> "+myArr[0].ord_shipping_address+"<br/>\n\
                                        <hr style='border:2px red solid;'/>";
                }
                $("#dt"+ord_id).slideDown();
                $("#p"+ord_id).html(jsonResponse);
            }
            xmlhttp.send();
            }
            else
            {
                    $("#dt"+ord_id).slideUp();
            }
    }

    function set_ord_status(obj)
    {
        var ordid = obj.id;//alert(ordid);
        var val = obj.href;//alert(val);
        var v = val.slice(-1);
        var jsonResponse="<center>\n\
                               <table id='ord_dtls' class='responsive-table striped centered'>\n\
                                    <thead>\n\
                                        <tr>\n\
                                            <th data-field='Name'>No.</th>\n\
                                            <th data-field='Name'>Customer Name</th>\n\
                                            <th data-field='Name'>Order Type</th>\n\
                                            <th data-field='Name'>Order Status</th>\n\
                                            <th data-field='Name'>Approve/Disapprove</th>\n\
                                    </thead><tbody>";
        var xmlhttp =  new XMLHttpRequest();
        xmlhttp.open("GET","setpage.php?page=setordstatus&id="+ordid+"&value="+v,true);
        xmlhttp.onreadystatechange = function()
        {
            if(xmlhttp.readyState==4 && xmlhttp.status==200)
            {
                var response = xmlhttp.responseText;//alert(response);
                var myArr = JSON.parse(response);
                if(myArr[0].msg=="Order Succesfully Approved!!")
                    {
                        $("#"+ordid).slideUp();
                        $("#p"+ordid).slideUp();
                        var ord_val = $("#notify").text();//alert(ord_val);
                        ord_val = ord_val - 1;//alert(ord_val);
                        $("#notify").html(ord_val);
                        $("#"+myArr[0].id).slideUp();
                        if($("#notify").text()=="0")
                            {
                                $("#notify").html("");
                                $("#notify").removeClass("new badge");
                                $("#order_btn").css("width","auto");
                                jsonResponse += "<tr><td colspan='5'>No New Orders!!</td></tr>";
                                $("#ord_details").html(jsonResponse);
                            }
                            Materialize.toast(myArr[0].msg, 3000);
                    }
                    else
                        {
                            $("#"+ordid).slideUp();
                            $("#p"+ordid).slideUp();
                            var ord_val = $("#notify").text();//alert(ord_val);
                            ord_val = ord_val - 1;//alert(ord_val);
                            $("#notify").html(ord_val);
                            //alert("#"+myArr[0].id);
                            //document.getElementById("ordr_dtls").deleteRow("#"+myArr[0].id);
                            $("#"+myArr[0].id).slideUp();
                            if($("#notify").text()=="0")
                            {
                                $("#notify").html("");
                                $("#notify").removeClass("new badge");
                                $("#order_btn").css("width","auto");
                                jsonResponse += "<tr><td colspan='5'>No New Orders!!</td></tr>";
                                $("#ord_details").html(jsonResponse);
                            }
                            Materialize.toast(myArr[0].msg, 3000);
                        }
            }
        }
        xmlhttp.send();
    }

    var response_for_order2 = "";

    function check_for_orders2()
    {
            var xmlhttp =  new XMLHttpRequest();
            xmlhttp.open("GET","setpage.php?page=check_for_new_order_exist2",true);
            xmlhttp.onreadystatechange = function()
            {
                if(xmlhttp.readyState==4 && xmlhttp.status==200)
                {
                     response_for_order2 = xmlhttp.responseText;//alert(response);
                    if(response_for_order2 == "0")
                    {
                        $("#notify2").removeClass("new badge");
                        $("#apprd_btn").css("width","auto");
                        if($("#notify2").text()=="0")
                                {
                                    $("#notify2").html("");
                                }
                    }
                    else
                    {
                        $("#apprd_btn").css("width","200px");
                        $("#notify2").style="margin-right: -60px";
                        $("#notify2").addClass("new badge");
                        $("#notify2").html(response_for_order2);
                    }
                    set_order_details2();
                }
                //$(".main_disp").html(jsonResponse);
            }
            xmlhttp.send();
    }

//setInterval(check_for_orders(), 1000);

    function set_order_details2()
    {   
            var ord = response_for_order2;
            var xmlhttp =  new XMLHttpRequest();
            xmlhttp.open("GET","Search.php?search=orders2&loop="+ord,true);
            var jsonResponse="<center>\n\
                               <table id='ord_dtls' class='responsive-table striped centered'>\n\
                                    <thead>\n\
                                        <tr>\n\
                                            <th data-field='Name'>No.</th>\n\
                                            <th data-field='Name'>Customer Name</th>\n\
                                            <th data-field='Name'>Order Type</th>\n\
                                            <th data-field='Name'>Order Status</th>\n\
                                            <th data-field='Name'>Dispatch</th>\n\
                                            <th data-field='Name'>Bill</th></tr>\n\
                                    </thead><tbody>";

            xmlhttp.onreadystatechange = function()
            {
                if(xmlhttp.readyState==4 && xmlhttp.status==200)
                {
                    var response = xmlhttp.responseText;//alert(response);
                    var myArr = JSON.parse(response);//alert(myArr.length);
                    if(response_for_order2 == "0")
                    {
                        jsonResponse += "<tr><td colspan='5'>No New Orders!!</td></tr>";
                    }
                    else
                        {
                            for(var i=0;i<=myArr.length-1;i++)
                                {
                                    jsonResponse += "<tr id='"+(i+1)+"'><td>"+(i+1)+"</td><td>"+myArr[i].ud_fname+" "+myArr[i].ud_lname+"</td><td>"+myArr[i].ord_type+"</td><td>"+myArr[i].ord_status+"</td><td><a href='#!' id='"+myArr[i].ord_id+"' onclick='set_ord_status2(this)' value='2'><i class='small material-icons' style='color: #69f0ae;'>done</i></a></td><td><a href='./AdminPanel/bill11.php?ud_id="+myArr[i].ud_id+"&ord_id="+myArr[i].ord_id+"' target='_blank'>Bill</a></td></tr>";
                                    //jsonResponse += "<tr><td>"+myArr[i].loop+"</td><td>"+myArr[i].user_fname+" "+myArr[i].user_lname+"</td><td>"+myArr[i].ord_shipping_type+"</td><td>"+myArr[i].ord_status+"</td><td><button id='"+myArr[i].ord_id+"' onclick='set_ord_status(this)' value='1'><i class='small material-icons' style='color: #69f0ae;'>thumb_up</i></button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<button id='"+myArr[i].ord_id+"' onclick='set_ord_status(this)' value='0'><i class='small material-icons' style='color: #f44336'>thumb_down</i></button></td></tr>";
                                }
                        }
                        jsonResponse +="</tbody></table>";
                }
                $("#ord_details2").html(jsonResponse);
             }
             xmlhttp.send();
    }

    function set_ord_status2(obj)
    {
        var ordid = obj.id;//alert(id);
        //var val = obj.href;alert(val);
        //var v = val.slice(-1);
        var jsonResponse="<center>\n\
                               <table id='ord_dtls' class='responsive-table striped centered'>\n\
                                    <thead>\n\
                                        <tr>\n\
                                            <th data-field='Name'>No.</th>\n\
                                            <th data-field='Name'>Customer Name</th>\n\
                                            <th data-field='Name'>Order Type</th>\n\
                                            <th data-field='Name'>Order Status</th>\n\
                                            <th data-field='Name'>Dispatch</th>\n\
                                    </thead><tbody>";
        var xmlhttp =  new XMLHttpRequest();
        xmlhttp.open("GET","setpage.php?page=setordstatus2&id="+ordid,true);
        xmlhttp.onreadystatechange = function()
        {
            if(xmlhttp.readyState==4 && xmlhttp.status==200)
            {
                var response = xmlhttp.responseText;//alert(response);
                var myArr = JSON.parse(response);
                if(myArr[0].msg=="Order Succesfully Dispatched!!")
                    {
                        var ord_val = $("#notify2").text();//alert(ord_val);
                        ord_val = ord_val - 1;//alert(ord_val);
                        $("#notify2").html(ord_val);
                        $("#"+myArr[0].id).slideUp();
                        if($("#notify2").text()=="0")
                            {
                                $("#notify2").html("");
                                $("#notify2").removeClass("new badge");
                                $("#apprd_btn").css("width","auto");
                                jsonResponse += "<tr><td colspan='5'>No New Orders!!</td></tr>";
                                $("#ord_details2").html(jsonResponse);
                            }
                            Materialize.toast(myArr[0].msg, 3000);
                    }
                    else
                        {
                            var ord_val = $("#notify2").text();//alert(ord_val);
                            ord_val = ord_val - 1;//alert(ord_val);
                            $("#notify2").html(ord_val);
                            $("#"+myArr[0].id).slideUp();
                            if($("#notify2").text()=="0")
                            {
                                $("#notify2").html("");
                                $("#notify2").removeClass("new badge");
                                $("#apprd_btn").css("width","auto");
                                jsonResponse += "<tr><td colspan='5'>No New Orders!!</td></tr>";
                                $("#ord_details2").html(jsonResponse);
                            }
                            Materialize.toast(myArr[0].msg, 3000);
                        }
            }
        }
        xmlhttp.send();
    }


    var response_for_order3 = "";

    function check_for_orders3()
    {
            var xmlhttp =  new XMLHttpRequest();
            xmlhttp.open("GET","setpage.php?page=check_for_new_order_exist3",true);
            xmlhttp.onreadystatechange = function()
            {
                if(xmlhttp.readyState==4 && xmlhttp.status==200)
                {
                     response_for_order3 = xmlhttp.responseText;//alert(response);
                    if(response_for_order3 == "0")
                    {
                        $("#notify3").removeClass("new badge");
                        $("#disp_btn").css("width","auto");
                        if($("#notify3").text()=="0")
                                {
                                    $("#notify3").html("");
                                }
                    }
                    else
                    {
                        $("#disp_btn").css("width","197px");
                        $("#notify3").style="margin-right: -60px";
                        $("#notify3").addClass("new badge");
                        $("#notify3").html(response_for_order3);
                    }
                    set_order_details3();
                }
                //$(".main_disp").html(jsonResponse);
            }
            xmlhttp.send();
    }

//setInterval(check_for_orders(), 1000);

    function set_order_details3()
    {
            var ord = response_for_order3;
            var xmlhttp =  new XMLHttpRequest();
            xmlhttp.open("GET","Search.php?search=orders3&loop="+ord,true);
            var jsonResponse="<center>\n\
                               <table id='ord_dtls' class='responsive-table striped centered'>\n\
                                    <thead>\n\
                                        <tr>\n\
                                            <th data-field='Name'>No.</th>\n\
                                            <th data-field='Name'>Customer Name</th>\n\
                                            <th data-field='Name'>Order Type</th>\n\
                                            <th data-field='Name'>Order Status</th>\n\
                                            <th data-field='Name'>Deliever</th>\n\
                                    </thead><tbody>";

            xmlhttp.onreadystatechange = function()
            {
                if(xmlhttp.readyState==4 && xmlhttp.status==200)
                {
                    var response = xmlhttp.responseText;//alert(response);
                    var myArr = JSON.parse(response);//alert(myArr.length);
                    if(response_for_order3 == "0")
                    {
                        jsonResponse += "<tr><td colspan='5'>No New Orders!!</td></tr>";
                    }
                    else
                        {
                            for(var i=0;i<=myArr.length-1;i++)
                                {
                                    jsonResponse += "<tr id='"+(i+1)+"'><td>"+(i+1)+"</td><td>"+myArr[i].ud_fname+" "+myArr[i].ud_lname+"</td><td>"+myArr[i].ord_type+"</td><td>"+myArr[i].ord_status+"</td><td><a href='#!' id='"+myArr[i].ord_id+"' onclick='set_ord_status3(this)' value='3'><i class='small material-icons' style='color: #69f0ae;'>done_all</i></a></td></tr>";
                                    //jsonResponse += "<tr><td>"+myArr[i].loop+"</td><td>"+myArr[i].user_fname+" "+myArr[i].user_lname+"</td><td>"+myArr[i].ord_shipping_type+"</td><td>"+myArr[i].ord_status+"</td><td><button id='"+myArr[i].ord_id+"' onclick='set_ord_status(this)' value='1'><i class='small material-icons' style='color: #69f0ae;'>thumb_up</i></button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<button id='"+myArr[i].ord_id+"' onclick='set_ord_status(this)' value='0'><i class='small material-icons' style='color: #f44336'>thumb_down</i></button></td></tr>";
                                }
                        }
                        jsonResponse +="</tbody></table>";
                }
                $("#ord_details3").html(jsonResponse);
             }
             xmlhttp.send();
    }

    function set_ord_status3(obj)
    {
        var ordid = obj.id;//alert(id);
        //var val = obj.href;//alert(val);
        //var v = val.slice(-1);
        var jsonResponse="<center>\n\
                               <table id='ord_dtls' class='responsive-table striped centered'>\n\
                                    <thead>\n\
                                        <tr>\n\
                                            <th data-field='Name'>No.</th>\n\
                                            <th data-field='Name'>Customer Name</th>\n\
                                            <th data-field='Name'>Order Type</th>\n\
                                            <th data-field='Name'>Order Status</th>\n\
                                            <th data-field='Name'>Delieverd</th>\n\
                                    </thead><tbody>";
        var xmlhttp =  new XMLHttpRequest();
        xmlhttp.open("GET","setpage.php?page=setordstatus3&id="+ordid,true);
        xmlhttp.onreadystatechange = function()
        {
            if(xmlhttp.readyState==4 && xmlhttp.status==200)
            {
                var response = xmlhttp.responseText;//alert(response);
                var myArr = JSON.parse(response);
                if(myArr[0].msg=="Order Succesfully Delieverd!!")
                    {
                        var ord_val = $("#notify3").text();//alert(ord_val);
                        ord_val = ord_val - 1;//alert(ord_val);
                        $("#notify3").html(ord_val);
                        //alert("#"+myArr[0].id);
                        //document.getElementById("ordr_dtls").deleteRow("#"+myArr[0].id);
                        $("#"+myArr[0].id).slideUp();
                        if($("#notify3").text()=="0")
                            {
                                $("#notify3").html("");
                                $("#notify3").removeClass("new badge");
                                $("#disp_btn").css("width","auto");
                                jsonResponse += "<tr><td colspan='5'>No New Orders!!</td></tr>";
                                $("#ord_details3").html(jsonResponse);
                            }
                            Materialize.toast(myArr[0].msg, 3000);
                    }
                    else
                        {
                            var ord_val = $("#notify3").text();//alert(ord_val);
                            ord_val = ord_val - 1;//alert(ord_val);
                            $("#notify3").html(ord_val);
                            //alert("#"+myArr[0].id);
                            //document.getElementById("ordr_dtls").deleteRow("#"+myArr[0].id);
                            $("#"+myArr[0].id).slideUp();
                            if($("#notify3").text()=="0")
                            {
                                $("#notify3").html("");
                                $("#notify3").removeClass("new badge");
                                $("#disp_btn").css("width","auto");
                                jsonResponse += "<tr><td colspan='5'>No New Orders!!</td></tr>";
                                $("#ord_details3").html(jsonResponse);
                            }
                            Materialize.toast(myArr[0].msg, 3000);
                        }
            }
        }
        xmlhttp.send();
    }

    var response_for_order4 = "";

    function check_for_orders4()
    {
            var xmlhttp =  new XMLHttpRequest();
            xmlhttp.open("GET","setpage.php?page=check_for_new_order_exist4",true);
            xmlhttp.onreadystatechange = function()
            {
                if(xmlhttp.readyState==4 && xmlhttp.status==200)
                {
                     response_for_order4 = xmlhttp.responseText;//alert(response);
                    if(response_for_order4 == "0")
                    {
                        $("#notify4").removeClass("new badge");
                        $("#disappr_btn").css("width","auto");
                        if($("#notify4").text()=="0")
                                {
                                    $("#notify4").html("");
                                }
                    }
                    else
                    {
                        $("#disappr_btn").css("width","197px");
                        $("#notify4").style="margin-right: -60px";
                        $("#notify4").addClass("new badge");
                        $("#notify4").html(response_for_order4);
                    }
                    set_order_details4();
                }
                //$(".main_disp").html(jsonResponse);
            }
            xmlhttp.send();
    }

//setInterval(check_for_orders(), 1000);

    function set_order_details4()
    {
            var ord = response_for_order4;
            var xmlhttp =  new XMLHttpRequest();
            xmlhttp.open("GET","Search.php?search=orders4&loop="+ord,true);
            var jsonResponse="<center>\n\
                               <table id='ord_dtls' class='responsive-table striped centered'>\n\
                                    <thead>\n\
                                        <tr>\n\
                                            <th data-field='Name'>No.</th>\n\
                                            <th data-field='Name'>Customer Name</th>\n\
                                            <th data-field='Name'>Order Type</th>\n\
                                            <th data-field='Name'>Order Status</th>\n\
                                            <th data-field='Name'>Approve</th>\n\
                                    </thead><tbody>";

            xmlhttp.onreadystatechange = function()
            {
                if(xmlhttp.readyState==4 && xmlhttp.status==200)
                {
                    var response = xmlhttp.responseText;//alert(response);
                    var myArr = JSON.parse(response);//alert(myArr.length);
                    if(response_for_order4 == "0")
                    {
                        jsonResponse += "<tr><td colspan='5'>No New Orders!!</td></tr>";
                    }
                    else
                        {
                            for(var i=0;i<=myArr.length-1;i++)
                                {
                                    jsonResponse += "<tr id='"+(i+1)+"'><td>"+(i+1)+"</td><td>"+myArr[i].ud_fname+" "+myArr[i].ud_lname+"</td><td>"+myArr[i].ord_type+"</td><td>"+myArr[i].ord_status+"</td><td><a href='#1' id='"+myArr[i].ord_id+"' onclick='set_ord_status4(this)' value='1'><i class='small material-icons' style='color: #69f0ae;'>thumb_up</i></a></td></tr>";
                                    //jsonResponse += "<tr><td>"+myArr[i].loop+"</td><td>"+myArr[i].user_fname+" "+myArr[i].user_lname+"</td><td>"+myArr[i].ord_shipping_type+"</td><td>"+myArr[i].ord_status+"</td><td><button id='"+myArr[i].ord_id+"' onclick='set_ord_status(this)' value='1'><i class='small material-icons' style='color: #69f0ae;'>thumb_up</i></button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<button id='"+myArr[i].ord_id+"' onclick='set_ord_status(this)' value='0'><i class='small material-icons' style='color: #f44336'>thumb_down</i></button></td></tr>";
                                }
                        }
                        jsonResponse +="</tbody></table>";
                }
                $("#ord_details4").html(jsonResponse);
             }
             xmlhttp.send();
    }

    function set_ord_status4(obj)
    {
        var ordid = obj.id;//alert(id);
        var val = obj.href;//alert(val);
        var v = val.slice(-1);
        var jsonResponse="<center>\n\
                               <table id='ord_dtls' class='responsive-table striped centered'>\n\
                                    <thead>\n\
                                        <tr>\n\
                                            <th data-field='Name'>No.</th>\n\
                                            <th data-field='Name'>Customer Name</th>\n\
                                            <th data-field='Name'>Order Type</th>\n\
                                            <th data-field='Name'>Order Status</th>\n\
                                            <th data-field='Name'>Approve</th>\n\
                                    </thead><tbody>";
        var xmlhttp =  new XMLHttpRequest();
        xmlhttp.open("GET","setpage.php?page=setordstatus4&id="+ordid+"&value="+v,true);
        xmlhttp.onreadystatechange = function()
        {
            if(xmlhttp.readyState==4 && xmlhttp.status==200)
            {
                var response = xmlhttp.responseText;//alert(response);
                var myArr = JSON.parse(response);
                if(myArr[0].msg=="Order Succesfully Approved!!")
                    {
                        var ord_val = $("#notify4").text();//alert(ord_val);
                        ord_val = ord_val - 1;//alert(ord_val);
                        $("#notify4").html(ord_val);
                        //alert("#"+myArr[0].id);
                        //document.getElementById("ordr_dtls").deleteRow("#"+myArr[0].id);
                        $("#"+myArr[0].id).slideUp();
                        if($("#notify4").text()=="0")
                            {
                                $("#notify4").html("");
                                $("#notify4").removeClass("new badge");
                                $("#disappr_btn").css("width","auto");
                                jsonResponse += "<tr><td colspan='5'>No New Orders!!</td></tr>";
                                $("#ord_details4").html(jsonResponse);
                            }
                            Materialize.toast(myArr[0].msg, 3000);
                    }
                    else
                        {
                            var ord_val = $("#notify4").text();//alert(ord_val);
                            ord_val = ord_val - 1;//alert(ord_val);
                            $("#notify4").html(ord_val);
                            $("#"+myArr[0].id).slideUp();
                            if($("#notify4").text()=="0")
                            {
                                $("#notify4").html("");
                                $("#notify4").removeClass("new badge");
                                $("#disappr_btn").css("width","auto");
                                jsonResponse += "<tr><td colspan='5'>No New Orders!!</td></tr>";
                                $("#ord_details4").html(jsonResponse);
                            }
                            Materialize.toast(myArr[0].msg, 3000);
                        }
            }
        }
        xmlhttp.send();
    }

    var response_for_order5 = "";

    function check_for_orders5()
    {
            var xmlhttp =  new XMLHttpRequest();
            xmlhttp.open("GET","setpage.php?page=check_for_new_order_exist5",true);
            xmlhttp.onreadystatechange = function()
            {
                if(xmlhttp.readyState==4 && xmlhttp.status==200)
                {
                     response_for_order5 = xmlhttp.responseText;//alert(response);
                    if(response_for_order5 == "0")
                    {
                        $("#notify5").removeClass("new badge");
                        $("#disptch_btn").css("width","auto");
                        if($("#notify5").text()=="0")
                                {
                                    $("#notify5").html("");
                                }
                    }
                    else
                    {
                        $("#disptch_btn").css("width","197px");
                        $("#notify5").style="margin-right: -60px";
                        $("#notify5").addClass("new badge");
                        $("#notify5").html(response_for_order5);
                    }
                    set_order_details5();
                }
                //$(".main_disp").html(jsonResponse);
            }
            xmlhttp.send();
    }

//setInterval(check_for_orders(), 1000);

    function set_order_details5()
    {
            var ord = response_for_order5;
            var xmlhttp =  new XMLHttpRequest();
            xmlhttp.open("GET","Search.php?search=orders5&loop="+ord,true);
            var jsonResponse="<center>\n\
                               <table id='ord_dtls' class='responsive-table striped centered'>\n\
                                    <thead>\n\
                                        <tr>\n\
                                            <th data-field='Name'>No.</th>\n\
                                            <th data-field='Name'>Customer Name</th>\n\
                                            <th data-field='Name'>Order Type</th>\n\
                                            <th data-field='Name'>Order Status</th>\n\
                                    </thead><tbody>";

            xmlhttp.onreadystatechange = function()
            {
                if(xmlhttp.readyState==4 && xmlhttp.status==200)
                {
                    var response = xmlhttp.responseText;//alert(response);
                    var myArr = JSON.parse(response);//alert(myArr.length);
                    if(response_for_order5 == "0")
                    {
                        jsonResponse += "<tr><td colspan='5'>No New Orders!!</td></tr>";
                    }
                    else
                        {
                            for(var i=0;i<=myArr.length-1;i++)
                                {
                                    jsonResponse += "<tr id='"+(i+1)+"'><td>"+(i+1)+"</td><td>"+myArr[i].ud_fname+" "+myArr[i].ud_lname+"</td><td>"+myArr[i].ord_type+"</td><td>"+myArr[i].ord_status+"</td></tr>";
                                    //jsonResponse += "<tr><td>"+myArr[i].loop+"</td><td>"+myArr[i].user_fname+" "+myArr[i].user_lname+"</td><td>"+myArr[i].ord_shipping_type+"</td><td>"+myArr[i].ord_status+"</td><td><button id='"+myArr[i].ord_id+"' onclick='set_ord_status(this)' value='1'><i class='small material-icons' style='color: #69f0ae;'>thumb_up</i></button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<button id='"+myArr[i].ord_id+"' onclick='set_ord_status(this)' value='0'><i class='small material-icons' style='color: #f44336'>thumb_down</i></button></td></tr>";
                                }
                        }
                        jsonResponse +="</tbody></table>";
                }
                $("#ord_details5").html(jsonResponse);
             }
             xmlhttp.send();
    }

    window.setInterval(function(){
    check_for_orders(),check_for_orders2(),check_for_orders3(),check_for_orders4(),check_for_orders5();
}, 100000);