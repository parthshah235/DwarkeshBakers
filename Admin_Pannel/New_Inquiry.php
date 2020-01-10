<?php
session_start();
if (!isset($_SESSION['ud_id'])) {
    header("Location:../404.html");
} else {
    include './connection.php';
    ?>
    <html>
        <head>
            <link rel="stylesheet" href="./css/materialize.css" />
            <link rel="stylesheet" href="./css/materialize.min.css" />
            <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
            <!--<script type="text/javascript" src="js/jquery-2.1.1.min.js"></script>-->
            <script type="text/javascript" src="./js/jquery-3.0.0.js"></script>
            <script type="text/javascript" src="./js/materialize.min.js"></script>
            <script>
                function check_inq()
                {
                    var jsonResponse = "<table class='striped highlight centered'><thead><tr><th data-field='No'>No</th><th data-field='Email'>Email</th><th data-field='Subject'>Subject</th><th data-field='Contact'>Contact</th><th data-field='Message'>Message</th></tr></thead><tbody><tr>";
                    var xmlhttp = new XMLHttpRequest();
                    xmlhttp.open("GET", "setpage.php?page=new_inq", true);
                    xmlhttp.onreadystatechange = function ()
                    {
                        if (xmlhttp.readyState == 4 && xmlhttp.status == 200)
                        {
                            var response = xmlhttp.responseText;//alert(response);
                            var myArr = JSON.parse(response);
                            for (var i = 0; i <= myArr.length - 1; i++)
                            {
                                jsonResponse += "<td>" + (i + 1) + "</td><td>" + myArr[i].inq_email + "</td><td>" + myArr[i].inq_subject + "</td><td>" + myArr[i].inq_mobile + "</td><td>\n\
                                    <a onclick='modal(this)' class='modal-trigger waves-effect waves-light btn' href='#modal" + i + "' id='" + myArr[i].inq_id + "'>View Message</a>\n\
                                    <form id='formmsg' enctype='multipart/form-data' action='setpage.php?page=retrieve' method='post'>\n\
                                    <div id='modal" + i + "' class='modal modal-fixed-footer'>\n\
                                        <div class='modal-content'>\n\
                                            <h4 style='background-color: #ee6e73;color: white;padding-top: 8px;height: 50px;' class='brand-logo center' >Message</h4>\n\
                                                <p id='msg'>\n\
                                                    <div style=''>\n\
                                                        <label for='textarea1' style='margin-right: 520px;'>Message</label>\n\
                                                        <textarea id='textarea1' class='materialize-textarea' readonly>" + myArr[i].inq_desc + "</textarea>\n\
                                                        </div>\n\
                                                    <br/>\n\
                                                    <div id='reply' class='reply-hide'><div class='input-field col s12'>\n\
                                                            <label for='textarea2' style='margin-left: -11px;'>Reply Message</label>\n\
                                                            <textarea id='msg2' name='msg' class='msg materialize-textarea'></textarea></div>\n\
                                                            <input type='text' name='email' id='email' value=" + myArr[i].inq_email + " hidden>\n\
                                                    </div>\n\
                                                    <div>\n\
                                                        <div class='file-field input-field'>\
                                                          <div class='btn'>\
                                                            <span>File</span>\
                                                            <input type='file' name='file' multiple>\
                                                          </div>\
                                                          <div class='file-path-wrapper'>\
                                                            <input class='file-path validate' type='text' placeholder='Upload one or more files'>\
                                                          </div>\
                                                        </div>\
                                                        </form>\
                                                </div>\
                                                </p>\n\
                                        </div>\n\
                                        <div class='modal-footer'>\n\
                                            <button type='submit' class='btn' style='margin: 6px 250;' id='" + myArr[i].inq_id + "'>Reply</button>\n\
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

                //var queryString = $('#formmsg').serialize();alert(queryString);
            </script>
        </head>
        <body onload="check_inq()">
        <center>
            <div id="show">

            </div>
        </center>
    </body>
    <script>
        $(document).ready(function () {
            // the "href" attribute of .modal-trigger must specify the modal ID that wants to be triggered
            $('.modal-trigger').leanModal();
        });
    </script>
    </html>
<?php } ?>