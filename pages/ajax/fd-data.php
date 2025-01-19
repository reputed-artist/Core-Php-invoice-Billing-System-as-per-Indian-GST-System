<?php
include_once("../dbconnection.php");

$sql = "SELECT id,fdissueddate,fdholder,fdofbank,principleamt,intrate,intamt,finalamt,maturitydate,fdentrydate From fd";
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