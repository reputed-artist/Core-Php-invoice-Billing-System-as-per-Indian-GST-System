<?php

include '../dbconnection.php';
//include './ajax/dbbackup.php';


  $inviderror="";
  $taxrateerror="";
  $clienterror="";


    $try=0;



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
    $itemCount = count($_POST["item_name"]);
    $itemValues=0;
    $query = "INSERT INTO invtest (orderno,orderid,item_name,item_desc,hsn,quantity,price,total) VALUES ";
    $queryValue = "";
    for($i=0;$i<$itemCount;$i++) {
      if(!empty($_POST["item_name"][$i]) || !empty($_POST["price"][$i])) {
        $itemValues++;
        if($queryValue!="") {
          $queryValue .= ",";
        }

        $queryValue .= "(NULL,'" . $orderid . "','" . $_POST["item_name"][$i] . "','" . $_POST["item_desc"][$i] . "','" . $_POST["hsn"][$i] . "',
        '" . $_POST["item_quantity"][$i] . "', '" . $_POST["price"][$i] . "','" . $_POST["total"][$i] . "')"
         or die("Error IN ORDER TABLE: " . mysqli_error($con));
      }
    }

    $sql = $query.$queryValue;
   //ECHO $sql;
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
  
    //echo "\n Total No. of Items:".$itemCount."";

    $invid=$_POST['invid'];

    $client=addslashes($_POST['client']);
   
   //echo $client;

  //$getclientid=mysqli_query($con,"select cid from Client where c_name='$client'")or die("Error IN FETCHING Client ID: " . mysqli_error($con));
  
  //$data2=mysqli_fetch_array($getclientid);
  //echo "\n Client id".$data2[0];
  
  //$fg2=$data2[0];
    $subTotal=$_POST['subTotal'];
    $taxRate = $_POST['taxRate'];
    $taxAmount=$_POST['taxAmount'];
    $totalAftertax =$_POST['totalAftertax'];
    date_default_timezone_set("Asia/Calcutta");
    $date= date("Y-m-d h:i:sa");



//$date=date('Y-m-d');
$stm=mysqli_query($con, "insert into invtest2(invid,cid, orderid,totalitems,subtotal,taxrate,taxamount,totalamount,created) values ('$invid','$client','$orderid','$itemCount','$subTotal','$taxRate','$taxAmount','$totalAftertax','$date')")or die("Error IN FETCHING Client ID: " . mysqli_error($con));

 // echo "insert into invtest2(invid,cid, orderid,totalitems,subtotal,taxrate,taxamount,totalamount,created) values ('$invid','$fg2','$orderid','$itemCount','$subTotal','$taxRate','$taxAmount','$totalAftertax','$date')";

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

//$_SESSION['msg']="Invoice Added successfully";
//dbbackup("localhost", "root", "", "loginsystem" );

// echo "<script type=\"text/javascript\">
//         setTimeout(function(){
//         window.open('proformainv.php?inv=".$invid."', '_blank')
//         }, 10);
//     </script>";
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