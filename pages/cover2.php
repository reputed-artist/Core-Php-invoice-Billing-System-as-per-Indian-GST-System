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
  height: 31cm; 
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
.style1 {
	color: #FFFFFF;
	font-weight: bold;
}
@media print {
  body, page {
    margin: 0;
    box-shadow: 0;
-webkit-print-color-adjust: exact;
  }
}


.final td {
   background-color: #000000 !important;
   color: white !important;   
}

@media print {
body {-webkit-print-color-adjust: exact;}
}
</style>

<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"></head>

<body style="background-color: gray">
<?php
if(isset($_GET['inv']))
{
$val=$_GET['inv'];
$invdata=mysqli_query($con,"SELECT invtest2.invid, invtest2.orderid,client.c_name,client.c_add,client.mob,client.gst,client.c_type, client.country,invtest2.created, invtest2.subtotal,invtest2.taxrate,invtest2.taxamount,invtest2.totalamount FROM `invtest2`join client where invtest2.cid=client.cid and invtest2.invid='$val'") or die("Error: " . mysqli_error($con));



$items=mysqli_num_rows($invdata);

if($items == 0)
{
  $message="0 times Invoice not created";
}
while($d=mysqli_fetch_array($invdata))
   {
      $cname = $d['c_name'];
      $cadd=$d['c_add'];
      $mob=$d['mob'];

   }

}
?>

<page size="A4">
  <table width="945" height="342" border="0" style="border-width:thin">
    <tr>
      <td width="236" height="134"><div align="center"><img src="black.png" alt="logo" width="200" height="130"></div></td>
      <td colspan="3" valign="top"><p>&nbsp; </p>
        <blockquote style="border-color: none;">
          <blockquote style="border-color: none;">
            <p style="font-weight: bold"> Office : A4/1 Suryanagar Soc., Jawahar Chowk, Maninagar, Ahmedabad, Gujarat - 380008 (India)</p>
            <p style="font-weight: bold"> Mob : +91-9737693302 / 7016419537 / 8511369124</p>
          </blockquote>
      </blockquote></td>
    </tr>
    </br>
        <tr>
      <td height="123" colspan="2" valign="top">&nbsp;</td>
      <td width="454" valign="top"><p  style="margin-left:50px; font-size: 18px;"> To, </br>
<b style="font-size: 18px;" contenteditable>M/s. <?php echo $cname; ?> </b></br> 
<b style="font-size: 18px;" contenteditable><?php 
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
      <p>&nbsp;</p></td>
      <td width="22">&nbsp;</td>
    </tr>
    <tr>
      <td class="final" height="75" colspan="4" valign="middle" bordercolor="#F0F0F0" bgcolor="#000000"><p align="center" class="style1">Manufacturer: Inkjet Printers, TIJ, Conveyor, stracker, Dispensor, Stereo printers, Manual coder,</p>
      <p align="center" class="style1">Semi-automatic coder, Automatic coders, HP cartridge &amp; consumables</p></td>
    </tr>
  </table>
</page>
</body>
</html>
