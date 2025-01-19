<?php 
include_once"dbconnection.php";
include("checklogin.php");
//check_login();



$companydetail=mysqli_query($con,"select * from admin");

while($data=mysqli_fetch_array($companydetail))
{
    $c_name=$data['c_name'];
    $c_add=$data['c_add'];
    $mob=$data['mob'];
    $gst=$data['gst'];
    $email=$data['email'];
}



?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AdminLTE 2 | Invoice</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  
  <?php include_once "links.php"; ?>

</head>
<body style="background-color: darkgray;">
<div id="loader"></div>
<div class="col-xs-10 wrapper" style="margin-left: 100px;">

 

  <!-- Content Wrapper. Contains page content -->
  <div>
   
    <div class="pad margin no-print">
      
    </div>

    <!-- Main content -->
    <section class="invoice d-flex justify-content-center col-xs-10" >
      <!-- title row -->
      <div class="row">
        <div class="col-xs-12">
          <h2 class="page-header">
            <i class="fa fa-globe"></i> CodeTech, Inc.
             <small class="pull-right"><b style="font-size: large;">Purchase Invoice </b></small> 
          </h2>
        </div>
        <!-- /.col -->
      </div>

<?php 
  if(isset($_GET['orderid']))
  {
    $orderid=$_GET['orderid'];
   $invdata=mysqli_query($con,"SELECT purchasecom.pcname, purchasecom.pcadd, purchasecom.pcmob, purchasecom.gst, purchasecom.email, purchasecom.pcomtype, purchaseinv2.invid, purchaseinv2.totalitems, purchaseinv2.orderid, purchaseinv2.invdate, purchaseinv2.subtotal,purchaseinv2.taxrate, purchaseinv2.taxamount, purchaseinv2.totalamount FROM purchasecom INNER JOIN purchaseinv2 WHERE purchasecom.pcid =purchaseinv2.cid AND purchaseinv2.orderid ='$orderid'");
   
  
    while($row=mysqli_fetch_array($invdata))
 {
    $pcname=$row['pcname'];
    $pcadd =$row['pcadd'];
    $pcmob=$row['pcmob'];
    $gst2=$row['gst'];
    $email2=$row['email'];
    $invid=$row['invid'];
    $totalitems=$row['totalitems'];
    $subtotal=$row['subtotal'];
    $taxrate=$row['taxrate'];
    $taxamt=$row['taxamount'];
    $totalamt=$row['totalamount'];
    $created=date('d-m-Y',strtotime($row['invdate']));
    $orderid=$row['orderid'];
    $pcomtype=$row['pcomtype'];
 }
 
 }
 ?>


      <!-- info row -->
      <div class="row invoice-info">
        <div class="col-sm-4 invoice-col">
          From
          <address>
            <strong><?php echo $pcname; ?></strong><br>
             <?php

            $arr = explode(",", $pcadd);
$str ="";
Foreach(array_chunk($arr,3) as $sub){
    $str .= trim(implode(",",$sub)) .",<br>\n";
}
Echo $str;
?>
           <b> GST: </b> <?php echo $gst2; ?></br>

            Email: <?php echo $email2; ?>
          </address>
        </div>
        <!-- /.col -->
        <div class="col-sm-4 invoice-col">
          To
          <address>
            <strong><?php echo $c_name; ?></strong><br>
            <?php

            $arr = explode(",", $c_add);
$str ="";
Foreach(array_chunk($arr,3) as $sub){
    $str .= trim(implode(",",$sub)) .",<br>\n";
}
Echo $str;?>
              <b> GST: </b> <?php echo $gst; ?></br>
            Email: <?php echo $email; ?> 
          </address>
        </div>
        <!-- /.col -->
        <div class="col-sm-4 invoice-col">
          <b>Invoice <?php echo $invid; ?></b><br>
          <br>
          <b>Invoice Date:</b> <?php echo $created; ?><br>
          <b>Order ID:</b> <?php echo $orderid; ?><br>
          
          <!-- <b>Account:</b> 968-34567 -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </br> </br>
      <!-- Table row -->

      <div class="row">
        <div class="col-xs-12 table-responsive">
          <table class="table table-striped">
            <thead>
            <tr>
              <th>Sr. no.</th>
              <th>Product</th>
              <th>HSN #</th>
              <th>Qty</th>
              <th>Price</th>
      
          
              <th>Total</th>
            </tr>
            </thead>
            <tbody>
          <?php 
  
$items=mysqli_query($con,"select * from purchaseinv where orderid='$orderid'");
$cnt=1;
while($itemdata=mysqli_fetch_array($items))
{
?>
            <tr>
              <td><?php echo $cnt; ?></td>
              <td><?php echo $itemdata['item_name']; ?></td>
              <td><?php echo $itemdata['hsn']; ?></td>
              <td><?php echo $itemdata['quantity']; ?></td>
              
              <td><?php echo $itemdata['price'].".00"; ?></td>
             <!--  <td> <?php echo $itemdata['taxrate']."%";?></td> -->
              
              <td><?php echo $itemdata['total'].".00"; ?></td>
            </tr>
            <?php $cnt++; } ?>
            
          
            </tbody>
          </table>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

      <div class="row">
        <!-- accepted payments column -->
        <div class="col-xs-8">
        </br></br></br></br></br>
          <p class="lead">Payment Methods:</p>
          <img src="../dist/img/credit/visa.png" alt="Visa">
          <img src="../dist/img/credit/mastercard.png" alt="Mastercard">
          <img src="../dist/img/credit/american-express.png" alt="American Express">
          <img src="../dist/img/credit/paypal2.png" alt="Paypal">

                  </div>
        <!-- /.col -->
        <div class="col-xs-4">
          <p class="lead"></p>

          <div class="table-responsive">
            <table class="table">

              <tr>
                <th style="width:50%">Subtotal:</th>
                <td><?php echo $subtotal.".00"; ?></td>
              </tr>
          
          <?php 
                if ($pcomtype == "Loc"){


          ?>
            <tr>
                <th style="width:50%">CGST 9%:</th>
                <td><?php 
                 $tx= $taxamt/2;
                echo $tx.".00"; ?></td>
              </tr>
               <tr>
                <th style="width:50%">IGST 9%:</th>
                <td><?php 
                $tx2=$taxamt/2;
                echo $tx2.".00"; ?></td>
              </tr>

<?php } else{ ?>

             <tr>
                <th style="width:50%">GST 18%:</th>
                <td><?php echo $taxamt.".00"; ?></td>
              </tr>
             <?php }?>
              <tr>
              <tr>
                <th>Total:</th>
                <td><?php echo $totalamt.".00"; ?></td>
              </tr>
            </table>
          </div>
        </div>
        <!-- /.col -->
        
      </div>
      <!-- /.row -->

      <!-- this row will not appear when printing -->
      <div class="row no-print">
        <div class="col-xs-12">
          <a href="invoice-print.html" target="_blank" class="btn btn-default"><i class="fa fa-print"></i> Print</a>
          <button type="button" class="btn btn-success pull-right"><i class="fa fa-credit-card"></i> Submit Payment
          </button>
          <button type="button" class="btn btn-primary pull-right" style="margin-right: 5px;">
            <i class="fa fa-download"></i> Generate PDF
          </button>
        </div>
      </div>
    </section>
    <!-- /.content -->
    <div class="clearfix"></div>
  </div>
 
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->


</body>
</html>
