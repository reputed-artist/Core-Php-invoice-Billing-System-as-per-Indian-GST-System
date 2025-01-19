<?php
include'../dbconnection.php';
include_once"../inc/titlecase.php";

$try=0;
$nameerror="";
$moberror="";
$cadderror="";
$countryerror="";
$response="";
$gsterror="";
$ctypeerror="";

$cid=$_REQUEST['cid'];

if(isset($_REQUEST['c_name']) && $_REQUEST['c_name'] != null)
{
      
  $cname=titlecase(addslashes($_REQUEST['c_name']));
    $try++;
    //echo "name".$try;
 }
 else
 {
    $nameerror="Enter Client Name";
 }

 if($_REQUEST['c_add'] != null)
 { 
  $cadd= addslashes($_REQUEST['c_add']);
  $try++;
  //echo "add".$try;
}
else
{
    $cadderror="Enter Client Address";
}

  //$mobcount=strlen(($_REQUEST['mob']));
  if($_REQUEST['fullno'] !=null)
  {
  $mob= $_REQUEST['fullno'];
  $try++;
  //echo "mob".$try;
 }
 else{
  $moberror="Enter Valid Mobile number";
 }




$conzy = rtrim($_REQUEST['fulldetails']);

//echo $conzy;

if($_REQUEST['fulldetails'] != null && $conzy == "India")
  {
  $country= trim($_REQUEST['fulldetails']);
  $sp= $_REQUEST['address_country'];
    //echo "\n"."correct";
    $in=0;
    $try++;
    //echo "country".$try;
    //echo "first conition";
  }
  else if ($_REQUEST['fulldetails'] != null && $_REQUEST['fulldetails'] != "India"){
  #$countryerror="Enter Valid Mobile number for Country selection";
   $country= trim($_REQUEST['fulldetails']);
  $sp= trim($_REQUEST['address_country']);
   $in=1;
   //echo "2nd condition";
   $try++;
   //echo "country".$try;
 }

 else {
  $countryerror="Enter Valid Mobile number for Country selection";
 //echo " enter else";
 }

//echo "\n Country print".$_REQUEST['fulldetails'];
//echo "\n Ind value print".$in;



if($_REQUEST['gst'] != null && $in == 0 && $conzy == "India")
{

  $gstcount=strlen(trim($_REQUEST['gst'],""));

  //echo $gstcount; 
  //echo "\n first condition";
    if($gstcount == 10 or $gstcount == 15 or $gstcount == 12)
    {

    //echo "\n country".$_REQUEST['fulldetails'];
    //echo  "\n count".$gstcount;

    $gst=strtoupper($_REQUEST['gst']);
    $try++;
    //echo "gst".$try;
    } 
    else {
      $gsterror="Enter Valid 15 Digit GST / 10 Digit Pan or 12 Digit Adhaar number"; 
    }
}
 else if ($_REQUEST['gst'] != null && $in == 1){

   //echo "\n Enter Other country".$_REQUEST['fulldetails'];
 $gst=strtoupper(trim($_REQUEST['gst']));
      $try++;
   //echo "gst".$try;
 }

else if ($_REQUEST['gst'] == null)
{
  if($in == 0)
  {
  $gsterror="Enter Valid 15 Digit GST / 10 Digit Pan or 12 Digit Adhaar number"; 
}
else{
  $gsterror="Enter Valid details";
}
}

else{
  //echo "\n Lastly" ;
  if($in == 0)
  {
  $gsterror="Enter Valid 15 Digit GST / 10 Digit Pan or 12 Digit Adhaar number"; 
}
else{
  $gsterror="Enter Valid details";
}
}



if($_REQUEST['ctype'] != null)
{

  $ctype=$_REQUEST['ctype'];
  $try++;
  //echo $ctype;
  //echo "ctype".$try;
 }
 else
 {
  $ctypeerror="Select the Client Type";
 }


  $date= date("Y-m-d");

//echo "try value ::::::::::".$try;

//echo "INSERT INTO `client` (`cid`, `c_name`, `c_add`,`mob`,`country`,`gst`,`c_type`, `created`) VALUES ('$cid','$cname', '$cadd', '$mob','$country', '$gst','$ctype','$date')";

$response=array();
if($try == 6 )
{

 $c=mysqli_query($con,"INSERT INTO `client` (`cid`, `c_name`, `c_add`,`mob`,`country`,`gst`,`c_type`, `created`) VALUES ('$cid','$cname', '$cadd', '$mob','$country', '$gst','$ctype','$date')") or die("Error: " . mysqli_error($con));

if(!$c)
{
  
  //$_SESSION['msg']="Error Occured ".mysqli_error($con);
  $response['success'] = false;
    $response['message'] = "Error Occurred";
    $response['errors'] = array(
        'c_name' => $nameerror,
        'c_add' => $cadderror,
        'mob' => $moberror,
        'country' => $countryerror,
        'gst' => $gsterror,
        'ctype' => $ctypeerror
    );

}
else
{

 $response['success'] = true;
    $response['message'] = "Client Added successfully";

$_SESSION['msg']="Client Added successfully";

 } 
}
 else{
  $response['success'] = false;
    $response['message'] = "Error Occurred";
    $response['errors'] = array(
        'c_name' => $nameerror,
        'c_add' => $cadderror,
        'mob' => $moberror,
        'country' => $countryerror,
        'gst' => $gsterror,
        'ctype' => $ctypeerror
    );
 
}
echo json_encode($response);

?>