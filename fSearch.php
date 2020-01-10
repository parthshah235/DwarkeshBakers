<?php

include './connection.php';

$page = $_GET['page'];
$value = $_GET['value'];
$json = 0;
if ($page == "search") {
    if (preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $value) || $value == ' ' || $value == '') {
        $json;
    } else {
        $qry = mysqli_query($con, "select * from product_details where prd_name like '%$value%'");
        $json = array();
        while ($row = mysqli_fetch_array($qry)) {
            $json[] = array(
                'prd_id' => $row['prd_id'],
                'prd_name' => $row['prd_name'],
                'prd_mrp' => $row['prd_mrp']
            );
        }
    }
    $jsonstring = json_encode($json);
    echo $jsonstring;
}
?>