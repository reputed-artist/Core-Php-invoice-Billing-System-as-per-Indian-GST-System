<?php


include'../dbconnection.php';

$pinviderror="";
$taxrateerror="";
$clienterror="";

$try=0;


if(isset($_REQUEST['orderid']))
{
  $orderid=$_REQUEST['orderid'];

//echo $orderid;
}


    if(isset($_REQUEST['pinvid']) && $_REQUEST['pinvid'] != null)
{
      
  $pinvid=addslashes($_REQUEST['pinvid']);
    $try++;
    //echo "name".$try;
 }
 else
 {
    $pinviderror="Enter pinvid";
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


    //echo $orderid;
    $del=mysqli_query($con,"DELETE FROM `protest` WHERE `protest`.`orderid` = '$orderid'");

   // echo "\n DELETE FROM `invtest` WHERE `invtest`.`orderid` = '$orderid'";
      //$conn = mysqli_connect("localhost","root","test", "blog_samples");
    $itemCount = count($_POST["item_name"]);
    $itemValues=0;
    $query = "INSERT INTO protest (orderno,orderid,item_name,item_desc,hsn,quantity,price,total) VALUES ";
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
    //ECHO "\n".$sql."\n";
    if($itemValues!=0) {
        $result = mysqli_query($con, $sql);
      
      if(!empty($result)) 
        {$message = "Added Successfully.";
       // echo $message;
    }}
    else{
      $message= "error";
    }
  
   // echo "\n Total No. of Items:".$itemCount."";


  //$client=addslashes($_POST['client']);
  
  $getclientid=mysqli_query($con,"select c_name,cid, c_add from Client where cid='$client'")or die("Error IN FETCHING Client ID: " . mysqli_error($con));

  $data2=mysqli_fetch_array($getclientid);
  //echo "\n Client id".$data2[0];

   $fg2=$data2[1];

   $clientname=$data2[0];

   $clientaddz=$data2[2];

    $subTotal=$_POST['subTotal'];
    $taxRate = $_POST['taxRate'];
    $taxAmount=$_POST['taxAmount'];
    $totalAftertax =$_POST['totalAftertax'];
    date_default_timezone_set("Asia/Calcutta");
    $date= date("Y-m-d h:i:sa");

   $demo= mysqli_query($con,"update protest2 set cid='$fg2', orderid='$orderid',totalitems='$itemCount',subtotal='$subTotal',
    taxrate='$taxRate',taxamount='$taxAmount',totalamount='$totalAftertax' where invid='$pinvid'") or die("Error IN INVOICE TABLE".mysqli_error($con));


    // echo "update invtest2 set invid = '$invid',cid='$fg2', orderid='$orderid',totalitems='$itemCount',subtotal='$subTotal',
    //taxrate='$taxRate',taxamount='$taxAmount',totalamount='$totalAftertax'";

       // echo "\n insert into invtest2(invid,cid, orderid,totalitems,subtotal,taxrate,taxamount,totalamount,created) values (Null,'$fg2','$orderid','$itemCount','$subTotal','$taxRate','$taxAmount','$totalAftertax','$date')";
    if(!$demo)
    {
        $response['message'] = "Error Occurred";
    $response['errors'] = array(
        'pinvid' => $pinviderror,
        'client' => $clienterror,
          'taxrate' =>$taxrateerror,

    );

    }
    
      else{


$_SESSION['msg']="Purchase Invoice Added successfully";
$response['success'] = true;
    $response['message'] = "Supplier Added successfully";
    $response['orderid'] = $orderid;
$response['invid'] = $pinvid;


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
        'pinvid' => $pinviderror,
        'client' => $clienterror,
          'taxrate' =>$taxrateerror,
            );
 
}
echo json_encode($response);

//}
?>