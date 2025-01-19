<?php
session_start();
include'dbconnection.php';
include("checklogin.php");
include 'inc/getState.php';

 check_login();

$current_page="setting";




$data=mysqli_query($con,"select count(invid) 'sales' from invtest2");

$ds=mysqli_fetch_array($data);

$data2=mysqli_query($con,"select count(name) 'products' from products");
$ds2=mysqli_fetch_array($data2);

$data3=mysqli_query($con,"select count(c_name) 'client' from client");
$ds3=mysqli_fetch_array($data3);

// $profile= mysqli_query($con,"select * from admin");

$mode=mysqli_query($con,"select * from paymode");



if(isset($_POST['profilesubmit']))
{

  $name=ucwords(strtolower($_POST['name']));
  $email=$_POST['email'];

  $profession=ucwords(strtolower($_POST['profession']));

  $qualification=$_POST['qualification'];

  $location=ucwords(strtolower($_POST['location']));



  $update=mysqli_query($con,"update admin set name='$name', username='$email',qualification='$qualification',
    location='$location',profession='$profession' where id= 1") or die("error".mysqli_error($con));


  if($update)
{
    $_SESSION['msg']="Profile updated successfully";
    
    

}
else
{
  $_SESSION['Msg'] =" Error Occured";
}
}

//company details
if(isset($_POST['csubmit']))
{

  $cname=$_POST['cname'];
  
  $cadd=$_POST['cadd'];

  $cmob=$_POST['cmob'];

  $cemail=$_POST['cemail'];

  $cgst =strtoupper($_POST['cgst']);  

// $tags  = $_POST['skills'];
// $tags  = json_encode($tags); 
// $tags  = htmlspecialchars_decode($tags);


  $pan=strtoupper($_POST['cpan']);

  $update=mysqli_query($con,"update admin set c_name='$cname',c_add='$cadd', mob='$cmob', email='$cemail', gst='$cgst', pan='$pan' where id= 1") or die("error".mysqli_error($con));

  //echo "update admin set c_name='$cname',c_add='$cadd', mob='$cmob', email='$cemail', gst='$cgst' where id= 1";

$bnames=$_POST['bname'];

  $acs=$_POST['ac'];

  $ifscs=$_POST['ifsc'];

  $branchs=$_POST['branch'];

$update2=mysqli_query($con,"update bankdetails set bname='$bnames',ac='$acs',ifsc='$ifscs', branch='$branchs' where bid=1") or die("error".mysqli_error($con));



  if($update)
{
    $_SESSION['msg']="Profile updated successfully";
   

}
else
{
  $_SESSION['Msg'] =" Error Occured";
}
}


//pay mode
if(isset($_POST['modesubmit']))
{

   $itemCount = count($_POST["mode_name"]);
    $itemValues=0;
    $query = "INSERT INTO paymode (mid,mode) VALUES ";
    $queryValue = "";
    for($i=0;$i<$itemCount;$i++) {
      if(!empty($_POST["mode_name"][$i])) {
        $itemValues++;
        if($queryValue!="") {
          $queryValue .= ",";
        }

        $queryValue .= "(NULL,'" .  $_POST["mode_name"][$i] . "')"
         or die("Error IN ORDER TABLE: " . mysqli_error($con));
      }
    }

    $del=mysqli_query($con,"truncate table paymode");

    $sql = $query.$queryValue;
  // ECHO $sql;
    if($itemValues!=0) {
        $result = mysqli_query($con, $sql);
      
      if(!empty($result)) 
        {
          $_SESSION['msg'] = " Payment Mode Added Successfully.";
      //      echo "<script>
      //    setTimeout(function(){
      //       window.location.href = 'profile.php';
      //    }, 3000);
      // </script>";
        //echo $message;
    }}
    else{
      echo "error";
    }
  

}

//change password
if(isset($_POST['upsubmit']))
{
  $password =$_POST['password'];
  $cpassword=$_POST['cpassword'];

  if($password != null && $cpassword != null)
  {

  $upd=mysqli_query($con,"update admin set password='$cpassword' where id=1");
  if($upd)
  {
    $_SESSION['msg']="Password Has been Updated..Now Plz relogin";

      echo "<script>
         setTimeout(function(){
            window.location.href = 'logout.php';
         }, 3000);
      </script>";
        //echo $message;
  }
  else{
    $_SESSION['msg']="Error Occured";
  }
}
 
}

?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AdminLTE 2 | User Profile</title>
  
  <?php include_once"links.php"; ?>

<!-- <script type="text/javascript">
  document.documentElement.scrollTop = 0;
  </script> -->


<script >
$(document).ready(function () {

    //If image edit link is clicked
    $(".editLink").on('click', function(e){
        e.preventDefault();
        $("#fileInput:hidden").trigger('click');
    });
  
    //On select file to upload
    $("#fileInput").on('change', function(){
        var image = $('#fileInput').val();
        var img_ex = /(\.jpg|\.jpeg|\.png|\.gif)$/i;

    var maxWidth = 160; // Max width for the image
    var maxHeight = 160;    // Max height for the image
    var ratio = 0;  // Used for aspect ratio
    var width = $(this).width();    // Current image width
    var height = $(this).height();  // Current image height


    // Check if the current width is larger than the max
    if(width > maxWidth){
        ratio = maxWidth / width;   // get ratio for scaling image
        $(this).css("width", maxWidth); // Set new width
        $(this).css("height", height * ratio);  // Scale height based on ratio
        height = height * ratio;    // Reset height to match scaled image
    }

    var width = $(this).width();    // Current image width
    var height = $(this).height();  // Current image height


    // Check if current height is larger than max
    if(height > maxHeight){
        ratio = maxHeight / height; // get ratio for scaling image
        $(this).css("height", maxHeight);   // Set new height
        $(this).css("width", width * ratio);    // Scale width based on ratio
        width = width * ratio;    // Reset width to match scaled image
    }
    

console.log(width);
console.log(height);

    //validate file type
        if(!img_ex.exec(image)){
            alert('Please upload only .jpg/.jpeg/.png/.gif file.');
            $('#fileInput').val('');
            return false;
        }else{


            $('.uploadProcess').show();
            $('#uploadForm').hide();
            $( "#picUploadForm" ).submit();
        }
    });

});

//After completion of image upload process
function completeUpload(success, fileName) {
  if(success == 1){
    $('#imagePreview').attr("src", "");
    $('#imagePreview').attr("src", fileName);

     $('#imagePreview2').attr("src", "");
    $('#imagePreview2').attr("src", fileName);

     $('#imagePreview3').attr("src", "");
    $('#imagePreview3').attr("src", fileName);

     $('#imagePreview4').attr("src", "");
    $('#imagePreview4').attr("src", fileName);

     $('#imagePreview5').attr("src", "");
    $('#imagePreview5').attr("src", fileName);

    $('#fileInput').attr("value", fileName);
    $('.uploadProcess').hide();
  }else{
    $('.uploadProcess').hide();
    alert('There was an error during file upload!');
  }
  return true;
}


</script>      

<script>

$(document).ready(function () {

 $(".editLink2").on('click', function(e){
        e.preventDefault();
        $("#fileInput2:hidden").trigger('click');
    });
    
    //On select file to upload
    $("#fileInput2").on('change', function(){
        var image2 = $('#fileInput2').val();
        var img_ex2 = /(\.jpg|\.jpeg|\.png|\.gif)$/i;
        
        
   console.log("fileinput2 working");
    var maxWidth = 160; // Max width for the image
    var maxHeight = 160;    // Max height for the image
    var ratio = 0;  // Used for aspect ratio
    var width = $(this).width();    // Current image width
    var height = $(this).height();  // Current image height


    // Check if the current width is larger than the max
    if(width > maxWidth){
        ratio = maxWidth / width;   // get ratio for scaling image
        $(this).css("width", maxWidth); // Set new width
        $(this).css("height", height * ratio);  // Scale height based on ratio
        height = height * ratio;    // Reset height to match scaled image
    }

    var width = $(this).width();    // Current image width
    var height = $(this).height();  // Current image height


    // Check if current height is larger than max
    if(height > maxHeight){
        ratio = maxHeight / height; // get ratio for scaling image
        $(this).css("height", maxHeight);   // Set new height
        $(this).css("width", width * ratio);    // Scale width based on ratio
        width = width * ratio;    // Reset width to match scaled image
    }
    
        //validate file type
        if(!img_ex2.exec(image2)){
            alert('Please upload only .jpg/.jpeg/.png/.gif file.');
            $('#fileInput2').val('');
            return false;
        }else{
            $('.uploadProcess2').show();
            $('#uploadForm2').hide();
            $( "#picUploadForm2" ).submit();

        }
    });  

});

    function completeUploadz(success, fileName) {
    if(success == 1){
        $('#imagePreview6').attr("src", "");
        $('#imagePreview6').attr("src", fileName);
        
        $('#fileInput2').attr("value", fileName);
        $('.uploadProcess6').hide();
    }else{
        $('.uploadProcess6').hide();
        alert('There was an error during file upload 2!');
    }
    return true;
}      
</script>
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.css">

<script src="https://cdn.jsdelivr.net/bootstrap.tagsinput/0.8.0/bootstrap-tagsinput.min.js"> </script>


</head>
<body class="hold-transition skin-blue sidebar-mini <?php echo getState('fixed-layout') ? 'fixed ' : ''; ?>
    <?php echo getState('boxed-layout') ? 'layout-boxed ' : ''; ?>
    <?php echo getState('sidebar-collapse') ? 'sidebar-collapse ' : ''; ?>
    <?php echo getState('expand-on-hover') ? 'expandOnHover ' : ''; ?>
    <?php echo getState('control-sidebar-open') ? 'control-sidebar-open ' : ''; ?>
    <?php echo getState('sidebar-skin-toggle') ? 'sidebar-light ' : ''; ?>" onload="scrollTo(0,0)">

<div id="loader"></div>
<div class="wrapper">

 <?php include_once "header.php";?>

    
<?php include_once"navbar.php"; ?>


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        User Profile
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">User profile</li>
      </ol>
    </section>

<?php 
$bankdata=mysqli_query($con,"select * from bankdetails");

while($bdata=mysqli_fetch_array($bankdata))
{
  $bankname=$bdata['bname'];
  $ac=$bdata['ac'];
  //echo $ac;
  $ifsc=$bdata['ifsc'];
  $branch=$bdata['branch'];
}

$profile= mysqli_query($con,"select * from admin");
while($row=mysqli_fetch_array($profile))
{
?>

    <!-- Main content -->
    <section class="content">

      <div class="row">
      
        <div class="col-md-3">

          <!-- Profile Image -->
          <div class="box box-primary">
            <div class="box-body box-profile">


              <img class="profile-user-img img-responsive img-circle" src="<?php echo $userPictureURL; ?>" 
              style="height: 95px; width:95px;" id="imagePreview2" alt="User profile picture">

              <h3 class="profile-username text-center"><?php echo $row['name']; ?></h3>

              <p class="text-muted text-center"><?php echo $row['profession']; ?></p>

              <ul class="list-group list-group-unbordered">
                 
                <li class="list-group-item">
                  <b>Total Clients</b> <a class="pull-right"><?php echo $ds3[0]; ?></a>
                </li>
                <li class="list-group-item">
                  <b>Products</b> <a class="pull-right"><?php echo $ds2[0]; ?></a>
                </li>
                <li class="list-group-item">
                  <b>Sales</b> <a class="pull-right"><?php echo $ds[0]; ?></a>
                </li>
              </ul>

           <!--    <a href="#" class="btn btn-primary btn-block"><b>Follow</b></a> -->
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

          <!-- About Me Box -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">About Me</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <strong><i class="fa fa-book margin-r-5"></i> Education</strong>

              <p class="text-muted">
                <?php echo $row['qualification']; ?>
              </p>

              <hr>

              <strong><i class="fa fa-map-marker margin-r-5"></i> Location</strong>

              <p class="text-muted"><?php echo $row['location']; ?></p>

              <hr>

              <strong><i class="fa fa-pencil margin-r-5"></i> Skills</strong>

              <p>
                <span class="label label-danger">UI Design</span>
                <span class="label label-success">Coding</span>
                <span class="label label-info">Javascript</span>
                <span class="label label-warning">PHP</span>
                <span class="label label-primary">C#</span>
              </p>
             
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- / col-md-3 finished -->


        <!-- /.col -->
        <div class="col-md-9">
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              
              <li class="active"><a href="#profile" data-toggle="tab">Profile</a></li>
               <li><a href="#companydetails" data-toggle="tab">Company Details</a></li>
               <li><a href="#paymode" data-toggle="tab">Payment Modes</a></li>
              <li><a href="#settings" data-toggle="tab">Change Password</a></li>
            </ul>

          <!-- Hidden upload form -->
    
     <form method="post" action="upload.php" enctype="multipart/form-data" id="picUploadForm" target="uploadTarget">
        <input type="file" name="picture" id="fileInput"  style="display:none"/>
      </form>
            
      <div class="tab-content">
        <div class="active tab-pane" id="profile">
            <form class="form-horizontal" method="POST" action="">
              
            <div class="demo" style="border:0px !important; box-shadow: 0px !important;">
            
               <div class="box-body box-profile">
    
                 <div class="overlay uploadProcess" style="display: none;">
                   <div class="overlay-content"><img src="../dist/img/images/loading.gif" style="z-index: -1;padding-left: 150px; position: relative;"/></div>
                 </div>
      
                 <iframe id="uploadTarget" name="uploadTarget" src="#" style="width:0;height:0;border:0px solid #fff;"></iframe>
      
                  <div align="center">
                  <a class="editLink" style="z-index: -1;padding-left: 150px;"><img src="../dist/img/images/edit.png"/></a>
                  </div>

                      <img class="profile-user-img img-responsive img-circle" src="<?php echo $userPictureURL; ?>" id="imagePreview"
                       style="height: 150px; width:150px; z-index: -1;" alt="User profile picture">

    
               </div>

            </div>
           <br/>
                
                <p align="center" style="color:#F00;"><?php 
                     if(isset($_SESSION['msg']))
                     {
                     echo $_SESSION['msg']; }?><?php echo $_SESSION['msg']=""; ?></p>
                           <form class="form-horizontal style-form" name="form1" method="post" action="" onSubmit="return valid();">
                           <p style="color:#F00"><?php echo $_SESSION['msg'];?><?php echo $_SESSION['msg']="";?></p>

                  <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Name</label>

                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="inputName" name="name" placeholder="Name" 
                      value="<?php echo $row['name']; ?>">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputEmail" class="col-sm-2 control-label">Email</label>

                    <div class="col-sm-10">
                      <input type="email" class="form-control" id="inputEmail" name="email" placeholder="Email" 
                       value="<?php echo $row['username']; ?>">
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Profession</label>
                   <div class="col-sm-10">
                     <input type="text" class="form-control" id="inputcom" name="profession" placeholder="Profession"
                       value="<?php echo $row['profession']; ?>">
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Qualification</label>

                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="inputName" name="qualification" placeholder="Name"
                       value="<?php echo $row['qualification']; ?>">
                    </div>
                  </div>

                   <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Location</label>

                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="inputName" name="location" placeholder="Name"
                       value="<?php echo $row['location']; ?>">
                    </div>
                  </div>
                 
            
               <br/>
                  <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                      <input type="submit" class="btn btn-danger" name="profilesubmit">
                    </div>
                  </div>

                  <br/><br/>
                </form>
              
              </div>

             <div class="overlay uploadProcess2" style="display: none;">
                <div class="overlay-content" style="z-index: -1;padding-left: 150px; position: relative;"><img src="images/loading.gif"/></div>
            </div>
            <!-- Hidden upload form -->
            <form method="post" action="upload2.php" enctype="multipart/form-data" id="picUploadForm2" target="uploadTarget2">
                <input type="file" name="picturelogo" id="fileInput2"  style="display:none"/>
            </form>

              
              <!-- /.tab-pane -->
              <div class="tab-pane" id="companydetails">
            
            <form class="form-horizontal" action="" method="POST">
                

            <div class="box-body box-profile">
      
      <iframe id="uploadTarget2" name="uploadTarget2" src="#" style="width:0;height:0;border:0px solid #fff;"></iframe>
      <div align="center">
      <a class="editLink2" style="z-index: -1; padding-left: 150px;"><img src="../dist/img/images/edit.png"/></a></div>
      <!-- Image update link -->
      <div align="center">
           
            <img class="profile-user-img img-responsive img-circle" src="<?php echo $userPictureURLz; ?>" id="imagePreview6" style="height: 150px; width:150px; z-index: -1;" alt="Company Logo">
         </div>

                      
                    </div>
              </br> </br>
               <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Company Name</label>

                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="inputcom" name="cname" placeholder="Company Name"
                       value="<?php echo $row['c_name']; ?>">
                    </div>
                  </div>
                   <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Company Address</label>
                   <div class="col-sm-10">
                      <textarea class="form-control" id="inputadd" name="cadd" placeholder="Company Address"><?php echo $row['c_add']; ?></textarea>
                    </div>
                  </div>

                   <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Mobile</label>
                   <div class="col-sm-10">
                     <input type="text" class="form-control" id="inputcom" name="cmob" placeholder="Mobile"
                       value="<?php echo $row['mob']; ?>">
                    </div>
                  </div>
                   <div class="form-group">
                    <label for="inputEmail" class="col-sm-2 control-label">Email</label>

                    <div class="col-sm-10">
                      <input type="email" class="form-control" id="inputEmail" name="cemail" placeholder="Email" 
                       value="<?php echo $row['email']; ?>">
                    </div>
                  </div>

                   <div class="form-group">
                    <label for="inputGST" class="col-sm-2 control-label">GST</label>
                   <div class="col-sm-10">
                     <input type="text" class="form-control" id="inputcom" style="text-transform: uppercase;" name="cgst"  
maxlength="15" minlength="10" placeholder="GST or Adhaar or Pan" value="<?php echo $row['gst']; ?>">
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="inputPan" class="col-sm-2 control-label">PAN</label>
                   <div class="col-sm-10">
                     <input type="text" class="form-control" id="inputcom" name="cpan"  
maxlength="10" minlength="10" placeholder="Company Pan" style="text-transform: uppercase; " value="<?php echo $row['pan']; ?>">
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="inputPan" class="col-sm-2 control-label">Bank Name</label>
                   <div class="col-sm-10">
                     <input type="text" class="form-control" id="inputcom" name="bname"  
                           placeholder="Bank Name" value="<?php echo $bankname; ?>">
                    </div>
                  </div>
                  <!-- <?php echo $ac;?> -->
                   <div class="form-group">
                    <label for="inputPan" class="col-sm-2 control-label">A/c Number</label>
                   <div class="col-sm-10">
                     <input type="text" class="form-control" id="inputcom" name="ac"  
                           placeholder="Account number" value="<?php echo $ac; ?>">
                    </div>
                  </div>
                   <div class="form-group">
                    <label for="inputPan" class="col-sm-2 control-label">IFSC Code</label>
                   <div class="col-sm-10">
                     <input type="text" class="form-control" id="inputcom" name="ifsc"  
                           placeholder="IFSC Code" style="text-transform: uppercase; " value="<?php echo $ifsc; ?>">
                    </div>
                  </div>

                    <div class="form-group">
                    <label for="inputPan" class="col-sm-2 control-label">Branch</label>
                   <div class="col-sm-10">
                     <input type="text" class="form-control" id="inputcom" name="branch"  
                           placeholder="Branch Name" value="<?php echo $branch; ?>">
                    </div>
                  </div>


                <br/>
                  <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                      <input type="submit" class="btn btn-danger" name="csubmit">
                    </div>
                  </div>
                  <br/><br/>
                </form>
               

              </div>
              <!-- /.tab-pane -->
               <div class="tab-pane" id="paymode">
                <form class="form-horizontal" action="" method="POST">
                  <br/ ><br/ >
                   <table class="table table-bordered" id="item_table" style="margin-left: 10px; margin-right:10px; ">
      <tr>
        <th width="10%"><input id="checkAll" class="formcontrol" type="checkbox"></th>
              <th width="15%">Mode ID</th>
              <th width="35%">Payment Mode</th>
             
       <th width="5%"><button type="button" name="add" class="btn btn-success btn-sm add"><span class="glyphicon glyphicon-plus"></span></button></th>
      </tr>
        <?php
        $mode=mysqli_query($con,"select * from paymode");
                $cnt=0;
                while($modeval=mysqli_fetch_array($mode))
                { 
                  $cnt++;
                ?>
      <tr>
        <td><input class="itemRow" type="checkbox"></td>
        <td><input type="text" name="mode_id[]" id="modeid_1" value="<?php echo $cnt; ?>" class="form-control" autocomplete="off"></td>
        
       
        
        <td><input type="text" name="mode_name[]" id="mname_1" value="<?php echo $modeval['mode']; ?>" class="form-control item_name" ></td>
        
 
              <td><button type="button" name="remove" class="btn btn-danger btn-sm remove"><span class="glyphicon glyphicon-minus"></span></button></td>
  </tr>
<?php } ?>
     </table>

<br/>
               <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                      <input type="submit" class="btn btn-danger" name="modesubmit">
                    </div>
                  </div>
                    <br /> <br /> 
                </form>
               </div>

              <div class="tab-pane" id="settings">
                <form class="form-horizontal" action="" method="POST">
                  <br/>
                  <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">User Name</label>

                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="user name" placeholder="User Name" value="<?php echo $row['username']; } ?>" >
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="password" class="col-sm-2 control-label">New Password</label>

                    <div class="col-sm-10">
                      <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                   <div id="passerror"> </div>
                    </div>
                     
                  </div>
                  <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Confirm Password</label>

                    <div class="col-sm-10">
                      <input type="password" class="form-control" id="cpassword" name="cpassword" placeholder="Confirm Password">
                      <div id="cpasserror"> </div>
                    </div>
                    
                  </div>
                  <br />
    
                  <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                      <button type="submit" class="btn btn-danger" name="upsubmit" onclick="validate()">Submit</button>
                    </div>
                  </div>
                  <br /><br />
                </form>
              </div>
              <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
          </div>
          <!-- /.nav-tabs-custom -->
        </div>
        <!-- /.col -->
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
<!-- ./wrapper -->



<script>

 
  $(document).ready(function(){
  
  $(document).on('click', '#checkAll', function() {           
    $(".itemRow").prop("checked", this.checked);
  }); 


  $(document).on('click', '.itemRow', function() {    
    if ($('.itemRow:checked').length == $('.itemRow').length) {
      $('#checkAll').prop('checked', true);
    } else {
      $('#checkAll').prop('checked', false);
    }
  });  

  var count = $(".itemRow").length;

 
 $(document).on('click', '.add', function(){
  count++;
  var html = '';
  html += '<tr>';
  html += '<td><input class="itemRow" type="checkbox"></td>';
  html += ' <td><input type="text" name="mode_id[]" id="modeid_'+count+'" value='+count+' class="form-control" autocomplete="off"></td>';


  html += '<td><input type="text" name="mode_name[]" id="mname_'+count+'" class="form-control item_name" /></td>';

  html += '<td><button type="button" name="remove" class="btn btn-danger btn-sm remove"><span class="glyphicon glyphicon-minus"></span></button></td></tr>';

  $('#item_table').append(html);
 });
 

$(document).on('click', '.remove', function(){
  $(this).closest('tr').remove();
 });

}); 

 </script>


</body>
</html>
