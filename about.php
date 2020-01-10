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
        <main class="container">
    <div class="row">
        <div class="col s12"><br>
            <h3 class="center page-header"><font style="color:#ef5350">About Us</font></h3>
            <div class="section">
                <p class="flow-text" align="justify"><i class="small material-icons"><font style="color:#ef5350">label</font></i> Welcome to Dwarkesh Bakers– one-stop-shop bringing wide verities of Bakery products like cake,cookies,pastries etc. We provide fresh products to all our customers.</p>
                <p class="flow-text" align="justify"> <i class="small material-icons"><font style="color:#ef5350">label</font></i>  Different types of Bakery items are easily available at Dwarkesh Bakers and they all are of top quality which is made up of fresh ingredients. We never compromise with the quality of our products.</p>
                <p class="flow-text" align="justify"><i class="small material-icons"><font style="color:#ef5350">label</font></i>  We are a professionally managed organization which is ardently engulfed of all kinds of Bakery products. Last but not least, we have established long-term business relationship with our prestigious clients via our superlative products. </p>
                
            </div>
        </div>
    </div>
</main>
    </body>
    <?php
    include './footer.php';
    ?>
</html>
