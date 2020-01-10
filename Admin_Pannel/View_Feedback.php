<?php
session_start();
if (!isset($_SESSION['ud_id'])) {
    header("Location:../404.html");
} else {
    ?>
<html>
    <head>
        <link rel="stylesheet" href="./css/materialize.css" />
        <link rel="stylesheet" href="./css/materialize.min.css" />
        <link href="../iconfont/material-icons.css" rel="stylesheet">
        <!--<script type="text/javascript" src="js/jquery-2.1.1.min.js"></script>-->
        <script type="text/javascript" src="./js/jquery-3.0.0.js"></script>
        <script type="text/javascript" src="./js/materialize.min.js"></script>
        <script>
        function check_fdbck()
        {
            var jsonResponse = "<table class='striped highlight centered'><thead><tr><th data-field='No'>No</th><th data-field='Name'>Name</th><th data-field='E-Mail'>E-Mail</th><th data-field='Contact'>Contact</th><th data-field='Message'>Message</th></tr></thead><tbody><tr>";
            var xmlhttp =  new XMLHttpRequest();
            xmlhttp.open("GET","setpage.php?page=fdbck",true);
            xmlhttp.onreadystatechange = function()
            {
                if(xmlhttp.readyState==4 && xmlhttp.status==200)
                {
                    var response = xmlhttp.responseText;//alert(response);
                    var myArr = JSON.parse(response);
                    for(var i=0;i<=myArr.length-1;i++)
                        {
                            jsonResponse += "<td>"+(i+1)+"</td><td>"+myArr[i].ud_fname+" "+myArr[i].ud_lname+"</td><td>"+myArr[i].ud_email+"</td><td>"+myArr[i].ud_mobile+"</td><td>\n\
                            <a onclick='modal(this)' class='modal-trigger waves-effect waves-light btn' href='#modal"+i+"' id='"+myArr[i].fdbk_id+"'>View Message</a>\n\
                            <form id='formmsg' action='setpage.php?page=retrieve' method='post'>\n\
                            <div id='modal"+i+"' class='modal modal-fixed-footer'>\n\
                                <div class='modal-content'>\n\
                                    <h4 style='background-color: #ee6e73;color: white;padding-top: 8px;height: 50px;' class='brand-logo center' >Message</h4>\n\
                                        <p id='msg'>\n\
                                            <div style=''>\n\
                                                <label for='textarea1' style='margin-right: 520px;'>Message</label>\n\
                                                <textarea id='textarea1' class='materialize-textarea' readonly>"+myArr[i].fdbk_desc+"</textarea>\n\
                                                </div>\n\
                                            <br/>\n\
                                        </p>\n\
                                </div>\n\
                                <div class='modal-footer'>\n\
                                    <a href='#!' class='modal-action modal-close waves-effect waves-green btn ' style='margin: 6px 240;'>Close</a>\n\
                                </div>\n\
                              </form>\n\
                            </div>\n\
                            </td></tr>";
                        }
                        jsonResponse += "</tbody></table>";
                }
                $("#show").html(jsonResponse);
            }
            xmlhttp.send();
        }

        function modal(obj)
        {
            var id = obj.href.slice(-7);//alert(id);
            $(id).openModal();
        }
    </script>
    </head>
    <body onload="check_fdbck()">
        <center>
            <div id="show">

            </div>
        </center>
    </body>
    <script>
    $(document).ready(function(){
    // the "href" attribute of .modal-trigger must specify the modal ID that wants to be triggered
    $('.modal-trigger').leanModal();
  });
</script>
</html>
<?php } ?>