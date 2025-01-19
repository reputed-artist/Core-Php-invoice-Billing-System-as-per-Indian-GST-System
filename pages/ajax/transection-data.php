<?php
header('Content-Type: application/json');
include_once("../dbconnection.php");


$sql = "SELECT (@row_number:=@row_number + 1) AS serial_number, ph.pay_id, CASE WHEN ph.type_cs = 1 THEN s.pcname WHEN ph.type_cs = 2 THEN c.c_name ELSE 'Unknown' END AS c_name, CASE WHEN ph.type_cs = 1 THEN SUBSTRING_INDEX(s.pcadd, ',', -1) WHEN ph.type_cs = 2 THEN SUBSTRING_INDEX(c.c_add, ',', -1) ELSE NULL END AS location, ph.amount, ph.dateofpayment, ph.purpose, ph.mode, ph.type_cs, ph.created FROM paidhistory ph LEFT JOIN purchasecom s ON ph.p_m = s.pcid AND ph.type_cs = 1 LEFT JOIN client c ON ph.p_m = c.cid AND ph.type_cs = 2 CROSS JOIN (SELECT @row_number := 0) AS rn";



if (isset($_GET['startDate']) && isset($_GET['endDate'])) {
	$todates = $_GET['startDate'];
    $fromdates = $_GET['endDate'];

    $sql .= " WHERE ph.dateofpayment BETWEEN '$todates' AND '$fromdates'";
    
    if (isset($_GET['customer']) && $_GET['customer'] !=null ) {
        $customer = addslashes($_GET['customer']);
        $sql .= " AND c.c_name = '$customer'";
    }

    if (isset($_GET['supplier']) && $_GET['supplier'] !=null ) {
        $supplier = addslashes($_GET['supplier']);
        $sql .= " AND s.pcname = '$supplier'";
    }
    if (isset($_GET['ctype']) && $_GET['ctype'] !=null ) {
        $type = $_GET['ctype'];
        $sql .= " AND ph.type_cs = $type";
    }
}


//echo $sql;
$totalamount=0;

$resultset = mysqli_query($con, $sql) or die("database error:". mysqli_error($con));
$data = array();
$c=array();
$cid=1;
$pos=0;
while( $rows = mysqli_fetch_assoc($resultset) ) {
	$data[]=$rows;
    $totalamount+=$rows['amount'];

	//echo var_dump($rows);

}


//echo var_dump($data);
$results = array(

	"sEcho" => 1,
"iTotalRecords" => count($data),
"iTotalDisplayRecords" => count($data),
  "aaData"=>$data,
  "totalamount"=> $totalamount,
  );

echo json_encode($results);

?>