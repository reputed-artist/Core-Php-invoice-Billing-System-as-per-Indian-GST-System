
 <?php  
 //load_data.php  
 //$connect = mysqli_connect("localhost", "root","", "loginsystem");  

 include_once("../dbconnection.php");
 $output = '';  
//Path to test code   %20 shows space
 //http://localhost/adminlt/pages/load_data.php?brand_id=2023%202024
 if(isset($_REQUEST["brand_id"]))  
 {  
      if($_REQUEST["brand_id"] != '')  
      {  

//echo "\n brand_id".$_REQUEST["brand_id"];

$startyear=substr($_REQUEST["brand_id"],0,4);
//echo $startyear;

$endyear=substr($_REQUEST["brand_id"],5,10);
//echo "\n end year".$endyear;




           $sql = "SELECT query1.Months, query1.Turnover, query1.Tax, query2.item_name, query2.item_sold FROM ( select date_format(created,'%b') 'Months',sum(totalamount) 'Turnover',sum(taxamount) 'Tax' from invtest2 WHERE created between '$startyear-04-01' AND '$endyear-03-31' group by year(created),month(created) ) query1 JOIN ( SELECT DATE_FORMAT(invtest2.created, '%b') AS Months, item_name, COUNT(item_name) AS item_sold, invtest2.created, RANK() OVER (PARTITION BY DATE_FORMAT(invtest2.created, '%Y-%m') ORDER BY COUNT(item_name) DESC, SUM(total) DESC) AS item_rank FROM invtest INNER JOIN invtest2 ON invtest.orderid = invtest2.orderid INNER JOIN products ON invtest.item_name = products.name WHERE products.p_type = 'Machine' AND invtest2.created BETWEEN '$startyear-04-01' AND '$endyear-03-31' GROUP BY item_name, DATE_FORMAT(invtest2.created, '%Y-%m') ) query2 ON query1.Months = query2.Months WHERE query2.item_rank = 1";  

           //echo $sql;


           $sql2="select item_name,COUNT(item_name) 'item_sold' FROM invtest INNER JOIN invtest2 on invtest.orderid = invtest2.orderid INNER join products on invtest.item_name = products.name where products.p_type = 'Machine' and invtest2.created BETWEEN '$startyear-04-01' and '$endyear-03-31' GROUP BY item_name ORDER BY COUNT(item_name) DESC LIMIT 5";
      }  

      else  
      { 

if (date('m') >= 4) {//Upto June 2014-2015
    $financial_year = date('Y') . '-' . (date('Y') + 1);

} else {//After June 2015-2016
    $financial_year = (date('Y')-1) . '-' . date('Y');
} 
$startyear=substr($financial_year,0,4);
//echo $startyear;

$endyear=substr($financial_year,5,10);

           $sql = "SELECT query1.Months, query1.Turnover, query1.Tax, query2.item_name, query2.item_sold FROM ( select date_format(created,'%b') 'Months',sum(totalamount) 'Turnover',sum(taxamount) 'Tax' from invtest2 WHERE created between '$startyear-04-01' AND '$endyear-03-31' group by year(created),month(created) ) query1 JOIN ( SELECT DATE_FORMAT(invtest2.created, '%b') AS Months, item_name, COUNT(item_name) AS item_sold, invtest2.created, RANK() OVER (PARTITION BY DATE_FORMAT(invtest2.created, '%Y-%m') ORDER BY COUNT(item_name) DESC, SUM(total) DESC) AS item_rank FROM invtest INNER JOIN invtest2 ON invtest.orderid = invtest2.orderid INNER JOIN products ON invtest.item_name = products.name WHERE products.p_type = 'Machine' AND invtest2.created BETWEEN '$startyear-04-01' AND '$endyear-03-31' GROUP BY item_name, DATE_FORMAT(invtest2.created, '%Y-%m') ) query2 ON query1.Months = query2.Months WHERE query2.item_rank = 1";  

           $sql2="select item_name,COUNT(item_name) 'item_sold' FROM invtest INNER JOIN invtest2 on invtest.orderid = invtest2.orderid INNER join products on invtest.item_name = products.name where products.p_type = 'Machine' and invtest2.created BETWEEN '$startyear-04-01' and '$endyear-03-31' GROUP BY item_name ORDER BY COUNT(item_name) DESC LIMIT 5";
      }  
      //echo '<script>console.log("Enter load data file."); </script>';
      $result = mysqli_query($con, $sql)or die("Error".mysqli_error($con));  
       $data_points = array();

       $result1 = mysqli_query($con, $sql2) or die("Error".mysqli_error($con));  
       $data_pro = array();


      while($row = mysqli_fetch_array($result))  
      {  

          $pointz = array("y" => $row['Months'] ,
          "a" =>  $row['Turnover'], "b" => $row['Tax'], "c" =>($row['item_sold']),"label" =>($row['item_name']));
        
           array_push($data_points, $pointz);        



           //$output .= '<div class="col-md-3"><div style="border:1px solid #ccc; padding:20px; margin-bottom:20px;">'.$row["Months"].' '.$row['Turnover'].' '.$row['Tax'].'</div></div>';  
      }  

        while($rw = mysqli_fetch_array($result1))  
      {  

          $pointpro = array("item_name" => $rw['item_name'] , "item_sold" => $rw['item_sold']);
        
           array_push($data_pro, $pointpro);        

      //      // $output .= '<div class="col-md-3"><div style="border:1px solid #ccc; padding:20px; margin-bottom:20px;">'.$row["item_name"].' '.$row['item_sold'].'</div></div>';  
      }  
      //echo $output;  
      //$real= json_encode(array('r1' =>$data_points,'r2' => $data_pro));
      //echo $real;
// $response = array();

// $response = array_merge($data_points,$data_pro);
// echo json_encode($response);

      $arr= array();
$arr['arr1'] = $data_points;
$arr['arr2'] = $data_pro;

echo json_encode($arr,JSON_NUMERIC_CHECK);


      //return json_encode($data_points, JSON_NUMERIC_CHECK);
 }  


 ?>  