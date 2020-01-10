<?php

error_reporting(E_ERROR | E_PARSE);
$con = mysqli_connect("localhost", "root", "", "dwarkesh_bakery");

$page = $_GET['page'];
if ($page == 'login') {
    $unm = $_GET['unm'];
    $pass = $_GET['pass'];
    if ($unm == 'Admin' && $pass == 'Admin') {
        session_start();
        $_SESSION['log_id'] = 'Admin';
        $msg = "1";
    } else {
        $msg = "0";
    }
    echo $msg;
} elseif ($page == 'logout') {
    session_start();
    session_unset();
    session_destroy();
    header("Location:../Home.php");
} elseif ($page == "add_prd") {
    $product_name = $_POST["product_name"];
    $product_about = $_POST["product_desc"];
//$product_category = $_POST['cat_id'];
    $product_mrp = $_POST["product_mrp"];
    $product_quantity = $_POST["product_quantity"];
    $cat_main = $_POST['cat_name'];

//echo $product_name."<br/>",$product_about."<br/>",$cat_main."<br/>",$product_mrp."<br/>",$product_quantity."<br/>";
    $name = $_FILES['file']['name'];
    $tmpName = $_FILES['file']['tmp_name'];
    $ext = pathinfo($name, PATHINFO_EXTENSION);
    $product_image = "./images/product_images/" . $product_name . "." . $ext; //echo $product_image;
//echo $product_name_new;
    $result = move_uploaded_file($tmpName, $product_image);
    if (!$result) {
        $msg2 = "Error While Uploading Image!!";
        //print_r(error_get_last());
    } else {
        $cat_id = mysqli_query($con, "select * from category where cat_name='$cat_main'");
        while ($row = mysqli_fetch_array($cat_id)) {
            $category_id = $row['cat_id'];
        }
        if (!$category_id) {
            $msg2 = "No Category Found!!";
            //error_get_last();
        } else {
//            print_r("insert into product_details(`prd_name`,`prd_about`,`prd_image`,`prd_mrp`,`prd_sell_rate`,`prd_tax`,`prd_quantity`,`paras_product`,`cat_id`)
//         VALUES ('$product_name','$product_about','$product_image','$product_mrp','$product_sell_rate','$product_tax ','$product_quantity','$prd_type','$category_id')");
            $qry = mysqli_query($con, "insert into product_details(`prd_name`,`prd_about`,`prd_image`,`prd_mrp`,`prd_quantity`,`cat_id`) VALUES ('$product_name','$product_about','$product_image','$product_mrp','$product_quantity','$category_id')");
            if (!$qry) {
                $msg2 = "Error While Inserting Data!!";
                //error_get_last();
                header("refresh:0; url= ./add_product.php?e=1");
            } else {
                $msg2 = "Data Successfully Inserted!!";
                header("refresh:0; url= ./add_product.php?e=0");
            }
        }
    }
}
//elseif($page=="update_prd")
//{
//    
//$qry = mysqli_query($con, "select * from product_details");
//$json = array();
//while ($row = mysqli_fetch_array($qry)) {
//    $json[] = array(
//        "prd_id" => $row['prd_id'],
//        "prd_name" => $row['prd_name'],
//        "prd_about" => $row['prd_about'],
//        "prd_mrp" => $row['prd_mrp'],
//        "prd_image" => $row['prd_image'],
//        "prd_quantity" => $row['prd_quantity']
//    );
//}
//$jsonstring = json_encode($json);
//echo $jsonstring;
//}
elseif ($page == "add_cat") {
    $cat_name = $_REQUEST['cat'];
    mysqli_query($con, "insert into category(`cat_name`) VALUES ('$cat_name')");
    if (mysqli_affected_rows($con) == "0") {
        $msg = 0;
    } else {
        $msg = 1;
    }
    echo $msg;
} elseif ($page == "del_prd") {
    $id = $_POST['id'];
    mysqli_query($con, "DELETE FROM `product_details` WHERE `prd_id`=$id");
    if (mysqli_affected_rows($con) == "0") {
        $msg = 0;
    } else {
        $msg = 1;
    }
    echo $msg;
} elseif ($page == "get_prd_dtl") {
    $id = $_POST['id'];
    $qry8 = mysqli_query($con, "select * FROM `product_details` WHERE `prd_id`=$id");
    $json = array();
    while ($row = mysqli_fetch_array($qry8)) {
        $json[] = array(
            "prd_id" => $row['prd_id'],
            "prd_name" => $row['prd_name'],
            "prd_about" => $row['prd_about'],
            "prd_mrp" => $row['prd_mrp'],
            "prd_image" => $row['prd_image'],
            "prd_quantity" => $row['prd_quantity'],
            "cat_id" => $row['cat_id']
        );
    }
    $jsonstring = json_encode($json);
    echo $jsonstring;
} elseif ($page == "get_cat") {
    $qry = mysqli_query($con, "select * from category");
    $json = array();
    while ($row = mysqli_fetch_array($qry)) {
        $json[] = array(
            "cat_id" => $row['cat_id'],
            "cat_name" => $row['cat_name']
        );
    }
    $jsonstring = json_encode($json);
    echo $jsonstring;
} elseif ($page == "upd_prd") {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $cat = $_POST['cat'];
    $desc = $_POST['desc'];
    $mrp = $_POST['mrp'];
    $qty = $_POST['qty'];
    $img = $_POST['img'];

    $cat_qry = mysqli_query($con, "select cat_id from category where cat_name='$cat'");
    while ($row1 = mysqli_fetch_array($cat_qry)) {
        $cat_id = $row1['cat_id'];
    }

    mysqli_query($con, "select * from `product_details` where `prd_name`='$name' and `prd_about`='$desc' and `prd_mrp`='$mrp' and `prd_quantity`='$qty' and `cat_id`=$cat_id");
    if (mysqli_affected_rows($con) == "0") {
        mysqli_query($con, "UPDATE `product_details` SET `prd_name`='$name',`prd_about`='$desc',`prd_mrp`='$mrp',`prd_quantity`='$qty',`cat_id`=$cat_id WHERE `prd_id`=$id");
        if (mysqli_affected_rows($con) == "0") {
            $msg = 0;
        } else {
            $msg = 1;
        }
    } else {
        $msg = 2;
    }
    echo $msg;
} elseif ($page == "del_cat") {
    $id = $_POST['id'];
    mysqli_query($con, "DELETE FROM `category` WHERE `cat_id`=$id");
    if (mysqli_affected_rows($con) == "0") {
        $msg = 0;
    } else {
        $msg = 1;
    }
    echo $msg;
} elseif ($page == "get_cat_dtl") {
    $id = $_POST['id'];
    $qry8 = mysqli_query($con, "select * FROM `category` WHERE `cat_id`=$id");
    $json = array();
    while ($row = mysqli_fetch_array($qry8)) {
        $json[] = array(
            "cat_id" => $row['cat_id'],
            "cat_name" => $row['cat_name']
        );
    }
    $jsonstring = json_encode($json);
    echo $jsonstring;
} elseif ($page == "upd_cat") {
    $id = $_POST['id'];
    $name = $_POST['name'];

    mysqli_query($con, "select cat_name from category where cat_name='$name'");
    if (mysqli_affected_rows($con) == "0") {
        mysqli_query($con, "UPDATE `category` SET `cat_name`='$name' WHERE `cat_id`=$id");
        if (mysqli_affected_rows($con) == "0") {
            $msg = 0;
        } else {
            $msg = 1;
        }
    } else {
        $msg = 3;
    }
    echo $msg;
} elseif ($page == "upd_prd_img") {
    $pname = $_GET['name'];
    $src = $_GET['src'];
    $pic = $_GET['pic'];
    //echo $_SERVER['DOCUMENT_ROOT'];
    if (0 < $_FILES['file']['error']) {
        echo 'Error: ' . $_FILES['file']['error'] . '<br>';
    } else {
        //move_uploaded_file($_FILES['file']['tmp_name'], './images/product_images/'.$name);
        $name = $_FILES['file']['name']; //echo $name;
        $tmpName = $_FILES['file']['tmp_name'];
        $ext = pathinfo($name, PATHINFO_EXTENSION);
        if (file_exists("./images/product_images/" . $pname . "." . $ext)) {
            unlink("./images/product_images/" . $pname . "." . $ext);
            //echo "./images/product_images/" . $pname . "." . $ext;
        }
        $product_image = "./images/product_images/" . $pname . "." . $ext; //echo $product_image;
        //$product_image = "./images/product_images/$pic"; echo $product_image;
//echo $product_name_new;
        move_uploaded_file($tmpName, $product_image);
        echo "1";
    }
} elseif ($page == "valid_cat_name") {
    $name = $_POST['name'];

    mysqli_query($con, "select cat_name from category where cat_name='$name'");
    if (mysqli_affected_rows($con) == "0") {
        $msg = 0;
    } else {
        $msg = 1;
    }
    echo $msg;
} elseif ($page == "valid_prd_name") {
    $name = $_POST['name'];

    mysqli_query($con, "select prd_name from product_details where prd_name='$name'");
    if (mysqli_affected_rows($con) == "0") {
        $msg = 0;
    } else {
        $msg = 1;
    }
    echo $msg;
} elseif ($page == "search") {
    $key = $_POST['key'];
    $cat2 = $_POST['cat'];
    $min = $_POST['min'];
    $max = $_POST['max'];

    if ($cat2 == "" && $min == "" && $max == "") { //echo "1";
        $qry9 = mysqli_query($con, "select * from product_details where prd_name like '%$key%'");
    } elseif ($min == "" || NULL && $max == "" || NULL) { //echo "2";
        $cat_qry = mysqli_query($con, "select cat_id from category where cat_name='$cat2'");
        while ($row1 = mysqli_fetch_array($cat_qry)) {
            $cat_id = $row1['cat_id'];
        }
        //echo "select * from product_details where prd_name like '%$key%' and cat_id=$cat_id";
        $qry9 = mysqli_query($con, "select * from product_details where prd_name like '%$key%' and cat_id=$cat_id");
    } elseif ($min != "" || NULL && $max != "" || NULL) { //echo "3";
        if ($cat2 == "" || NULL) { //echo "4";
            $qry9 = mysqli_query($con, "select * from product_details where prd_name like '%$key%' and (prd_mrp between $min AND $max)");
        } else { //echo "5";
            $cat_qry = mysqli_query($con, "select cat_id from category where cat_name='$cat2'");
            while ($row1 = mysqli_fetch_array($cat_qry)) {
                $cat_id = $row1['cat_id'];
            }
            //echo "select * from product_details where prd_name like '%$key%' and cat_id=$cat_id";
            $qry9 = mysqli_query($con, "select * from product_details where prd_name like '%$key%' and (prd_mrp between $min AND $max) and cat_id=$cat_id");
        }
    }
    $json = array();
    while ($row = mysqli_fetch_array($qry9)) {
        $json[] = array(
            "prd_id" => $row['prd_id'],
            "prd_name" => $row['prd_name'],
            "prd_about" => $row['prd_about'],
            "prd_mrp" => $row['prd_mrp'],
            "prd_image" => $row['prd_image'],
            "prd_quantity" => $row['prd_quantity'],
            "cat_id" => $row['cat_id']
        );
    }
    $jsonstring = json_encode($json);
    echo $jsonstring;
} elseif ($page == "view_user") {
    $qry = mysqli_query($con, "select * from user_details where ud_id !=1");
    $json = array();
    while ($row = mysqli_fetch_array($qry)) {
        $json[] = array(
            "ud_id" => $row['ud_id'],
            "ud_fname" => $row['ud_fname'],
            "ud_lname" => $row['ud_lname'],
            "ud_email" => $row['ud_email'],
            "ud_mobile" => $row['ud_mobile'],
            "ud_address" => $row['ud_address'],
            "ud_type" => $row['ud_type']
        );
    }
    $jsonstring = json_encode($json);
    echo $jsonstring;
} elseif ($page == "disable_user") {
    $id = $_POST["id"];
    $dis = $_POST['dis'];
    mysqli_query($con, "select * from user_details where ud_id =$id");
    if (mysqli_affected_rows($con) == 0) {
        $msg = 0;
    } else {
        if ($dis == "1") {
            mysqli_query($con, "UPDATE `user_details` SET `ud_type`=1 WHERE ud_id =$id");
            if (mysqli_affected_rows($con) == 0) {
                $msg = 1;
            } else {
                $msg = 2;
            }
        } else {
            mysqli_query($con, "UPDATE `user_details` SET `ud_type`=0 WHERE ud_id =$id");
            if (mysqli_affected_rows($con) == 0) {
                $msg = 1;
            } else {
                $msg = 2;
            }
        }
    }
    echo $msg;
} elseif ($page == "update_prd") {
    $qry = mysqli_query($con, "select * from product_details");
    $json = array();
    while ($row = mysqli_fetch_array($qry)) {
        $json[] = array(
            "prd_id" => $row['prd_id'],
            "prd_name" => $row['prd_name'],
            "prd_about" => $row['prd_about'],
            "prd_mrp" => $row['prd_mrp'],
            "prd_image" => $row['prd_image'],
            "prd_quantity" => $row['prd_quantity']
        );
    }
    $jsonstring = json_encode($json);
    echo $jsonstring;
} elseif ($page == "update_cat") {
    $qry = mysqli_query($con, "select * from category");
    $json = array();
    while ($row = mysqli_fetch_array($qry)) {
        $json[] = array(
            "cat_id" => $row['cat_id'],
            "cat_name" => $row['cat_name']
        );
    }
    $jsonstring = json_encode($json);
    echo $jsonstring;
}

else if($page=="chartyear")
{
    $data=array();$year=$_POST['year'];
    for($i=1;$i<13;$i++)
    {
    $result1=mysqli_query($con,"SELECT COUNT(order_details.ord_id) AS ord_total,SUM(oprd_qty*oprd_unit_price) AS total FROM order_details INNER JOIN order_products ON order_details.ord_id=order_products.ord_id WHERE MONTH(order_details.ord_date)='$i' AND order_details.ord_status=3 AND '2016'=YEAR(order_details.ord_date) GROUP BY MONTH(ord_date)");
    if(mysqli_num_rows($result1)==NULL)
        {
        $data[]=array("0"=>"0",'order_total'=>0);
        }
        else
            {
            while($row=mysqli_fetch_array($result1))
                {
                $data[]=$row;
                }
            }
    }
    print json_encode($data);
}

else if($page=="chartmonth")
{
    $data=array();$month=$_GET['month'];
    $d=cal_days_in_month(CAL_GREGORIAN,$month,date('Y'));
    for($i=1;$i<$d+1;$i++)
        {
            $result1=  mysqli_query($con,"SELECT COUNT(order_details.ord_id) AS ord_total,SUM(oprd_qty*oprd_unit_price) AS total FROM order_details INNER JOIN order_products ON order_details.ord_id=order_products.ord_id  WHERE DAY(order_details.ord_date)='$i' AND '$month'=MONTH(order_details.ord_date) AND order_details.ord_status=3 GROUP BY DAY(order_details.ord_date)");
            if(mysqli_num_rows($result1)==NULL)
        {
        $data[]=array("0"=>"0",'order_total'=>0);
        }
        else
            {
            while($row=mysqli_fetch_array($result1))
                {
                $data[]=$row;
                }
            }
        }
    print json_encode($data);
}
else if($page=="chart_custom")
{
    $data=array();$month=$_POST['month'];$year=$_POST['year'];
    $d=cal_days_in_month(CAL_GREGORIAN,$month,date('Y'));
    for($i=1;$i<$d+1;$i++)
        {
            $result1=  mysqli_query($con,"SELECT COUNT(order_details.ord_id) AS ord_total,SUM(oprd_qty*oprd_unit_price) AS total FROM order_details INNER JOIN order_products ON order_details.ord_id=order_products.ord_id  WHERE DAY(order_details.ord_date)='$i' AND '$month'=MONTH(order_details.ord_date) AND '$year'=YEAR(order_details.ord_date) AND order_details.ord_status=3 GROUP BY DAY(order_details.ord_date)");
            if(mysqli_num_rows($result1)==NULL)
        {
        $data[]=array("0"=>"0",'order_total'=>0);
        }
        else
            {
            while($row=mysqli_fetch_array($result1))
                {
                $data[]=$row;
                }
            }
        }
    print json_encode($data);
}
else if($page=="chartyearp")
{
    $data=array();$year=$_POST['year'];$id=$_POST['id'];
    for($i=1;$i<13;$i++)
    {
    $result1=mysqli_query($con,"SELECT SUM(oprd_qty) AS ord_total,SUM(oprd_qty*oprd_unit_price) AS total FROM order_details INNER JOIN order_products ON order_details.ord_id=order_products.ord_id WHERE MONTH(order_details.ord_date)='$i' AND order_details.ord_status=3 AND '2016'=YEAR(order_details.ord_date) AND order_products.prd_id='$id' GROUP BY MONTH(ord_date)");
    if(mysqli_num_rows($result1)==NULL)
        {
        $data[]=array("0"=>"0",'order_total'=>0);
        }
        else
            {
            while($row=mysqli_fetch_array($result1))
                {
                $data[]=$row;
                }
            }
    }
    print json_encode($data);
}

else if($page=="chartmonthp")
{
    $data=array();$month=$_POST['month'];$id=$_POST['id'];
    $d=cal_days_in_month(CAL_GREGORIAN,$month,date('Y'));
    for($i=1;$i<$d+1;$i++)
        {
            $result1=  mysqli_query($con,"SELECT SUM(oprd_qty) AS ord_total,SUM(oprd_qty*oprd_unit_price) AS total FROM order_details INNER JOIN order_products ON order_details.ord_id=order_products.ord_id  WHERE DAY(order_details.ord_date)='$i' AND '$month'=MONTH(order_details.ord_date) AND order_details.ord_status=3 AND order_products.prd_id='$id' GROUP BY DAY(order_details.ord_date)");
            if(mysqli_num_rows($result1)==NULL)
        {
        $data[]=array("0"=>"0",'order_total'=>0);
        }
        else
            {
            while($row=mysqli_fetch_array($result1))
                {
                $data[]=$row;
                }
            }
        }
    print json_encode($data);
}
else if($page=="chart_customp")
{
    $data=array();$month=$_POST['month'];$year=$_POST['year'];$id=$_POST['id'];
    $d=cal_days_in_month(CAL_GREGORIAN,$month,date('Y'));
    for($i=1;$i<$d+1;$i++)
        {
            $result1=  mysqli_query($con,"SELECT SUM(oprd_qty) AS ord_total,SUM(oprd_qty*oprd_unit_price) AS total FROM order_details INNER JOIN order_products ON order_details.ord_id=order_products.ord_id  WHERE DAY(order_details.ord_date)='$i' AND '$month'=MONTH(order_details.ord_date) AND '$year'=YEAR(order_details.ord_date) AND order_details.ord_status=3 AND order_products.prd_id='$id' GROUP BY DAY(order_details.ord_date)");
            if(mysqli_num_rows($result1)==NULL)
        {
        $data[]=array("0"=>"0",'order_total'=>0);
        }
        else
            {
            while($row=mysqli_fetch_array($result1))
                {
                $data[]=$row;
                }
            }
        }
    print json_encode($data);
}
else if($page=="chartyearc")
{
    $data=array();$year=$_POST['year'];$id="1";
    for($i=1;$i<13;$i++)
    {
        $a=0;$b=0;
    $result1=mysqli_query($con,"SELECT SUM(oprd_qty) AS ord_total,SUM(oprd_qty*oprd_unit_price) AS total FROM order_products INNER JOIN order_details ON order_details.ord_id=order_products.ord_id INNER JOIN product_details ON product_details.prd_id=order_products.prd_id WHERE MONTH(order_details.ord_date)='$i' AND order_details.ord_status=3 AND '2016'=YEAR(order_details.ord_date) AND product_details.cat_id=$id GROUP BY MONTH(ord_date)");
    if(mysqli_num_rows($result1)==NULL)
        {
        $data[]=array('order_total'=>0,'total'=>0);
        }
        else
            {
            while($row=mysqli_fetch_array($result1))
                {
                    $data[]=$row;
                }
            }
    }
    print json_encode($data);
}

else if($page=="chartmonthc")
{
    $data=array();$month=$_POST['month'];$id=$_POST['id'];
    $d=cal_days_in_month(CAL_GREGORIAN,$month,date('Y'));
    for($i=1;$i<$d+1;$i++)
        {
            $result1=  mysqli_query($con,"SELECT SUM(oprd_qty) AS ord_total,SUM(oprd_qty*oprd_unit_price) AS total FROM order_details INNER JOIN order_products ON order_details.ord_id=order_products.ord_id  WHERE DAY(order_details.ord_date)='$i' AND '$month'=MONTH(order_details.ord_date) AND order_details.ord_status=3 AND order_products.prd_id='$id' GROUP BY DAY(order_details.ord_date)");
            if(mysqli_num_rows($result1)==NULL)
        {
        $data[]=array("0"=>"0",'order_total'=>0);
        }
        else
            {
            while($row=mysqli_fetch_array($result1))
                {
                $data[]=$row;
                }
            }
        }
    print json_encode($data);
}
else if($page=="chart_customc")
{
    $data=array();$month=$_POST['month'];$year=$_POST['year'];$id=$_POST['id'];
    $d=cal_days_in_month(CAL_GREGORIAN,$month,date('Y'));
    for($i=1;$i<$d+1;$i++)
        {
            $result1=  mysqli_query($con,"SELECT SUM(oprd_qty) AS ord_total,SUM(oprd_qty*oprd_unit_price) AS total FROM order_details INNER JOIN order_products ON order_details.ord_id=order_products.ord_id  WHERE DAY(order_details.ord_date)='$i' AND '$month'=MONTH(order_details.ord_date) AND '$year'=YEAR(order_details.ord_date) AND order_details.ord_status=3 AND order_products.prd_id='$id' GROUP BY DAY(order_details.ord_date)");
            if(mysqli_num_rows($result1)==NULL)
        {
        $data[]=array("0"=>"0",'order_total'=>0);
        }
        else
            {
            while($row=mysqli_fetch_array($result1))
                {
                $data[]=$row;
                }
            }
        }
    print json_encode($data);
}

else if($page=="search")
{
    $value=$_POST['value'];$view=$_POST['view'];$set=null;
    if($view=="list"){$set="1";}
    if($value!=NULL )
        {
            $result=mysqli_query($con,"SELECT prd_id,prd_name,prd_image FROM product_details WHERE prd_name LIKE '%$value%'");
            if(strlen($value)>0 && mysqli_num_rows($result)==0){
            
                echo "No Results Found";
            }
                else{
                    echo "<table style='width:150px;' border='1'><tr>";$count=1;
                while($row=mysqli_fetch_array($result))
            {
                echo "<td style='width:150px;height:100px;'><center><a style='color:red' href='Home.php#".$row['prd_id'].$set."'><img src='./Admin_Panel".$row['prd_image']."' style='display:block;height:100px;width:100px;'>".$row['prd_name']."</a></center></td><td>&emsp;&emsp;&emsp;&emsp;</td>";
                if($count%10==0){echo "</tr>";}
                $count++;
            }
            echo "</tr></table>";
            
            }
            
        }
}

else if($page=="search0")
{
    $value=$_POST['value'];
    if($value!=NULL )
        {
            $result=mysqli_query($con,"SELECT ord_id FROM order_details WHERE ord_id LIKE '$value%' ORDER BY ord_id");
            if(strlen($value)>0 && mysqli_num_rows($result)==0){
            
                echo "No Results Found";
            }
                else{
                    echo "<table style='width:150px;' border='1'><tr>";$count=1;
                while($row=mysqli_fetch_array($result))
            {
                echo "<td><center><a style='color:red' href='vieworder.php#".$row['ord_id']."'>".$row['ord_id']."</a></center></td>";
                if($count%10==0){echo "</tr>";}
                $count++;
            }
            echo "</tr></table>";
            
            }
            
        }
}

else if($page=="search2")
{
    $value=$_POST['value'];$name=$_POST['n'];
    if($value!=NULL )
        {
            $result=mysqli_query($con,"SELECT ud_id,ud_fname,ud_lname FROM user_details WHERE ud_".$name." LIKE '$value%'");
            if(strlen($value)>0 && mysqli_num_rows($result)==0){
            
                echo "No Results Found";
            }
                else{
                    echo "<table style='width:150px;'><tr>";$count=1;
                while($row=mysqli_fetch_array($result))
            {
                echo "<td style='width:150px;height:100px;'><center><a style='color:red;' href='disable_user.php#".$row['ud_id']."'>".$row['ud_fname']." ".$row['ud_lname']."</a></center></td><td>&emsp;&emsp;&emsp;&emsp;</td>";
                if($count%6==0){echo "</tr>";}
                $count++;
            }
            echo "</tr></table>";
            
            }
            
        }

}


else  if($page=="changeorderstatus")
 {
     $status=$_POST['status'];$or_id=$_POST['or_id'];
     $res=mysqli_query($con,"SELECT ord_status FROM order_details WHERE ord_id='$or_id'");
     $res1=mysqli_fetch_array($res);
     if($res1['ord_status']=="4"||$res1['ord_status']=="5")
     {
         echo "0";
     }
     else
         {
     $email=$_SESSION['name'];
     $result=mysqli_query($con,"UPDATE order_details SET ord_status='$status' WHERE ord_id='$or_id'");
     if($result)
         {
            if($status=="1"){mail($email,"Order is Confirmed","Your order with Order ID :.".$or_id." has been confirmed.","From: order@fruitkart.com");}
            else if($status=="2"){mail($email,"Order Has Been Dispatched","Your order with Order ID :.".$or_id." has been dispatched.","From: order@fruitkart.com");}
            else if($status=="3"){if(mail($email,"Order Has Been Delivered","Your order with Order ID :.".$or_id." has been delivered.","From: order@fruitkart.com")){echo "dd<br>";}}
            else if($status=="4" || $status=="5")
                {
                    $a=mysqli_query($con,"SELECT prd_id,oprd_qty FROM order_products WHERE ord_id='".$or_id."'");
                    while($a1=mysqli_fetch_array($a))
                    {
                        mysqli_query($con,"UPDATE product_details SET prd_quantity=prd_quantity+'".$a1['oprd_qty']."' WHERE prd_id='".$a1['prd_id']."'");
                    }
                }
         
            echo "Status Changed";
            
                    }
         else
             {
             echo mysqli_error($con);}
        }       
 }
 
 elseif($page=="add_off")
 {
     $off_name=$_POST['offer_name'];
     $off_code=$_POST['offer_code'];
     $off_amt=$_POST['offer_amt'];
     $off_pro=$_POST['pro_name'];
     $off_type="1";
     //echo $off_pro;
         $qry = mysqli_query($con,"INSERT INTO `offer_details`(`ofd_name`,ofd_type, `ofd_code`, `ofd_amount`,ofd_product)
     VALUES ('$off_name','$off_type','$off_code', $off_amt,'$off_pro')");
         if($qry)
         {
             header("refresh:0; url= http://localhost/DwarkeshBakers/Admin_Panel/Add_Offer_p.php");
         }
         else
         {
             header("refresh:0; url= http://localhost/DwarkeshBakers/Admin_Panel/404.html");
         }
 }


 
?>