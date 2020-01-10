<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
          <style>
                body {
                        display: flex;
                        min-height: 100vh;
                        flex-direction: column;
                    }
                main {
                        flex: 1 0 auto;
                    }

            </style>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        // put your code here
        include './Navbar.php';
        ?>
        <main>
        <center><h3 class="red-text">Privacy Policy</h3></center>
        <div class="container">
            <div><h5>1) What information is, or may be, collected form you?</h5>
                <p align="justify">
                    As part of the registration process on the Site, DBPL may collect the following personally identifiable information about you: Name including first and last name, alternate email address, mobile phone number and contact details, Postal code, address etc. and information about the pages on the site you visit/access, the links you click on the site, the number of times you access the page and any such browsing information. 
                </p>
            </div>
            <div><h5>2) With whom your information will be shared</h5>
                <p align="justify">
DBPL will not use your financial information for any purpose other than to complete a transaction with you. DBPL does not rent, sell or share your personal information and will not disclose any of your personally identifiable information to third parties. In cases where it has your permission to provide products or services you've requested and such information is necessary to provide these products or services the information may be shared with DBPL’s business associates and partners. DBPL may, however, share consumer information on an aggregate with its partners or thrird parties where it deems necessary. In addition DBPL may use this information for promotional offers, to help investigate, prevent or take action regarding unlawful and illegal activities, suspected fraud, potential threat to the safety or security of any person, violations of the Site’s terms of use or to defend against legal claims; special circumstances such as compliance with subpoenas, court orders, requests/order from legal authorities or law enforcement agencies requiring such disclosure. 
                </p>
            </div>
            <div><h5>3) What Choice are available to you regarding collection, use and distribution of your information?</h5>
               <p align="justify">
                       To protect against the loss, misuse and alteration of the information under its control, DBPL has in place appropriate physical, electronic and managerial procedures. For example, DBPL servers are accessible only to authorized personnel and your information is shared with employees and authorised personnel on a need to know basis to complete the transaction and to provide the services requested by you. Although DBPL will endeavour to safeguard the confidentiality of your personally identifiable information, transmissions made by means of the Internet cannot be made absolutely secure. By using this site, you agree that DBPL will have no liability for disclosure of your information due to errors in transmission or unauthorized acts of third parties. 
                </p>
            </div>
             <div><h5>4) How can you correct inaccuracies in the information ?</h5>
                <p align="justify">
                    To correct or update any information you have provided, the Site allows you to do it online. In the event of loss of access details you can Visit Link (<a href='forgot_password.php'>Recover Account</a>)
                </p>
            </div>
            <div><h5>5)Contact Information</h5>
               <p align="justify">
                   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href='contact_us.php'>Contact Us</a>
                </p>
            </div>
        </div>
        </main>
    </body>
    <?php
    include './footer.php';
    ?>
</html>
