<?php

include'../dbconnection.php';
include_once"../inc/titlecase.php";


 $try=0;
 $pcnameerror="";
 $pcadderror="";
 $moberror="";
 $countryerror="";
 $gsterror="";
 $pterror="";

if($_REQUEST['pcname'] != null )
{
  $pcname=titlecase(addslashes($_REQUEST['pcname']));
  $try++;
}
else{
  $pcnameerror="Supplier Name Can't be Empty";
}

if($_REQUEST['pcadd'] != null)
{
  $pcadd=addslashes($_REQUEST['pcadd']);
  $try++;
 }
 else{
    $pcadderror="Supplier Address Can't be Empty";
 }


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
  $country= $_REQUEST['fulldetails'];
  $sp= $_REQUEST['address_country'];
    //echo "\n"."correct";
    $in=0;
  
    //echo "country".$try;
    //echo "first conition";
  }
  else if ($_REQUEST['fulldetails'] != null && $_REQUEST['fulldetails'] != "India"){
  #$countryerror="Enter Valid Mobile number for Country selection";
   $country= $_REQUEST['fulldetails'];
  $sp= $_REQUEST['address_country'];
   $in=1;
   //echo "2nd condition";
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


 // $pcmobcount=strlen(($_REQUEST['pcmob']));
 //  if($pcmobcount == 10)
 //  {
 //  $pcmob=$_REQUEST['pcmob'];
 //    $try++;
 // }
 // else{
 //  $moberror="Invalid Mobile number";
 // }

 $pcid=$_REQUEST['pcid'];
  
  $email=$_REQUEST['email'];
 
  


 if($_REQUEST['pcomtype'] != null)
 {
  $pcomtype=$_REQUEST['pcomtype'];
    $try++;
}
else
{
  $pterror="Plz select Supplier type";
  
}
  $date= date("Y-m-d");

  //echo $try;
 
 if($try == 5)
 {
  $c=mysqli_query($con,"INSERT INTO `purchasecom` (`pcid`, `pcname`, `pcadd`,`pcmob`,`email`,`gst`,`pcomtype`,`country`, `created`) VALUES ('$pcid','$pcname', '$pcadd', '$mob','$email', '$gst','$pcomtype','$country','$date')")
    or die("Error: " . mysqli_error($con));

//echo "INSERT INTO `purchasecom` (`pcid`, `pcname`, `pcadd`,`pcmob`,`email`,`gst`,`pcomtype`,`country`, `created`) VALUES ('$pcid','$pcname', '$pcadd', '$mob','$email', '$gst','$pcomtype','$country','$date')";


if(!$c)
{
  
  //$_SESSION['msg']="Error Occured ".mysqli_error($con);
  $response['success'] = false;
    $response['message'] = "Error Occurred";
    $response['errors'] = array(
        'pcname' => $pcnameerror,
        'pcadd' => $pcadderror,
          'pcmob' => $moberror,
    
        'gst' => $gsterror,
        'pcomtype' => $pterror
    );

}
else
{

 $response['success'] = true;
    $response['message'] = "Supplier Added successfully";

//$_SESSION['msg']="Client Added successfully";

 } 
}
 else{
  $response['success'] = false;
    $response['message'] = "Error Occurred";
    $response['errors'] = array(
       'pcname' => $pcnameerror,
        'pcadd' => $pcadderror,
        'pcmob' => $moberror,
      
        'gst' => $gsterror,
        'pcomtype' => $pterror
            );
 
}
echo json_encode($response);
?>