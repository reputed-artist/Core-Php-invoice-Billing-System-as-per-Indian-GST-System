<?php

include'dbconnection.php';
include_once"inc/titlecase.php";

$try=0;

$actypeerror="";

$pnameerror="";

$amterror="";
$purposeerror="";
$response="";
$modeerror="";
$dateerror="";
$pname="";

$cid=0;

if(isset($_REQUEST['coid']) && $_REQUEST['coid'] != null)
{
      
  $pname=addslashes($_REQUEST['coid']);
    $try++;
    //echo "name".$try;
 }
 else
 {
    $pnameerror="Select client/supplier Name";
 }

if(isset($_REQUEST['amount']) && $_REQUEST['amount'] != null)
{
      
  $amt=addslashes($_REQUEST['amount']);
    $try++;
    //echo "name".$try;
 }
 else
 {
    $amterror="Enter Amount";
 }

 if(isset($_REQUEST['purpose']) && $_REQUEST['purpose'] != null)
{
      
  $purpose=addslashes($_REQUEST['purpose']);
    $try++;
    //echo "name".$try;
 }
 else
 {
    $purposeerror="Enter purpose or reference ID";
 }


if(isset($_REQUEST['mode']) && $_REQUEST['mode'] != null)
{
      
  $mode=addslashes($_REQUEST['mode']);
    $try++;
    //echo "name".$try;
 }
 else
 {
    $modeerror="Select Mode";
 }




  if($_REQUEST["actype"] == "supplier")
{


  $typcs=$_REQUEST["actype"];

  if($typcs == "supplier"){
    $tp=1;
  }
  else{
    $tp=2;
  }

  $date= date("Y-m-d",strtotime($_REQUEST['datepicker']));

// $fdate= date_format($cz,"Y-m-d");
    date_default_timezone_set("Asia/Calcutta");

    $timez=date("h:i:sa");
    //echo $time;
    $cvdate= $date." ".$timez;
    //echo $cvdate;


$dv=date("Y-m-d");
$time=date("h:i:sa");
$dv2=$dv." ".$time;



$cs=mysqli_query($con,"INSERT INTO `paidhistory` (`pay_id`, `p_m`, `amount`, `mode`, `dateofpayment`,`purpose`,`type_cs`,`created`) VALUES (NULL,'$pname', '$amt','$mode','$cvdate','$purpose',$tp,'$dv2')") or die("Error: " . mysqli_error($con));

}

else {
 
   
  $typcs=$_REQUEST["actype"];

  if($typcs == "supplier"){
    $tp=1;
  }
  else{
    $tp=2;
  }

  $date = date("Y-m-d",strtotime($_REQUEST['datepicker']));
    date_default_timezone_set("Asia/Calcutta");

        $timez=date("h:i:sa");
    //echo $time;
    $cvdate= $date." ".$timez;
    //echo $cvdate;


$dv=date("Y-m-d");
$time=date("h:i:sa");
$dv2=$dv." ".$time;


$cs=mysqli_query($con,"INSERT INTO `paidhistory` (`pay_id`, `p_m`, `amount`, `mode`, `dateofpayment`,`purpose`,`type_cs`,`created`) VALUES (NULL,'$pname', '$amt','$mode','$cvdate','$purpose',$tp, '$dv2')") or die("Error: " . mysqli_error($con));

}



$actypeerror="";

$pnameerror="";

$amterror="";
$purposeerror="";
$response="";
$modeerror="";
//$dateerror="";

$response=array();

if(!$cs)
{
  
  //$_SESSION['msg']="Error Occured ".mysqli_error($con);
  $response['success'] = false;
    $response['message'] = "Error Occurred";
    $response['errors'] = array(
        'pname' => $pnameerror,
        'amt' => $amterror,
        'purpose' => $purposeerror,
        'mode' => $modeerror,

    );

}
 else{
  $response['success'] = true;
 $response['message'] = "Transaction Added successfully";
 $response['zid'] = $pname;
 
}
echo json_encode($response);



?>