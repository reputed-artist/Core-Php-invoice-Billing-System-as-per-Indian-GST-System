<?php
session_start();
include'dbconnection.php';
include("checklogin.php");
//include("titlecase.php");


include 'inc/getState.php';

check_login();
//$current_page ="account";

$current_page="accounts";
$current_page1="accounts1";



?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AdminLTE 2 | General Form Elements</title>

<?php include_once"links.php";?>

</head>
<body class="hold-transition skin-blue sidebar-mini <?php echo getState('fixed-layout') ? 'fixed ' : ''; ?>
    <?php echo getState('boxed-layout') ? 'layout-boxed ' : ''; ?>
    <?php echo getState('sidebar-collapse') ? 'sidebar-collapse ' : ''; ?>
    <?php echo getState('expand-on-hover') ? 'expandOnHover ' : ''; ?>
    <?php echo getState('control-sidebar-open') ? 'control-sidebar-open ' : ''; ?>
    <?php echo getState('sidebar-skin-toggle') ? 'sidebar-light ' : ''; ?>">
<div id="loader"></div>
<div class="wrapper" style="height: 800px !important; min-height: 500px !important;">

<?php include_once"header.php"; ?>
 
  <?php include_once"navbar.php"; ?>


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
        <li class="active">Add Clients</li>
      </ol>
    </section>

      <?php $ret=mysqli_query($con,"select * from account where aid=".$_GET['aid']."")or die("Error: " . mysqli_error($con));
      
     // echo "select * from account where aid=".$_GET['aid']."";


           // $row=mysqli_fetch_array($ret);
      while( $row=mysqli_fetch_array($ret))
    
    {
        $aid= $row['aid'];
        $cdata= $row['cid'];
        $type=$row['acc_type'];
        $opbal= $row['opening_bal'];
        $created=$row['created'];

    }


    if($type==1)
    {
      $fg=mysqli_query($con,"select pcname from purchasecom where pcid='$cdata'");

    }
    else{
          $fg=mysqli_query($con,"select c_name from client where cid='$cdata'");      
    }

    $fg2=mysqli_fetch_array($fg);
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
                           <form class="form-horizontal style-form" name="form" method="POST" >
                           <p style="color:#F00"><?php echo $_SESSION['msg'];?><?php echo $_SESSION['msg']="";?></p>
                         </br>
            <!-- /box-header -->
            <!-- form start -->
            
              <div class="box-body">
                
                <div class="form-group">
                  <label id="cidlbl" class="col-sm-2 control-label">Account ID</label>
                  <div class="col-sm-8">
                    <input type="text" class="form-control" name="aid" id="aid" value="<?php echo $aid; ?>" readonly>
                  </div>
                </div>

                 <div class="form-group">
                  <label id="cidlbl" class="col-sm-2 control-label">Account Type</label>
                  <div class="col-sm-8">
                  <?php if($type == 1)
                  { ?>
                  <div class="col-sm-2">
                    <input type="radio" class="minimal"  name="actype" id="actype" value="supplier"  checked> Supplier
                 </div>
                 <?php } else{ ?>   
                  <div class="col-sm-2">
                    <input type="radio" class="minimal"  name="actype" id="actype" value="supplier"> Supplier
                 </div>
                 <?php }?>

                 <?php if($type==2) {?>
                 <div class="col-sm-2">
                 <input type="radio" class="minimal" name="actype" id="actype" value="customer"  checked> Customer

                  </div>
                  <?php } else{?>
                  <div class="col-sm-2">
                 <input type="radio" class="minimal" name="actype" id="actype" value="customer"  > Customer

                  </div>
                  <?Php }?>
                </div>
                <div id="actype_error" style="color: red;"> </div>
</div>


                <div class="form-group">
                  <label id="cnamelbl" class="col-sm-2 control-label">Company Name</label>
                  <div class="col-sm-8">
                    <select name="clog" id="clog" class="form-control select2">
                    <option value="<?php echo $fg2[0] ?>"><?php echo $fg2[0] ?></option>
                   </select>
                                <div id="clog_error" style="color: red;"> </div>
                  </div>
                </div>
             

              <div class="form-group">
                  <label id="cmoblbl" class="col-sm-2 control-label">Opening Balance</label>
                  <div class="col-sm-8">
                   <input type="number" class="form-control" name="opbal" id="opbal" value="<?php echo $opbal; ?>" placeholder="Opening Balance"> <div id="opbal_error" style="color:red;"></div>
                               </div>
                               
                </div>

              </div>

            
                 <div class="form-group">
                  <label id="c_datelbl" class="col-sm-2 control-label">Creation Date</label>
                  <div class="col-sm-8">
                  <input type="text" class="form-control" name="created" value="<?php $datez= date("d-M-Y",strtotime($created)); 
                  echo $datez;
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

  <?php include_once"footer.php"; ?>

  <?php include_once"settings.php"; ?>
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>

<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2({
       placeholder: "Select a Client",
    allowClear: true
    });

  });

  
</script>
<script> 
    $(document).on('click','input[name="actype"]:radio',function() {
       var val="";
        var val = $(this).val(); 
        var myDropDownList = $("#clog");
       myDropDownList.prop('disabled', false);
       //$("#clog").attr('disabled','disabled');
        console.log(val); 
        $.ajax({ 
            type:"GET", 
            url:"getactype.php", 
            data:'para='+val, 
            dataType: 'json',
            success:function(r) { 
                    // myDropDownList.prop('disabled', false);
                console.log(r); 
                var data = r;
                var options = '';
                 myDropDownList.empty();
               
                // for(var i=0; i<data.length; i++) { // Loop through the data & construct the options
                //     options += '<option value="'+data[i]+'">'+data[i+1]+'</option>';
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
               // $('#clog').append(options);

                // $("form").submit();



            } 
        }); 
    })
</script>
<script>

  $("form").submit(function(event) {
        event.preventDefault();
        console.log("submit event");

        
        var formData = $(this).serialize();
        console.log(formData);
        $.ajax({
            type: 'GET',
            url: 'ajax/updateacctest.php',

            data: formData,
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                  console.log('calls second ajax');
        //           $('.error').html('');
        // // Remove error classes
        //            $('.error').removeClass('error');


                    $('.error').css('border','0px');
                    $('#message').html(response.message);
                    Swal.fire({
                    title: "Good!",
                    text: "Account Data Updated!",
                    icon: "success",
                    showConfirmButton: false, // Hide the OK button
                    timer: 3000, // Close the popup after 3 seconds (3000 milliseconds)
                  }).then(function() {
                    // This function will be called after the popup closes
                    //location.reload(); // Refresh the page
                  window.location.href = 'accounts.php';
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
