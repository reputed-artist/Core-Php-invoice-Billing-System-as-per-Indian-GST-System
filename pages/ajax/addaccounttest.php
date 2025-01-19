<?php

include'../dbconnection.php';
include_once"../inc/titlecase.php";

$try=0;
$clogerror="";
$opbalerror="";
$actypeerror="";

$actype="";
$clog="";

//$aid=$_REQUEST['aid'];
 
 if(isset($_REQUEST['actype']) && $_REQUEST['actype'] != null)
{
  $actype=$_REQUEST['actype'];
  //echo "\n actype: ".$actype;
    $try++;
}
else{
  $actypeerror="Select A/c Type";
}
 if(isset($_REQUEST['clog']) && $_REQUEST['clog'] != null)
{
  $clog=$_REQUEST['clog'];
  //echo "\n clog: ".$clog;
    $try++;
}
else{
  $clogerror="Select Firm Name";
}

 if(isset($_REQUEST['opbal']) && $_REQUEST['opbal'] != null)
{
  $opbal=$_REQUEST['opbal'];
    $try++;
}
else{
  $opbalerror="Enter Opening Balance";
}


if($actype == "supplier")
{
  $tp=1;
  $ds=$clog;
  //echo "select pcid from purchasecom where pcname='$clog'";
}
else{
  $tp=2;
 $ds=$clog;
 //echo "select cid from client where c_name='$clog'"; 
}

//$row=mysqli_fetch_array($ds);
  
$val= $ds;
$date = date("Y-m-d");


if($try ==3 && $tp!=0 )
{

 $c=mysqli_query($con,"INSERT INTO `account` (`aid`, `cid`, `acc_type`,`opening_bal`,`created`) VALUES (null,'$val', '$tp','$opbal','$date')") or die("Error: " . mysqli_error($con));

//echo "INSERT INTO `account` (`aid`, `cid`, `acc_type`,`opening_bal`,`created`) VALUES ('$aid','$val', '$tp','$opbal','$date')";

if(!$c)
{
  
  //$_SESSION['msg']="Error Occured ".mysqli_error($con);
  $response['success'] = false;
    $response['message'] = "Error Occurred";
    $response['errors'] = array(
        'actype' => $actypeerror,
        'clog' => $clogerror,
        'opbal' => $opbalerror
        
    );

}
else
{


$response['success'] = true;
    $response['message'] = "Client Added successfully";
 } 
}
else{
   $response['success'] = false;
    $response['message'] = "Error Occurred";
    $response['errors'] = array(
        'actype' => $actypeerror,
        'clog' => $clogerror,
        'opbal' => $opbalerror
        
    );
  //echo '<script type="text/javascript">validate();</script>';
}
echo json_encode($response);

?>