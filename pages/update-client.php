<?php
session_start();
include'dbconnection.php';
include("checklogin.php");
//include_once("titlecase.php");


include 'inc/getState.php';

check_login();
$current_page ="manage-clients";

?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AdminLTE 2 | General Form Elements</title>
  
<link href="../bower_components/intl-tel-input/build/css/intlTelInput.min.css" rel="stylesheet"/>
  <?php include_once "links.php"; ?>
  <script src="../bower_components/intl-tel-input/build/js/intlTelInput.min.js"></script>

<script src="../bower_components/jquery-validation/jquery.validate.min.js"></script>

<link rel="stylesheet" type="text/css" href="tp.css">


<style type="text/css">
.form-horizontal .has-feedback .form-control-feedback {
    right: 67px;
}
body {
  font-family: 'Source Sans Pro','Helvetica Neue',Helvetica,Arial,sans-serif;
    font-size: 14px;
    font-weight: 400;
    line-height: 1.42857143;
}
.btn{
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
        <li class="active">Update Client Details</li>
      </ol>
    </section>

      <?php $ret=mysqli_query($con,"select * from Client where cid=".$_GET['clid']."") or die("Error: " . mysqli_error($con));
    while($row=mysqli_fetch_array($ret))
    
    {?>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <!-- left column -->
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Update Client Details</h3>
              <hr>
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
                  <label id="cidlbl" class="col-sm-2 control-label">Client ID</label>
                  <div class="col-sm-8">
                    <input type="text" class="form-control" name="cid" id="cid" value="<?php echo $row['cid']; ?>" readonly>
                  </div>
                </div>

                <div class="form-group">
                  <label id="c_namelbl" class="col-sm-2 control-label">Company Name</label>
                  <div class="col-sm-8">
                    <input type="text" class="form-control" name="c_name"  id="c_name" value="<?php echo $row['c_name'];?>">
                    <div id="c_name_error" style="color: red;"> </div>
                  </div>
                </div>

                <div class="form-group">
                  <label id="c_addlbl" class="col-sm-2 control-label">Address</label>
                  <div class="col-sm-8">
                    <textarea class="form-control" name="c_add" id="c_add"><?php echo $row['c_add']; ?></textarea>
                                  <div id="c_add_error" style="color:red;"> </div>
                </div>
              </div>

                <div class="form-group has-danger">
              <label id="mob" class="col-sm-2 control-label">Mobile</label>
                  <div class="col-sm-8">
  <input id="phone" class="phone" type="tel" name="phone" value="<?php echo $row['mob'];?>" style="{min-width: 100%;
    max-width: 100%;}" />

    <input id="fullno" class="phone" type="hidden" name="fullno" style="{min-width: 100%;
    max-width: 100%;}" value="" />
  <br>

  <span id="error-msg" class="hide"></span>
<div id="mob_error" style="color: red;"> </div>

<p id="result" name="result"></p> 
  </div>       
</div>


<div class="form-group">
            <label for="" class="col-sm-2 control-label">Select Country</label>
      <div class="col-sm-8 col">
        

        <select  id="address_country" name="address_country" class="form-control">
        <?php if(isset($country) && isset($sp)){
          ?> <option value="<?php echo $sp; ?>"> <?php echo $country; ?> </option>
       <?php } ?>
          </select>
        
<input id="fulldetails" class="phone" type="hidden" name="fulldetails" style="{min-width: 100%;
    max-width: 100%;}" />
        </div>
      </div>

              <div class="form-group">
                  <label id="gstlbl" class="col-sm-2 control-label">GST</label>
                  <div class="col-sm-8">
                   <input type="text" style="text-transform: uppercase;" class="form-control" id="gst" name="gst" value="<?php echo $row['gst'];?>">
                                  <div id="gst_error" style="color: red;"> </div>
                </div>
              </div>
            

                <div class="form-group">
                  <label id="typelbl" class="col-sm-2 control-label">Client Type</label>
                  <div class="col-sm-8">
                   <select name="ctype" id="ctype" class="form-control select2" style="width: 100%; height: 34px; border-radius: 0px !important;">

              <option value=""></option>
                  <?php 

                    $type=mysqli_query($con,"select * from clienttype");
                    while($rop=mysqli_fetch_array($type))
                    {
                      if($rop['type'] == $row['c_type'])
                      {
                  ?>    
                         <option value="<?php echo $rop['type']; ?>" selected="selected"> <?php echo $rop['type']; ?> </option>                      
                    <?php 
                      } 
                      else {
  
                        ?> 

                     <option value="<?php echo $rop['type']; ?>"> <?php echo $rop['type']; ?> </option>
                     <?php } } ?>
                   
                      
                   </select>
                       <?php } ?>
                                  <div id="ctype_error" style="color: red;"> </div>
                </div>
              </div>



              <div class="form-group">
                  <label id="c_add" class="col-sm-2 control-label">Creation Date</label>
                  <div class="col-sm-8">
                  <input type="text" class="form-control" name="created" value="<?php  $c=date("d-M-Y");
                                        echo $c; ?>" readonly/>

                </div>
              </div>




              <!-- /.box-body -->
              <div class="box-footer ">
                <label class="col-sm-2"></label>
                <input type="submit" name="submit"  id="submitbtn" class="btn btn-info col-sm-8">
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


<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2({
       placeholder: "Select a Client Type",
    allowClear: true
    });

  });

  
</script>
<script>
 


  
    var input = document.querySelector("#phone"),
        errorMap = ["Invalid number", "Invalid country code", "Too short", "Too long", "Invalid number"],
        result = document.querySelector("#result");


    var iti;      
        window.addEventListener("load", function ($form, event) {
        var countryData = window.intlTelInputGlobals.getCountryData(),
            addressDropdown = document.querySelector("#address_country"),
            errorMsg = document.querySelector("#error-msg");



         iti= window.intlTelInput(input, {
            hiddenInput: "full_number",
            nationalMode: false,
            formatOnDisplay: true,
            separateDialCode: true,
            autoHideDialCode: true,
            autoPlaceholder: "aggressive",
            initialCountry: "in",
            placeholderNumberType: "MOBILE",
            preferredCountries: ['in', 'np'],
            utilsScript: "../bower_components/intl-tel-input/build/js/utils.js",
        });

        input.addEventListener('keyup', formatIntlTelInput);
        input.addEventListener('change', formatIntlTelInput);

        for (var i = 0; i < countryData.length; i++) {
            var country = countryData[i];
            var optionNode = document.createElement("option");
            optionNode.setAttribute("data-city", country.name.replace(/(\(.+\))/g, ''));
            optionNode.value = country.iso2.replace(/(\(.+\))/g, '');
            var textNode = document.createTextNode(country.name.replace(/(\(.+\))/g, ''));
            optionNode.appendChild(textNode);
            addressDropdown.appendChild(optionNode);
        }

        addressDropdown.value = iti.getSelectedCountryData().iso2.replace(/(\(.+\))/g, '');
        $('#fulldetails').val(iti.getSelectedCountryData().name.replace(/(\(.+\))/g, ''));

        input.addEventListener('countrychange', function(e) {
            addressDropdown.value = iti.getSelectedCountryData().iso2.replace(/(\(.+\))/g, '');
            $('#fulldetails').val(iti.getSelectedCountryData().name.replace(/(\(.+\))/g, ''));
        });

        addressDropdown.addEventListener('change', function() {
            iti.setCountry(this.value);
        });

        function formatIntlTelInput() {
            if (typeof intlTelInputUtils !== 'undefined') {
                var currentText = iti.getNumber(intlTelInputUtils.numberFormat.E164);
                if (typeof currentText === 'string') {
                    iti.setNumber(currentText);
                }
            }
        }

        input.addEventListener('keyup', function() {
            reset();
            if (input.value.trim()) {
                if (iti.isValidNumber()) {
                    $(input).addClass('form-control is-valid');
                    $("#submitbtn").attr('disabled', false);
                } else {
                    $(input).addClass('form-control is-invalid');
                    var errorCode = iti.getValidationError();
                    errorMsg.innerHTML = errorMap[errorCode];
                    $(errorMsg).show();
                    $("#submitbtn").attr('disabled', true);
                }
            }
        });

        input.addEventListener('change', reset);
        input.addEventListener('keyup', reset);

        var reset = function() {
            $(input).removeClass('form-control is-invalid');
            errorMsg.innerHTML = "";
            $(errorMsg).hide();
        };

        input.addEventListener('keyup', function(e) {
            e.preventDefault();
            var num = iti.getNumber(),
                valid = iti.isValidNumber();
            result.textContent = "Number: " + num + ", valid: " + valid;
        }, false);

        input.addEventListener("focus", function() {
            result.textContent = "";
        }, false);

        $(input).on("focusout", function(e, countryData) {
            var intlNumber = iti.getNumber();
            $("#fullno").val(intlNumber);
            console.log(intlNumber);
        });
    });

    $("form").submit(function(event) {
        event.preventDefault();
        console.log("submit event");

          var clid = '<?php echo $_GET["clid"]; ?>';


        var formData = $(this).serialize();
         
         formData += '&clid=' + encodeURIComponent(clid);

        $.ajax({
            type: 'POST',
            url: 'ajax/updateclienttest.php',

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
                    title: "Updated!",
                    text: "Client Data Updated!",
                    icon: "success",
                    showConfirmButton: false, // Hide the OK button
                    timer: 3000, // Close the popup after 3 seconds (3000 milliseconds)
                  }).then(function() {
                    // This function will be called after the popup closes
                    //location.reload(); // Refresh the page
                  window.location.href = 'manage-clients.php';
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
