<?php


include'../dbconnection.php';


  $quoteiderror="";
  $taxrateerror="";
  $clienterror="";

  $try=0;

if(isset($_REQUEST['orderid']))
{
  $orderid=$_REQUEST['orderid'];

//echo $orderid;
  $try++;
}

    

 if(isset($_REQUEST['quoteid']) && $_REQUEST['quoteid'] != null)
{
      
  $quoteid=addslashes($_REQUEST['quoteid']);
    $try++;
    //echo "name".$try;
 }
 else
 {
    $quoteiderror="Enter Quoteid";
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
      
  $taxRate=addslashes($_REQUEST['taxRate']);
    $try++;
    //echo "try:".$try;
 }
 else
 {
    $taxrateerror="Enter Tax %";
 }


$response=array();


if($try == 4)
{


    //echo $orderid;
    $del=mysqli_query($con,"DELETE FROM `quote` WHERE `quote`.`orderid` = '$orderid'");

    //echo "\n DELETE FROM `quote` WHERE `quote`.`orderid` = '$orderid'";
      //$conn = mysqli_connect("localhost","root","test", "blog_samples");
    $itemCount = count($_POST["item_name"]);
    $itemValues=0;
    $query = "INSERT INTO quote (orderno,orderid,item_name,quantity,price,total) VALUES ";
    $queryValue = "";
    for($i=0;$i<$itemCount;$i++) {
      if(!empty($_POST["item_name"][$i]) || !empty($_POST["price"][$i])) {
        $itemValues++;
        if($queryValue!="") {
          $queryValue .= ",";
        }

        $queryValue .= "(NULL,'" . $orderid . "','" . $_POST["item_name"][$i] . "',
        '" . $_POST["item_quantity"][$i] . "', '" . $_POST["price"][$i] . "','" . $_POST["total"][$i] . "')"
         or die("Error IN ORDER TABLE: " . mysqli_error($con));
      }
    }

    $sql = $query.$queryValue;
    //ECHO "\n".$sql."\n";
    if($itemValues!=0) {
        $result = mysqli_query($con, $sql);
      
      if(!empty($result)) 
        {
          $message = "Added Successfully.";
       // echo $message;
    }}
    else{
      $message= "error";
    }
  
   // echo "\n Total No. of Items:".$itemCount."";


    $client=$_POST['client'];
  
  // $getclientid=mysqli_query($con,"select c_name from Client where cid='$client'")or die("Error IN FETCHING Client ID: " . mysqli_error($con));
  // $data2=mysqli_fetch_array($getclientid);
  // //echo "\n Client id".$data2[0];
  // $fg2=$data2[0];

    $subTotal=$_POST['subTotal'];
    $taxRate = $_POST['taxRate'];
    $taxAmount=$_POST['taxAmount'];
    $totalAftertax =$_POST['totalAftertax'];
    $date= date("Y-m-d");
    $note= $_POST['notez'];



   $demo= mysqli_query($con,"update quote2 set cid='$client', orderid='$orderid',totalitems='$itemCount',subtotal='$subTotal',
    taxrate='$taxRate',taxamount='$taxAmount',totalamount='$totalAftertax', note='$note' where invid='$quoteid'") or die("Error IN INVOICE TABLE".mysqli_error($con));


    //echo "update quote2 set cid='$fg2', orderid='$orderid',totalitems='$itemCount',subtotal='$subTotal',
    //taxrate='$taxRate',taxamount='$taxAmount',totalamount='$totalAftertax', note='$note' where invid='$invid'";
      
    
    if(!$demo)
    {
        // $_SESSION['msg']="Error Occured ".mysqli_error($con);
       $response['success'] = false;
    $response['message'] = "Error Occurred";
    $response['errors'] = array(
      'quoteid' => $quoteiderror,
        'client' => $clienterror,
          'taxrate' =>$taxrateerror,
            );
 
    }
    else
    {
      // $_SESSION['msg']="Invoice Edited Successfully";

       //$id=$_POST['cid'];
$response['success'] = true;
    $response['message'] = "Supplier Added successfully";
    $response['did'] = $quoteid;


      // dbbackup("localhost", "root", "", "loginsystem" );


 //header("Refresh:3; url=q-list.php");

   //  echo "<script type=\"text/javascript\">
     //   setTimeout(function(){
      //  window.open('a4.php?did=".$invid."', '_blank')
      //  }, 10);
    //</script>";


    }



  }else
  {
     $response['success'] = false;
    $response['message'] = "Error Occurred";
    $response['errors'] = array(
        'quoteid' => $quoteiderror,
        'client' => $clienterror,
          'taxrate' =>$taxrateerror,
            );
 
}
echo json_encode($response);
?>