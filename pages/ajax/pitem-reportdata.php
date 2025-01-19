<?php
header('Content-Type: application/json');
include_once("../dbconnection.php");

$sql = "SELECT ROW_NUMBER() OVER () AS id, purchaseinv.item_name AS item, purchaseinv.item_desc,purchaseinv.hsn,purchaseinv.quantity, purchaseinv.price As price, purchaseinv.total AS subtotal, purchaseinv2.taxrate, purchaseinv2.invdate FROM purchaseinv2 INNER JOIN purchaseinv ON purchaseinv.orderid = purchaseinv2.orderid INNER JOIN products ON purchaseinv.item_name=products.name";


$todates = $_GET['startDate'];
$fromdates = $_GET['endDate'];
$item = addslashes($_GET["item_name"]);
// $customer = addslashes($_GET["customer"]);

if (isset($_GET['startDate']) && isset($_GET['endDate'])) {
    $sql .= " WHERE purchaseinv2.invdate BETWEEN '$todates' AND '$fromdates'";
    if (!empty($item)) {
        $sql .= " AND purchaseinv.item_name = '$item'";
    }
   
    //$sql .= " GROUP BY invtest.item_name";
}

//echo $sql;

$quantity=0;
$totalamount=0;
$taxamt=0;
$subtotal=0;

$baseamt=0;
// Calculate GST amount
//$gstAmount = ($amount * $gstPercentage) / 100;

// Calculate total amount including GST
//$totalAmount = $amount + $gstAmount;


$resultset = mysqli_query($con, $sql) or die("database error:". mysqli_error($con));
$data = array();
while ($rows = mysqli_fetch_assoc($resultset)) {

    $price = $rows['subtotal'];
    $gstPercentage = 18; // GST percentage

    // Calculate GST amount for this row's price
    $gstAmount = ($price * 18) / 100;

    // Add the calculated GST to the row's data
    $rows['taxamt'] = $gstAmount;
    $rows['totalamount']=$gstAmount+$price;



    $data[] = $rows;
    $baseamt += $rows['price'];
    $quantity += $rows['quantity'];
    $subtotal +=$rows['subtotal'];

    $taxamt += $rows['taxamt'];
    $totalamount +=$rows['totalamount'];
   // $totalamount+=($subtotal + $taxamt);
}

$results = array(
    "sEcho" => 1,
    "iTotalRecords" => count($data),
    "iTotalDisplayRecords" => count($data),
    "aaData" => $data,
    "baseamt"=> $baseamt,
    "quantity"=> $quantity,
    "subtotal" => $subtotal,
    "taxamt" => $taxamt,
    "totalamount"=> $totalamount
);

echo json_encode($results);

?>
