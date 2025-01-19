<?php
include'../dbconnection.php';
//include_once"../inc/titlecase.php";

$try=0;
$fdholdernameerror="";
$fdholderbankerror="";
$principleamterror="";
$nodayserror="";
$intrateerror="";
$response="";
$fdissuedateerror="";
$matdateerror="";
$intamterror="";
$finalamterror="";

$datesameerror="";
//$gsterror="";
//$ctypeerror="";

$fid=$_REQUEST['fid'];

if(isset($_REQUEST['fdholdername']) && $_REQUEST['fdholdername'] != null)
{
      
  $fdholdername=addslashes($_REQUEST['fdholdername']);
    $try++;
    //echo "name".$try;
 }
 else
 {
    $fdholdernameerror="Enter fdholdername";
 }

 if($_REQUEST['datepicker'] != null)
 { 
    
  $dp=$_REQUEST['datepicker'];



  $fdissueddate= date("Y-m-d", strtotime($dp));



  $try++;
  //echo "add".$try;
}
else
{
    $fdissuedateerror="Enter FD issued date";
}


  //$mobcount=strlen(($_REQUEST['mob']));
  if($_REQUEST['fdholderbank'] !=null)
  {
  $fdholderbank= $_REQUEST['fdholderbank'];
  $try++;
  //echo "mob".$try;
 }
 else{
  $fdholderbankerror="Select Fd Holder Bank name";
 }


if($_REQUEST['principleamt'] !=null)
  {
  $principleamt= $_REQUEST['principleamt'];
  $try++;
  //echo "mob".$try;
 }
 else{
  $principleamterror="Enter principleamt";
 }


if($_REQUEST['nodays'] !=null)
  {
  $nodays= $_REQUEST['nodays'];
  $try++;
  //echo "mob".$try;
 }
 else{
  $nodayserror="Enter years";
 }


if($_REQUEST['intrate'] !=null)
  {
  $intrate= $_REQUEST['intrate'];
  $try++;
  //echo "mob".$try;
 }
 else{
  $intrateerror="Enter Int rate";
 }


if($_REQUEST['intamt'] !=null)
  {
  $intamt= $_REQUEST['intamt'];
  $try++;
  //echo "mob".$try;
 }
 else{
  $intamterror="Enter Int Amt";
 }


if($_REQUEST['finalamt'] !=null)
  {
  $finalamt= $_REQUEST['finalamt'];
  $try++;
  //echo "mob".$try;
 }
 else{
  $finalamterror="Enter Final Amt";
 }


if($_REQUEST['datepicker2'] != null)
 { 

  $dp2=$_REQUEST['datepicker2'];
  $matdate=date("Y-m-d", strtotime($dp2));
  $try++;
  //echo "add".$try;
}
else
{
    $matdateerror="Enter FD Maturity date";
}

if($fdissueddate != $matdate)
{
  $datesame = false;
  $try++;
}
else{
  $datesame=true;
  $matdateerror="Issued date and Maturity Date must not be same";
  //$datesameerror="dates are same";
}


if(isset($_REQUEST['created']))
{
  $dp3=$_REQUEST['created'];
$fdentrydate=date("Y-m-d", strtotime($dp3));


$time=date("h:i:sa");

$fdentrydatez=$fdentrydate." ".$time;

$try++;
}
// echo $try;




$response=array();
if($try == 11 )
{

 $c=mysqli_query($con,"INSERT INTO `fd` (`id`, `fdissueddate`, `fdholder`,`fdofbank`,`principleamt`,`nodays`,`intrate`,`intamt`, `finalamt`,`maturitydate`,`fdentrydate`) VALUES (null,'$fdissueddate', '$fdholdername', '$fdholderbank','$principleamt','$nodays', '$intrate','$intamt','$finalamt','$matdate','$fdentrydatez')") or die("Error: " . mysqli_error($con));

if(!$c)
{
  
  //$_SESSION['msg']="Error Occured ".mysqli_error($con);
  $response['success'] = false;
    $response['message'] = "Error Occurred";
    $response['errors'] = array(
        'fdholdername' => $fdholdernameerror,
        'fdholderbank' => $fdholderbankerror,
        'nodays' => $nodayserror,
        'intrate' => $intrateerror,
        'principleamt' => $principleamterror,
        'fdissueddate' => $fdissuedateerror,
        'matdate'=>$matdateerror,
        'finalamt'=> $finalamterror,
        
        'intamt'=> $intamterror
        
    );

}
else
{

 $response['success'] = true;
    $response['message'] = "FD Added successfully";

$_SESSION['msg']="FD Added successfully";

 } 
}
 else{
  $response['success'] = false;
    $response['message'] = "Error Occurred";
    $response['errors'] = array(
      'fdholdername' => $fdholdernameerror,
        'fdholderbank' => $fdholderbankerror,
        'nodays' => $nodayserror,
        'intrate' => $intrateerror,
        'principleamt' => $principleamterror,
        'fdissueddate' => $fdissuedateerror,
        'matdate'=>$matdateerror,
        'finalamt'=> $finalamterror,
      
        'intamt'=> $intamterror
    );
 
}
echo json_encode($response);

?>