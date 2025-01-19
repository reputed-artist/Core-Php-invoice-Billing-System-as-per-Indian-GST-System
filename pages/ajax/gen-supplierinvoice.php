<?php

include'../dbconnection.php';


// if(isset($_REQUEST['submit']))
// {

  #$invid=0;
  #$supplier="";
  #$subTotal=0;
  #$totalAftertax=0;
  #$totalAmount=0;
  $inviderror="";
  $taxrateerror="";
  $suppliererror="";


    $try=0;


      //echo "\n Total No. of Items:".$itemCount."";


    if(isset($_REQUEST['invid']) && $_REQUEST['invid'] != null)
{
      
  $invid=addslashes($_REQUEST['invid']);
    $try++;
    //echo "name".$try;
 }
 else
 {
    $inviderror="Enter invid";
 }



 if(isset($_REQUEST['supplier']) && $_REQUEST['supplier'] != null)
{
      
  $supplier=addslashes($_REQUEST['supplier']);
    $try++;
    //echo "name".$try;
 }
 else
 {
    $suppliererror="Select Supplier";
 }



 if(isset($_REQUEST['taxRate']) && $_REQUEST['taxRate'] != null)
{
      
  $taxRate=addslashes($_REQUEST['taxRate']);
    $try++;
    //echo "name".$try;
 }
 else
 {
    $taxrateerror="Enter Tax %";
 }


$response=array();
if($try == 3)
{

    $orderid=uniqid();

    //echo $orderid;
    
    $itemCount = count($_REQUEST["item_name"]);
    
   // echo "\n Item Count: ".$itemCount;

    $itemValues=0;
   

    $query = "INSERT INTO purchaseinv (orderno,orderid,item_name,item_desc,hsn,quantity,price,total) VALUES ";
    $queryValue = "";
   
    for($i=0;$i<$itemCount;$i++) {
      if(!empty($_REQUEST["item_name"][$i]) || !empty($_REQUEST["price"][$i])) {
        $itemValues++;
        if($queryValue!="") {
          $queryValue .= ",";
        }

        $queryValue .= "(NULL,'" . $orderid . "','" . $_REQUEST["item_name"][$i] . "','" . $_REQUEST["item_desc"][$i] . "','" . $_REQUEST["hsn"][$i] . "',
        '" . $_REQUEST["item_quantity"][$i] . "', '" . $_REQUEST["price"][$i] . "','" . $_REQUEST["total"][$i] . "')"
         or die("Error IN ORDER TABLE: " . mysqli_error($con));
      }
    }

    $sql = $query.$queryValue;

   
    //ECHO "\n ".$sql."";

        if($itemValues!=0) {
        $result = mysqli_query($con, $sql);
      
      if(!empty($result)) 
        {
          //$message = "Added Successfully.";
          
        //echo $message;
    }}
    else{
      //echo "error";
    }


    $subTotal=$_REQUEST['subTotal'];
    //$taxRate = $_REQUEST['taxRate'];
    $taxAmount=$_REQUEST['taxAmount'];
    $totalAftertax =$_REQUEST['totalAftertax'];


    //$invid=$_REQUEST['invid'];

    //$supplier=addslashes($_REQUEST['supplier']);
   
   //echo "\n".$supplier;


   $getclientid=mysqli_query($con,"select pcid from purchasecom where pcname='$supplier'")or die("Error IN FETCHING Client ID: " . mysqli_error($con));
  
  //echo "\n"."select pcid from purchasecom where pcname='$supplier'";

  $data2=mysqli_fetch_array($getclientid);
  //echo "\n Supplier id".$data2[0];
  
    $fg2=$data2[0];
    

    $invdate= $_REQUEST ['datepicker'];
    
    //echo "\n".$created;
    
    $cz= date_create($invdate);  // DateTime Object ( [date] => 2013-02-13 00:00:00.000000 [timezone_type] => 3 [timezone] => America/New_York )
    $fdate= date_format($cz,"Y-m-d");
    date_default_timezone_set("Asia/Calcutta");

        //echo $time;
    $cvdate= $fdate;




   //$combinedDT = date('Y-m-d H:i:sa', strtotime("$date $time"));
   //echo $combinedDT;
   // echo "\n".$cvdate;

$date=date('Y-m-d');
$time=date("h:i:sa");

$created=$date." ".$time;


$stm=mysqli_query($con, "insert into purchaseinv2(nid,invid,cid,invdate, orderid,totalitems,subtotal,taxrate,taxamount,totalamount,created) values (Null,'$invid','$fg2','$cvdate','$orderid','$itemCount','$subTotal','$taxRate','$taxAmount','$totalAftertax','$created')")or die("Error IN FETCHING Client ID: " . mysqli_error($con));

//echo "\n"."insert into purchaseinv2(nid,invid,cid, orderid,totalitems,subtotal,taxrate,taxamount,totalamount,created) values (Null,'$invid','$fg2','$orderid','$itemCount','$subTotal','$taxRate','$taxAmount','$totalAftertax','$cvdate')";
 

    if(!$stm)
    {
        //$_SESSION['msg']="Error Occured ".mysqli_error($con);
        $response['success'] = false;
    $response['message'] = "Error Occurred";
    $response['errors'] = array(
        'invid' => $inviderror,
        'supplier' => $suppliererror,
          'taxrate' =>$taxrateerror,

    );

    }
    
      else{


$_SESSION['msg']="Purchase Invoice Added successfully";
$response['success'] = true;
    $response['message'] = "Supplier Added successfully";
    $response['orderid'] = $orderid;

//dbbackup("localhost", "root", "", "loginsystem" );

//header("Refresh:3; url=genpurchaseinv.php");

// echo "<script type=\"text/javascript\">
//         setTimeout(function(){
//         window.open('purinv copy.php?orderid=".$orderid."', '_blank')
//         }, 3);


//     </script>";


  }
}
 else{
  $response['success'] = false;
    $response['message'] = "Error Occurred";
    $response['errors'] = array(
        'invid' => $inviderror,
        'supplier' => $suppliererror,
          'taxrate' =>$taxrateerror,
            );
 
}
echo json_encode($response);

//}
?>