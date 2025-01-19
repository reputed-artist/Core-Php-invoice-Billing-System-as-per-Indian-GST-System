<?php 
session_start();
include "dbconnection.php";
include("checklogin.php");
check_login();

include("moneyFormatIndia.php");


?>
<html>
<head> <title> </title>
<?php include_once "links.php"; ?>

<style>
body {
  background: rgb(204,204,204); 
  margin: 0mm 25mm 25mm 25mm;
}
page {
  background: white;
  display: block;
  margin: 0 auto;
  margin-bottom: 0.5cm;
  box-shadow: 0 0 0.5cm rgba(0,0,0,0.5);
}
page[size="A4"] {  
  width: 25cm;
  height: 35cm; 
}

@media print {
  body, page {
    margin: 0;
    box-shadow: 0;
  }
}

 *[contenteditable] {
  border-radius: 0.25em;
  min-width: 1em;
  outline: 0;
  cursor: pointer;
}
*[contenteditable]:hover {
  background: #def;
  box-shadow: 0 0 1em 0.5em #def;
}
*[contenteditable]:focus {
  background: #def;
  box-shadow: 0 0 1em 0.5em #def;
}

 img {
    image-rendering: -webkit-optimize-contrast !important;
  }
</style>

</head>

<body style="background-color: gray">
<div id="loader"></div>
<page size="A4">

  <img src="letterpad/sticker letter pad .png" height="200px" width="870px" alt="logo" style="margin-top:20px;margin-left: 20px;"> 

<div style="border-bottom:5px solid black;" class="col-md-12">
</div>

<?php

if(isset($_GET['did']))
{

  $qid2=$_GET['did'];

  $q2=mysqli_query($con,"SELECT quote.orderid, quote.item_name, quote.quantity, quote.total, quote2.invid, quote2.cid, quote2.subtotal,quote2.taxrate,quote2.taxamount,quote2.totalamount,quote2.created,quote2.note from quote INNER join quote2 on quote.orderid = quote2.orderid and quote2.invid='$qid2'")or die("Error: " . mysqli_error($con));;

$cnt=0;
while ($row=mysqli_fetch_array($q2)) {

$cnt++;
    
$client = $row['cid'];

$orderid=$row['orderid'];
//echo  $orderid;

$created=date("d-m-Y", strtotime($row['created']));
                                
}


$dd=mysqli_query($con,"select quote.item_name, techsps.subcat from products INNER JOIN techsps on products.p_id = techsps.p_id INNER JOIN quote on quote.item_name=products.name WHERE orderid='$orderid' LIMIT 1");

$dd1=mysqli_fetch_array($dd);

}
?>
  <div class="col-md-12 ">
<p  style="margin-left:52px;font-size: 15px;"><b> Ref.: <?php echo $_GET['did']; ?> </b> 
<b style="float: right; margin-right: 167px;font-size: 15px;">Date: <?php echo $created; ?>
 </b> </p>
  </div>
</br>

<div class="col-md-12">
<?php 
 
 $cli=mysqli_query($con,"select * from client where cid='$client'");

 while($d=mysqli_fetch_array($cli))
   {
      $cname = $d['c_name'];
      $cadd=$d['c_add'];
      $mob=$d['mob'];

   }


?>
</br>
<p  style="margin-left:50px; font-size: 15px;"> To, </br>
<b style="font-size: 15px;">M/s. <?php echo $cname; ?> </b></br> 
<b style="font-size: 15px;"><?php 
       $x = 30;
$longString =$cadd;
$lines = explode("\n", wordwrap($longString, $x));

//echo "lines:".count($lines)." ";

for($num = 0; $num < count($lines); $num += 1){ 
    //echo  $lines[$num]. "\n <br>";

     $data[$num]=$lines[$num];
} 


for($num=0;$num<count($lines);$num++)
{
   $data[$num]."</br>";
}

if($data[0] != null)
{
  echo $data[0]."</br>";
}

 if(isset($data[1]) != null)
{
  echo $data[1]."</br>";
} 

 if(isset($data[2]) != null)
{
  echo $data[2]."</br>";
}

if(isset($data[3]) != null)
{
  echo $data[3]."</br>";
}
  echo "Mob: ".$mob;
 ?>

 </b> </p>

</div>
</br></br>
<div class="col-md-12">
</br>
<p class="text-center" style="font-size: 15px;" contenteditable> <b>Kind Attn.: Mr. </b> </p>
</div>

<div class="col-md-12">
</br>
<p class="text-center" style="font-size: 15px;"><b>Sub.: Batch Coding Machines </b></p>
</div>
</br>
<div class="col-md-12">
</br>
<p class="text-left" style="margin-left:65px;text-decoration: underline;font-size: 15px;" contenteditable><b>Quotation for
 <?php echo $dd1[1]; ?>  </b></p>
</div>

<table class="col-md-10" style="margin-left:65px"  border="5" >
 
  <tr class="text-center">
    <td width="60" height="40"><strong>Sr. no.</strong></td>
    <td width="350"><strong>Description</strong></td>
    <td width="100"><strong>Qty.</strong></td>
    <td width="140" valign="top" align="left"><p align="center"><strong>Total Amount</strong><br />
                <strong>EXW</strong></p>
          <p align="center" ><STRONG>(INR)</STRONG></p>
</td>
  </tr>

<?php 
 
 $zid2=$_GET['did'];

  $qz=mysqli_query($con,"SELECT quote.orderid, quote.item_name, quote.quantity, quote.total, quote2.invid, quote2.cid, quote2.subtotal,quote2.taxrate,quote2.taxamount,quote2.totalamount,quote2.created,quote2.note from quote INNER join quote2 on quote.orderid = quote2.orderid and quote2.invid='$zid2'")or die("Error: " . mysqli_error($con));

  $cnt=0;
 while($ro=mysqli_fetch_array($qz)) { 
  $cnt++;
 
 $tz=$ro['item_name'];

$orid=$ro['orderid'];

$gdid=mysqli_query($con,"select p_id from products where name='$tz'");

$ggid=mysqli_fetch_array($gdid);

$gdata=$ggid[0];

$cd=mysqli_query($con,"select techs from techsps where p_id='$gdata'");


$cd2=mysqli_fetch_array($cd);


//echo "</br>cd 2 data ".$cd2[0];
if($ro["item_name"] == "Courier" || $ro['item_name'] == "Freight Charges" || $ro['item_name'] == "Wooden Packing" 
  || $ro['item_name'] == "Packing and forwarding")
    {
      $extracol=$ro["item_name"];

      $extracol2=$ro["total"];
    }

else{
?>

  <tr>
    <td height="195" class="text-center"><?php echo $cnt;  ?></td>
    <td class="text-left" style="padding-left: 8px; padding-top: 10px; padding-right: 8px;" contenteditable>

    <?php

    $dy=array();

    array_push($dy,$ro['item_name']);

     printf ("<b><u>".$ro['item_name']."</b></u> </br>");


echo "</br>";
     $var=$cd2[0];
   

  $data2=mysqli_real_escape_string($con,$var);

    //echo $data2;
    

    $data = str_replace("\r",' ', $data2);
   $data = str_replace(" ",'', $data2);

$data=explode(';', $data2);

   //var_dump( $data);
   echo "<ul>";
   
   for ($i = 0; $i < count($data); $i++) {
  print "<li>".stripcslashes($data[$i])."</br>"."</li>";
} 
echo "</br>";

      ?></td>
    <td class="text-center"><b><?php echo $ro['quantity']."No.";  ?></b></td>
    <td class="text-center"><b><?php echo moneyFormatIndia($ro['total']); ?></b></td>
  </tr>
  <?php } }?>


<?php 
 
 $zid2=$_GET['did'];

  $qz=mysqli_query($con,"SELECT * from quote2 where orderid='$orid'")or die("Error: " . mysqli_error($con));

  $cnt=0;
 while($ro=mysqli_fetch_array($qz)) { 
  $cnt++;

if (isset($extracol))
{  ?>
<tr>
<td height="35" class="text-right" style="padding-right: 20px;" colspan="3"><b><?php if(isset($extracol)){ echo $extracol; } ?></b></td>
    <td height="35" class="text-center" ><b><?php if(isset($extracol2)){echo moneyFormatIndia($extracol2); } ?></b></td>
  
  </tr>
  <?php }

  if ((isset($extracol)) || (!isset($extracol)) )
  { ?>
  <tr>
      <td  height="35" colspan="3" class="text-right" style="padding-right: 20px;"><b> GST 18% </b></td>
    <td height="35" class="text-center"><b><?php  echo moneyFormatIndia($ro['taxamount']); ?></b></td>

    
  </tr>
<?php } ?>
  <tr>
    

<td height="35" colspan="3" class="text-right" style="padding-right: 20px;"> <b>Total </b></td>
    <td  height="35" class="text-center"><b><?php echo moneyFormatIndia($ro['totalamount']); ?></b></td>


  </tr>
</table>
<div class="col-md-11">
</br>
<p style="margin-left:50px"><b><?php 

if($ro['note'] == null )
{

}

else {
  echo "Note:".$ro['note']."</br>";
}


 ?> </b></p>


</div>
<?php  } ?>
</br></br>
</br></br>
<div class="col-md-12">
</br>
<p class="text-right" style="margin-right: 70px;font-size: 15px; "><b>Continued.... </b></p>
</div>
</page>

 <?php

 $im=mysqli_query($con,"select products.name, products.p_id,techsps.img_loc, techsps.subcat from products INNER JOIN techsps USING (p_id) INNER JOIN quote on products.name = quote.item_name WHERE quote.orderid = '$orid'");

$vg=mysqli_num_rows($im);
?>
<page size="A4">
</br></br>
  <div style="margin-left: 65px;font-size: 15px;"> <strong> <u> Product Image : </u></strong> </div>
  </br>
<div  class="col-md-12" >
<?php
 
 while($im2=mysqli_fetch_array($im))
{

    
if($vg>1)
{
 ?>

    <div style="margin-left: 25px;" class="col-md-4">


      <?php  echo "<img src='../dist/img/".$im2['img_loc']."'height='300px' width='400px'>"."</br> " ;    ?>
      <p style="font-size: 15px;margin-left: 30px;"><b><?php echo $im2["name"]; ?> </b></p>

     </div>
    
     
     <div class="col-xs-2"> </div>
 <?php } 

else
 { 

 ?>

 

<div style="margin-left:34px" class="col-md-4"> 


      <?php  echo "<img src='../dist/img/".$im2['img_loc']."'height='350px' width='450px' >";    ?>
       <p style="font-size: 15px; margin-left: 30px;"><b><?php echo $im2["name"]; ?> </b></p>

     </div>


<?php } } ?>
</div>


<div class="col-md-12"  style=" height: 100px;"> </div>
</br>
  
  <div style="margin-left: 55px;" class="col-md-10"> <strong style="font-size: 18px;"> <u> Terms  and Conditions : </u></strong> </div>
  </br>
  <?php echo "</br>"; ?>

<div style="margin-left: 55px; margin-right: 40px;font-size: 15px;margin-top: 8px;font-family: system-ui;" class="col-md-10" contenteditable>
 
<p><strong>A. </strong>  Above prices are  Ex- works Ahmedabad. Transport  Charges extra.     </p>                          
<p><strong>B. Payment Terms :</strong> 50% Advance along with confirmed P.O. & balance 50 % against Proforma  
Invoice before dispatch after inspection.          </p>                                
<p><strong>C. Delivery: </strong> Within 3 -4  Weeks from the date of receipt of confirmed P.O. along with Advance. </p>
<p>  <strong>D. Installation:</strong> It will be free of cost from our side.</p>
<p><strong>E.</strong>  The design and prices are subject to change for any changes/ additions in the above specifications. </p>
<p><strong>F. Warranty: </strong> 1 Year from the date of delivery against any manufacturing defects. The warranty covers free replacement of defective part if any.                           </p> 
<p><strong>G.</strong>   Order once placed cannot be cancelled under any circumstances. In case of order being
       cancelled , then the entire amount of Advance payment will stand as forfeited.  </p>

</div>

<div style="margin-left: 70px; font-family: system-ui;" class="col-md-10">
<p>We hope that the offer is technically in line with your requirement. </p>

<p>Thanking you and looking for your valuable Purchase Order. </p>


Yours truly,

<p style="font-family: 'Source Sans Pro','Helvetica Neue',Helvetica,Arial,sans-serif; font-size: 15px;"><strong>From CodeTech Engineers,</strong></p>
    <p style="margin-left: 25px;font-family: 'Source Sans Pro','Helvetica Neue',Helvetica,Arial,sans-serif;">  -----sd------ </p>
<p style="font-family: 'Source Sans Pro','Helvetica Neue',Helvetica,Arial,sans-serif;font-size: 15px;"> <strong>Kamlesh Chavda </strong> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  <strong class="text-right" style="margin-right: 10px;font-family: 'Source Sans Pro','Helvetica Neue',Helvetica,Arial,sans-serif;font-size: 15px; float: right;"> Mob.: +91-9737693302 </strong>     </p>         
                                                                                        
</div>
</page>
</body>
</html>
