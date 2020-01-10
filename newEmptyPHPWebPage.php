<?php

include './connection.php';
//    echo md5(uniqid(rand()));
//echo md5("who")
$res= mysqli_query($con, "SELECT * FROM user_details ORDER BY ud_id DESC");
$row= mysqli_fetch_array($res);
$md5Id = md5($row['ud_id']);
$id = $row['ud_id'];
$tempId = $md5Id.$id;

echo substr($tempId, 32);
?>