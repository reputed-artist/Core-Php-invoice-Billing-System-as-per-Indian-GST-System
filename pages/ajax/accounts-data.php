<?php
include_once("../dbconnection.php");

$sql = "SELECT account.aid,purchasecom.pcid,purchasecom.pcname,substring_index(purchasecom.pcadd, ',', -1) as location ,purchasecom.pcmob,acc_type.type,account.opening_bal,account.created FROM purchasecom INNER JOIN account ON purchasecom.pcid = account.cid INNER JOIN acc_type ON account.acc_type = acc_type.id and acc_type=1 UNION SELECT account.aid,client.cid,client.c_name,

substring_index(client.c_add, ',', -1) as location ,client.mob,acc_type.type,account.opening_bal,account.created FROM client INNER JOIN account ON client.cid = account.cid INNER JOIN acc_type ON account.acc_type = acc_type.id and acc_type =2";
$resultset = mysqli_query($con, $sql) or die("database error:". mysqli_error($conn));
$data = array();
$c=array();
$cid=1;
$pos=0;
while( $rows = mysqli_fetch_assoc($resultset) ) {
	$data[]=$rows;

	//echo var_dump($rows);

}


//echo var_dump($data);
$results = array(

	"sEcho" => 1,
"iTotalRecords" => count($data),
"iTotalDisplayRecords" => count($data),
  "aaData"=>$data);

echo json_encode($results);

?>