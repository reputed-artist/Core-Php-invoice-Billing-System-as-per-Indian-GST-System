<?php
include'../dbconnection.php';

include '../fy.php';



$query5 = "SELECT query1.Months, query1.Turnover, query1.Tax, query2.item_name, query2.item_sold FROM ( select date_format(created,'%b') 'Months',sum(totalamount) 'Turnover',sum(taxamount) 'Tax' from invtest2 WHERE created between '$startyear-04-01' AND '$endyear-03-31' group by year(created),month(created) ) query1 JOIN ( SELECT DATE_FORMAT(invtest2.created, '%b') AS Months, item_name, COUNT(item_name) AS item_sold, invtest2.created, RANK() OVER (PARTITION BY DATE_FORMAT(invtest2.created, '%Y-%m') ORDER BY COUNT(item_name) DESC, SUM(total) DESC) AS item_rank FROM invtest INNER JOIN invtest2 ON invtest.orderid = invtest2.orderid INNER JOIN products ON invtest.item_name = products.name WHERE products.p_type = 'Machine' AND invtest2.created BETWEEN '$startyear-04-01' AND '$endyear-03-31' GROUP BY item_name, DATE_FORMAT(invtest2.created, '%Y-%m') ) query2 ON query1.Months = query2.Months WHERE query2.item_rank = 1";

$result5 = $con->query($query5);
$data5 = array();

while ($row = $result5->fetch_assoc()) {
    $data5[] = array("y" => $row['Months'] , "a" =>($row['Turnover']), 
          "b" =>($row['Tax']), "c" =>($row['item_sold']),"label" =>($row['item_name']));
}


// $query5 = "SELECT MONTH(invtest2.created) AS Months, SUM(totalamount) AS Turnover, SUM(taxamount) AS Tax, item_name, COUNT(item_name) AS item_sold FROM invtest2 INNER JOIN invtest ON invtest.orderid = invtest2.orderid INNER JOIN products ON invtest.item_name = products.name WHERE products.p_type = 'Machine' AND invtest2.created BETWEEN '$startyear-04-01' AND '$endyear-03-31' GROUP BY MONTH(created), item_name";

// $result5 = $con->query($query5);

// $data5 = array();

// while ($row = $result5->fetch_assoc()) {
//    $data5[] = array("y" => $row['Months'] , "a" =>($row['Turnover']), 
//            "b" =>($row['Tax']), "c" =>($row['item_sold']),"label" =>($row['item_name']));
// }



// Query 1: Count of GST lengths
$query1 = "SELECT CASE WHEN CHAR_LENGTH(gst) = 15 THEN 'GST' WHEN CHAR_LENGTH(gst) IN (10, 9) THEN 'PAN' WHEN CHAR_LENGTH(gst) = 12 THEN 'Adhaar' ELSE 'TIN' END AS Category, COUNT(*) AS Count FROM client GROUP BY Category";
$result1 = $con->query($query1);
$data1 = array();

while ($row = $result1->fetch_assoc()) {
    $data1[] = array('label' => $row['Category'], 'value' => $row['Count']);
}

// Query 2: Count of clients by country
$query2 = "SELECT country, COUNT(*) AS country_count FROM client GROUP BY country";
$result2 = $con->query($query2);
$data2 = array();

while ($row = $result2->fetch_assoc()) {
    $data2[] = array('label' => $row['country'], 'value' => $row['country_count']);
}

// Query 3: Count of products by category
$query3 = "SELECT p_type AS Category, COUNT(*) AS CategoryCount FROM products GROUP BY p_type";
$result3 = $con->query($query3);
$data3 = array();

while ($row = $result3->fetch_assoc()) {
    $data3[] = array('label' => $row['Category'], 'value' => $row['CategoryCount']);
}



$query4 = "SELECT CASE WHEN t2.cid IS NULL THEN 'Non-Billed Clients' ELSE 'Billed Clients' END AS client_category, COUNT(*) AS client_count FROM client t1 LEFT JOIN invtest2 t2 ON t1.cid = t2.cid GROUP BY client_category";
$result4 = $con->query($query4);
$data4 = array();

while ($row = $result4->fetch_assoc()) {
    $data4[] = array('label' => $row['client_category'],'value' =>  $row['client_count']);
}



// $query6 = "SELECT financial_year, item_name, ItemCount AS total_quantity, GST, Turnover, created FROM ( SELECT CONCAT('20', SUBSTRING(inv2.invid, 6, 5)) AS financial_year, inv.item_name, SUM(inv.quantity) AS ItemCount, SUM(inv2.taxamount) AS GST, SUM(inv2.totalamount) AS Turnover, inv2.created, ROW_NUMBER() OVER(PARTITION BY CONCAT('20', SUBSTRING(inv2.invid, 6, 5)) ORDER BY SUM(inv.quantity) DESC, SUM(inv.quantity * inv.price) DESC) AS row_num FROM invtest inv INNER JOIN products ON products.name = inv.item_name AND products.p_type = 'Machine' JOIN invtest2 inv2 ON inv.orderid = inv2.orderid GROUP BY CONCAT('20', SUBSTRING(inv2.invid, 6, 5)), inv.item_name, inv2.created ) AS sub WHERE row_num = 1 ORDER BY financial_year DESC";

$query6="WITH ItemData AS ( SELECT CONCAT( YEAR(inv2.created) - IF(MONTH(inv2.created) < 4, 1, 0), '-', 
            YEAR(inv2.created) - IF(MONTH(inv2.created) < 4, 0, -1)) AS financial_year, inv.item_name, SUM(inv.quantity) AS total_quantity, 
        ROW_NUMBER() OVER(
            PARTITION BY CONCAT(
                YEAR(inv2.created) - IF(MONTH(inv2.created) < 4, 1, 0), 
                '-', 
                YEAR(inv2.created) - IF(MONTH(inv2.created) < 4, 0, -1)
            ) 
            ORDER BY SUM(inv.quantity) DESC, SUM(inv.quantity * inv.price) DESC) AS row_num FROM invtest inv 
        INNER JOIN products ON products.name = inv.item_name AND products.p_type = 'Machine' 
        JOIN invtest2 inv2 ON inv.orderid = inv2.orderid GROUP BY 
        CONCAT(
            YEAR(inv2.created) - IF(MONTH(inv2.created) < 4, 1, 0), 
            '-', 
            YEAR(inv2.created) - IF(MONTH(inv2.created) < 4, 0, -1)
        ), 
        inv.item_name), FinancialYearData AS (
    SELECT CONCAT( YEAR(created) - IF(MONTH(created) < 4, 1, 0), 
            '-', 
            YEAR(created) - IF(MONTH(created) < 4, 0, -1)) AS financial_year, SUM(taxamount) AS GST, SUM(totalamount) AS Turnover FROM invtest2 GROUP BY financial_year) SELECT i.item_name,  i.total_quantity,  i.financial_year,  f.GST,  f.Turnover FROM ItemData i JOIN FinancialYearData f ON i.financial_year = f.financial_year WHERE i.row_num = 1  ORDER BY  i.financial_year DESC,i.item_name";

$result6 = $con->query($query6);
$data6 = array();

while ($row = $result6->fetch_assoc()) {
    $data6[] = array("y" => $row['financial_year'] , "a" =>($row['Turnover']), 
          "b" =>($row['GST']), "c" =>($row['total_quantity']),"label" =>($row['item_name']));
}



$query7 = "SELECT item_name,sum(quantity) 'item_sold', invtest2.created FROM invtest INNER JOIN invtest2 on invtest.orderid = invtest2.orderid INNER join products on invtest.item_name = products.name where products.p_type = 'Consumables' and invtest2.created BETWEEN '$startyear-04-01' and '$endyear-03-31' GROUP BY item_name ORDER BY sum(quantity) DESC limit 6
";

$result7 = $con->query($query7);

$data7 = array();

while ($row = $result7->fetch_assoc()) {
    $data7[] = array("label" => $row['item_name'],"value" => $row['item_sold']);
}



//$query8 = "SELECT 'Proforma Invoice' AS Invoice, COUNT(invid) AS Count FROM protest2 UNION ALL SELECT 'Tax Invoice' AS Invoice, COUNT(invid) AS Count FROM invtest2 WHERE created BETWEEN '$startyear-04-01' AND '$endyear-03-31'";

$query8="SELECT 'Proforma Invoice' AS PI, COUNT(invid) AS Count FROM protest2 UNION ALL SELECT 'Tax Invoice' AS TaxInv, COUNT(invid) AS Count FROM invtest2 UNION ALL SELECT 'Quotation' AS Quote, COUNT(quote2.invid) AS Count FROM quote2 UNION ALL SELECT 'Quick Quotation' AS qquote, COUNT(quickquote.q_id) AS Count FROM quickquote WHERE created BETWEEN '$startyear-04-01' AND '$endyear-03-31' ORDER BY Count DESC";

$result8 = $con->query($query8);

$data8 = array();

while ($row = $result8->fetch_assoc()) {
    $data8[] = array("label" => $row['PI'],"value" => $row['Count']);
}



$query9 = "SELECT ROW_NUMBER() OVER () AS id, protest.item_name AS item, protest2.invid AS `invno`, protest2.created AS `inv date`, client.c_name AS client, SUBSTRING_INDEX(client.c_add, ',', -1) AS location, client.mob AS mob, client.c_type AS c_type, protest2.subtotal AS subtotal, protest2.taxrate AS taxrate, protest2.taxamount AS taxamount, protest2.totalamount AS totalamount FROM protest2 INNER JOIN protest ON protest.orderid = protest2.orderid INNER JOIN client ON protest2.cid = client.cid GROUP BY protest.orderid ORDER BY protest2.created DESC limit 7";

$result9 = $con->query($query9);

$data9 = array();

while ($row = $result9->fetch_assoc()) {
    $data9[] =$row;
}


$query10 = "SELECT 
    DISTINCT LOWER(TRIM(SUBSTRING_INDEX(client.c_add, ',', -1))) AS location, 
    COUNT(*) AS count 
FROM 
    invtest 
INNER JOIN 
    invtest2 ON invtest.orderid = invtest2.orderid 
INNER JOIN 
    client ON invtest2.cid = client.cid 
GROUP BY 
    location
ORDER BY 
    count DESC 
LIMIT 15";

$result10 = $con->query($query10);

$data10 = array();

while ($row = $result10->fetch_assoc()) {
    $data10[] =$row;
}


// Combine data into a single array
$combinedData = array(
    'pie1' => $data1,
    'pie2' => $data2,
    'pie3' => $data3,
    'pie4'=> $data4,

    'graph1'=> $data5,
    'graph2' => $data6,
    'pie5' => $data7,
     'pie6' => $data8, 
     'tbdata'=>$data9,  
     'areadata'=>$data10,
);

// Convert the combined data to JSON
echo json_encode($combinedData);

$con->close();
?>