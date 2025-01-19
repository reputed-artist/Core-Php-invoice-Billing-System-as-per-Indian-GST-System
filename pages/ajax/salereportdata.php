<?php
header('Content-Type: application/json');
include_once("../dbconnection.php");

$sql = "SELECT ROW_NUMBER() OVER () AS id, invtest.item_name AS item, invtest2.invid AS `inv no`, invtest2.created AS `inv date`, client.c_name AS client, SUBSTRING_INDEX(client.c_add, ',', -1) AS location, client.gst AS GST, client.c_type AS c_type, invtest2.subtotal AS subtotal, invtest2.taxrate AS taxrate, invtest2.taxamount AS taxamount, invtest2.totalamount AS totalamount FROM invtest2 INNER JOIN invtest ON invtest.orderid = invtest2.orderid INNER JOIN client ON invtest2.cid = client.cid ";

$todates = $_GET['startDate'];
$fromdates = $_GET['endDate'];
$item = addslashes($_GET["item_name"]);
$customer = addslashes($_GET["customer"]);

if (isset($_GET['startDate']) && isset($_GET['endDate'])) {
    $sql .= " WHERE invtest2.created BETWEEN '$todates' AND '$fromdates'";
    if (!empty($item)) {
        $sql .= " AND invtest.item_name = '$item'";
    }
    if (!empty($customer)) {
        $sql .= " AND client.c_name = '$customer'";
    }
    $sql .= " GROUP BY invtest.orderid";
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
