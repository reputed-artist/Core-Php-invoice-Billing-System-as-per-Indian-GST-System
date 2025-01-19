<?php

include'../dbconnection.php';

  $inviderror="";
  $taxrateerror="";
  $clienterror="";


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
    $inviderror="Enter Invid";
 }



 if(isset($_REQUEST['client']) && $_REQUEST['client'] != null)
{
      
  $client=addslashes($_REQUEST['client']);
    $try++;
    //echo "name".$try;
 }
 else
 {
    $clienterror="Select Client";
 }



 if(isset($_REQUEST['taxRate']) && $_REQUEST['taxRate'] != null)
{
      
  $taxrate=addslashes($_REQUEST['taxRate']);
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
    //$_GET['cid'];

      //$conn = mysqli_connect("localhost","root","test", "blog_samples");
    $itemCount = count($_REQUEST["item_name"]);
    $itemValues=0;
    $query = "INSERT INTO protest(orderno,orderid,item_name,item_desc,hsn,quantity,price,total) VALUES ";
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
  // ECHO $sql;
    if($itemValues!=0) {
        $result = mysqli_query($con, $sql);
      
      if(!empty($result)) 
        {
          $message = "Added Successfully.";
        //echo $message;
    }}
    else{
      //echo "error";
    }
  
   

    $subTotal=$_REQUEST['subTotal'];
   // $taxRate = $_REQUEST['taxRate'];
    $taxAmount=$_REQUEST['taxAmount'];
    $totalAftertax =$_REQUEST['totalAftertax'];
    date_default_timezone_set("Asia/Calcutta");
    $date= date("Y-m-d h:i:sa");
//$id=$_REQUEST['cid'];
   $stm=mysqli_query($con, "insert into protest2(invid,cid, orderid,totalitems,subtotal,taxrate,taxamount,totalamount,created) values ('$invid','$client','$orderid','$itemCount','$subTotal','$taxrate','$taxAmount','$totalAftertax','$date')");

  //echo "insert into protest2(invid,cid, orderid,totalitems,subtotal,taxrate,taxamount,totalamount,created) values ('$invid','$client','$orderid','$itemCount','$subTotal','$taxrate','$taxAmount','$totalAftertax','$date')";

    if(!$stm)
    {
        //$_SESSION['msg']="Error Occured ".mysqli_error($con);
           $response['success'] = false;
    $response['message'] = "Error Occurred";
    $response['errors'] = array(
      'invid' => $inviderror,
        'client' => $clienterror,
          'taxrate' =>$taxrateerror,
            );
    }
    
      else{


$response['success'] = true;
    $response['message'] = "Supplier Added successfully";
    $response['inv'] = $invid;
 } //e

}
else{
   $response['success'] = false;
    $response['message'] = "Error Occurred";
    $response['errors'] = array(
      'invid' => $inviderror,
        'client' => $clienterror,
          'taxrate' =>$taxrateerror,
            );
}

  
echo json_encode($response);
  
?>