<?php
include'../dbconnection.php';

include '../fy.php';


if(isset($_GET['infoid']))

{    
    $pn=$_GET['infoid'];
   // echo $pn;
// Query 1: Count of GST lengths
$query1 = "SELECT CASE WHEN MONTH(invtest2.created) >= 4 THEN CONCAT(YEAR(invtest2.created), '-', RIGHT(YEAR(invtest2.created) + 1, 2)) ELSE CONCAT(YEAR(invtest2.created) - 1, '-', RIGHT(YEAR(invtest2.created), 2)) END AS FinancialYear, SUM(invtest2.totalamount) AS TotalAmount FROM invtest2 INNER JOIN ( SELECT orderid, SUM(quantity) AS total_quantity FROM invtest GROUP BY orderid ) AS invtest ON invtest.orderid = invtest2.orderid WHERE invtest2.cid = $pn GROUP BY FinancialYear ORDER BY FinancialYear DESC LIMIT 3";


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