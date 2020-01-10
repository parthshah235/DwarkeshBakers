<?php
error_reporting(E_ERROR | E_PARSE);
session_start();
if (!isset($_SESSION['ud_fname'])) {
    header("Location: ./home.php");
} else {
    //print_r($_SESSION);
//    if ($_SESSION['ud_fname'] != 'Admin') {
//        header("Location: ../home.php");
//    } else {
    //$con = mysqli_connect("localhost", "root", "", "nfa");
    include './connection.php';
    ?>
    <html>
        <head>
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <title></title>
            <script type="text/javascript" src="./js/jquery-3.0.0.js"></script>
            <script type="text/javascript" src="./js/materialize.min.js"></script>
            <link rel="stylesheet" href="./css/materialize.min.css" />
            <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
            <link href="./iconfont/material-icons.css" rel="stylesheet">
            <script type="text/javascript" src="./js/functions.js"></script>
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

            <!--/*****************************------------------  Fonts  ------------------*****************************/-->

            <link href="https://fonts.googleapis.com/css?family=Josefin+Sans:300,400" rel="stylesheet">
            <link href='https://fonts.googleapis.com/css?family=Product+Sans:400,700' rel='stylesheet' type='text/css'>
            <link href="https://fonts.googleapis.com/css?family=Pacifico" rel="stylesheet">
            <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet">
            <link href="https://fonts.googleapis.com/css?family=Assistant:300,400,600&amp;subset=hebrew" rel="stylesheet">
            <link href="https://fonts.googleapis.com/css?family=Sansita:400,400i" rel="stylesheet">
            <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">

            <script type="text/javascript">
                function posi(obj) {
                    var curr = obj.find("i.material-icons").html();
                    $(".side-nav ul#sidenav_collapsible").children().each(function (index, element) {
                        $(element).find("i.material-icons").html("keyboard_arrow_down");
                    });
                    if (curr == "keyboard_arrow_down") {
                        obj.find("i.material-icons").html("keyboard_arrow_up");
                    } else {
                        obj.find("i.material-icons").html("keyboard_arrow_down");
                    }
                }

                function set_page(obj)
                {
                    var name = obj.name;//alert(name);
                    if (name == "add_prd")
                    {
                        $('#div').html("<object data='../Admin_Panel/add_product.php' style='width: 100%;height: 100%;' />");
                    } else if (name == "add_cat")
                    {
                        $('#div').html("<object data='../Admin_Panel/add_category.php' style='width: 100%;height: 100%;' />");
                    } else if (name == "update_prd")
                    {
                        $('#div').html("<object data='../Admin_Panel/update_product.php' style='width: 100%;height: 100%;' />");
                    } else if (name == "update_cat")
                    {
                        $('#div').html("<object data='../Admin_Panel/update_category.php' style='width: 100%;height: 100%;' />");
                    } else if (name == "cust_search")
                    {
                        $('#div').html("<object data='../Admin_Panel/search.php' style='width: 100%;height: 100%;' />");
                    } else if (name == "view_user")
                    {
                        $('#div').html("<object data='../Admin_Panel/view_user.php' style='width: 100%;height: 100%;' />");
                    } else if (name == "dis_user")
                    {
                        $('#div').html("<object data='../Admin_Panel/disable_user.php' style='width: 100%;height: 100%;' />");
                    } else if (name == "view_orders")
                    {
                        $('#div').html("<object data='../Admin_Panel/order/vieworder.php' style='width: 100%;height: 100%;' />");
                    } else if (name == "add_off")
                    {
                        $('#div').html("<object data='../Admin_Panel/Add_Offer_p.php' style='width: 100%;height: 100%;' />");
                    } else if (name == "update_off")
                    {
                        $('#div').html("<object data='../Admin_Panel/Update_Offer.php' style='width: 100%;height: 100%;' />");
                    }
                    else if (name == "view_inquiry")
                    {
                        $('#div').html("<object data='../Admin_Panel/View_Inquiry.php' style='width: 100%;height: 100%;' />");
                    }
                    else if (name == "new_inquiry")
                    {
                        $('#div').html("<object data='../Admin_Panel/New_Inquiry.php' style='width: 100%;height: 100%;' />");
                    }
                    else if (name == "view_feedback")
                    {
                        $('#div').html("<object data='../Admin_Panel/View_Feedback.php' style='width: 100%;height: 100%;' />");
                    }

                }

                function welcome() {
                    Materialize.toast("Welcome Admin!!", 3000);
                }
                function start_Time() {
                    var today = new Date();
                    var h = today.getHours();
                    var m = today.getMinutes();
                    var s = today.getSeconds();
                    var ampm = h >= 12 ? 'PM' : 'AM';
                    if (h > 12) {
                        h -= 12;
                    } else if (h === 0) {
                        h = 12;
                    }
                    m = checkTime(m);
                    s = checkTime(s);
                    document.getElementById('time').innerHTML =
                            h + ":" + m + ":" + s + " " + ampm;
                    var t = setTimeout(start_Time, 500);
                }
                function checkTime(i) {
                    if (i < 10) {
                        i = "0" + i
                    }
                    ; // add zero in front of numbers < 10
                    return i;
                }

            </script>
            <style type="text/css">
                .cnt {
                    overflow-y: scroll;
                }

                .cnt::-webkit-scrollbar { 
                    /* This is the magic bit */
                    display: none;
                }
                .collapsible-header-text-css {
                    font-size: 15px;
                    font-family: 'Josefin Sans', sans-serif;
                    -webkit-font-smoothing: antialiased;
                    font-weight: 400;
                    color: #444;
                    letter-spacing: 1px;
                }
                .collapsible-body-text-css {
                    font-size: 15px;
                    font-family: 'Lato', sans-serif;
                    -webkit-font-smoothing: antialiased;
                    font-weight: 400;
                    color: #444;
                }
                .admin-brand-logo-css {
                    display: block;
                    margin-left: 100px;
                    font-family: 'Josefin Sans', sans-serif;
                    -webkit-font-smoothing: antialiased;
                    font-weight: 300;
                    color: #fff;
                    letter-spacing: 1px;
                }
                .admin-brand-logo-css:hover {
                    color: rgba(255,255,255,0.5);
                }
                .time-css {
                    font-size: 20px;
                    font-family: 'Josefin Sans', sans-serif;
                    -webkit-font-smoothing: antialiased;
                    font-weight: 400;
                    letter-spacing: 1.5px;
                }
            </style>
        </head>
        <body class="cnt" onload="start_Time()">
            <?php
            // put your code here
            ?>


            <ul  id="slide-out" class="side-nav fixed cnt">
                <li>
                    <ul>
                        <li><center><img src="./images/product_images/Dwarkesh_Logo-Red.svg" height="20%"></center></li>
            </ul>
            <ul><li class="divider"></li></ul>
            <ul class="collapsible" data-collapsible="accordion">
                <li>
                    <div class="tooltipped collapsible-header collapsible-header-text-css"  data-position="right" data-delay="50" data-tooltip="Users Details"><i class="fa fa-user-circle-o" aria-hidden="true"></i> USER</div>
                    <div class="collapsible-body collapsible-body-text-css">
                        <ul>
                            <li>
                                <a href="#" onclick="set_page(this)" name="view_user"><i class="fa fa-user" aria-hidden="true"></i> &nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp; View User</a>
                            </li>
                            <li>
                                <a href="#" onclick="set_page(this)" name="dis_user"><i class="fa fa-user-times" aria-hidden="true"></i> &nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp; Disable User</a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="divider"></li>
                <li>
                    <div class="tooltipped collapsible-header collapsible-header-text-css"  data-position="right" data-delay="50" data-tooltip="Category Details"><i class="fa fa-list-alt" aria-hidden="true"></i> CATEGORY</div>
                    <div class="collapsible-body">
                        <ul>
                            <li>
                                <a href="#" onclick="set_page(this)" name="add_cat"><i class="fa fa-plus" aria-hidden="true"></i> &nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp; Add Category</a>
                            </li>
                            <li>
                                <a href="#" onclick="set_page(this)" name="update_cat"><i class="fa fa-pencil" aria-hidden="true"></i> &nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp; Update Category</a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="divider"></li>
                <li>
                    <div class="tooltipped collapsible-header collapsible-header-text-css"  data-position="right" data-delay="50" data-tooltip="Product Details"><i class="fa fa-archive" aria-hidden="true"></i> STOCK</div>
                    <div class="collapsible-body">
                        <ul>
                            <li>
                                <a href="#" onclick="set_page(this)" name="add_prd"><i class="fa fa-plus" aria-hidden="true"></i> &nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp; Add Products</a>
                            </li>
                            <li>
                                <a href="#" onclick="set_page(this)" name="update_prd"><i class="fa fa-pencil" aria-hidden="true"></i> &nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp; Update Products</a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="divider"></li>
                <li>
                    <div class="tooltipped collapsible-header collapsible-header-text-css"  data-position="right" data-delay="50" data-tooltip="Product Details"><i class="material-icons" aria-hidden="true">payment</i> OFFER</div>
                    <div class="collapsible-body">
                        <ul>
                            <li>
                                <a href="#" onclick="set_page(this)" name="add_off"><i class="fa fa-plus" aria-hidden="true"></i> &nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp; Add Offer</a>
                            </li>
                            <li>
                                <a href="#" onclick="set_page(this)" name="update_off"><i class="fa fa-pencil" aria-hidden="true"></i> &nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp; Update Offer</a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="divider"></li>
                <li>
                    <div class="tooltipped collapsible-header collapsible-header-text-css"  data-position="right" data-delay="50" data-tooltip="View Orders"><i class="fa fa-shopping-bag" aria-hidden="true"></i> ORDERS</div>
                    <div class="collapsible-body">
                        <ul>
                            <li>
                                <a href="#" onclick="set_page(this)" name="view_orders"><i class="fa fa-eye" aria-hidden="true"></i> &nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp; View Orders</a>
                            </li>
                            <!--                                        <li>
                                                                        <a href="#" onclick="set_page(this)" name="update_inst"><i class="fa fa-pencil" aria-hidden="true"></i> &nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp; Update</a>
                                                                    </li>-->
                        </ul>
                    </div>
                </li>
                
                <li class="divider"></li>
                <li>
                    <div class="tooltipped collapsible-header collapsible-header-text-css"  data-position="right" data-delay="50" data-tooltip="View Orders"><i class="material-icons" aria-hidden="true">content_paste</i> Inquiry</div>
                    <div class="collapsible-body">
                        <ul>
                            <li>
                                <a href="#" onclick="set_page(this)" name="view_inquiry"><i class="fa fa-eye" aria-hidden="true"></i> &nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp; View Inquiry</a>
                            </li>
<!--                            <li>
                                <a href="#" onclick="set_page(this)" name="new_inquiry"><i class="fa fa-eye" aria-hidden="true"></i> &nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp; New Inquiry</a>
                            </li>-->
                            <!--                                        <li>
                                                                        <a href="#" onclick="set_page(this)" name="update_inst"><i class="fa fa-pencil" aria-hidden="true"></i> &nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp; Update</a>
                                                                    </li>-->
                        </ul>
                    </div>
                </li>
                
                <li class="divider"></li>
                <li>
                    <div class="tooltipped collapsible-header collapsible-header-text-css"  data-position="right" data-delay="50" data-tooltip="View Orders"><i class="material-icons" aria-hidden="true">comment</i> Feedback</div>
                    <div class="collapsible-body">
                        <ul>
                            <li>
                                <a href="#" onclick="set_page(this)" name="view_feedback"><i class="fa fa-eye" aria-hidden="true"></i> &nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp; View Feedback</a>
                            </li>
<!--                            <li>
                                <a href="#" onclick="set_page(this)" name="new_inquiry"><i class="fa fa-eye" aria-hidden="true"></i> &nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp; New Inquiry</a>
                            </li>-->
                            <!--                                        <li>
                                                                        <a href="#" onclick="set_page(this)" name="update_inst"><i class="fa fa-pencil" aria-hidden="true"></i> &nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp; Update</a>
                                                                    </li>-->
                        </ul>
                    </div>
                </li>

                
                <li class="divider"></li>
                <li style="width: 240px;">
                    <div id="d1" class="collapsible-header waves-effect waves-teal" style="margin-left: 0px;width: 285px;">
                        <a class="red-text tooltipped" onclick="posi($(this))" id="a1" data-position="right" data-delay="50" data-tooltip="Search Product & Category" style="font-size: 1.5em;">SEARCH<i class="material-icons right" id="c1">keyboard_arrow_down</i></a>
                    </div>
                    <div class="collapsible-body" style="margin-left: 59px;">
                        <ul class="collapsible collapsible-accordion no-padding">
                            <ul>
                                <li>
                                    <a class="waves-effect waves-teal no-padding text-darken-2" onclick="set_page(this)" name="cust_search" style="width: 210px;">Custom Search</a>
                                </li>
                                <!--                                                                                <li>
                                                                                                                    <a class="waves-effect waves-teal no-padding text-darken-2" onclick="set_page(this)" name="update_help" style="width: 210px;">Disable User</a>
                                                                                                                </li>-->
                            </ul>
                        </ul>
                    </div>
                </li>
            </ul>
        </li>
    </ul>

    <!--                <ul class="side-nav fixed right" id="mobile-demo" style="width: 233px">
                        <li class="bold" style="margin-top: 64px">
                            <ul class="collapsible" id="sidenav_collapsible" data-collapsible="accordion" style="margin-left: -14px;">
                                <li style="width: 240px;">
                                    <div id="d1" class="collapsible-header waves-effect waves-teal" style="margin-left: 0px;width: 285px;">
                                        <a class="tooltipped sidenav-text-css" onclick="posi($(this))" id="a1" data-position="right" data-delay="50" data-tooltip="User Details" style="font-size: 1.5em;">USER<i class="material-icons right" id="c1">keyboard_arrow_down</i></a>
                                    </div>
                                    <div class="collapsible-body" style="margin-left: 59px;">
                                        <ul class="collapsible collapsible-accordion no-padding">
                                            <ul>
                                                <li>
                                                    <a class="waves-effect waves-teal no-padding text-darken-2" onclick="set_page(this)" name="view_user" style="width: 210px;">View User</a>
                                                </li>
                                                <li>
                                                    <a class="waves-effect waves-teal no-padding text-darken-2" onclick="set_page(this)" name="dis_user" style="width: 210px;">Disable User</a>
                                                </li>
                                            </ul>
                                        </ul>
                                    </div>
                                </li>

                                <li style="width: 240px;">
                                    <div id="d2" class="collapsible-header waves-effect waves-teal" style="margin-left: 0px;width: 285px;">
                                        <a class="red-text tooltipped" onclick="posi($(this))" id="a2" data-position="right" data-delay="50" data-tooltip="Category Details" style="font-size: 1.4em;">CATEGORY<i class="material-icons right" id="c2">keyboard_arrow_down</i></a>
                                    </div>
                                    <div class="collapsible-body" style="margin-left: 59px;">
                                        <ul class="collapsible collapsible-accordion no-padding">
                                            <ul>
                                                <li>
                                                    <a class="waves-effect waves-teal no-padding text-darken-2" onclick="set_page(this)" name="add_cat" style="width: 210px;">Add Category</a>
                                                </li>
                                                <li>
                                                    <a class="waves-effect waves-teal no-padding text-darken-2" onclick="set_page(this)" name="update_cat" style="width: 210px;">Update Category</a>
                                                </li>
                                            </ul>
                                        </ul>
                                    </div>
                                </li>

                                <li style="width: 240px;">
                                    <div id="d2" class="collapsible-header waves-effect waves-teal" style="margin-left: 0px;width: 285px;">
                                        <a class="red-text tooltipped" onclick="posi($(this))" id="a2" data-position="right" data-delay="50" data-tooltip="Product Details" style="font-size: 1.4em;">STOCK<i class="material-icons right" id="c2">keyboard_arrow_down</i></a>
                                    </div>
                                    <div class="collapsible-body" style="margin-left: 59px;">
                                        <ul class="collapsible collapsible-accordion no-padding">
                                            <ul>
                                                <li>
                                                    <a class="waves-effect waves-teal no-padding text-darken-2" onclick="set_page(this)" name="add_prd" style="width: 210px;">Add Product</a>
                                                </li>
                                                <li>
                                                    <a class="waves-effect waves-teal no-padding text-darken-2" onclick="set_page(this)" name="update_prd" style="width: 210px;">Update Products</a>
                                                </li>
                                            </ul>
                                        </ul>
                                    </div>
                                </li>
                                <li style="width: 240px;">
                                    <div id="d3" class="collapsible-header waves-effect waves-teal" style="margin-left: 0px;width: 285px;">
                                        <a class="red-text tooltipped" onclick="posi($(this))" id="a3" data-position="right" data-delay="50" data-tooltip="View orders" style="font-size: 1.3em;">ORDERS<i class="material-icons right" id="c3">keyboard_arrow_down</i></a>
                                    </div>
                                    <div class="collapsible-body" style="margin-left: 59px;">
                                        <ul class="collapsible collapsible-accordion no-padding">
                                            <ul>
                                                <li>
                                                    <a class="waves-effect waves-teal no-padding text-darken-2" onclick="set_page(this)" name="view_orders" style="width: 210px;">View Orders</a>
                                                </li>
                                                                                    <li>
                                                                                        <a class="waves-effect waves-teal no-padding text-darken-2" onclick="set_page(this)" name="update_inst" style="width: 210px;">Update School/College</a>
                                                                                    </li>
                                            </ul>
                                        </ul>
                                    </div>
                                </li>

                                <li style="width: 240px;">
                                    <div id="d1" class="collapsible-header waves-effect waves-teal" style="margin-left: 0px;width: 285px;">
                                        <a class="red-text tooltipped" onclick="posi($(this))" id="a1" data-position="right" data-delay="50" data-tooltip="Search Product & Category" style="font-size: 1.5em;">SEARCH<i class="material-icons right" id="c1">keyboard_arrow_down</i></a>
                                    </div>
                                    <div class="collapsible-body" style="margin-left: 59px;">
                                        <ul class="collapsible collapsible-accordion no-padding">
                                            <ul>
                                                <li>
                                                    <a class="waves-effect waves-teal no-padding text-darken-2" onclick="set_page(this)" name="cust_search" style="width: 210px;">Custom Search</a>
                                                </li>
                                                                                    <li>
                                                                                        <a class="waves-effect waves-teal no-padding text-darken-2" onclick="set_page(this)" name="update_help" style="width: 210px;">Disable User</a>
                                                                                    </li>
                                            </ul>
                                        </ul>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ul>-->



    <nav>
        <div class="nav-wrapper">
            <a href="./panel.php" class="brand-logo center admin-brand-logo-css">Welcome Administrator</a>
            <a href="#" data-activates="mobile-demo" class="button-collapse"><i class="material-icons">menu</i></a>
            <a href="./logic.php?page=logout">
                <i class="small material-icons right tooltipped" data-position="left" data-delay="50" data-tooltip="Logout" style="margin-right: 20px;">power_settings_new</i>
            </a>
            <a href="#!" class="right hide-on-med-and-down time-css" id="time"></a>
        </div>
    </nav>
    <!--z-depth-1-->
    <div class="row container center" style="width: 100%;height: 100%;">
        <div id="div" class="col s12 m12 l12 offset-l1 cnt" >
            <iframe style="margin-top:  0px;height: 105vh;width: 100%;border: none" src="./dashboard.php"></iframe>
        </div>
    </div>

    <div id="del_prd" class="modal modal-fixed-footer" style="width: 32%;height: 220px;">
        <div class="modal-content">
            <h4 class="center">Alert</h4>
            <hr style="margin-right: -23px;margin-left: -23px;" />
            <p class="center">Are You Sure To Delete This Product ?</p>
        </div>
        <div class="modal-footer">
            <a href="#!" class="modal-action modal-close waves-effect waves-green btn" id="del_prd" onclick="del_prd(this)" style="margin-right: 70px;">NO</a>
            <a href="#!" class="modal-action modal-close waves-effect waves-green btn" id="del_prd" onclick="del_prd(this)" style="margin-right: 117px;">YES</a>
        </div>
    </div>

    <div id="del_cat" class="modal modal-fixed-footer" style="width: 32%;height: 220px;">
        <div class="modal-content">
            <h4 class="center">Alert</h4>
            <hr style="margin-right: -23px;margin-left: -23px;" />
            <p class="center">Are You Sure To Delete This Category ?</p>
        </div>
        <div class="modal-footer">
            <a href="#!" class="modal-action modal-close waves-effect waves-green btn" id="del_cat" onclick="del_cat(this)" style="margin-right: 70px;">NO</a>
            <a href="#!" class="modal-action modal-close waves-effect waves-green btn" id="del_cat" onclick="del_cat(this)" style="margin-right: 117px;">YES</a>
        </div>
    </div>

    <div id="upd_prd" onfocus="set_id()" class="modal modal-fixed-footer" style="width: 75%;max-height: 100%;">
        <div class="modal-content  cnt">
            <h4 class="center">Update Product</h4>
            <hr style="margin-right: -23px;margin-left: -23px;" />
            <p class="center">
            <form>
                <div class="row upd_prd center">
                </div>
            </form>
            </p>
        </div>
        <div class="modal-footer center container">
            <a href="#!" class="modal-action modal-close waves-effect waves-green btn right red" id="upd_prd" onclick="">NO</a>
            <a href="#!" class="modal-action modal-close waves-effect waves-green btn left" id="upd_prd" onclick="upd_prd()">YES</a>
        </div>
    </div>

    <div id="upd_cat" onfocus="set_id2()" class="modal modal-fixed-footer" style="width: 32%;height: 220px;">
        <div class="modal-content cnt">
            <h4 class="center">Update Category</h4>
            <hr style="margin-right: -23px;margin-left: -23px;" />
            <form class="center">
                <div class="row upd_cat center">
                </div>
            </form>
        </div>
        <div class="modal-footer center container">
            <a href="#!" class="modal-action modal-close waves-effect waves-green btn right red" id="upd_cat" onclick="">NO</a>
            <a href="#!" class="modal-action waves-effect waves-green btn left" id="upd_cat" onclick="upd_cat()">YES</a>
        </div>
    </div>

    <input type="hidden" id="prd_id_hide" />
    <input type="hidden" id="cat_id_hide" />



    </body>
    <script>
        $(document).ready(function () {
            $(".button-collapse").sideNav();
            $('select').material_select();
        });
        $("#upd_prd").click(function () {
            change_prd_img();
        });
        $(document).ready(function () {
            $('.collapsible').collapsible();
        });
    </script>
    </html>
    <?php
}
//}
?>