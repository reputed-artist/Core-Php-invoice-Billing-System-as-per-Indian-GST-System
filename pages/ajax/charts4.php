<?php
include'../dbconnection.php';

include '../fy.php';


if(isset($_GET['infoid']))

{    
    $pn=$_GET['infoid'];
   // echo $pn;
// Query 1: Count of GST lengths
$query1 = "SELECT CASE WHEN MONTH(purchaseinv2.created) >= 4 THEN CONCAT(YEAR(purchaseinv2.created), '-', RIGHT(YEAR(purchaseinv2.created) + 1, 2)) ELSE CONCAT(YEAR(purchaseinv2.created) - 1, '-', RIGHT(YEAR(purchaseinv2.created), 2)) END AS FinancialYear, SUM(purchaseinv2.totalamount) AS TotalAmount FROM purchaseinv2 INNER JOIN ( SELECT orderid, SUM(quantity) AS total_quantity FROM purchaseinv GROUP BY orderid ) AS purchaseinv ON purchaseinv.orderid = purchaseinv2.orderid WHERE purchaseinv2.cid = $pn GROUP BY FinancialYear ORDER BY FinancialYear DESC LIMIT 5";


//echo $query1;

$result1 = $con->query($query1);
$data1 = array();


while ($row = $result1->fetch_assoc()) {
    $data1[] = array('label' => $row['FinancialYear'], 'value' => $row['TotalAmount']);
}


// Combine data into a single array
$combinedData = array(
    'pie1' => $data1,
    
);


// Convert the combined data to JSON
echo json_encode($combinedData);

}
$con->close();
?>