<?php
 $connect = mysqli_connect("localhost", "root", "", "loginsystem");  
 $output = '';  

 
 $data_pointsz = array();
    $resultz = mysqli_query($con, "SELECT CASE WHEN MONTH(created)>=4 THEN concat(YEAR(created), '-',YEAR(created)+1) ELSE concat(YEAR(created)-1,'-', YEAR(created)) END AS financial_year, SUM(totalamount) 'Turnover', SUM(taxamount) 'GST' FROM invtest2 GROUP BY financial_year ");
    
    //echo "SELECT date_format(purchaseinv2.created,'%b') 'Months', sum(taxamount) 'Tax Paid', sum(totalamount) 'Purtotal' from purchaseinv LEFT JOIN purchaseinv2 on purchaseinv.orderid =purchaseinv2.orderid WHERE created between '$startyear-04-01' and '$endyear-03-31' group by year(created),month(created) order by year(created),month(created)";

    while($rowz = mysqli_fetch_array($resultz))
    {        
        $pointz = array("y" => $rowz['financial_year'] , "a" => $rowz['Turnover'],"b" => $rowz['GST']);
        
        array_push($data_pointsz, $pointz);        
    }
      //echo $output;  
      $real= json_encode($data_pointsz, JSON_NUMERIC_CHECK);
      echo $real;	




     
 
?>