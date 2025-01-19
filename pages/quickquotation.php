<?php 
session_start();
include "dbconnection.php";
include("checklogin.php");
check_login();

include 'inc/getState.php';
include("moneyFormatIndia.php");
include("FY.php");

?>
<html>
<head> <title>Quick Quotation </title>

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
  border-bottom: 50px solid #b800b8;
  /*border-top: 50px solid #b800b8;*/
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

if(isset($_GET['quick']))
{

  $qid2=$_GET['quick'];

  $q2=mysqli_query($con,"SELECT quickquote.q_id, products.p_id, products.name, quickquote.mob, techsps.techs, techsps.img_loc, products.hsn, products.p_type, techsps.subcat, quickquote.quantity,quickquote.price,quickquote.subtotal, quickquote.gst,quickquote.total, products.created FROM `techsps` INNER JOIN products on techsps.p_id=products.p_id INNER JOIN quickquote where products.p_id=$qid2")or die("Error: " . mysqli_error($con));;

$cnt=0;
while ($row=mysqli_fetch_array($q2)) {
$cnt++;

$q_id=$row['q_id'];
$p_id=$row['p_id'];
$p_name=$row['name'];
$mob=$row['mob'];
$techs=$row['techs'];
$img=$row['img_loc'];
$hsn=$row['hsn'];
$subcat=$row['subcat'];

$quantity=$row['quantity'];
$price=$row['price'];

$subtotal=$row['subtotal'];
$gst=$row['gst'];
$total=$row['total'];

                                
}


// $dd=mysqli_query($con,"select quote.item_name, techsps.subcat from products INNER JOIN techsps on products.p_id = techsps.p_id INNER JOIN quote on quote.item_name=products.name WHERE orderid='$orderid' LIMIT 1");

// $dd1=mysqli_fetch_array($dd);

}
?>
  <div class="col-md-12 ">
<p  style="margin-left:52px;font-size: 15px;"><b> Ref.: <?php echo $q_id; ?> </b> 
<b style="float: right; margin-right: 167px;font-size: 15px;">Date: <?php echo date("d-m-Y"); ?>
 </b> </p>
  </div>
</br>

<div class="col-md-12">
</br>
<p  style="margin-left:50px; font-size: 15px;"> To, </br>
<p style="margin-left: 50px;" contenteditable><b style="font-size: 15px;" >M/s. <?php  ?> </b></br> </p>
<p contenteditable style="margin-left: 50px;"></p>
<p></p>
<p></p>
<b style="font-size: 15px;margin-left:50px;" contenteditable><?php 
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
 <?php echo $subcat; ?>  </b></p>
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


  <tr>
    <td height="195" class="text-center"><?php echo "1";  ?></td>
    <td class="text-left" style="padding-left: 8px; padding-top: 10px; padding-right: 8px;" contenteditable>

    <?php

    $dy=array();

    array_push($dy,$p_name);

     printf ("<b><u>".$p_name."</b></u> </br>");


echo "</br>";
     $var=$techs;
   

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
    <td class="text-center"><b><?php echo $quantity." No."; ?></b></td>
    <td class="text-center"><b><?php echo $subtotal."=00"; ?></b></td>
  </tr>
  <?php  //}?>



<!-- <tr>
<td height="35" class="text-right" style="padding-right: 20px;" colspan="3"><b><?php if(isset($extracol)){ echo $extracol; } ?></b></td>
    <td height="35" class="text-center" ><b><?php if(isset($extracol2)){echo moneyFormatIndia($extracol2); } ?></b></td>
  
  </tr>
 -->  

  
  <tr>
      <td  height="35" colspan="3" class="text-right" style="padding-right: 20px;"><b> GST 18% </b></td>
    <td height="35" class="text-center"><b><?php echo $gst."=00"; ?></b></td>

    
  </tr>
  <tr>
    

<td height="35" colspan="3" class="text-right" style="padding-right: 20px;"> <b>Total </b></td>
    <td  height="35" class="text-center"><b><?php echo $total."=00"; ?></b></td>


  </tr>
</table>
<div class="col-md-11">
</br>
<p style="margin-left:50px" contenteditable><b></b></p>


</div>

</br></br>
</br></br>


<div class="col-md-12">
</br>
<p class="text-right" style="margin-right: 70px;font-size: 15px; "><b> </b></p>
</div>

<div class="col-md-12">
</br>
<p class="text-right" style="margin-right: 70px;font-size: 15px; "><b>Continued.... </b></p>
</div>



</page>


 <!-- <?php

 $im=mysqli_query($con,"select products.name, products.p_id,techsps.img_loc, techsps.subcat from products INNER JOIN techsps USING (p_id) INNER JOIN quote on products.name = quote.item_name WHERE quote.orderid = '$orid'");

$vg=mysqli_num_rows($im);
?> -->
<page size="A4">
</br></br>
  <div style="margin-left: 65px;font-size: 15px;"> <strong> <u> Product Image : </u></strong> </div>
  </br>
<div  class="col-md-12" >


    <div style="margin-left: 25px;" class="col-md-4">


      <?php  echo "<img src='../dist/img/".$img."'height='300px' width='400px'>"."</br> " ;    ?>
      <p style="font-size: 15px;margin-left: 30px;"><b><?php echo $p_name; ?> </b></p>

     </div>
    
     
<?php  ?>
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
