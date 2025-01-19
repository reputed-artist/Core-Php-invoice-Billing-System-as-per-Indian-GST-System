<?php 

include'../dbconnection.php';

  $quoteiderror="";
  $taxrateerror="";
  $clienterror="";


    $try=0;


      //echo "\n Total No. of Items:".$itemCount."";


    if(isset($_REQUEST['quoteid']) && $_REQUEST['quoteid'] != null)
{
      
  $quoteid=addslashes($_REQUEST['quoteid']);
    $try++;
    //echo "name".$try;
 }
 else
 {
    $quoteiderror="Enter quoteid";
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
   //ECHO $sql;
    if($itemValues!=0) {
        $result = mysqli_query($con, $sql);
      
      if(!empty($result)) 
        {
         // $message = "Added Successfully.";
        //echo $message;
    }}
    else{
      //echo "error";
    }
  
    //echo "\n Total No. of Items:".$itemCount."";

    //$invid=$_POST['invid'];

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
    $date= date("Y-m-d");



//$date=date('Y-m-d');
$stm=mysqli_query($con, "insert into quote2(invid,cid, orderid,totalitems,subtotal,taxrate,taxamount,totalamount,created) values ('$quoteid','$client','$orderid','$itemCount','$subTotal','$taxRate','$taxAmount','$totalAftertax','$date')")or die("Error IN FETCHING Client ID: " . mysqli_error($con));

 // echo "insert into invtest2(invid,cid, orderid,totalitems,subtotal,taxrate,taxamount,totalamount,created) values ('$invid','$fg2','$orderid','$itemCount','$subTotal','$taxRate','$taxAmount','$totalAftertax','$date')";

    if(!$stm)
    {
        //$_SESSION['msg']="Error Occured ".mysqli_error($con);
         $response['success'] = false;
    $response['message'] = "Error Occurred";
    $response['errors'] = array(
      'quoteid' => $quoteiderror,
        'client' => $clienterror,
          'taxrate' =>$taxrateerror,
            );
 

    }
    
      else{

//$_SESSION['msg']="Invoice Added successfully";


// dbbackup("localhost", "root", "", "loginsystem" );


//  header("Refresh:3; url=gen-q.php");

// echo "<script type=\"text/javascript\">
//         setTimeout(function(){
//         window.open('a4.php?did=".$invid."', '_blank')
//          }, 3);
//      </script>";

$response['success'] = true;
    $response['message'] = "Supplier Added successfully";
    $response['did'] = $quoteid;


  }

}
 else{
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