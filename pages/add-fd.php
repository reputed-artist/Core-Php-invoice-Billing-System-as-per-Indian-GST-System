<?php
session_start();
include'dbconnection.php';
include("checklogin.php");
//include("titlecase.php");

check_login();

include 'inc/getState.php';

$current_page="accounts";
$current_page1="Fixed Assets";



?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AdminLTE 2 | General Form Elements</title>


<link href="../bower_components/intl-tel-input/build/css/intlTelInput.min.css" rel="stylesheet"/>
<?php include_once"links.php";?> 

<!-- <script src = "https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js">   </script> -->

<script src="../bower_components/intl-tel-input/build/js/intlTelInput.min.js"></script>

<script src="../bower_components/jquery-validation/jquery.validate.min.js"></script>

<!-- <script src="examples/dist/js/adminlte.min.js"></script>

<script src="examples/dist/js/demo.js"></script> -->

    <!-- 
<link rel="stylesheet" type="text/css" href="tp.css"> -->

</head>
<style>
    /* Style for datepicker dropdown */
    .ui-datepicker {
        width: 17em; /* Adjust width as needed */
        padding: .2em .2em 0;
        display: none;
        z-index: 9999;
        font-size: 15px;
    }
    /* Style for datepicker dropdown items */
    .ui-datepicker td {
        padding: .4em;
        border: 0;
        font-size: 15px;
    }
    /* Style for datepicker dropdown header */
    .ui-datepicker .ui-datepicker-header {
        padding: .2em .2em .3em;
        background: #eee;
        border-bottom: 1px solid #ddd;
        font-weight: bold;
        text-align: center;
        font-size: 15px;
    }
    /* Style for datepicker dropdown button */
    .ui-datepicker .ui-datepicker-prev, .ui-datepicker .ui-datepicker-next {
        display: inline-block;
        width: 1.8em;
        height: 1.8em;
        margin-top: 0;
        padding: 0;
        cursor: pointer;
        background: #eee;
        border: 1px solid #ddd;
        text-align: center;
        font-size: 15px;
    }
    /* Style for datepicker dropdown button icons */
    .ui-datepicker .ui-datepicker-prev span, .ui-datepicker .ui-datepicker-next span {
        display: block;
        margin-top: 0.6em;
    }
    /* Style for datepicker dropdown button icons (arrows) */
    .ui-datepicker .ui-datepicker-prev span {
        margin-left: 0.1em;
    }
    /* Style for datepicker dropdown button icons (arrows) */
    .ui-datepicker .ui-datepicker-next span {
        margin-left: 0.2em;
    }


.dropdown-menu{
  /*margin-top:320px;
  padding: 10px;*/
font-size:15px;
}
.form-horizontal .has-feedback .form-control-feedback {
    right: 67px;
}
body {
  font-family: 'Source Sans Pro','Helvetica Neue',Helvetica,Arial,sans-serif;
    font-size: 14px;
    font-weight: 400;
    line-height: 1.42857143;
}
/*.btn{
  display: inline-block;
    padding: 6px 12px;
    margin-bottom: 0;
    font-size: 14px;
    font-weight: 400;
    line-height: 1.42857143;
    text-align: center;
    white-space: nowrap;
    vertical-align: middle;
}
*/

.form-control{
    display: block;
    width: 100%;
    height: 34px;
    padding: 6px 12px;
    font-size: 14px;
    line-height: 1.42857143;
    color: #555;
    background-color: #fff;
    background-image: none;
    border: 1px solid #ccc;
    border-radius: 0px;
    /*-webkit-box-shadow: inset 0 1px 1px rgba(0,0,0,.075);
    box-shadow: inset 0 1px 1px rgba(0,0,0,.075);
    -webkit-transition: border-color ease-in-out .15s,-webkit-box-shadow ease-in-out .15s;
    -o-transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s;
    transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s;*/
}
#phone {
    font-family: inherit;
    font-size: inherit;
    line-height: inherit;
    width: 100%;
    border: 1px solid #ccc;
        height: 34px;
}
/*.form-horizontal .has-feedback .form-control-feedback {
    right: 57px;
}*/
  .iti {
  width: 100%;
  min-width: 100%;
    max-width: 100%;
}

.iti-flag {
  background-image: url("https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/10.0.2/img/flags.png");
}

body .intl-tel-input .flag-container {
  position: static;
  min-width: 100%;
    max-width: 100%;

}

body .intl-tel-input .selected-flag {
  position: absolute;
  top: 50%;
  transform: translateY(-50%);
  height: 100%;
  min-width: 100%;
    max-width: 100%;
}

body .iti .country-list {
  width: 100%;
  top: 100%;
}
.iti__country-list {
  width:1250%;
}
.has-error .select2-selection {
    border-color: rgb(185, 74, 72) !important;
    min-width: 100%;
    max-width: 100%;
}

input .error{
 border: 1px solid #f00;
}
  
.error{
 border: 1px solid #f00;
}

</style>
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
      Manage Fixed Deposit
        <small></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Add Fixed Deposit</li>
      </ol>
    </section>

      <?php $ret=mysqli_query($con,"select (id)+1 from fd ORDER BY id DESC LIMIT 1")or die("Error: " . mysqli_error($con));
      
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
              <h3 class="box-title">Add Fixed Deposit</h3>
            </div>
          </br>
           <p align="center" style="color:#F00;"><?php 
                     if(isset($_SESSION['msg']))
                     {
                     echo $_SESSION['msg']; }?><?php echo $_SESSION['msg']=""; ?></p>
        

        <form class="form-horizontal style-form" name="form" id="form" method="post" action="">
                           <p style="color:#F00"><?php echo $_SESSION['msg'];?><?php echo $_SESSION['msg']="";?></p>
                         </br>
            <!-- /box-header -->
            <!-- form start -->
            
 <div class="box-body">
                
                <div class="form-group">
                  <label id="fidlbl" class="col-sm-2 control-label">FD ID</label>
                  <div class="col-sm-8">
                    <input type="text" class="form-control" name="fid" id="fid" value="<?php echo $row[0]; ?>" readonly>
                  </div>
                </div>



                <div class="form-group">
                  <label id="fdnamelbl" class="col-sm-2 control-label">FD Holder Name</label>
                  <div class="col-sm-8">
                  
                   <select name="fdholdername" class="form-control select2" style=" height: 34px;width:100%" id="fdholdername">
                    <option value=""></option>
                    <option value="Tejas">Tejas </option>
                    <option value="Harsh">Harsh </option>
                    <option value="Mom">Mom </option>
                    <option value="Dad">Dad </option>
                    <option value="Codetech">Codetech </option>
                    </select>
                    <!-- <input type="text" class="form-control" name="c_name" 
                    value="<?php if(isset($_POST['c_name'])){ echo $_POST['c_name'];} ?>" id="c_name" 
                     placeholder="Company Name"> -->
                    <div id="fdholdername_error" style="color:red;"> </div>

                  </div>
                </div>



              <div class="form-group">
                   <label id="fddatelbl" class="col-sm-2 control-label">FD issued Date</label>
                  <div class="col-sm-8">

                <div class="input-group date">
                  <div class="input-group-addon" style="padding: 9px 14px 8px 10px;">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="text" name="datepicker" class="form-control pull-right" id="datepicker" value="<?php echo date('d-m-Y'); ?>">
                                        <div id="issueddate_error"> </div>
                </div>
              </div>
              </div>


      <div class="form-group">
                  <label id="cnamelbl" class="col-sm-2 control-label">FD's Bank Name</label>
                  <div class="col-sm-8">
                  
                   <select name="fdholderbank" class="form-control select21" style=" height: 34px;width:100%" id="fdholderbank">

                    <option value=""></option>
                    <option value="Yes Bank">Yes Bank </option>
                    <option value="Central Bank of India">Central Bank of India </option>
                    <option value="Saraswat Bank">Saraswat Bank </option>
                    <option value="Bank of India">Bank of India</option>
                    <option value="State Bank of India">State Bank of India</option>
                    </select>
                    <!-- <input type="text" class="form-control" name="c_name" 
                    value="<?php if(isset($_POST['c_name'])){ echo $_POST['c_name'];} ?>" id="c_name" 
                     placeholder="Company Name"> -->
                    <div id="fdholderbank_error" style="color:red;"> </div>

                  </div>
                </div>



                <div class="form-group">

               <label id="pamt_lbl" class="col-sm-2 control-label">Principle Amount</label>
                  <div class="col-sm-8">

                <div class="input-group date">
                  <div class="input-group-addon currency" style="padding: 9px 10px 8px 10px">
                    <i class="fa fa-fw fa-inr"></i>
                  </div>
                  <input type="text" class="form-control pull-right" id="principleamt" name="principleamt" >
                                        
                </div>
                <div id="principleamt_error" style="color:red;"> </div>
              </div>
              
            </div> 


             <div class="form-group">
               <label id="nodayslbl" class="col-sm-2 control-label">Tenure (Years)</label>
                  <div class="col-sm-8">

                <div class="input-group date">
                  <div class="input-group-addon" style="padding: 9px 10px 8px 10px"><i class="fa fa-fw fa-bank"></i></div>
                  <input type="text" class="form-control pull-right" id="nodays" name="nodays" value="">
                  
                                        
                </div>
                <div id="nodays_error" style="color:red;"> </div>
              </div>
              
            </div> 


             <div class="form-group">
               <label id="intratelbl" class="col-sm-2 control-label">Interest Rate</label>
                  <div class="col-sm-8">

                <div class="input-group date">
                  
                  <input type="text" class="form-control pull-right" id="intrate" name="intrate"  value="">
                  <div class="input-group-addon" style="padding: 9px 14px 8px 10px"><b>%</b></div>
                                        
                </div>
                <div id="intrate_error" style="color:red;"> </div>
              </div>
            </div> 


             <div class="form-group">

               <label id="intamtlbl" class="col-sm-2 control-label">Interest Amount</label>
                  <div class="col-sm-8">

                <div class="input-group date">
                  <div class="input-group-addon currency" style="padding: 9px 10px 8px 10px">
                    <i class="fa fa-fw fa-inr"></i>
                  </div>
                  <input type="number" class="form-control pull-right" id="intamt" name="intamt"  value="0">
                                        
                </div>
                <div id="intamt_error" style="color: red;"> </div>
              </div>
            </div> 


             <div class="form-group">

               <label id="matamtlbl" class="col-sm-2 control-label">Maturity Amount</label>
                  <div class="col-sm-8">

                <div class="input-group date">
                  <div class="input-group-addon currency" style="padding: 9px 10px 8px 10px">
                    <i class="fa fa-fw fa-inr"></i>
                  </div>
                  <input type="number" class="form-control pull-right" id="finalamt" name="finalamt" value="0">
                                        
                </div>
                <div id="finalamt_error"> </div>
              </div>
            </div> 



              <div class="form-group">
                   <label id="matdatelbl"  class="col-sm-2 control-label">Maturity Date</label>
                  <div class="col-sm-8">

                <div class="input-group date">
                  <div class="input-group-addon" style="padding: 9px 14px 8px 10px">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="text" name="datepicker2" class="form-control pull-right" id="datepicker2" value="<?php echo date('d-m-Y'); ?>">
                                        
                </div>
                <div id="matdate_error" style="color: red"> </div>
              </div>
              </div>

             
              <div class="form-group">
                  <label id="c_datelbl" class="col-sm-2 control-label">Creation Date</label>
                  <div class="col-sm-8">
                  <input type="text" class="form-control" name="created" value="<?php  $c=date("d-M-Y");
                                        echo $c; ?>" readonly/>

                </div>
              </div>




              <!-- /.box-body -->
              <div class="box-footer ">
                <label class="col-sm-2"></label>
                <input type="submit" name="submit" id="submitbtn" class="btn btn-info col-sm-8">
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
       placeholder: "Select a FD Holder",
    allowClear: true
    });


$('.select21').select2({
       placeholder: "Select a Bank Name",
    allowClear: true
    });
  });

  
</script>

 
 <script>
 
 $(document).ready(function() {




$("#datepicker").datepicker({
                format: "dd-mm-yyyy",
                language: "fr",
                changeMonth: true,
                changeYear: true,
                autoclose: true
    });

$("#datepicker2").datepicker({
                format: "dd-mm-yyyy",
                language: "fr",
                changeMonth: true,
                changeYear: true,
                autoclose: true
    });


 $(document).on('change', '#fdholderbank', function() {
        calculateTotal();
    });


    // Function to calculate total when principle amount changes
    $(document).on('blur', '#pamt_name', function() {
        calculateTotal();
    });

    // Function to calculate total when number of days changes
    $(document).on('blur', '#nodays', function() {
        calculateTotal();
    });

    // Function to calculate total when interest rate changes
    $(document).on('blur', '#intrate', function() {
        calculateTotal();
    });
});

  
    

    $("form").submit(function(event) {
        event.preventDefault();
        console.log("submit event");

        
        var formData = $(this).serialize();
        $.ajax({
            type: 'POST',
            url: 'ajax/addfdtest.php',

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
                    text: "New Client Data Inserted!",
                    icon: "success",
                    showConfirmButton: false, // Hide the OK button
                    timer: 3000, // Close the popup after 3 seconds (3000 milliseconds)
                  }).then(function() {
                    // This function will be called after the popup closes
                    //location.reload(); // Refresh the page
                  window.location.href = 'fd.php';
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
    
  });
function calculateTotal() {
    var bank = $('#fdholderbank').val();
    var principleamt = parseFloat($('#principleamt').val());
    var nodays = parseFloat($('#nodays').val());
    var intrate = parseFloat($('#intrate').val());
    var issuedDate = $('#datepicker').val(); 
    console.log('Issued Date:', issuedDate);  // Log the issued date

    if (isNaN(principleamt) || isNaN(nodays) || isNaN(intrate)) {
        console.log('Invalid principleamt:' + isNaN(principleamt));
        console.log('Invalid nodays:' + isNaN(nodays));
        console.log('Invalid intrate:' + isNaN(intrate));
        return;
    }

    var intrate2 = (intrate / 100);
    var n = 4;
    var logic = (intrate2 / n);
    var flogic = 1 + logic;
    var sqlogic = n * nodays;
    var clogic = Math.pow(flogic, sqlogic);
    var dlogic = clogic * principleamt;

    if (bank == 'Yes Bank') {
        var data = (principleamt * intrate * nodays) / 100;
        $('#intamt').val(data);
        $('#finalamt').val(data + principleamt);

    } else if (bank == 'Central Bank of India' || bank == 'Bank of India' || bank == 'State Bank of India') {

        console.log("enters Central bank");
        var sub = dlogic - principleamt;
        $('#intamt').val(sub.toFixed(0));
        $('#finalamt').val(dlogic.toFixed(0));

    } else {

        var intrate2 = (intrate / 100);
        var n = 1;
        var logic = (intrate2 / n);
        var flogic = 1 + logic;
        var sqlogic = n * nodays;
        var clogic = Math.pow(flogic, sqlogic);
        var dlogic = clogic * principleamt;

        var sub = dlogic - principleamt;

        $('#intamt').val(sub.toFixed(0));
        $('#finalamt').val(dlogic.toFixed(0));
    }

    // Calculate and display renewal date
    var dateParts = issuedDate.split('-');
    var day = parseInt(dateParts[0], 10);
    var month = parseInt(dateParts[1], 10) - 1; // Month is 0-indexed in JavaScript
    var year = parseInt(dateParts[2], 10);
    var issuedDateObj = new Date(year, month, day);
    console.log('Parsed Date Object:', issuedDateObj);

    if (isNaN(issuedDateObj.getTime())) {
        console.log('Invalid issued date');
        return;
    }

    // Convert nodays to days (1 year = 365.25 days for more accuracy)
    var daysToAdd = nodays * 365.25;
    issuedDateObj.setDate(issuedDateObj.getDate() + daysToAdd);

    var renewalDay = ("0" + issuedDateObj.getDate()).slice(-2);
    var renewalMonth = ("0" + (issuedDateObj.getMonth() + 1)).slice(-2); // Months are zero indexed
    var renewalYear = issuedDateObj.getFullYear();

    var renewalDateString = renewalDay + '-' + renewalMonth + '-' + renewalYear;
    console.log(renewalDateString);
    $('#datepicker2').datepicker('setDate', renewalDateString);
}


// function calculateTotal() {
//     var bank = $('#fdholderbank').val();
//     var principleamt = parseFloat($('#principleamt').val());
//     var nodays = parseFloat($('#nodays').val());
//     var intrate = parseFloat($('#intrate').val());
//     var issuedDate = $('#datepicker').val(); 
//     var maturityDate=$('#datepicker2').val();

//     if (isNaN(principleamt) || isNaN(nodays) || isNaN(intrate)) {
//         console.log('Invalid principleamt:'+isNaN(principleamt));
//         console.log('Invalid nodays:'+isNaN(nodays));
//         console.log('Invalid intrate:'+isNaN(intrate));
//         return;
//     }


//     var intrate2 = (intrate / 100);
//     var n = 4;
//     var logic = (intrate2 / n);
//     var flogic = 1 + logic;
//     var sqlogic = n * nodays;
//     var clogic = Math.pow(flogic, sqlogic);
//     var dlogic = clogic * principleamt;

//     if (bank == 'Yes Bank') {
//         var data = (principleamt * intrate * nodays) / 100;
//         $('#intamt').val(data);
//         $('#finalamt').val(data + principleamt);

//     } else if (bank == 'Central Bank of India' || bank == 'Bank of India' || bank == 'State Bank of India') {


//         console.log("enters Central bank");
//         var sub=dlogic - principleamt
//         $('#intamt').val(sub.toFixed(0));
//         $('#finalamt').val(dlogic.toFixed(0));

//     } else {
    
//     var intrate2 = (intrate / 100);
//     var n = 1;
//     var logic = (intrate2 / n);
//     var flogic = 1 + logic;
//     var sqlogic = n * nodays;
//     var clogic = Math.pow(flogic, sqlogic);
//     var dlogic = clogic * principleamt;
      

//         var sub=dlogic - principleamt;


//          $('#intamt').val(sub.toFixed(0));
//         $('#finalamt').val(dlogic.toFixed(0));

//       }


//     // Calculate and display renewal date
//     var issuedDateObj = new Date(issuedDate);
//     if (isNaN(issuedDateObj)) {
//         console.log('Invalid issued date');
//         return;
//     }

//     // Convert nodays to days (1 year = 365.25 days for more accuracy)
//     var daysToAdd = nodays * 365.25;
//     var renewalDateObj = new Date(issuedDateObj.getTime() + (daysToAdd * 24 * 60 * 60 * 1000));
//     var renewalDateString = renewalDateObj.toISOString().split('T')[0];
//     console.log(renewalDateString);
//     $('#datepicker2').val(renewalDateString);


  

// }


 </script>
</body>
</html>
