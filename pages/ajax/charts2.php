<?php
include'../dbconnection.php';

include '../fy.php';


if(isset($_GET['p_name']))

{    
    $pn=$_GET['p_name'];
   // echo $pn;
// Query 1: Count of GST lengths
$query1 = "SELECT CASE WHEN MONTH(invtest2.created) >= 4 THEN CONCAT(YEAR(invtest2.created), '-', RIGHT(YEAR(invtest2.created) + 1, 2)) ELSE CONCAT(YEAR(invtest2.created) - 1, '-', RIGHT(YEAR(invtest2.created), 2)) END AS FinancialYear, invtest.`item_name` AS ItemName, count(invtest.quantity) AS TotalQuantity FROM invtest INNER JOIN invtest2 ON invtest.orderid = invtest2.orderid WHERE invtest.item_name ='$pn' GROUP BY FinancialYear, invtest.`item_name` ORDER BY FinancialYear DESC LIMIT 8";


//echo $query1;

$result1 = $con->query($query1);
$data1 = array();


while ($row = $result1->fetch_assoc()) {
    $data1[] = array('label' => $row['FinancialYear'], 'value' => $row['TotalQuantity']);
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