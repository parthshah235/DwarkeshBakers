<?php

include '../connection.php';

$udId = $_GET['ud_id'];
$ordId = $_GET['ord_id'];
$qry = mysqli_query($con, "SELECT * from user_details where ud_id='$udId'");
while ($row = mysqli_fetch_array($qry)) {
    $fname = $row['ud_fname'];
    $lname = $row['ud_lname'];
}
$name = $fname . " " . $lname;

$billno = $ordId;

$qry2 = mysqli_query($con, "SELECT * from order_details where ud_id='$udId'");
while ($row2 = mysqli_fetch_array($qry2)) {
    $date = $row2['ord_date'];
    $add = $row2['ord_shipping_address'];
}
$cd = date("d-m-Y");
require '../js/fpdf/fpdf.php';

class PDF extends FPDF {

// Page header
    function Header() {

        $this->SetFont('Arial', '', 10);
        $this->Cell(0, 10, "Cash/Credit Memo", 0, 1, "C");
        $this->SetFont('Arial', '', 30);
        $this->Cell(0, 10, "PARAS FLOUR MILL", 0, 1, "C");
        $this->SetFont('Arial', '', 10);
        $this->Cell(0, 10, "T-66, Paras Flour Mill, Nr. Sant Kanwar Garden, Warashia, Vadodara-6. (Guj.)", 0, 1, "C");

//Customer Name
        $this->Cell(29, 7, "Customer Name : ", 0, 0);
        $this->Cell(83, 7, $GLOBALS['name'], 0, 0);
        $this->Line(40, 45, 120, 45);

//Bill Number
        $this->SetFont('Arial', '', 10);
        $this->Cell(22, 7, "Bill Number : ", 0);
        $this->Cell(2, 7, $GLOBALS['billno'], 0, 1);
        $this->Line(145, 45, 190, 45);

//Delivery Address
        $this->Cell(17, 7, "Address : ", 0, 0);
        $this->Cell(89, 7, $GLOBALS['add'], 0, 1);
        $this->Line(28, 52, 190, 52);

//Delivery Details
        $this->Cell(23, 7, "Delivered By : ", 0, 0);
        $this->Cell(89, 7, "", 0, 0);
        $this->Line(34, 59, 120, 59);

//Delivery Date
        $this->Cell(11, 7, "Date : ", 0, 0);
        $this->Cell(10, 7, $GLOBALS['date'], 0, 1);
        $this->Line(134, 59, 190, 59);
        $this->Line(10, 66, 200, 66);
    }

// Page footer
    function Footer() {

        $this->SetY(-50);
        $this->Line(0, 245, 210, 245);
        $this->SetFont('Arial', 'B', 15);
        $this->Cell(0, 10, "PARAS FLOUR MILL", 0, 1, "C");
        $this->SetFont('Arial', '', 10);
        $this->Cell(0, 10, "T-66, Paras Flour Mill, Nr. Sant Kanwar Garden, Warashia, Vadodara-6. (Guj.)", 0, 1, "C");

//Bill Number
        $this->Cell(21, 5, "Bill Number : ", 0);
        $this->Cell(83, 5, $GLOBALS['billno'], 0);
        $this->Line(32, 271, 80, 271);

//Delivery Date
        $this->Cell(10, 5, "Date : ", 0);
        $this->Cell(2, 5, $GLOBALS['cd'], 0, 1);
        $this->Line(125, 271, 190, 271);

//Name
        $this->Cell(12, 5, "Name : ", 0);
        $this->Cell(75, 5, $GLOBALS['name'], 0);
        $this->Line(23, 276, 80, 276);

//Tempo Number
        $this->Cell(2, 5, "Tempo Number : ", 0, 1);
        $this->Line(125, 276, 190, 276);

//Delivery Address
        $this->Cell(16, 5, "Address : ", 0, 0);
        $this->Cell(89, 5, $GLOBALS['add'], 0, 1);
        $this->Line(27, 281, 190, 281);
        
//Amount
        $this->Cell(80, 5, "Amount : ", 0);
        $this->Line(26, 286, 80, 286);

//Customer Signature
        $this->Cell(10, 5, "Customer Signature : ", 0, 1);
        $this->Line(125, 286, 190, 286);

// Arial italic 8
        $this->SetFont('Arial', 'I', 8);
        
// Page number
        $this->Cell(0, 10, 'Page ' . $this->PageNo() . '/{nb}', 0, 0, 'C');
    }

}

// Instanciation of inherited class
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();

//Table header
$pdf->Ln();
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(20, 10, "Sr. no.", 0);
$pdf->Cell(80, 10, "Product Name", 0);
$pdf->Cell(25, 10, "Quantity", 0);
$pdf->Cell(20, 10, "Price", 0);
$pdf->Cell(20, 10, "Subtotal", 0);

$pdf->Ln();

$pdf->SetFont('Arial', '', 10);
$user_id = $udId;

$total_price = 0;
$i = 1;
$sql1 = "SELECT * FROM order_product WHERE ord_id=" . $ordId . "";
$result1 = mysqli_query($con, $sql1);
while ($row1 = mysqli_fetch_array($result1)) {
    $sql2 = "SELECT * FROM product_details WHERE prd_id=" . $row1["prd_id"] . "";
    $result2 = mysqli_query($con, $sql2);
    while ($row2 = mysqli_fetch_array($result2)) {
        $pdf->Cell(20, 10, "    " . $i, 0);
        $pdf->Cell(80, 10, $row2["prd_name"], 0);
        $pdf->Cell(20, 10, $row1["oprd_qty"], 0, 0, "C");
        $pdf->Cell(25, 10, $row2["prd_sell_rate"], 0, 0, "C");
        $subtotal = $row2["prd_sell_rate"] * $row1["oprd_qty"];
        $pdf->Cell(20, 10, $subtotal . ".00", 0, 0, "C");
        $total_price+=$subtotal;
        $i++;
        $pdf->Ln();
    }
}

$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(80, 10, "", 0);
$pdf->Cell(38, 10, "", 0);
$pdf->Cell(30, 10, "Total", 0, 0, "C");
$pdf->Cell(20, 10, $total_price . ".00", 0, 0, "C");

$pdf->Output();
?>