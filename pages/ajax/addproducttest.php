<?php

include'../dbconnection.php';
include_once"../inc/replaceSpacesWithSemicolon.php";

$try=0;
$pnameerror="";
$pdescerror="";
$ptypeerror="";
$hsnerror="";



if(isset($_REQUEST['pid']))
{
  $pid=$_REQUEST['pid'];
}

if(isset($_REQUEST['pname']) && $_REQUEST['pname'] != null)
{
      
  $pname=addslashes($_REQUEST['pname']);
    $try++;
    //echo "name".$try;
 }
 else
 {
    $pnameerror="Enter Product Name";
 }


if(isset($_REQUEST['pdesc']) && $_REQUEST['pdesc'] != null)
{
      
  $pdesc=addslashes($_REQUEST['pdesc']);
    $try++;
    //echo "name".$try;
 }
 else
 {
    $pdescerror="Enter Product Description";
 }


if(isset($_REQUEST['hsn']) && $_REQUEST['hsn'] != null)
{
      
  $hsn=$_REQUEST['hsn'];
    $try++;
    //echo "name".$try;
 }
 else
 {
    $hsnerror="Enter Product HSN";
 }


if(isset($_REQUEST['ptype']) && $_REQUEST['ptype'] != null)
{
      
  $ptype=$_REQUEST['ptype'];
    $try++;
    //echo "name".$try;
 }
 else
 {
    $ptypeerror="Enter Product Description";
 }

$cr=0;
if(isset($_REQUEST['imgname']))
{
  $cr=+1;
  $imgname=$_REQUEST['imgname'];
}
else{
  $imgname="default.jpg";
}

if(isset($_REQUEST['techs']))
{
  $cr=+1;
  $techs=replaceSpacesWithSemicolon($_REQUEST['techs']);
}

  //$pname=$_POST['pname'];
  
  //$pdesc=$_POST['desc'];
  
  //$hsn=$_POST['hsn'];


  //$ptype=$_POST['ptype'];


  $date= date("Y-m-d");
  $subcat="";

$response=array();
if($try == 4 )
{


 $c= mysqli_query($con,"INSERT INTO `products` (`p_id`, `name`, `hsn`, `description`,`p_type`,`created`) VALUES ($pid,'$pname', '$hsn','$pdesc','$ptype','$date')") or die("Error: " . mysqli_error($con));

//echo "INSERT INTO `products` (`p_id`, `name`, `hsn`, `description`,`p_type`,`created`) VALUES (NULL,'$pname', '$hsn','$pdesc','$ptype','$date')";

$d=mysqli_query($con,"INSERT into techsps (`tid`, `p_id`, `img_loc`, `techs`,`subcat`) VALUES (NULL,'$pid','$imgname','$techs','$subcat')")    or die("Error: " . mysqli_error($con));

//echo "INSERT into techsps (`tid`, `p_id`, `img_loc`, `techs`,`subcat`) VALUES (NULL,'$pid','$imgname','$techs','$subcat')"; 


if(!$c)
{
  
  //$_SESSION['msg']="Error Occured ".mysqli_error($con);
$response['success'] = false;
    $response['message'] = "Error Occurred";
    $response['errors'] = array(
        'pname' => $pnameerror,
        'pdesc' => $pdescerror,
        'hsn' => $hsnerror,
        'ptype' => $ptypeerror
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
    'pname' => $pnameerror,
        'pdesc' => $pdescerror,
        'hsn' => $hsnerror,
        'ptype' => $ptypeerror
    );
 
}
echo json_encode($response);

 ?>