<?php
session_start();
include'dbconnection.php';
include("checklogin.php");
check_login();
include("backupdata.php");
//include("backupdata.php");

include 'inc/getState.php';
$current_page="quick quotation";
//$current_page1="gen-pro";


$connect = new PDO("mysql:host=localhost;dbname=loginsystem", "root", "");

function fill_unit_select_box($connect)
{ 
 $output = '';
 $query = "SELECT * FROM products";
 $statement = $connect->prepare($query);
 $statement->execute();
 $result = $statement->fetchAll();
 foreach($result as $row)
 {

  $output .= '<option value="'.$row["name"].'">'.$row["name"].'</option>';
 }
 return $output;
}


?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AdminLTE 2 | General Form Elements</title>
  <link href="../bower_components/intl-tel-input/build/css/intlTelInput.min.css" rel="stylesheet"/>

  <?php include_once"links.php"; ?>
  <script src="../bower_components/intl-tel-input/build/js/intlTelInput.min.js"></script>

 <link rel="stylesheet" type="text/css" href="tp.css">
 <style>

    [class^='select2'] {
  border-radius: 0px !important;
  line-height: 25px !important;
    
}

.dropdown-menu{
  margin-top:300px;

}
.form-horizontal .has-feedback .form-control-feedback {
    right: 67px;
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
.input-group-addon {
  padding:11px 24px 6px 11px;
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
#phone,select, textarea {
    font-family: inherit;
    font-size: inherit;
    line-height: inherit;
    width: 100%;
    border: 1px solid #ccc;
        height: 30px;
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
    font-size: 15px !important;
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
.swal2-popup {
    width: 500px; /* Adjust the width as needed */
}

label {
    font-size: medium;
}
.swal2-confirm,
.swal2-cancel {

    padding: 10px 24px; /* Adjust padding to increase button size */
    /*font-size: 30px;*/ /* Adjust font size if needed */

}
.swal2-confirm{
    background-color:#14A44D !important;
    /*font-size: medium;*/
    font-size: 15px !important;
}
.swal2-cancel{
    background-color: #DC4C64 !important;
    font-size: 15px !important;
}
.swal2-validation-message {
  font-size: 20px;
  color:red;

}

.phone{
  font-size: 15px !important;
}

.iti__selected-flag{
  font-size: 15px !important;
}

.swal2-title{
  font-size: 20px !important;
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
  <!-- Left side column. contains the logo and sidebar -->
    
<?php include_once"navbar.php"; ?>


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
      Quick Quotation
        <small></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Quick Quotation</li>
      </ol>
    </section>

     <?php 
  
       if (date('m') > 3) {
    $year = date('y')."-".(date('y') +1);
}
else {
    $year = (date('y')-1)."-".date('y');
}
//echo $year;

$date=date('Y-m-d');

//$cd=mysqli_query($con,"select products.p_id, products.name, techsps.img_loc from products inner join techsps WHERE products.p_id = techsps.p_id");
$cd=mysqli_query($con,"SELECT products.p_id, products.name, techsps.img_loc FROM products INNER JOIN techsps ON products.p_id = techsps.p_id GROUP BY techsps.img_loc order by products.p_id");

    ?>
    <!-- Main content -->
    <section class="content">
      <div class="row">
  
  <?php
while($row=mysqli_fetch_array($cd))

 {

  ?>

        <div class="col-md-3">
          <!-- general form elements -->
          <div class="box box-info">         
           
          <!--   <div class="box-header with-border">
              <h3 class="box-title">Product</h3>
            </div>
          </br> -->
                <form class="form-horizontal style-form" name="form" id="form" method="post" action=""> </br>
                           
                  

                         <div class="form-group center" id="product_selection">
                             <!--  <a   href="quickquotation.php?quick=<?php echo $row['p_id']; ?> " >        -->
                            <a  class="product-link" data-product-id="<?php echo $row['p_id']; ?>">
                            <?php  echo "<img src='../dist/img/".$row['img_loc']."'height='250px' width='300px' class='col-md-12'>"."</br> " ;    ?></a><p style="font-size: 15px; text-align:center"><b><?php echo $row["name"]; ?> </b></p>


                            </div>

                      


                  </form>

                </div>
            </div>      
  <?php } ?>   

       
 <!-- <?php 
 $q_id="";
   $cs=mysqli_query ($con,"SELECT CONCAT_WS( '/', '24-25' , COALESCE(LPAD( CASE WHEN '2024-04-19' >= DATE_FORMAT('2024-04-19','%Y-04-01') THEN SUM(created >= DATE_FORMAT('2024-04-19','%Y-04-01')) ELSE SUM(created BETWEEN DATE_FORMAT('2024-04-19','%Y-04-01')-INTERVAL 1 YEAR AND DATE_FORMAT('2024-04-19','%Y-04-01')) END +1,4,0 ),LPAD(1,4,0)) ) 'q_id' from quickquote");


  $result=mysqli_fetch_array($cs);

  echo $result[0];

  $q_id.="QUICKT/"."$result[0]";

// Display the current ID
//echo "QUICKT/".$startyear."-".$endyear."/". $result[0]; 
 ?>
 -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
 
 <?php include_once"settings.php"; ?>
 <?php include_once"footer.php";?>



<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2({
       placeholder: "Select a Person or Company",
    allowClear: true
    });

  });
</script>
<script>

var cnt=0;
$(document).on('click', '#product_selection', function() {
    cnt++; 
    var productLinks = $('.product-link');
    productLinks.each(function() {
        $(this).on('click', function() {
            var productId = $(this).data('product-id');
            console.log(productId);
           

calculateTotal();

 $(document).on('blur', "#quantity, #price, #gst", function(){
      calculateTotal();
      });

// Call calculateTotal initially to calculate and display the total
function calculateTotal() {
    // Retrieve form values
    const quantity = parseFloat($("#quantity").val());
    const price = parseFloat($("#price").val());
    const gst = 18;

    const subtotal=parseFloat($("#subtotal").val());


    const subval=quantity*price;

    // Calculate total
    const total = quantity * price * (1 + gst / 100);
    console.log("total",total.toFixed(0));


    const gstamt=total-subtotal;

     $("#gst").val(gstamt.toFixed(0)); 

    // Display total using jQuery
    $("#subtotal").val(subval.toFixed(0));
    $("#total").val(total.toFixed(0));
}
//

Swal.fire({
    title: 'Quick Quote',
    html: `
         <div class="box-body col-md-12" style="padding-left:0px !important;">

                  

                   
                    <div class="form-group has-danger">
                      <label id="mob" class="col-sm-4 control-label">Mobile</label>
                        <div class="col-sm-8">
                         <input id="phone" class="phone" type="tel" name="phone" value="<?php if(isset($_POST['fullno'])){ echo $_POST['fullno'];} ?>" style="{min-width: 100%; max-width: 100%; }" />

                              <input id="fullno" class="phone" type="hidden" name="fullno" style="{min-width: 100%;
                               max-width: 100%;}" value="<?php if(isset($_POST['fullno']))
                                                        { echo $_POST['fullno'];   } ?>" />
                    <br>

                    <span id="error-msg" class="hide"></span>
                  <div id="mob_error" style="color: red;"> </div>

                  <p id="result" name="result"></p> 
                    </div>       
                  </div>



                  <div class="form-group has-danger">
                      <label id="quantitylbl" class="col-sm-4 control-label">Quantity</label>
                        <div class="col-sm-8">
                         <input type="number" class="form-control" name="quantity" 
                    value="1" id="quantity" 
                     placeholder="quantity">

                    <span id="error-msg" class="hide"></span>
                  <div id="mob_error" style="color: red;"> </div>

                  <p id="result" name="result"></p> 
                    </div>       
                  </div>


                  <div class="form-group has-danger">
                      <label id="pricelbl" class="col-sm-4 control-label">Price</label>
                        <div class="col-sm-8">
                         <input type="number" class="form-control" name="price" 
                    id="price" 
                     placeholder="price">


                    <span id="error-msg" class="hide"></span>
                  <div id="mob_error" style="color: red;"> </div>

                  <p id="result" name="result"></p> 
                    </div>       
                  </div>


                  <div class="form-group has-danger">
                      <label id="gstlbl" class="col-sm-4 control-label">Sub-Total</label>
                        <div class="col-sm-8">
                        <input type="number" class="form-control" name="subtotal" id="subtotal" 
                     placeholder="subtotal">

                    <span id="error-msg" class="hide"></span>
                  <div id="mob_error" style="color: red;"> </div>

                  <p id="result" name="result"></p> 
                    </div>       
                  </div>

                    
                  <div class="form-group has-danger">
                      <label id="gstlbl" class="col-sm-4 control-label">GST Amt 18%</label>
                        <div class="col-sm-8">
                        <input type="number" class="form-control" name="gst" 
                     id="gst" placeholder="gst amt">

                    <span id="error-msg" class="hide"></span>
                  <div id="mob_error" style="color: red;"> </div>

                  <p id="result" name="result"></p> 
                    </div>       
                  </div>


                  <div class="form-group has-danger">
                      <label id="mob" class="col-sm-4 control-label">Total</label>
                        <div class="col-sm-8">
                        <input type="number" class="form-control" name="total" 
                     id="total" 
                     placeholder="Total">                  

                    <span id="error-msg" class="hide"></span>
                  <div id="mob_error" style="color: red;"> </div>

                  <p id="result" name="result"></p> 
                    </div>       
                  </div>




                   </div>  `,
                      showCancelButton: true,
                      confirmButtonText: 'Submit',
                      cancelButtonText: 'Cancel',
                      focusConfirm: false,
                      preConfirm: () => {
                       

                          // Retrieve form values
                          const q_id = $("#q_id").val();
                          const mobileNumber = $("#phone").val();
                          console.log(mobileNumber);
                          const quantity = $("#quantity").val();
                          console.log(quantity);
                          const price = $("#price").val();
                          console.log(price);
                          const subtotal = $("#subtotal").val();
                          console.log(subtotal);
                          const gst = $("#gst").val();
                          console.log(gst);
                          const total = $("#total").val();

                          // Check if any input field is empty
                          if (mobileNumber === "" || quantity === "" || price === "" || gst === "") {
                              Swal.showValidationMessage('All fields are required');
                          } else {
                              // Display total using jQuery
                               $("#total").val(calculateTotal());
                              

                                  const formData = {
                                    q_id:q_id,
                                    productId:productId,
                                  mobileNumber: mobileNumber,
                                  quantity: quantity,
                                  price: price,
                                  subtotal:subtotal,
                                  gst: gst,
                                  total:total
                              };

                              // Submit form data via AJAX
                              $.ajax({
                                  url: "ajax/submitquickq.php", // Replace "submit.php" with your actual backend endpoint
                                  type: "POST",
                                  data: formData,

                                  success: function(response) {
                                   
                                      console.log(formData);

                                      Swal.fire('Success', response.message, 'success');
                                      window.open('quickquotation.php?quick='+productId, '_blank');
                                      console.log(response.message);
                                      console.log(response.div);
                                  },
                                  error: function(xhr, status, error) {
                                      Swal.fire('Error', 'An error occurred while submitting the form.', 'error');
                                  }
                              });

                          }
                      }
                  });
                          
                        
              // Initialize intlTelInput
              var input = document.querySelector("#phone");
              var iti;

              iti=window.intlTelInput(input, {
                  hiddenInput: "full_number",
                  nationalMode: false,
                  formatOnDisplay: true,
                  separateDialCode: true,
                  autoHideDialCode: true,
                  autoPlaceholder: "aggressive",
                  initialCountry: "in",
                  placeholderNumberType: "MOBILE",
                  preferredCountries: ['in', 'np'],
                  utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.12/js/utils.js"
              });

        }); //link event listener ends
    }); //product link function ends
}); // main function ends




// // Show/hide courier input based on option selected
// document.querySelectorAll('input[name="courierOption"]').forEach((elem) => {
//     elem.addEventListener("change", function() {
//         const courierInput = document.getElementById("courierInput");
//         if (elem.value === "yes") {
//             courierInput.style.display = "block";
//         } else {
//             courierInput.style.display = "none";
//         }
//     });
// });
    
    </script>
</body>
</html>
