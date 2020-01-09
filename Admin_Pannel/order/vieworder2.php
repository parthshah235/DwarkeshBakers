<?php 
include '../../connection.php';
$x=mysqli_query($con,"SELECT order_products.*,order_details.ord_date FROM order_products INNER JOIN order_details ON order_details.ord_id=order_products.ord_id WHERE order_products.ord_id='".$_POST['a']."'");$z="";
$xx1=mysqli_fetch_array($x);
?>
 <link rel="stylesheet" href="../css/materialize.min.css" />
                <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
                <link href="./iconfont/material-icons.css" rel="stylesheet">
                <script type="text/javascript" src="../js/jquery-3.0.0.js"></script>
                <script type="text/javascript" src="../js/materialize.min.js"></script>
                <script type="text/javascript" src="./js/functions.js"></script>
<center><b><u>Order ID </u>: <?php echo $_POST['a'];?><br><u>Date </u>: 
        <?php if($xx1['ord_date']==NULL){echo null;}else{$date1=date('d-m-Y',strtotime($xx1['ord_date']));echo $date1;}?>
    </b></center>
<table class="centered">
    <thead>
        <th>Name</th>
        <th>Qty</th>
        <th>Price</th>
        <th>Sub-Total</th>
    </thead>
    <tbody>
<?php 
$x=mysqli_query($con,"SELECT order_products.*,order_details.ord_date FROM order_products INNER JOIN order_details ON order_details.ord_id=order_products.ord_id WHERE order_products.ord_id='".$_POST['a']."'");$z="";
while($y=mysqli_fetch_array($x))
{
$x1=mysqli_query($con,"SELECT prd_name FROM product_details WHERE prd_id='".$y['prd_id']."'");
$y1=mysqli_fetch_array($x1);
?>
        <tr>
            <td><?php echo $y1['prd_name'];?></td>
            <td><?php echo $y['oprd_qty'];?></td>
            <td><?php echo $y['oprd_unit_price'];?></td>
            <td><?php echo $y['oprd_qty']*$y['oprd_unit_price'];$z=$z+$y['oprd_qty']*$y['oprd_unit_price'];?></td>
        </tr>
<?php }?>
        <tr><td><b>Total</b></td><td></td><td></td><td><b><?php echo $z;?></b></td></tr>
    </tbody>
</table>

