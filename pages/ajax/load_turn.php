 <?php  
 //load_data.php  
 //$connect = mysqli_connect("localhost", "root", "", "loginsystem");  
 
include_once("../dbconnection.php");

 $output = '';  

 function indian_number_format($num) {
    $num = "".$num;
    if( strlen($num) < 4) return $num;
    $tail = substr($num,-3);
    $head = substr($num,0,-3);
    $head = preg_replace("/\B(?=(?:\d{2})+(?!\d))/",",",$head);
    return $head.",".$tail;
}

 if(isset($_GET["brand_y"]))  
 {  
      if($_GET["brand_y"] != '')  
      {  

$startyear=substr($_GET["brand_y"],0,4);
//echo $startyear;

$endyear=substr($_GET["brand_y"],5,10);

$invtotal=mysqli_query($con,"SELECT count(invid) FROM `invtest2` where created between '$startyear-04-01' and '$endyear-03-30'");

$invval=mysqli_fetch_array($invtotal);

$totalitems=mysqli_query($con,"SELECT sum(totalitems) FROM `invtest2` where created between '$startyear-04-01' 
	and '$endyear-03-30'");

$totalitemval=mysqli_fetch_array($totalitems);



$yeartotal=mysqli_query($con,"SELECT sum(totalamount) FROM `invtest2` where created between '$startyear-04-01' 
	and '$endyear-03-30'");

$yeartotalval=mysqli_fetch_array($yeartotal);

$taxtotal=mysqli_query($con,"SELECT sum(taxamount) FROM `invtest2` where created between '$startyear-04-01' and '$endyear-03-30'");

$taxtotalval=mysqli_fetch_array($taxtotal);

echo json_encode(array("invoices"=>$invval[0],"totalitems"=>$totalitemval[0],"turnovery"=>indian_number_format($yeartotalval[0]),"taxy"=>indian_number_format($taxtotalval[0])),JSON_NUMERIC_CHECK);
}
}