<?php

?>
<script type="text/javascript">
    function setval(obj)
    {
        var id = obj.id;
        id = id.substr(0, 3);//alert(id);
        var pid = obj.id;
        pid = pid.substr(3, id.length);//alert(pid);
        var val = $('#qty' + pid).val();
        var qty = ["0.5", "1", "1.5", "2", "2.5", "3", "3.5", "4", "4.5", "5"];
        //alert(qty.length);
        var index = "";
        if (id == "add")
        {
            index = qty.indexOf(val);
            //alert("current :" + index);
            if (index <= 8)
            {
                index++;
                if (index > 8)
                {
                    $('#qty' + pid).val(qty[index]);
                    $('#add' + pid).addClass('disabled');
                    $('#add' + pid).prop('onclick', null).off('click');
                } else {
                    //alert("now :" + index);
                    $('#qty' + pid).val(qty[index]);
                    $('#rem' + pid).removeClass('disabled');
                    $('#rem' + pid).attr('onclick', 'setval(this)');
                }
            }
        } 
        
    }
    
    
    function setval1(obj)
    {
        var id = obj.id;
        id = id.substr(0, 3);//alert(id);
        var pid = obj.id;
        pid = pid.substr(3, id.length);//alert(pid);
        var val = $('#qty' + pid).val();
        var qty = ["0.5", "1", "1.5", "2", "2.5", "3", "3.5", "4", "4.5", "5"];
        //alert(qty.length);
        var index = "";
         if (id == "rem")
        {
            index = qty.indexOf(val);
            //alert("current :" + index);
            if (index == 9)
            {
                index--;
                $('#qty' + pid).val(qty[index]);
                $('#add' + pid).removeClass('disabled');
                $('#add' + pid).attr('onclick', 'setval(this)');
            } else if (index == 1)
            {
                index--;
                $('#qty' + pid).val(qty[index]);
                $('#rem' + pid).addClass('disabled');
                $('#rem' + pid).prop('onclick', null).off('click');
            } else {
                index--;
                $('#qty' + pid).val(qty[index]);
            }
        }
        
    }
    
    
    

    function add_cart(obj)
    {
        var ud_id = "<?php echo $_SESSION['ud_id']; ?>";
        if (ud_id == "")
        {
            Materialize.toast("Login to add in cart!", 4000);
        } else {
            var prd_name = obj.value;
            var prd_id = obj.id;
            var qty = $("#qty" + prd_id).val();//alert(qty);
            //alert("user_id=" + encodeURIComponent(ud_id) + "&prd_id=" + encodeURIComponent(prd_id) + "&qty=" + encodeURIComponent(qty));
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.open("POST", "./logic.php?page=add_cart_wl", true);
            xmlhttp.onreadystatechange = function ()
            {
                if (xmlhttp.readyState == 4 && xmlhttp.status == 200)
                {
                    var response = xmlhttp.responseText;//alert(response);
                    if (response == "2")
                    {
                        Materialize.toast(prd_name + " Already In Cart !", 4000);
                    } else if (response == "0")
                    {
                        Materialize.toast(prd_name + " Failed To Add In Your Cart !", 4000);
                    } else if (response == "1")
                    {
                        Materialize.toast(prd_name + " Added To Your Cart !", 4000);
                    }
                }
            }
            xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xmlhttp.send("user_id=" + encodeURIComponent(ud_id) + "&prd_id=" + encodeURIComponent(prd_id) + "&qty=" + encodeURIComponent(qty));
        }
    }

    function add_cart_wl(obj)
    {
        var ud_id = "<?php echo $_SESSION['ud_id']; ?>";
        if (ud_id == "")
        {
            Materialize.toast("Login to add in cart!", 4000);
        } else {
            var prd_name = obj.value;
            var prd_id = obj.id;
            var qty = $("#qty" + prd_id).val();//alert(qty);
            //alert("user_id=" + encodeURIComponent(ud_id) + "&prd_id=" + encodeURIComponent(prd_id) + "&qty=" + encodeURIComponent(qty));
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.open("POST", "./logic.php?page=add_cart_wl", true);
            xmlhttp.onreadystatechange = function ()
            {
                if (xmlhttp.readyState == 4 && xmlhttp.status == 200)
                {
                    var response = xmlhttp.responseText;//alert(response);
                    if (response == "2")
                    {
                        Materialize.toast(prd_name + " Already In Cart !", 4000);
                    } else if (response == "0")
                    {
                        Materialize.toast(prd_name + " Failed To Add In Your Cart !", 4000);
                    } else if (response == "1")
                    {
                        Materialize.toast(prd_name + " Added To Your Cart !", 4000);
                        $("#wlprd" + prd_id).remove();
                    }
                }
            }
            xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xmlhttp.send("user_id=" + encodeURIComponent(ud_id) + "&prd_id=" + encodeURIComponent(prd_id) + "&qty=" + encodeURIComponent(qty));
        }
    }

    function add_wl(obj)
    {
        var ud_id = "<?php echo $_SESSION['ud_id']; ?>";
        if (ud_id == "")
        {
            Materialize.toast("Login to add in WishList!", 4000);
        } else {
            var prd_name = obj.value;
            var prd_id = obj.id;
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.open("POST", "./logic.php?page=add_wl", true);
            xmlhttp.onreadystatechange = function ()
            {
                if (xmlhttp.readyState == 4 && xmlhttp.status == 200)
                {
                    var response = xmlhttp.responseText;
                    if (response == "0")
                    {
                        Materialize.toast(prd_name + " Failed To Add In WishList !", 4000);
                    } else if (response == "1")
                    {
                        Materialize.toast(prd_name + " Added To WishList !", 4000);
                    } else if (response == "2")
                    {
                        Materialize.toast(prd_name + " Already In WishList !", 4000);
                    }
                }
            }
            xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xmlhttp.send("user_id=" + encodeURIComponent(ud_id) + "&prd_id=" + encodeURIComponent(prd_id));
        }
    }

    function submit_data()
    {
        var user = $("#email").val();
        var pass = $("#pwd").val();
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.open("POST", "logic.php?page=login", true);
        xmlhttp.onreadystatechange = function ()
        {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200)
            {
                var response = xmlhttp.responseText;//alert(response);
                //alert(response.length);
                response = response.trim();
                if (response == "4")
                {
                    Materialize.toast("Welcome Admin!!", 2000);
                    window.location = "./Admin_panel/Panel.php"; //link ur url or if possible do in logic only ok ?
                } else if (response == "1")
                {
                    Materialize.toast("Welcome!!", 2000);
                    window.location = "./Home.php"; //link ur url or if possible do in logic only ok ?ok
                } else if (response == "2")
                {
                    Materialize.toast("Username Or Password Incorrect!!", 2000);
                } else if (response == "5")
                {
                    $("#msg_usr").show();
                    $("#msg_usr").html("Contact Admin By Having <a href='#'>Inquiry</a> About It !!");
                    Materialize.toast("You Are Disabled By Admin !!", 2000);
                    $('#msg_usr').delay(5000).fadeOut('slow');
                } else {
                    Materialize.toast("Some Error!!", 2000);
                }
            }
            //$(".main_disp").html(jsonResponse);
        }
        xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xmlhttp.send("user=" + user + "&pass=" + pass);
    }

    function set_details()
    {
        var phn = $("#txtnumber").val();
        var add = $("#txtaddress1").val();
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
        xmlhttp.send("phn=" + encodeURIComponent(phn) + "&add=" + encodeURIComponent(add) + "&id=<?php echo $_SESSION['ud_id']; ?>");
    }

    function check_mail() //this function is for check mail is already exist or not ?
    {
        var mail = $("#rg_email").val();// $("#rg_email") it is jquery which was used against javascript 
        // document.getElementById('rg_email').value = $('#rg_email').val()
        // $() use for refrence || # is used for "id"
        if (mail == "" || null)
        {
            $("#submitbtn").addClass("disabled");
        } else {
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.open("POST", "logic.php?page=check_mail", true);
            xmlhttp.onreadystatechange = function ()
            {
                if (xmlhttp.readyState == 4 && xmlhttp.status == 200)
                {
                    var response = (xmlhttp.responseText).trim();//alert(response);
                    if (response == 1)
                    {
                        $("#rg_email").addClass("invalid");
                        $("#rgsubmitbtn").addClass("disabled");
                        $("#rg_email").focus();
                        $("#rgsubmitbtn").prop("disabled", true);
                        Materialize.toast("Email Already Exist !!", 2000);
                    } else if (response == 0)
                    {
                        if ($('#rg_email').hasClass("invalid")) {
                            $("#rgsubmitbtn").prop("disabled", true);
                            Materialize.toast("E-Mail Format (Ex. abc@xyz.com) !!", 2000);
                            $("#rg_email").focus();
                        } else {
                            $("#rg_email").addClass("valid");
                            $("#rgsubmitbtn").prop("disabled", false);
                            $("#rgsubmitbtn").removeClass("disabled");
                        }
                    }
                }
                //$(".main_disp").html(jsonResponse);
            }
            xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xmlhttp.send("mail=" + mail);
        }
    }

    function register()
    {
        var fname = $("#first_name").val();
        var lname = $("#last_name").val();
        var ps = $("#password").val();
        var mail = $("#rg_email").val();//alert(mail);
        if (fname == "" || null || lname == "" || null || ps == "" || null || mail == "" || null)
        {
            Materialize.toast("Please Fill Required Fields !!");
        } else {
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.open("POST", "logic.php?page=registration", true);
            xmlhttp.onreadystatechange = function ()
            {
                if (xmlhttp.readyState == 4 && xmlhttp.status == 200)
                {
                    var response = (xmlhttp.responseText).trim();//alert(response);
                    if (response == 1)
                    {
                        Materialize.toast("Registration Successful !!", 2000);
                        window.location = "./profile.php";
                    } else if (response == 0)
                    {
                        Materialize.toast("Registration Failed !!", 2000);
                    }
                }
                //$(".main_disp").html(jsonResponse);
            }
            xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xmlhttp.send("fn=" + fname + "&ln=" + lname + "&ps=" + ps + "&mail=" + mail);
        }
    }
</script>
