<?php
header('Content-Type: application/json');
include_once("../dbconnection.php");

$sql = "SELECT ROW_NUMBER() OVER () AS id, purchaseinv.item_name 'item',purchaseinv2.invid 'inv no',purchaseinv2.invdate 'inv date', purchasecom.pcname 'supplier',substring_index(purchasecom.pcadd, ',', -1) as location, purchasecom.gst 'GST',purchasecom.pcomtype 'c_type', purchaseinv2.subtotal 'subtotal',purchaseinv2.taxrate 'Taxrate',purchaseinv2.taxamount 'taxamount',purchaseinv2.totalamount 'totalamount' from purchaseinv2 inner join purchaseinv on purchaseinv.orderid = purchaseinv2.orderid inner join purchasecom on purchasecom.pcid = purchaseinv2.cid ";


$todates = $_GET['startDate'];
$fromdates = $_GET['endDate'];
$item = addslashes($_GET["item_name"]);
$supplier = addslashes($_GET["supplier"]);

if (isset($_GET['startDate']) && isset($_GET['endDate'])) {
    $sql .= " WHERE purchaseinv2.invdate BETWEEN '$todates' AND '$fromdates'";
    if (!empty($item)) {
        $sql .= " AND purchaseinv.item_name = '$item'";
    }
    if (!empty($supplier)) {
        $sql .= " AND purchasecom.pcname = '$supplier'";
    }
    $sql .= " GROUP BY purchaseinv.orderid";
}

//echo $sql;

$totalamount=0;
$taxamt=0;
$subtotal=0;


$resultset = mysqli_query($con, $sql) or die("database error:". mysqli_error($con));
$data = array();
while ($rows = mysqli_fetch_assoc($resultset)) {
    $data[] = $rows;
    $subtotal += $rows['subtotal'];
    $taxamt += $rows['taxamount'];
    $totalamount+=$rows['totalamount'];
}

$results = array(
    "sEcho" => 1,
    "iTotalRecords" => count($data),
    "iTotalDisplayRecords" => count($data),
    "aaData" => $data,
    "subtotal" => $subtotal,
    "taxamt" => $taxamt,
    "totalamount"=> $totalamount
);

echo json_encode($results);

?>
