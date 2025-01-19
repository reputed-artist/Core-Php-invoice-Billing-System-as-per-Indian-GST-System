<?php


include'../dbconnection.php';
include_once"../inc/titlecase.php";
include_once"../inc/replaceSpacesWithSemicolon.php";


$try=0;
$pnameerror="";
$pdescerror="";
$ptypeerror="";
$hsnerror="";


$pid=$_REQUEST['pid'];

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
    $pdescerror="Enter Product description";
 }


if(isset($_REQUEST['hsn']) && $_REQUEST['hsn'] != null)
{
      
  $hsn=addslashes($_REQUEST['hsn']);
    $try++;
    //echo "name".$try;
 }
 else
 {
    $hsnerror="Enter HSN Code";
 }


if(isset($_REQUEST['ptype']) && $_REQUEST['ptype'] != null)
{
      
  $ptype=titlecase(addslashes($_REQUEST['ptype']));
    $try++;
    //echo "name".$try;
 }
 else
 {
    $ptypeerror="Enter Product Type";
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



  //$pname=addslashes($_POST['pname']);

  //$pdesc=addslashes($_POST['desc']);
  //$hsn=$_POST['hsn'];

  //$ptype=$_POST['ptype'];
  
  //$date= date("Y/m/d");


$response=array();

if($try == 4)
{

 $c= mysqli_query($con,"update products set name='$pname' ,hsn='$hsn' , description='$pdesc', p_type='$ptype' where p_id='".$pid."'")or die("Error: " . mysqli_error($con));

 $d=mysqli_query($con,"update techsps set img_loc='$imgname', techs='$techs' where p_id='".$pid."'")or die("Error: " . mysqli_error($con));   

if(!$c)
{
  
  //$_SESSION['msg']="Error Occured ".mysqli_error($con);

  $response['success'] = false;
    $response['message'] = "Error Occurred";
    $response['errors'] = array(
        'pname' => $pnameerror,
        'pdesc' => $pdescerror,
        'hsn' => $hsnerror,
        'ptype' => $ptypeerror,
            );

}
else
{

 $response['success'] = true;
    $response['message'] = "Product updated successfully";

//$_SESSION['msg']="Client Added successfully";

 } 
}
 else{
  $response['success'] = false;
    $response['message'] = "Error Occurred";
    $response['errors'] = array(
        'pname' => $pnameerror,
        'pdesc' => $pdescerror,
        'hsn' => $hsnerror,
        'ptype' => $ptypeerror,
            );
  
 
}
echo json_encode($response);

?>