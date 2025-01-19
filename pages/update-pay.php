<?php
session_start();
include'dbconnection.php';
include("checklogin.php");

include 'inc/getState.php';
check_login();

$current_page="manage-paidhistory";


?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AdminLTE 2 | General Form Elements</title>
  <?php include_once"links.php"; ?>

</head>
<body class="hold-transition skin-blue sidebar-mini <?php echo getState('fixed-layout') ? 'fixed ' : ''; ?>
    <?php echo getState('boxed-layout') ? 'layout-boxed ' : ''; ?>
    <?php echo getState('sidebar-collapse') ? 'sidebar-collapse ' : ''; ?>
    <?php echo getState('expand-on-hover') ? 'expandOnHover ' : ''; ?>
    <?php echo getState('control-sidebar-open') ? 'control-sidebar-open ' : ''; ?>
    <?php echo getState('sidebar-skin-toggle') ? 'sidebar-light ' : ''; ?>">
<div id="loader"></div>
<div class="wrapper">

<?php include_once"header.php"; ?>
  <?php include_once "navbar.php"; ?>
  
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
      Manage Clients
        <small></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Forms</a></li>
        <li class="active">General Elements</li>
      </ol>
    </section>
 <?php 
        $payid=$_GET['payid'];

     $ret=mysqli_query($con,"select * from paidhistory where pay_id='$payid'")or die("Error: " . mysqli_error($con));

     //echo "select * from paidhistory where pay_id='$payid'";
      $row=mysqli_fetch_array($ret);

      $dcz = $row['p_m'];


      if ($row['type_cs'] == 1)
     {


    $q2=mysqli_query($con,"select pcname from purchasecom where pcid=$dcz");
     }
     else {
      $q2=mysqli_query($con,"select c_name from client where cid=$dcz");
     }

     $qz=mysqli_fetch_array($q2);
    // echo "select pcname from purchasecom where pcid=$dcz";
    //echo $qz[0];

    ?>
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <!-- left column -->
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Add Client</h3>
            </div>
          </br>
           <p align="center" style="color:#F00;"><?php 
                     if(isset($_SESSION['msg']))
                     {
                     echo $_SESSION['msg']; }?><?php echo $_SESSION['msg']=""; ?></p>
            


          <form class="form-horizontal style-form" name="form" method="post" action="">
                           <p style="color:#F00"><?php echo $_SESSION['msg'];?><?php echo $_SESSION['msg']="";?></p>
                         </br>
            <!-- /box-header -->
            <!-- form start -->
    
              <div class="box-body">
                
                <div class="form-group">
                  <label id="cid" class="col-sm-2 control-label">Pay Id</label>
                  <div class="col-sm-8">
                    <input type="text" class="form-control" name="payid" id="payid" value="<?php echo $row['pay_id']; ?>">
                  </div>
                </div>

                <div class="form-group">
                  <label id="cidlbl" class="col-sm-2 control-label">Company Type</label>
                  <div class="col-sm-8">
                  <div class="col-sm-2">
                  <?php if ($row['type_cs'] == 1)
                    {
                   ?>
                    <input type="radio" class="minimal"  name="actype" id="actype" value="supplier" required="required" checked> Supplier
                    <?php } else{ ?>
                    <input type="radio" class="minimal"  name="actype" id="actype" value="supplier" required="required" > Supplier
                    <?php } ?>
                 </div>   
                 <div class="col-sm-2">
                 <?php if ($row['type_cs'] == 2)
                    {
                   ?>
                    
                 <input type="radio" class="minimal" name="actype" id="actype" value="customer" required="required" checked> Customer
                 <?php } else {?>
              <input type="radio" class="minimal" name="actype" id="actype" value="customer" required="required" > Customer
            <?php } ?>                 

                  </div>
                </div>
              </div>


                <div class="form-group">
                  <label id="c_name" class="col-sm-2 control-label"> Company Name</label>
                  <div class="col-sm-8">
                   <!--  <input type="text" class="form-control" name="pm"  id="pm" required="required" placeholder="Person or Company Name"> -->
                <select name="p_mz" id="p_mz" class="form-control select2">
                    <option value="<?php echo $qz[0]; ?>"><?php echo $qz[0]; ?></option>
                                    </select>
              </div>

                    <div id="pmerror"> </div>
                    </div>
                


                <div class="form-group">
                  <label id="c_add" class="col-sm-2 control-label">Amount</label>
                  <div class="col-sm-8">
                    <input type="number" class="form-control" name="amount" id="amount" value="<?php echo $row['amount']; ?>"></textarea>
                                  <div id="adderror"> </div>
                </div>
              </div>

              <div class="form-group">
                  <label id="c_add" class="col-sm-2 control-label">Purpose</label>
                  <div class="col-sm-8">
                   <input type="text" class="form-control" name="purpose" id="purpose" value="<?php echo $row['purpose']; ?>">
                                  <div id="moberror"> </div>
                </div>
              </div>
              <?php $modevalue=$row['mode'];
                //echo $modevalue;
               ?>

              <div class="form-group">
                  <label id="c_add" class="col-sm-2 control-label">Mode of Payment</label>
                  <div class="col-sm-8">
                   <select name="mode" class="form-control  select2" style="height: 32px;">
                      <option value="0">Mode</option>         
                      <?php

                       $data=mysqli_query($con,"select mode from paymode");

                      
                       while($rowz=mysqli_fetch_array($data))
                       {

                        if($rowz['mode'] == $modevalue)
                        {
                       ?>     
                        <option value="<?php echo $rowz['mode']; ?>" selected="selected"><?php echo $rowz['mode']; ?></option>
                       <?php 
                           }
                           else {

                        ?>
                             <option value="<?php echo $rowz['mode']; ?>"><?php echo $rowz['mode']; ?></option>       
                                 <?php } }?>

                                  </select>

                                  <label> </label>
                                  <div id="gsterror"> </div>

                </div>
              </div>

               <div class="form-group">
                  <label id="c_add" class="col-sm-2 control-label"> Date Of Payment</label>
                  <div class="input-group date col-sm-8" style="padding-left: 14px; padding-right: 17px;">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>

                  <input type="text" class="form-control pull-right" name="datepicker" id="datepicker" 
                  value="<?php $c=date("d-m-Y",strtotime($row['dateofpayment']));
                                       echo $c; ?>">

                </div>
              </div>

              <div class="form-group">
                  <label id="c_add" class="col-sm-2 control-label">Creation Date</label>
                  <div class="col-sm-8">
                  <input type="text" class="form-control" name="created" value="<?php  $c=date("d-M-Y",strtotime($row['created']));
                                       echo $c; 
          //echo $row['created'];
                   ?>" readonly/>

                </div>
              </div>




              <!-- /.box-body -->
              <div class="box-footer ">
                <label class="col-sm-2"></label>
                <input type="submit" name="submit" class="btn btn-info col-sm-8">
              </div>
              <!-- /.box-footer -->
              <br/><br/><br/>
            </form>
            
          </div>
            </div>            <!-- Form Element sizes -->
          
          <!-- /.box -->
        </div>
        <!--/.col (right) -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
   <?php include_once"footer.php"; ?>
   <?php include_once"settings.php";?>
   
  
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
    $(document).on('click','input[name="actype"]:radio',function() {
       var val="";
        var val = $(this).val(); 
        var myDropDownList = $("#p_mz");
       myDropDownList.prop('disabled', false);
       //$("#clog").attr('disabled','disabled');
        console.log(val); 
        $.ajax({ 
            type:"GET", 
            url:"ajax/fetchpaidperson.php", 
            data:'para='+val, 
            dataType: 'json',
            success:function(r) { 
                    // myDropDownList.prop('disabled', false);
                console.log(r); 
                var data = r;
                var options = '';
                 myDropDownList.empty();
                  $.each(data, function(index, item){
                    // Append option based on type
                    if(val === 'supplier') {
                        myDropDownList.append('<option value="' + item[0] + '">' + item[1] + '</option>');
                    } else {
                        myDropDownList.append('<option value="' + item[0] + '">' + item[1] + '</option>');
                    }
                });


                // Append to the html
                $('#p_mz').append(options);


            } 
        }); 
    })
</script>

<script>
 $("form").submit(function(event) {
        event.preventDefault();
        console.log("submit event");

        
        var formData = $(this).serialize();
        $.ajax({
            type: 'POST',
            url: 'ajax/updatepaytest.php',

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
                  window.location.href = 'paid-his.php';
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
