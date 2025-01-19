<?php
session_start();
include'dbconnection.php';
include("checklogin.php");
check_login();
include("backupdata.php");
//include("backupdata.php");
include 'inc/getState.php';

$current_page="generate-inv";
$current_page1="gen-pro";




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
  <?php include_once"links.php"; ?>

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
      Invoice Details
        <small></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Generate Invoice</li>
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

$datalog= "SELECT CONCAT_WS( '/', '$year'
                , COALESCE(LPAD(
                      CASE WHEN '$date' >= DATE_FORMAT('$date','%Y-04-01') 
                           THEN SUM(created >= DATE_FORMAT('$date','%Y-04-01')) 
                           ELSE SUM(created BETWEEN DATE_FORMAT('$date','%Y-04-01')-INTERVAL 1 YEAR AND 
                           DATE_FORMAT('$date','%Y-04-01'))
                      END +1,4,0
                      ),LPAD(1,4,0))
                ) 'invid' from protest2 ";
 
 //$do=mysqli_fetch_array($datalog);
 //$ds=$do[0];
     
$stmt = mysqli_query($con,$datalog);

    $dat=mysqli_num_rows($stmt);
    if($dat > 0) {
        if ($row = mysqli_fetch_assoc($stmt)) {
            $value2 = $row['invid'];
            
           // echo $value2;

            $value2 = substr($value2, 6, 4);//separating numeric part

            //echo "\n after substr".$value2;

          //  $value2 = $value2 + 1;//Incrementing numeric part
            $value2 = "\n PI/".$year."/" . sprintf('%04s', $value2);//concatenating incremented value
            $value = $value2; 
        }
    } 
    else {
        $value2 = "PI/".$year."/0001";
        $value = $value2;
    }
   // echo $value;//

    ?>
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <!-- left column -->
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Generate Proforma Invoice</h3>
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
                  <label id="ccid" class="col-sm-2 control-label">Proforma ID</label>
                  <div class="col-sm-3">
                    <input type="text" class="form-control" name="invid" id="invid" value="<?php echo $value; ?>">
                    <div class="invid_error" style="color: red"></div>
                  </div>

                  <label id="c_addlbl1" class="col-sm-2 control-label">Client Name</label>
                  <div class="col-sm-4">
                    <select name="client" id="client" class="form-control select2"  onchange="showCustomer(this.value)" style="height:34px;width: 80%;border-radius:0px;padding: 6px 12px !important; ">
                                 <option></option>
                                  
                                <?php $r=mysqli_query($con,"select * from client");
                                  while($row=mysqli_fetch_array($r))
                                  {
                                 ?>
                                
                                    <option value="<?php echo $row['cid']; ?>"> <?php echo $row['c_name']; ?> </option>
                                  

                                 <?php } ?>
                                  </select>
                                   <button type="button" id="btnplus"class="btn btn-success btn-sm " style="margin: 2px 2px 2px 2px;" onclick="window.location.href = 'add-client.php'";><span class="glyphicon glyphicon-plus"></span></button><br>
                                   <div id="client_error" style="color: red; width: 80%"> </div>
                </div>

                </div>

                <div class="form-group">
                  <label id="inviddate" class="col-sm-2 control-label">Invoice Date</label>
                  <div class="col-sm-3">
                    <input type="text" class="form-control" name="created" value="<?php  $c=date("d-M-Y");
                                        echo $c; ?>" />
                    <div id="nameerror"> </div>
                  </div>

                  <label id="c_addlbl" class="col-sm-2 control-label">Address</label>
                  <div class="col-sm-4">
                   <textarea class="form-control" rows="3" id="c_add" name="c_add" ></textarea>
                                  <div id="moberror"> </div>
                </div>

                </div>


                <div class="form-group col-sm-12 col-md-12" style="margin-left: 3px;">
                  
                  <table class="table table-bordered" id="item_table">
      <tr>
        <th width="2%"><input id="checkAll" class="formcontrol" type="checkbox"></th>
              <th width="8%">Item No</th>
              <th width="25%">Item Name</th>
              <th width="20%">Description Name</th>
              <th width="10%">HSN </th> 
              <th width="5%">Quantity</th>
              <th width="15%">Price</th>                
              <th width="25%">Total</th>
       <th><button type="button" name="add" class="btn btn-success btn-sm add"><span class="glyphicon glyphicon-plus"></span></button></th>
      </tr>
      <tr class="datarow">
        <td><input class="itemRow" type="checkbox"></td>
        <td><input type="text" name="item_code[]" id="productCode_1" value="1" class="form-control" autocomplete="off"></td>
        
        <td><select name="item_name[]" id="productName_1" class="form-control item_unit" onchange="showproduct(this.value)"><option value="">Select Unit</option>
          <?php echo fill_unit_select_box($connect); ?></select>
        </td>
        
        <td><input type="text" name="item_desc[]" id="productDesc_1" class="form-control item_name" ></td>
        <td><input type="text" name="hsn[]" id="hsn_1" value="8443" class="form-control item_hsn" ></td>
        <td><input type="number" name="item_quantity[]" id="quantity_1" min="1" 
        oninput="validity.valid||(value='');" class="form-control quantity" value="1"></td>
        
        <td><input type="number" name="price[]" id="price_1" class="form-control price" min="1" autocomplete="off"></td>
         
              <td><input type="number" name="total[]" id="total_1" class="form-control total" autocomplete="off"></td>
              <td><button type="button" name="remove" class="btn btn-danger btn-sm remove"><span class="glyphicon glyphicon-minus"></span></button></td>
  </tr>
     </table>
  
              </div>
</br></br></br>

      <div class="row"> 
        <div class="col-xs-10 col-sm-8 col-md-8 col-lg-8" style="padding-left: 50px;">
          <h3>Notes: </h3>
          <div class="form-group">
            <textarea class="form-control txt" rows="5" name="notes" id="notes" placeholder="Your Notes"></textarea>
          </div>
          <br>
          <div class="form-group">
            <input type="hidden" value="<?php //echo $_SESSION['userid']; ?>" class="form-control" name="userId">
            <input data-loading-text="Saving Invoice..." type="submit" id="submitbtn"  name="submit" value="Save Invoice" 
            style="width: 15em;  height: 3em; font-size:20px;" class="btn btn-success submit_btn invoice-save-btm">           
          </div>
          
        </div>
      </br></br></br>


        <div class="col-xs-10 col-sm-4 col-md-4 col-lg-4" style="padding-left:50px; ">
      
            <div class="form-group">

              <label>Subtotal: &nbsp;</label> 
            
              <div class="input-group col-sm-10">
                <div class="input-group-addon "><i class="fa fa-fw fa-inr"></i></div>
                <input value="" type="number" class="form-control" name="subTotal" id="subTotal" placeholder="Subtotal">
              </div>
            </div> 
            <div class="form-group">
              <label>Tax Rate: &nbsp;</label>
          
              <div class="input-group col-sm-10">
                <input value="" type="number" class="form-control" name="taxRate" id="taxRate" placeholder="Tax Rate">
                <div class="input-group-addon">%</div>
              </div>
              <div id="taxrate_error" style="color: red; width: 83%"> </div>
            </div>

            <div class="form-group">
              <label>Tax Amount: &nbsp;</label>
              <div class="input-group col-sm-10">
                <div class="input-group-addon currency"><i class="fa fa-fw fa-inr"></i></div>
                <input value="" type="number" class="form-control" name="taxAmount" id="taxAmount" placeholder="Tax Amount">
              </div>
            </div>              
            <div class="form-group">
              <label>Total: &nbsp;</label>
              <div class="input-group col-sm-10">
                <div class="input-group-addon currency"><i class="fa fa-fw fa-inr"></i></div>
                <input value="" type="number" class="form-control" name="totalAftertax" id="totalAftertax" placeholder="Total">
              </div>
            </div>

           <!--  <div class="form-group">
              <label>Amount Paid: &nbsp;</label>
              <div class="input-group">
                <div class="input-group-addon currency">$</div>
                <input value="" type="number" class="form-control" name="amountPaid" id="amountPaid" placeholder="Amount Paid">
              </div>
            </div>
            <div class="form-group">
              <label>Amount Due: &nbsp;</label>
              <div class="input-group">
                <div class="input-group-addon currency">$</div>
                <input value="" type="number" class="form-control" name="amountDue" id="amountDue" placeholder="Amount Due">
              </div>
            </div>
 -->
          </form>

              <div class="form-group">
                  
              </div>


           
            
          </div>
            </div>            
          <!-- /.box -->
        </div>
        <!--/.col (right) -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
 
 <?php include_once"settings.php"; ?>
 <?php include_once"footer.php";?>


 <script>

 
  $(document).ready(function(){
  
  // $(document).on('click', '#checkAll', function() {           
  //   $(".itemRow").prop("checked", this.checked);
  // }); 


  // $(document).on('click', '.itemRow', function() {    
  //   if ($('.itemRow:checked').length == $('.itemRow').length) {
  //     $('#checkAll').prop('checked', true);
  //   } else {
  //     $('#checkAll').prop('checked', false);
  //   }
  // });  
    var final_total_amt = $('#final_total_amt').text();
        
  var count = 1;
  console.log(count);

  var rowCount = $('#item_table tbody tr.datarow').length;
    console.log("rowCount: "+rowCount);


  // var count = $(".itemRow").length;

 
 $(document).on('click', '.add', function(){
  count++;
  rowCount++;

  var html = '';
  html += '<tr class="datarow">';
  html += '<td><input class="itemRow" type="checkbox"></td>';
  html += ' <td><input type="text" name="itemCode[]" id="productCode_'+count+'" value='+count+' class="form-control" autocomplete="off"></td>';
  html += '<td><select name="item_name[]" id="productName_'+count+'" class="form-control item_unit" onchange="showproduct(this.value)"><option value="">Select Unit</option><?php echo fill_unit_select_box($connect); ?></select></td>';


  html += '<td><input type="text" name="item_desc[]" id="descName_'+count+'" class="form-control item_name" /></td>';

  html += '<td><input type="text" name="hsn[]" id="hsn_'+count+'" value="8443" class="form-control item_hsn" /></td>';
  html += '<td><input type="number" name="item_quantity[]" id="quantity_'+count+'" class="form-control item_quantity" value="1" min="1"  /></td>';

  html += ' <td><input type="number" name="price[]" id="price_'+count+'" class="form-control price" min="1" autocomplete="off"></td>';
  html += '<td><input type="number" name="total[]" id="total_'+count+'" class="form-control total" autocomplete="off"></td>';
 
  html += '<td><button type="button" name="remove" class="btn btn-danger btn-sm remove"><span class="glyphicon glyphicon-minus"></span></button></td></tr>';

  $('#item_table').append(html);
 });
 


$(document).on('click', '.remove', function(){
  
  //count--;

    var removeButton = $(this);
    

    // If there's only one row, disable the remove button
    if (rowCount === 1) {
      removeButton.prop('disabled', true);
      return;
    }

    $(this).closest('tr').remove();
    // If there are more than one rows, remove the current row
    removeButton.closest('tr').remove();
        rowCount--;
 });

$('#checkAll').prop('checked', false);
    calculateTotal();
  });



$(document).on('blur', "[id^=quantity_]", function(){
    calculateTotal();
  }); 
  $(document).on('blur', "[id^=price_]", function(){
    calculateTotal();
  }); 
  $(document).on('blur', "#taxRate", function(){    
    calculateTotal();
  }); 
  $(document).on('blur', "#amountPaid", function(){
    var amountPaid = $(this).val();
    var totalAftertax = $('#totalAftertax').val();  
    if(amountPaid && totalAftertax) {
      totalAftertax = totalAftertax-amountPaid;     
      $('#amountDue').val(totalAftertax);
    } else {
      $('#amountDue').val(totalAftertax);
    } 
  }); 
  
function calculateTotal(){
  var totalAmount = 0; 
  $("[id^='price_']").each(function() {
    var id = $(this).attr('id');
    id = id.replace("price_",'');
    var price = $('#price_'+id).val();
    var quantity  = $('#quantity_'+id).val();
    if(!quantity) {
      quantity = 1;
    }
    var total = price*quantity;
    $('#total_'+id).val(parseFloat(total));
    totalAmount += total;     
  });
  $('#subTotal').val(parseFloat(totalAmount));  
  var taxRate = $("#taxRate").val();
  var subTotal = $('#subTotal').val();  
  
  if(subTotal) {
    var taxAmount = Math.ceil(subTotal*taxRate/100);
    $('#taxAmount').val(taxAmount);
        subTotal =Math.ceil(parseFloat(subTotal)+parseFloat(taxAmount));
    $('#totalAftertax').val(subTotal);    
    
    var amountPaid = $('#amountPaid').val();
    var totalAftertax = $('#totalAftertax').val();  
    if(amountPaid && totalAftertax) {
      totalAftertax = totalAftertax-amountPaid;     
      $('#amountDue').val(totalAftertax);
    } else {    
      $('#amountDue').val(subTotal);
    }
  }
}

function showCustomer(str) {
  var xhttp;  
  if (str == "") {
    document.getElementById("c_add").innerHTML = "";
    return;
  }
  xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("c_add").innerHTML = this.responseText;
    }
  };

  var encodedstr = encodeURIComponent(str);
console.log(encodedstr);
  
  xhttp.open("GET", "ajax/getcustomer.php?q="+encodedstr, true);
  xhttp.send();
} 
 

 
   $("#form").submit(function(event) {
        event.preventDefault();
        console.log("submit event");
        var formData = $(this).serialize();

 //var formData = new FormData(document.getElementById("form"));

        console.log(formData);

        var itemNames = [];
        var itemDescs = [];
        var hsn = [];
        var quantities = [];
        var prices = [];
        var totals = [];

        $(".itemRow").each(function() {
            itemNames.push($(this).find(".item_name").val());
            itemDescs.push($(this).find(".item_desc").val());
            hsn.push($(this).find(".item_hsn").val()); // Corrected from .hsn
            quantities.push($(this).find(".item_quantity").val());
            prices.push($(this).find(".price").val());
            totals.push($(this).find(".total").val());
        });

        console.log(formData);

        $.ajax({
            type: "POST",
            url: "ajax/add-protest.php",
            data: formData,
            dataType: 'json', 
            //contentType: false,           
            success: function(response) {
                // Handle success response here
                if (response.success) {
        //           $('.error').html('');
        // // Remove error classes
        //            $('.error').removeClass('error');
                    console.log(response.success);
                    $('.error').css('border','0px');
                    $('#message').html(response.message);
                    Swal.fire({
                    title: "Good!",
                    text: "Proforma invoice Data Inserted!",
                    icon: "success",
                    showConfirmButton: false, // Hide the OK button
                   timer: 3000, // Close the popup after 3 seconds (3000 milliseconds)
                  }).then(function() {

                  <?php dbbackup("localhost", "root", "", "loginsystem" ); ?>  
                 window.location.href = 'gen-pro.php';
                 window.open('proformainv.php?inv='+response.inv, '_blank');

                  });
            }else {
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
                // Handle error here
                console.error(xhr.responseText);
            }
        });

        //event.preventDefault(); // Prevent default form submission
        
    });


 </script>

 


<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2({
       placeholder: "Select a Person or Company",
    allowClear: true
    });

  });
</script>
</body>
</html>
