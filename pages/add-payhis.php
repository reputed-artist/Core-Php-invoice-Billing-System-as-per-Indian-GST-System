<?php
session_start();
include'dbconnection.php';
include("checklogin.php");
check_login();

include 'inc/getState.php';

$current_page='manage-paidhistory';


?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AdminLTE 2 | General Form Elements</title>
  <?php include_once "links.php"; ?>

<style>

.select2-selection, .select2-selection--single, .select2-selection__rendered,.select2-search,.select2-results__options, 
.select2-search--dropdown,.select2-results__option, .select2-results__option--highlighted, .select2-results{
  width:auto !important;
}
</style>
</head>
<body class="hold-transition skin-blue sidebar-mini <?php echo getState('fixed-layout') ? 'fixed ' : ''; ?>
    <?php echo getState('boxed-layout') ? 'layout-boxed ' : ''; ?>
    <?php echo getState('sidebar-collapse') ? 'sidebar-collapse ' : ''; ?>
    <?php echo getState('expand-on-hover') ? 'expandOnHover ' : ''; ?>
    <?php echo getState('control-sidebar-open') ? 'control-sidebar-open ' : ''; ?>
    <?php echo getState('sidebar-skin-toggle') ? 'sidebar-light ' : ''; ?>">

<div id="loader"></div>
<div class="wrapper">

<?php include_once "header.php"; ?>
 <?php include_once "navbar.php"; ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
      Manage Payments
        <small></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Add Paid History</li>
      </ol>
    </section>
 
      <?php $ret=mysqli_query($con,"select count(*)+1 from paidhistory")or die("Error: " . mysqli_error($con));
      $row=mysqli_fetch_array($ret);

    ?>
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <!-- left column -->
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Add Payment Details</h3>
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
                    <input type="text" class="form-control" name="payid" id="payid" value="<?php echo $row[0]; ?>" readonly>
                  </div>
                </div>
               

                <div class="form-group">
                  <label id="cidlbl" class="col-sm-2 control-label">Company Type</label>
                  <div class="col-sm-8">
                  <div class="col-sm-2">
                    <input type="radio" class="minimal"  name="actype" id="actype" value="supplier"> Supplier
                 </div>   
                 <div class="col-sm-2">
                 <input type="radio" class="minimal" name="actype" id="actype" value="customer"> Customer

                  </div>
                </div>
              </div>


                <div class="form-group">
                  <label id="c_name" class="col-sm-2 control-label"> Company Name</label>
                  <div class="col-sm-8">
                   <!--  <input type="text" class="form-control" name="pm"  id="pm" required="required" placeholder="Person or Company Name"> -->
                <select name="p_m" id="p_m" class="form-control select2" disabled>
                    <option value=""></option>
                                    </select>
              </div>

                    <div id="pmerror"> </div>
                    </div>
                

                <div class="form-group">
                  <label id="c_add" class="col-sm-2 control-label">Amount</label>
                  <div class="col-sm-8">
                    <input type="number" class="form-control" name="amount" id="amount" placeholder="Amount"></textarea>
                                  <div id="amounterror"> </div>
                </div>
              </div>

              <div class="form-group">
                  <label id="c_add" class="col-sm-2 control-label">Purpose</label>
                  <div class="col-sm-8">
                   <input type="text" class="form-control" name="purpose" id="purpose" placeholder="Purpose">
                                  <div id="purposeerror"> </div>
                </div>
              </div>

              <div class="form-group">
                  <label id="c_add" class="col-sm-2 control-label">Mode of Payment</label>
                  <div class="col-sm-8">
                   <select name="mode" class="form-control select2" style="height: 32px;" id="mode">
                    
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
                  <div class="input-group date col-sm-8" style="padding-left: 14px; padding-right: 17px;">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>

                  <input type="text" class="form-control pull-right" name="datepicker" id="datepicker" value="<?php echo date('d-m-Y'); ?>">

                </div>
              </div>


              <div class="form-group">
                  <label id="c_add" class="col-sm-2 control-label">Creation Date</label>
                  <div class="col-sm-8">
                  <input type="text" class="form-control pull-right" value="<?php echo date('d-m-Y'); ?>" readonly>

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
  <?php include_once"settings.php";?>
  <?php include_once"footer.php"; ?>

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
        var myDropDownList = $("#p_m");
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
                // for(var i=0; i<data.length; i++) { // Loop through the data & construct the options
                //     options += '<option value="'+data[i]+'">'+data[i]+'</option>';
                // }

                  $.each(data, function(index, item){
                    // Append option based on type
                    if(val === 'supplier') {
                        myDropDownList.append('<option value="' + item[0] + '">' + item[1] + '</option>');
                    } else {
                        myDropDownList.append('<option value="' + item[0] + '">' + item[1] + '</option>');
                    }
                });



                // Append to the html
                $('#p_m').append(options);


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
            url: 'ajax/addpaytest.php',

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
