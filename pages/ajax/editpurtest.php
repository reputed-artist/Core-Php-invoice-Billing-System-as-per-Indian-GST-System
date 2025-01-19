<?php
// Save update

include'../dbconnection.php';


  $inviderror="";
  $taxrateerror="";
  $suppliererror="";

if(isset($_REQUEST['orderid']))
{
  $orderid=$_REQUEST['orderid'];

//echo $orderid;
}

    $try=0;

 if(isset($_REQUEST['invid']) && $_REQUEST['invid'] != null)
{
      
  $invid=addslashes($_REQUEST['invid']);
    $try++;
    //echo "invid".$invid;
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
    //echo "try:".$try;
 }
 else
 {
    $taxrateerror="Enter Tax %";
 }


$response=array();


if($try == 3)
{


    //echo $orderid;
    $del=mysqli_query($con,"DELETE FROM `purchaseinv` WHERE `purchaseinv`.`orderid` = '$orderid'");


    $itemCount = count($_REQUEST["item_name"]);
    $itemValues=0;
    $query = "INSERT INTO purchaseinv  (orderno,orderid,item_name,item_desc,hsn,quantity,price,total)  VALUES ";
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
    
    //ECHO "\n".$sql."\n";


    if($itemValues!=0) {
        $result = mysqli_query($con, $sql);
      
      if(!empty($result)) {
       // {$message = "Added Successfully.";
       // echo $message;
    }}
    else{
      //$message= "error";
    }
  
   // echo "\n Total No. of Items:".$itemCount."";


    $supplier=$_REQUEST['supplier'];

  $getclientid=mysqli_query($con,"select pcid from purchasecom where pcname='$supplier'")or die("Error IN FETCHING Client ID: " . mysqli_error($con));
  $data2=mysqli_fetch_array($getclientid);
  //echo "\n pc id".$data2[0];
  $fg2=$data2[0];

    $subTotal=$_REQUEST['subTotal'];
   // $taxRate = $_REQUEST['taxRate'];
    $taxAmount=$_REQUEST['taxAmount'];
    $totalAftertax =$_REQUEST['totalAftertax'];
   

   $invdate= $_REQUEST ['datepicker'];
    
    //echo "\n".$created;
    
    $cz= date_create($invdate);  // DateTime Object ( [date] => 2013-02-13 00:00:00.000000 [timezone_type] => 3 [timezone] => America/New_York )
    $fdate= date_format($cz,"Y-m-d");
    date_default_timezone_set("Asia/Calcutta");

        //echo $time;
    $cvdate= $fdate;




    $date=date('Y-m-d');
$time=date("h:i:sa");

$created=$date." ".$time;





   $demo= mysqli_query($con,"update purchaseinv2 set cid='$fg2', invid='$invid',invdate='$cvdate', totalitems='$itemCount',subtotal='$subTotal', taxrate='$taxRate',taxamount='$taxAmount',totalamount='$totalAftertax' where orderid='$orderid'") or die("Error IN INVOICE TABLE".mysqli_error($con));

    //echo "\n update purchaseinv2 set cid='$fg2', invid=$invid,totalitems='$itemCount',subtotal='$subTotal', taxrate='$taxRate',taxamount='$taxAmount',totalamount='$totalAftertax', created='$cvdate' where orderid='$orderid";

   $response=array();

    if(!$demo)
    {
        
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