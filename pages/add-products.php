<?php
session_start();
include'dbconnection.php';
include("checklogin.php");
check_login();

include 'inc/getState.php';

$current_page='manage-products';



// if (isset($_POST["Upload"])) {

//     // Check image using getimagesize function and get size
//     // if a valid number is got then uploaded file is an image
//     if (isset($_FILES["image"])) {
//         // directory name to store the uploaded image files
//         // this should have sufficient read/write/execute permissions
//         // if not already exists, please create it in the root of the
//         // project folder
//         $targetDir = "uploads/";
//         $targetFile = $targetDir . basename($_FILES["image"]["name"]);
//         $uploadOk = 1;
//         $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

//         $check = getimagesize($_FILES["image"]["tmp_name"]);
//         if ($check !== false) {
//             echo "File is an image - " . $check["mime"] . ".";
//             $uploadOk = 1;
//         } else {
//             echo "File is not an image.";
//             $uploadOk = 0;
//         }
//     }

//     // Check if the file already exists in the same path
//     if (file_exists($targetFile)) {
//         echo "Sorry, file already exists.";
//         $uploadOk = 0;
//     }

//     // Check file size and throw error if it is greater than
//     // the predefined value, here it is 500000
//     if ($_FILES["image"]["size"] > 5242880) {
//         echo "Sorry, your file is too large.";
//         $uploadOk = 0;
//     }

//     // Check for uploaded file formats and allow only 
//     // jpg, png, jpeg and gif
//     // If you want to allow more formats, declare it here
//     if (
//         $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
//         && $imageFileType != "gif"
//     ) {
//         echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
//         $uploadOk = 0;
//     }

//     // Check if $uploadOk is set to 0 by an error
//     if ($uploadOk == 0) {
//         echo "Sorry, your file was not uploaded.";
//     } else {
//         if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile)) {
//             echo "The file " . htmlspecialchars(basename($_FILES["image"]["name"])) . " has been uploaded.";
//         } else {
//             echo "Sorry, there was an error uploading your file.";
//         }
//     }
// }




?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AdminLTE 2 | General Form Elements</title>
  <?php include_once"links.php"; ?>

</head>
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
      Manage Products
        <small></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Add Products</li>
      </ol>
    </section>

      <?php $ret=mysqli_query($con,"select (p_id)+1 from products ORDER BY p_id DESC LIMIT 1")or die("Error: " . mysqli_error($con));
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
              <h3 class="box-title">Add Product</h3>
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
                  <label id="cid" class="col-sm-2 control-label">Product Id</label>
                  <div class="col-sm-8">
                    <input type="text" class="form-control" name="pid" id="pid" value="<?php echo $row[0]; ?>" readonly>
                  </div>
                </div>

                <div class="form-group">
                  <label id="c_name" class="col-sm-2 control-label">Product Name</label>
                  <div class="col-sm-8">
                    <input type="text" class="form-control" id="pname" name="pname" placeholder="Product Name">
                    <div id="pname_error" style="color: red;"> </div>
                  </div>
                </div>

                <div class="form-group">
                  <label id="c_add" class="col-sm-2 control-label">Description</label>
                  <div class="col-sm-8">
                    <textarea class="form-control" name="pdesc" id="pdesc" placeholder="Description"></textarea>
                                  <div id="pdesc_error" style="color: red;"> </div>
                </div>
              </div>

              <div class="form-group">
                  <label id="c_add" class="col-sm-2 control-label">HSN</label>
                  <div class="col-sm-8">
                   <input type="text" class="form-control" name="hsn" id="hsn"  placeholder="HSN Code">
                                  <div id="hsn_error" style="color: red;"> </div>
                </div>
              </div>

               <div class="form-group">
                  <label id="type" class="col-sm-2 control-label">Product Type</label>
                  <div class="col-sm-8">
                   <select name="ptype" class="form-control select2" style=" height: 34px;width:100%" id="ptype">
                    <option value=""></option>
                    <option value="Machine">Machine</option>
                    <option value="Consumables">Consumables</option>
                    
                    <option value="Freight">Freight</option>
                     </select>
                                  <div id="ptype_error" style="color: red;"> <?php if(isset($ptypeerror)) {
                                    echo $ptypeerror; 
                                  } ?> </div>
                </div>
              </div>


              <form action="" method="POST" id="imgform" enctype="multipart/form-data">
              <div class="form-group">
                  <label id="ftype" class="col-sm-2 control-label">File input</label>
                  <div class="col-sm-6">
                  <input type="file" name="image" id="image" style="font-size: medium;">
                  </div>
                  <div class="col-sm-2">
                  <input type="button" name="upload" value="upload" id="upload" style="font-size: medium;">
                  </div>
                  <div id="file_selection_error" style="color: red;"> </div>
                </div>
                </form>

                
                <div class="form-group">
              <label id="xftype" class="col-sm-2 control-label"> Display uploaded Image:</label>
              <div class="col-sm-8">
          
                    <img alt="Uploaded Image" id="uploadimg" src="../dist/img/default.jpg" height="300px" width="400px">
                </div>
                </div>


                <div class="form-group">
                  <label id="techslbl" class="col-sm-2 control-label">Technical Description</label>
                  <div class="col-sm-8">
                    <textarea class="form-control" name="techs" id="techs" placeholder="Technical Description" rows="4"></textarea>
                                  <div id="techs_error" style="color: red;"> </div>
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
                <input type="submit" name="submit" id="SubmitForm" class="btn btn-info col-sm-8">

              </div>
              <br/><br/><br/>
              <!-- /.box-footer -->
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
 <?php include_once"footer.php";?>

 <?php include_once"settings.php"; ?>
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->
<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2({
       placeholder: "Select a Product Type",
    allowClear: true
    });

  });

  
</script>


<script>

$(document).ready(function() {
    var imgname; // Ensure imgname is defined in a higher scope

    // Handler for uploading image
    $('#upload').click(function(e) {
        var formData = new FormData();
        formData.append('uploadimg', $('#image')[0].files[0]);

        $.ajax({
            url: 'ajax/upload_image.php',
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                var jsonResponse = JSON.parse(response);
                console.log(jsonResponse);

                if (jsonResponse.success) {
                    console.log('Image uploaded successfully: ' + jsonResponse.filename);
                    var imageUrl = '../dist/img/' + jsonResponse.filename;
                    console.log('Image URL: ' + imageUrl);
                    $('#uploadimg').attr('src', imageUrl);

                    imgname = jsonResponse.filename; // Assign imgname here
                } else {
                    console.log('Error: ' + jsonResponse.message);
                }
            },
            error: function() {
                console.log('Error uploading image');
            }
        });
    });

    // Handler for form submission
    $("form").submit(function(event) {
        event.preventDefault(); // Prevent default form submission
        console.log("submit event");

        var formData = new FormData(this); // Create FormData from the form
        formData.append('imgname', imgname); // Append imgname to FormData

        $.ajax({
            type: 'POST',
            url: 'ajax/addproducttest.php',
            data: formData,
            processData: false, // Prevent jQuery from processing the data
            contentType: false, // Prevent jQuery from setting the Content-Type header
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    $('.error').css('border', '0px');
                    $('#message').html(response.message);
                    Swal.fire({
                        title: "Good!",
                        text: "New Product Data Inserted!",
                        icon: "success",
                        showConfirmButton: false, // Hide the OK button
                        timer: 3000, // Close the popup after 3 seconds (3000 milliseconds)
                    }).then(function() {
                        window.location.href = 'manage-products.php';
                    });
                } else {
                    $('.error').css('border', '0px');

                    // Remove previous error messages and classes
                    $.each(response.errors, function(field, errorMessage) {
                        $('#' + field + '_error').removeClass('error').text('');
                    });

                    // Add new error messages and classes
                    $.each(response.errors, function(field, errorMessage) {
                        $('#' + field + '_error').addClass('error').text(errorMessage);
                    });

                    console.log(response.errors);
                }
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
    });
});

</script>
</body>
</html>
