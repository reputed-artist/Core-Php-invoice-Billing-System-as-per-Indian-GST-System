<?php
session_start();
include'dbconnection.php';
include("checklogin.php");
 check_login();
include('fy.php');

include 'inc/getState.php';

$current_page="accounts";
$current_page1="accounts1";


if(isset($_GET['aid']))
 {
  $val=$_GET['aid']; 
  

  $bdata=mysqli_query($con,"select acc_type from account where cid=$val");

  $bdata2=mysqli_fetch_array($bdata);

  $getype= $bdata2[0]; 
 
 //echo $getype;

  if($bdata2[0] == 2)

{
   
  $pinfo2=mysqli_query($con,"SELECT c.cid,c.c_name, SUBSTRING_INDEX(c.c_add, ',', -1) as c_add, a.opening_bal FROM Client c JOIN account a ON c.cid = a.cid WHERE a.cid = $val")or die("Error: " . mysqli_error($con));

 
$rg2=0;

$client=1;

$co=mysqli_num_rows($pinfo2);

$co=(int)$co;

//echo "\n count:".$co;

if ($co > 0) {
    // Loop through each row in the result set
    while ($rg2 = mysqli_fetch_array($pinfo2)){
        // Output data from each row
        //$pcid=$rg2['']
        $pcid=$rg2['cid'];
        $pcname1=$rg2['c_name'];
        //echo $pcname1;
        $pcadd1=$rg2['c_add'];
         $opening1 =$rg2['opening_bal'];
         //echo "open bal ".$opening1;
    }
} else {
    echo "No results found inside if.";
}


if (date('m') >= 4) {//Upto June 2014-2015
    $financial_year = date('Y') . '-' . (date('Y') + 1);

} else {//After June 2015-2016
    $financial_year = (date('Y')-1) . '-' . date('Y');
}
//echo $financial_year;

$startyear=substr($financial_year,0,4);


$endyear=substr($financial_year,5,10);




// Calculate total credits from purchase bills in the previous year
$query_prev_credit = "SELECT SUM(totalamount) AS total_credit FROM invtest2 WHERE created BETWEEN '$startyear-04-01' AND
 '$endyear-03-30' and cid=$val";


$result_prev_credit = mysqli_query($con, $query_prev_credit);
$row_prev_credit = mysqli_fetch_assoc($result_prev_credit);
$prev_credit = $row_prev_credit['total_credit'];

// Calculate total debits from paidhistory in the previous year
$query_prev_debit = "SELECT SUM(amount) AS total_debit FROM paidhistory WHERE p_m = $val AND type_cs = 1 AND dateofpayment BETWEEN '$startyear-04-01' AND '$endyear-03-30'";




$result_prev_debit = mysqli_query($con, $query_prev_debit);
$row_prev_debit = mysqli_fetch_assoc($result_prev_debit);
$prev_debit = $row_prev_debit['total_debit'];

// If previous year's data is found, calculate the previous year's closing balance
// Otherwise, set the opening balance to 0
if ($prev_credit !== null && $prev_debit !== null) {
    // Calculate the previous year's closing balance
    $prev_balance = $prev_credit - $prev_debit+$opening1;
    //echo "conditional if";
} 
elseif($prev_credit === null && $prev_debit === null ){
      $prev_balance = $opening1;
      //echo "second if";
  }
else {
    // Set opening balance to 0
    $prev_balance = 0;
}

// Adjust the opening balance of the current year with the previous year's closing balance
$opening_balance_current_year = $prev_balance;

//echo $opening_balance_current_year;

}


else{


 $supplier=1;

 $pinfo=mysqli_query($con,"SELECT p.pcid,p.pcname, SUBSTRING_INDEX(p.pcadd, ',', -1) as pcadd, a.opening_bal FROM purchasecom p JOIN account a ON p.pcid = a.cid WHERE a.cid = $val")  or die("Error: " . mysqli_error($con));


$rg=0;


if (mysqli_num_rows($pinfo) > 0) {
    // Loop through each row in the result set
    while ($rg = mysqli_fetch_array($pinfo)) {
        // Output data from each row
      $pcid=$rg['pcid'];
        $pcname1=$rg['pcname'];
        $pcadd1=$rg['pcadd'];
         $opening1 =$rg['opening_bal'];
    }
} else {
    echo "No results found.";
}


 $currentYear = date('Y');
$currentMonth = date('m');
if ($currentMonth >= 4) {
    $prev_start_date = ($currentYear - 1) . "-04-01";
    $prev_end_date = $currentYear . "-03-31";
} else {
    $prev_start_date = ($currentYear - 2) . "-04-01";
    $prev_end_date = ($currentYear - 1) . "-03-31";
}

// Calculate total credits from purchase bills in the previous year
$query_prev_credit = "SELECT SUM(totalamount) AS total_credit FROM purchaseinv2 WHERE invdate BETWEEN '$prev_start_date' AND '$prev_end_date' AND cid=$val";

//echo "SELECT SUM(totalamount) AS total_credit FROM purchaseinv2 WHERE invdate BETWEEN '$prev_start_date' AND '$prev_end_date' AND cid=$val";

$result_prev_credit = mysqli_query($con, $query_prev_credit);
$row_prev_credit = mysqli_fetch_assoc($result_prev_credit);
$prev_credit = $row_prev_credit['total_credit'];

// Calculate total debits from paidhistory in the previous year
$query_prev_debit = "SELECT SUM(amount) AS total_debit FROM paidhistory WHERE p_m =$val AND type_cs = 2 AND dateofpayment BETWEEN '$prev_start_date' AND '$prev_end_date'";

//echo "SELECT SUM(amount) AS total_debit FROM paidhistory WHERE p_m = $val AND type_cs = 2 AND dateofpayment BETWEEN '$prev_start_date' AND '$prev_end_date'";


$result_prev_debit = mysqli_query($con, $query_prev_debit);
$row_prev_debit = mysqli_fetch_assoc($result_prev_debit);
$prev_debit = $row_prev_debit['total_debit'];


$prev_balance=0;

if ($prev_credit !== null && $prev_debit !== null) {
    // Calculate the previous year's closing balance
    $prev_balance = $prev_credit - $prev_debit;
    //echo "enters conditional if";
} 

elseif($prev_credit === null && $prev_debit === null ){
      $prev_balance = $opening1;
          //echo "enters conditional elseif";
  }
else {
    // Set opening balance to 0
    $prev_balance = 0;
    //echo "enters else";
}

// Adjust the opening balance of the current year with the previous year's closing balance
$opening_balance_current_year = $prev_balance;

//echo $opening_balance_current_year;
}

?>


<?php

?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AdminLTE 2 | Data Tables</title>

 <?php include_once "links.php"; ?>

<!-- <script type="text/javascript" src="/script/dataTables.export.js"></script> --> 

<style>

.btn-default{
  color:white;
  font: 29px;
  padding: 10px 25px 10px 4px;
   /*padding: 5px 30px 5px 5px;*/
  position: relative;
  width: 70px;
}

@media (max-width: 575.98px) {
  .modal-fullscreen {
    padding: 0 !important;
  }
  .modal-fullscreen .modal-dialog {
    width: 100%;
    max-width: none;
    height: 100%;
    margin: 0;
  }
  .modal-fullscreen .modal-content {
    height: 100%;
    border: 0;
    border-radius: 0;
  }
  .modal-fullscreen .modal-body {
    overflow-y: auto;
  }
}
@media (max-width: 767.98px) {
  .modal-fullscreen-sm {
    padding: 0 !important;
  }
  .modal-fullscreen-sm .modal-dialog {
    width: 100%;
    max-width: none;
    height: 100%;
    margin: 0;
  }
  .modal-fullscreen-sm .modal-content {
    height: 100%;
    border: 0;
    border-radius: 0;
  }
  .modal-fullscreen-sm .modal-body {
    overflow-y: auto;
  }
}
@media (max-width: 991.98px) {
  .modal-fullscreen-md {
    padding: 0 !important;
  }
  .modal-fullscreen-md .modal-dialog {
    width: 100%;
    max-width: none;
    height: 100%;
    margin: 0;
  }
  .modal-fullscreen-md .modal-content {
    height: 100%;
    border: 0;
    border-radius: 0;
  }
  .modal-fullscreen-md .modal-body {
    overflow-y: auto;
  }
}
@media (max-width: 1199.98px) {
  .modal-fullscreen-lg {
    padding: 0 !important;
  }
  .modal-fullscreen-lg .modal-dialog {
    width: 100%;
    max-width: none;
    height: 100%;
    margin: 0;
  }
  .modal-fullscreen-lg .modal-content {
    height: 100%;
    border: 0;
    border-radius: 0;
  }
  .modal-fullscreen-lg .modal-body {
    overflow-y: auto;
  }
}
.modal-fullscreen-xl {
  padding: 0 !important;
}
.modal-fullscreen-xl .modal-dialog {
  width: 100%;
  max-width: none;
  height: 100%;
  margin: 0;
}
.modal-fullscreen-xl .modal-content {
  height: 100%;
  border: 0;
  border-radius: 0;
}
.modal-fullscreen-xl .modal-body {
  overflow-y: auto;
}


.fade-in-image {
  animation: fadeIn 5s;
}



.btn-open-modal {
  margin-bottom: 0.5em;
}
.float{
  position:fixed;
  width:60px;
  height:60px;
  bottom:40px;
  right:40px;
  background-color:#0C9;
  color:#FFF;
  border-radius:50px;
  text-align:center;
  box-shadow: 2px 2px 3px #999;
}

.my-float{
  margin-top:22px;
}

    [class^='select2'] {
  border-radius: 0px !important;
  line-height: 25px !important;
  width: 1095px;
    
}
.close {
  position: absolute;
  right: 32px;
  top: 10px;
  width: 32px;
  height: 32px;
  opacity: 0.3;
}
.close:hover {
  opacity: 1;
}
.close:before, .close:after {
  position: absolute;
  left: 15px;
  content: ' ';
  height: 33px;
  width: 2px;
  background-color: #333;
}
.close:before {
  transform: rotate(45deg);
}
.close:after {
  transform: rotate(-45deg);
}

/*btn-danger{
  padding: 10px 10px 10px 10px;
}*/

.select2-selection, .select2-selection--single, .select2-selection__rendered,.select2-search,.select2-results__options, 
.select2-search--dropdown,.select2-results__option, .select2-results__option--highlighted, .select2-results{
  width:auto !important;
}


@media print {
    a[href]:after {
        content: none !important;
    }
}

</style>
</head>
<body class="hold-transition skin-blue sidebar-mini
<?php echo getState('fixed-layout') ? 'fixed ' : ''; ?>
    <?php echo getState('boxed-layout') ? 'layout-boxed ' : ''; ?>
    <?php echo getState('sidebar-collapse') ? 'sidebar-collapse ' : ''; ?>
    <?php echo getState('expand-on-hover') ? 'expandOnHover ' : ''; ?>
    <?php echo getState('control-sidebar-open') ? 'control-sidebar-open ' : ''; ?>
    <?php echo getState('sidebar-skin-toggle') ? 'sidebar-light ' : ''; ?>">

<div id="loader"></div>
<div class="wrapper">

  <?php include_once "header.php"; ?>
    
<?php include_once"navbar.php"; ?>

 <!-- <script src="..bower_components/path/to/cdn/jquery.min.js"></script> -->


  <!-- Content Wrapper. Contains page content -->
  
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
      Manage Accounts
        
      </h1> 
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        
        <li class="active">Manage Accounts</li>
      </ol>
    </section>
    </br> 


    <!-- Main content -->
    <section class="content" style="overflow: auto;">

      <div class="row" style="overflow: auto;">
        <div class="col-xs-12" style="overflow: auto;">
  <?php       if(isset($_GET['aid']))
 { ?>
           <div class="box box-info" style="overflow: auto;">
            <div class="box-header col-xs-12" style="overflow: auto;">
              <h3 class="box-title" style="padding-top: 10px;"><b>Accounts of <?php 
                  $vs=$pcname1;
              echo $vs; ?></b></h3>
              <h3 class="box-title pull-right" style="margin-top: 10px; margin-right: 20px;"><b><?php echo "Opening Balance: ". $opening_balance_current_year; ?></b> </h3>
                </br>
                          <h3 class="box-title" style="padding-top: 10px;"><b>Location : <?php 
                  $vs2=$pcadd1;
              echo $vs2; ?></b></h3>

            
            <div class="box-body">
              <table id="example2"  class="table table-bordered table-striped col-md-10">
                            <hr>



                            <thead>
                              <tr>
                                  <th>Sno.</th>
                                  <th>Date</th>
                                  <th>Invoice Details</th>
                                  <th> Purpose </th>

                                  <th> Credit </th>
                                  <th> Dedit</th>
                                  <th> Subtotal </th>
                                  
                              </tr>
                              </thead>
                              <tbody>
                              <?php 

        if($bdata2[0] == 2)                      
{


$ret=mysqli_query($con,"SELECT * FROM ( SELECT invtest2.invid 'invoice details', NULL AS 'purpose', invtest2.totalamount 'credit', NULL AS 'debit', invtest2.created FROM invtest2 WHERE invtest2.cid = $val AND invtest2.created BETWEEN '$startyear-04-01' AND '$endyear-03-31' UNION SELECT NULL AS col1, paidhistory.purpose 'purpose', NULL AS col3, paidhistory.amount 'debit', paidhistory.dateofpayment FROM paidhistory WHERE paidhistory.p_m = $val AND paidhistory.type_cs = 2 AND paidhistory.dateofpayment BETWEEN '$startyear-04-01' AND '$endyear-03-31' ) AS X ORDER BY created ASC
")or die("Error: " . mysqli_error($con));
      

 }
     else
     {
       $ret=mysqli_query($con,"SELECT * FROM (
        SELECT purchaseinv2.nid, purchaseinv2.invid AS 'invoice details', purchaseinv2.invdate, purchaseinv2.orderid, 
        NULL AS 'purpose', purchaseinv2.totalamount AS 'credit', NULL AS 'debit', purchaseinv2.created 
        FROM purchaseinv2 
        WHERE purchaseinv2.cid = $val AND purchaseinv2.invdate BETWEEN '$startyear-04-01' AND '$endyear-03-31'
        UNION 
        SELECT NULL AS nid, NULL AS 'invoice details', paidhistory.dateofpayment AS invdate,NULL AS orderid, 
        paidhistory.purpose AS 'purpose', NULL AS totalamount, paidhistory.amount AS 'debit', paidhistory.created 
        FROM paidhistory 
        WHERE paidhistory.p_m = $val AND paidhistory.type_cs = 1 AND paidhistory.dateofpayment BETWEEN '$startyear-04-01' AND '$endyear-03-31'
    ) AS X 
    ORDER BY invdate")or die("Error: " . mysqli_error($con));

   


     }



     
                $cnt=1;
            
            
                  $balance = $opening_balance_current_year;
                //echo $balance;
            
                $credit=0;
                $debit=0;
                while($row=mysqli_fetch_array($ret))
                {?>
                              <tr>
                              <td><?php echo $cnt;?></td>
                            
                                  
                                  <td>&nbsp;<?php 
                                    if ($bdata2[0] == 2)
                                    { 
                                    $c=date("d-M-Y",strtotime($row['created']));
                                        echo $c;
                                      }
                                      else{
                                        $c=date("d-M-Y",strtotime($row['invdate']));
                                        echo $c;
                                      }
                                  ?></td> 
                    <td>
                    <?php
                      if ($bdata2[0] == 2)
                    { ?>
                    <a href="invtest.php?inv=<?php echo $row['invoice details']; ?>" target="_blank">
                    <?php }
                     else {?>
                      <a href="purinv copy.php?orderid=<?php echo $row['orderid']; ?>" target="_blank">
                 
                   <?php }

                    if($row['invoice details']!=Null){
                           echo "----Bill Details ".$row['invoice details']; 
                                    }
                                    else{
                                      echo $row['invoice details'];
                                    } ?></a></td>
                                   <td><?php
                                    if($row['purpose']!=Null){
                                     echo $row['purpose'];  
                                    }
                                    else{
                                       echo $row['purpose']=" ";
                                    }
                                      ?></td>   
                                  


                              <td><?php 
                                  if ($bdata2[0] == 2){

                                    $credit=$credit+$row['credit'];
                                      echo $row['credit'] > 0 ? number_format($row['credit'],2) : '';

                                                                            
                                  }else{
                                    $credit=$credit+$row['credit'];

                                    echo $row['credit'] > 0 ? number_format($row['credit'],2) : ''; } ?></td>
                                    
                                    <td>
                                    <?php 
                                    
                                    if ($bdata2[0] == 2){
                                      $debit=$debit+$row['debit'];
                                         echo $row['debit'] > 0 ? number_format($row['debit'],2) : '';
                                                                          }
                                    else{
                                    $debit=$debit+$row['debit'];

                                    echo $row['debit'] > 0 ? number_format($row['debit'],2) : '';  }?></td>   
                             
                              <td><?php 

                                   if ($bdata2[0] == 2){
                                    $balance =($balance +  $row['credit'] - $row['debit'] );
                                          echo number_format($balance,2);
                                   }
                                   else
                                   {
                                 $balance =(($balance +  $row['credit']) - $row['debit']);
                                          echo number_format($balance,2); }
                              ?></td>
                                  
                                 </tr>

                                   <?php $cnt=$cnt+1; } ?>
                                   <?php }?>

                                  
                                          </tbody>
                                                        
                                                         
                                                       <tfoot>
                                           
                                                         <tr>

                                                          <td colspan="4"><b style="margin-left:850px;"> Total Balance Credit & Debit </b></td>
                                                          <td> <?php if ($getype == 2){
                                                            echo number_format($debit,2); 
                                                          }
                                                          else{
                                                           echo number_format($credit,2); } ?> </td>
                                                          
                                                          <td><?php
                                                            if ($getype == 2){
                                                            echo number_format($credit,2); 
                                                          }else{
                                                           echo number_format($debit,2);} ?></td>
                                                          
                                                          <td></td>
                                                          
                                                          </tr>
                                                        <tr>
                                                          <td colspan="4"><b style="margin-left:850px;"> Total Closing Balance </b></td>
                                                          <td> <?php 

                                                          if ($getype[0] == 2){

                                                            $closing=$debit-$credit; 
                                                            echo number_format( $closing,2);

                                                          }else{
                                                            $closing=$credit-$debit + $opening_balance_current_year; 
                                                            echo number_format( $closing,2);} ?> </td>
                                                          <td></td>
                                                          <td></td>
                                                    
                                                          </tr>
                  <tr>
                 <th>Sno.</th>
                                  <th >Date</th>
                                  <th> Invoice Details</th>
                                  <th> Purpose</th>
                                  <th> Credit </th>
                                  <th> Dedit</th>
                                  <th> Subtotal </th>
                </tr>


                                                          </tfoot>
                <!-- <tfoot>
                
                </tfoot> -->
              
              </table> 
              
            </div>
            <!-- /.box-body -->
   
                                  

                             
          </div> 
          <!-- /.box -->
         
        </div>
        <!-- /.col -->

</div>

<a href="#" class="float btn-open-modal" data-toggle="modal" data-target="#modal-fullscreen-xl">
<i class="fa fa-plus my-float"></i>
</a>



<!-- Modal Fullscreen xl -->
<div class="modal modal-fullscreen-xl " id="modal-fullscreen-xl" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h2 class="modal-title" align="center">Add Transaction</h2>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
         <!--  <span aria-hidden="true">&times;</span> -->
        </button>

      </div>

      <?php 


      $ret=mysqli_query($con,"select count(*)+1 from paidhistory")or die("Error: " . mysqli_error($con));
      $row=mysqli_fetch_array($ret);

    ?>


<!-- Modal HTML  -->

      <div class="modal-body">
          <form class="form-horizontal" name="form" method="post" action="">
              <div class="box-body"  >
                   <p align="center" style="color:#F00;"><?php 
                     if(isset($_SESSION['msg']))
                     {
                     echo $_SESSION['msg']; }?><?php echo $_SESSION['msg']=""; ?></p>
              
               <form class="form-horizontal style-form">
                           <p style="color:#F00"><?php echo $_SESSION['msg'];?><?php echo $_SESSION['msg']="";?></p>
                         </br>
                <div class="form-group">
                  <label id="cid" class="col-sm-2 control-label">Pay Id</label>
                  <div class="col-sm-6">
                    <input type="text" class="form-control" name="payid" id="payid" value="<?php echo $row[0]; ?>">
                  </div>
                </div>
               

                <div class="form-group">
                  <label id="cidlbl" class="col-sm-2 control-label">Company Type</label>
                  <div class="col-sm-8">
                  <div class="col-sm-2">
                 <?php if ($bdata2[0] == 1)
                    {
                   ?>
                    <input type="radio" class="minimal"  name="actype" id="actype" value="supplier" required="required" checked readonly> Supplier
                    <?php } else{ ?>
                      <input type="radio" class="minimal" name="actype" id="actype" value="supplier" required="required"  disabled readonly> Supplier
                    <?php } ?>
                 </div>   
                 <div class="col-sm-2">
                 <?php if ($bdata2[0] == 2)
                    {
                   ?>
                     <input type="radio" class="minimal" name="actype" id="actype" value="customer" required="required" checked readonly> Customer
              
                 <?php } else {?>
              <input type="radio" class="minimal" name="actype" id="actype" value="customer" required="required" disabled> Customer
            <?php } ?>                 

                  </div>
              </div>
              
              </div>
              <?php $vs=$pcname1;
              $vs2=$pcid; ?>
                <div class="form-group">
                  <label id="c_name" class="col-sm-2 control-label" > Company Name</label>
                  <div class="col-sm-6">
                   <input type="text" class="form-control" name="p_moz"  id="p_moz"  placeholder="Person or Company Name" value="<?php  echo $vs; ?>" readonly> 
 <input type="hidden" id="coid" name="coid" value="<?php echo $vs2; ?>" > <!-- <select name="p_moz" id="p_moz" class="form-control select2" disabled style="width:100%;">
                    <option value="<?php echo $vs2;  ?>" selected="selected"><?php echo $vs; ?></option>
                      </select> -->
                       </div>

                    <div id="pmerror"> </div>
                    </div>
                

                <div class="form-group">
                  <label id="c_add" class="col-sm-2 control-label">Amount</label>
                  <div class="col-sm-6">
                    <input type="number" class="form-control" name="amount" id="amount" placeholder="Amount">
                                  <div id="amounterror"> </div>
                </div>
              </div>

              <div class="form-group">
                  <label id="c_add" class="col-sm-2 control-label">Purpose</label>
                  <div class="col-sm-6">
                   <input type="text" class="form-control" name="purpose" id="purpose" placeholder="Purpose">
                                  <div id="purposeerror"> </div>
                </div>
              </div>

              <div class="form-group">
                  <label id="c_add" class="col-sm-2 control-label">Mode of Payment</label>
                  <div class="col-sm-6">
                   <select name="mode" class="form-control col-sm-6 select2" style="height: 32px;width: 100%;" id="mode">
                    
                     <?php

                       $data=mysqli_query($con,"select mode from paymode");

                       
                       while($row=mysqli_fetch_array($data))
                       {
                       ?>
                                   
                                    
                                    <option value="<?php echo $row['mode']; ?>"><?php echo $row['mode']; ?></option>
                                    
                                    <?php } ?>
                                  </select>
                                  <div id="modeerror"> </div>
                </div>
              </div>

              <div class="form-group">
                  <label id="c_add" class="col-sm-2 control-label"> Date Of Payment</label>
                  <div class="input-group date col-sm-6" style="padding-left: 14px; padding-right: 17px;">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>

                  <input type="text" class="form-control pull-right" name="datepicker" id="datepicker" value="<?php echo date('d-m-Y'); ?>">

                </div>
              </div>

               <div class="form-group">
                  <label id="c_add" class="col-sm-2 control-label">Creation Date</label>
                  <div class="col-sm-6">
                  <input type="text" class="form-control pull-right" value="<?php echo date('d-m-Y'); ?>" readonly>

                </div>
              </div>


              <div class="box-footer ">
                <label class="col-sm-2"></label>
                <input type="submit" name="submit" class="btn btn-info col-sm-6">
              </div>
              <!-- /.box-footer -->
              <br/><br/><br/>
              
            </form>

        </div>
     
     </form>
     </div>

  </div>
</div>


      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->


  </div>
  <!-- /.content-wrapper -->
   <?php include_once"footer.php"; ?>

  <?php include_once "settings.php"; ?>
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2({
       placeholder: "Select a Person or Company",
    allowClear: true
    });

    $("#datepicker").datepicker({
                format: "dd-mm-yyyy",
                language: "fr",
                changeMonth: true,
                changeYear: true,
                autoclose: true
    });


  });
 
  
</script>

<script>

  $(function () {
    $('#example1').DataTable()
    var table=$('#example2').DataTable({
        'paging'      : false,
      'lengthChange': true,
      'searching'   : true,
      'processing' :false,
      'ordering'    : true,
      'info'        : false,
      'autoWidth'   : true,
      'responsive':true,
      'footer': true,

      pageLength: 25,

      exportOptions : {
                modifier : {
                  selected: null,
                    // DataTables core
                    order : 'index', // 'current', 'applied',
                    //'index', 'original'
                    page : 'all', // 'all', 'current'
                    search : 'none' // 'none', 'applied', 'removed'
                },
                columns: [ 1, 2, 3, 4, 5, 6, 7, 8, 9, 10 ]

            },
  
      dom: "<'row'<'col-sm-3'l><'col-sm-9'<'pull-center'fB>>>rtip",
   
    
       buttons: [
             {
                extend:    'copyHtml5',
                text:      '<i class="fa fa-files-o"> Copy </i>',
                className: "btn-sm btn btn-danger",
                titleAttr: 'Copy',
                footer:true,
      
            },
            {
                extend:    'excelHtml5',
                text:      '<i class="fa fa-file-excel-o">&nbsp; Excel</i>',
                className: "btn-sm btn btn-danger",
                titleAttr: 'Excel',
                footer:true,
                

            },
            {
                extend:    'csvHtml5',
                text:      '<i class="fa fa-file-text-o">&nbsp; CSV</i>',
                className: "btn-sm btn btn-danger",
                titleAttr: 'CSV',
                footer:true,
            },
            {
              extend:    'pdfHtml5',
              footer:true,
                text:      '<i class="fa fa-file-pdf-o">&nbsp; PDF</i>',
                className: "btn-sm btn btn-danger",  
                orientation: 'landscape',
                pageSize: 'A3',          
                titleAttr: 'PDF',
                title: 'AdminLT || Clients Data',
                customize: function(doc) {  
                doc.pageMargins = [10,10,10,10];
                doc.defaultStyle.fontSize = 7;
                doc.styles.tableHeader.fontSize = 7;
               
                doc.styles.tableFooter.fontSize=15;
                doc.styles.title.fontSize = 15;
                // Remove spaces around page title
                doc.content[0].text = doc.content[0].text.trim();
               // Create a footer
                doc['footer']=(function(page, pages) {
                return {
                    columns: [
                    {
                            // This is the right column
                            alignment: 'center',
                            text: ['Clients Data from CodeTech Engineers'],
                            
                        },
                        {
                            // This is the right column
                            alignment: 'right',
                            text: ['page ', { text: page.toString() },  ' of ', { text: pages.toString() }],
                            //fontSize:10
                        }
                    ],
                    margin: [10, 0]
                }
            });


        // doc['header'] = (function (page, pages) {
        //         return {
        //           columns: [
        //             {
        //               // 'This is your left footer column',
        //               alignment: 'left',
        //               //fontSize: 8,
        //               text: ['test'],
        //              // margin: [0, 10]
        //             },
        //             {
        //               // This is the right column
        //               alignment: 'right',
        //               text: ['ama'],
        //               //margin: [0, 10]
        //             }
        //           ],
        //           margin: [30, 0]
        //         }
        //       });

        // Styling the table: create style object
        var objLayout = {};
        // Horizontal line thickness
        objLayout['hLineWidth'] = function(i) { return .5; };
        // Vertikal line thickness
        objLayout['vLineWidth'] = function(i) { return .5; };
        // Horizontal line color
        objLayout['hLineColor'] = function(i) { return '#aaa'; };
        // Vertical line color
        objLayout['vLineColor'] = function(i) { return '#aaa'; };
        // Left padding of the cell
        objLayout['paddingLeft'] = function(i) { return 4; };
        // Right padding of the cell
        objLayout['paddingRight'] = function(i) { return 4; };
        // Inject the object in the document
        doc.content[1].layout = objLayout;
    
                doc.content[1].table.widths =Array(doc.content[1].table.body[0].length + 1).join('*').split('');
                doc.defaultStyle.alignment = 'center';
                doc.styles.tableHeader.alignment = 'center';
                },
                
            },     
           {
                extend:    'print',
                //footer: true,
                text:      '<i class="fa fa-print">&nbsp;Print</i>',
                 className: "btn btn-sm  btn-danger", 
                titleAttr: 'Print',
                footer:true,
            },




           // {
            //     text: '{ } JSON',
            //     className: "btn-sm btn btn-danger",
            //     titleAttr: 'JSON',
                
            //     action: function ( e, dt, button, config ) {
            //         var data = dt.buttons.exportData();
 
            //         $.fn.dataTable.fileSave(
            //             new Blob( [ JSON.stringify( data ) ] ),
            //             'Export.json'
            //         );
            //     }
            // },

            {
                              
             className: "btn btn-sm  btn-danger",  
             titleAttr: 'TXT',
             text: '<i class="fa fa-fw fa-file-text-o">&nbsp; TXT</i>',
             action: function (e, dt, node, config) {


            // Trigger the Ultimate Export plugin to export data from the textarea
             doExport('#example2', { type: 'txt' });
            },
  
           },

           {
                              
             className: "btn btn-sm  btn-danger",  
             titleAttr: 'pdf',
                       text: '<i class="fa fa-fw fa-file-text-o">&nbsp; pdf2</i>',
                  action: function (e, dt, node, config) {
                 var pdfConfig = {
                            type: 'pdf',
                            jspdf: {
                                orientation: 'landscape', // Set orientation to landscape
                                autotable: {
                                    tableWidth: 'wrap',
                                    margin: { top: 20, bottom: 20,}, //left: 20, right: 20 }, // Add margins
                                    styles: {
                                        cellPadding: 5, // Add padding
                                        fontSize: 10, // Set font size
                                        valign: 'middle', // Vertical alignment to middle
                                        halign: 'center' // Horizontal alignment to center
                                      
                                    },
                                    headerStyles: {
                                        fillColor: [100, 100, 100], // Header background color
                                        textColor: 255, // Header text color
                                        fontStyle: 'bold' // Header text style
                                    },
                                    alternateRowStyles: {
                                        fillColor: [230, 230, 230] // Alternate row background color
                                    }
                                },
                                addPageContent: function(data) {
                                    // Add dividing lines after every row
                                    //data.settings.margin = [20, 20, 20, 20];
                                    data.doc.line(data.settings.margin[0], data.cursor.y, data.settings.margin[0] + data.table.width, data.cursor.y);
                                }
                            }
                        };

                        // Trigger the Ultimate Export plugin to export data from the textarea
                        doExport('#example2', pdfConfig);
                    }
                },


                {
                                          
                   className: "btn btn-sm  btn-danger",  
                   titleAttr: 'sql',
                   text: '<i class="fa fa-fw fa-database">&nbsp; SQL</i>',
                   action: function (e, dt, node, config) {
                    // Trigger the Ultimate Export plugin to export data from the textarea
                    doExport('#example2', { type: 'sql' });
                },
                    exportOptions: {
                    modifier: {
                        page: 'all'
                    }
                }
              },
              {
                              
                   className: "btn btn-sm  btn-danger",  
                   titleAttr: 'doc',
                   text: '<i class="fa fa-fw fa-file-word-o">&nbsp; Docx</i>',
                   action: function (e, dt, node, config) {
                      // Trigger the Ultimate Export plugin to export data from the textarea
                      doExport('#example2', { type: 'doc',mso: {pageOrientation: 'landscape'} });
                 },
                exportOptions: {
                      modifier: {
                          page: 'all'
                      }
                  }
                },
             {
                              
                className: "btn btn-sm  btn-danger",  
                titleAttr: 'PNG',
                text:'<i class="fa fa-fw fa-image">&nbsp; PNG</i>',
                action: function (e, dt, node, config) {

                 // Trigger the Ultimate Export plugin to export data from the textarea
                      doExport('#example2', { type: 'png'});
                  },
                exportOptions: {
                      modifier: {
                          page: 'all'
                      }
                  }
                }
            
             ],
   
      initComplete: function () {
            var btns = $('.dt-button');
            btns.addClass('btn btn-primary btn-sm btn-group');
            btns.removeClass('dt-button');

        },        "lengthMenu": [[25, 100, 150, -1], [25, 100, 150, "All"]]
      } );
 


    })
  
</script>

<script>
 $("form").submit(function(event) {
        event.preventDefault();
        console.log("submit event");

        
        var formData = $(this).serialize();
        $.ajax({
            type: 'POST',
            url: 'ajax/addledgertransaction.php',

            data: formData,
            dataType: 'json',
            success: function(response) {
                if (response.success) {
        //           $('.error').html('');
        // // Remove error classes
        //            $('.error').removeClass('error');
                    $('.error').css('border','0px');
                    $('#message').html(response.message);
                    Swal.fire({
                    title: "Good!",
                    text: "New Transaction Data Inserted!",
                    icon: "success",
                    showConfirmButton: false, // Hide the OK button
                    timer: 3000, // Close the popup after 3 seconds (3000 milliseconds)
                  }).then(function() {
                    // This function will be called after the popup closes
                    //location.reload(); // Refresh the page
                  window.location.href = 'accdetails.php?aid='+response.zid;
                  });

                    // Redirect or do something else after successful submission
                } else {
                   //$('.error').html('');
               
                  $('.error').css('border','0px');

                  $.each(response.errors, function(field, errorMessage) {
                $('#' + field + '_error').removeClass('error');
            });

                   console.log(response.errors);
               $.each(response.errors, function(field, errorMessage) {
                $('#' + field + '_error').addClass('error').text(errorMessage);
            });
                }
            },
            error: function(xhr, status, error) {
             
                console.error(xhr.responseText);
                //console.error(status.responseText);
            }
        });
     //  }
    // else {
    //     // Handle case where phone number is not valid
    //     alert("Please enter a valid phone number.");
    // }
    });


 </script>

</body>
</html>


<?php }?>