<?php
//error_reporting(E_ERROR | E_PARSE);
session_start();
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Inquiry</title> <!-- Compiled and minified CSS -->
                <link rel="stylesheet" href="../css/materialize.css">
                <link href="./iconfont/material-icons.css" rel="stylesheet">
           
                <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
                <script type="text/javascript" src="./js/jquery-3.0.0.js"></script>
                <script type="text/javascript" src="./js/materialize.js"></script>
        <style>  i.is {font-size: 1.5em;}</style>
        <script>

            // Put this script in header or above select element

            function check(obj) {
                var a = obj.value;
                if (a == "inquiry") {
                    $("#mobile").slideUp();
                    $("#mobile").hide();
                    $("#no").removeAttr("required");
                    $("#no").removeAttr("pattern");

                    $("#contact_subject").val("");
                    $("#contact_subject").removeAttr("readonly");

                    $("#inq_name").slideDown();
                    $("#inq_email").slideDown();
                    $("#inq_subject").slideDown();

                    $("#contact_name").attr("required", "true");
                    $("#contact_email").attr("required", "true");
                    $("#contact_subject").attr("required", "true");
                } else if (a == "feedback") {
                    $("#mobile").slideUp();
                    $("#inq_name").slideUp();
                    $("#inq_email").slideUp();
                    $("#inq_subject").slideUp();

                    $("#inq_name").hide();
                    $("#mobile").hide();
                    $("#inq_email").hide();
                    $("#inq_subject").hide();

                    $("#contact_subject").removeAttr("required");
                    $("#contact_name").removeAttr("required");
                    $("#contact_email").removeAttr("required");
                    $("#no").removeAttr("required");
                    $("#no").removeAttr("pattern");

                    $("#contact_subject").removeAttr("value");
                    $("#contact_subject").removeAttr("readonly");
                } else {
                    $("#mobile").show();
                    $("#mobile").slideDown();
                    $("#no").attr("required", "true");
                    $("#contact_subject").val("Bulk Orders");
                    $("#contact_subject").attr("readonly", "true");
                    $("#contact_subject").addClass("valid");

                    $("#inq_name").slideDown();
                    $("#inq_email").slideDown();
                    $("#inq_subject").slideDown();
//                    $("#no").attr("pattern", "(7|8|9)\d{9}");
                    $("#contact_name").attr("required", "true");
                    $("#contact_email").attr("required", "true");
                    $("#contact_subject").attr("required", "true");
                }
            }
        </script>
    </head>
    <body>
        <?php include './Navbar.php'; ?>
        <div class="container">
            <div class="row">
                <br>
                <div class="col s12">
                    <h2>Inquiry <?php if (isset($_SESSION['ud_id'])) { ?> / Feedback <?php } ?>Form </h2>
                </div>
                <div class="col s12 m12 l6">

                    <form method="POST" action="logic.php?value=inquiry">
                        <div class="row">

                            <div class="input-field col s12">

                                <text >Type Of Query: </text><input name="group1" type="radio"   checked id="test1" value="inquiry"  onclick="check(this);" />
                                <label for="test1" class="tooltipped" data-position='top' data-delay='50' data-tooltip='Ask Questions OR Query!'>Inquiry</label>

                                <input name="group1" type="radio" onclick="check(this);" id="test2" value="bulkorder"/>
                                <label for="test2" class="tooltipped" data-position='top' data-delay='50' data-tooltip='Orders For Functions (Ex:Marraige)'>Bulk Order's</label>
                                <?php if (isset($_SESSION['ud_id'])) { ?>
                                    <input name="group1" type="radio" onclick="check(this);" id="test3" value="feedback"/>
                                    <label for="test3" class="tooltipped" data-position='top' data-delay='50' data-tooltip='Give Review'>Feedback</label><?php } ?>
                            </div>
                            <br><br><br>
                            <div class="input-field col s12" id="inq_name">
                                <input id="contact_name" name="contact_name" pattern="^[A-Za-z\s]{3,20}" class="validate" type="text" title="Enter Valid name " required>
                                <label for="contact_name">Your name</label>
                                <span id="err"></span>
                            </div>
                            <div class="input-field col s12" id="inq_email">
                                <input name="contact_email" id="contact_email" type="email" value="<?php
                                if (isset($_SESSION['ud_email'])) {
                                    echo $_SESSION['ud_email'];
                                }
                                ?>" class="validate" required >
                                <label for="contact_email">Your email</label>
                            </div>
                            <div class="input-field col s12" id="mobile" hidden  >
                                <input type="text"  name="no" id="no"  class="validate"  title="Enter 10 Digit Mobile No"/>
                                <label for="txtaddress2">Enter Mobile No. </label>  
                            </div>
                            <div class="input-field col s12" id="inq_subject">
                                <input id="contact_subject" name="contact_subject" class="red-text" type="text" required>
                                <label for="contact_subject">Subject</label>
                            </div>
                            <div class="input-field col s12">
                                <textarea id="contact_message" name="contact_message" class="materialize-textarea" required></textarea>
                                <label for="contact_message">Message</label>
                                <?php if (isset($_SESSION['ud_id'])) { ?><input type="hidden" name="ud_id" value="<?php echo $_SESSION['ud_id']; ?>"><?php } ?>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col s12">                              
                                <button class="btn waves-effect waves-light right red" type="submit">Send
                                    <i class="material-icons right">send</i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
<!--                <div class="col s12 m12 l6">
                    <h2>Contact us</h2><p>
                        T-66,Paras Flour Mill,<br>
                        N/R Sant Cover Garden,<br>
                        Vararsiya,Baroda.</p>

                    <p>Phone #: +91-265-2565582/83<br>
                        Mobile #: +91-982-504-3852 (Hiteshbhai)</p><br/>
                    <span><em>Please email us and we will help you as best we can.</em><br>info.parasflourmill@gmail.com</span>
                    <br><br>
                    <span class="red-text">Working Hours</span><br/>
                    10am - 10pm GMT Monday-Saturday <span class="red-text"><b>&nbsp; &nbsp; <u>MONDAY CLOSED</u></b></span><br><br>

                    <iframe src="https://www.google.com/maps/embed?pb=!1m23!1m12!1m3!1d118106.84803634482!2d73.1807449999427!3d22.321927858766227!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!4m8!3e6!4m0!4m5!1s0x395fcf9312bd4343%3A0xc2df8a9fdc9abc1e!2sparas+flour+mill+vadodara!3m2!1d22.3219429!2d73.2507854!5e0!3m2!1sen!2sin!4v1459160927307" width="600" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
                </div>-->
            </div>
        </div>
        <?php include './footer.php'; ?>
    </body>
    <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.3/js/materialize.min.js"></script>

    <script>
                                    $(document).ready(function () {
                                        $('.tooltipped').tooltip({delay: 50});
                                    });
    </script>
</html>
