<?php
session_start();
include'dbconnection.php';
include("checklogin.php");
 check_login();
include 'inc/getState.php';

$current_page="accounts";
$current_page1="acctype";
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AdminLTE 2 | Data Tables</title>
 <?php include_once "links.php"; ?>

<style>
.btn-default{
  color:white;

}
</style>
</head>
<body class="hold-transition skin-blue sidebar-mini hold-transition skin-blue sidebar-mini
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


  <!-- Content Wrapper. Contains page content -->
  
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
      Manage Account Type
        
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        
        <li class="active">Manage Account Type</li>
      </ol>
    </section>


    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          
          <div class="box box-info" style="overflow: auto;">
            <div class="box-header">
              <h3 class="box-title" style="padding-top: 10px;"> Account Type</h3>
            </div>
            <!-- /.box-header -->
             <button type="button" id="btnplus"class="btn btn-success btn-sm pull-right" style="margin: 2px 20px 2px 2px;" onclick="window.location.href = 'add-client.php'";><span class="glyphicon glyphicon-plus"></span></button><br>

            <div class="box-body">
              <table id="example2" class="table table-bordered table-striped">
                            
                            <hr>
                              <thead>
                              <tr>
                                  <th>Sno.</th>
                                  <th class="hidden-phone">Account Type</th>
        
                                   <!-- <th>Reg. Date</th> -->
                                      <th>Edit</th>
                              
                                      <th>Delete</th>
                              </tr>
                              </thead>
                              <tbody>
                              <?php $ret=mysqli_query($con,"select * from acc_type")or die("Error: " . mysqli_error($con));
     
                $cnt=1;
                while($row=mysqli_fetch_array($ret))
                {?>
                              <tr>
                              <td><?php echo $cnt;?></td>
                                  <td><?php echo $row['type'];?></td> 
                        
                                  <td>
                                     
                                     <a href="update-profile.php?clid=<?php echo $row['id'];?>"> 
                                     <button class="btn btn-primary btn-xs" style="width:30px;height:25px"><i class="fa fa-pencil"></i></button></a>
                                   <?php $did=$row['id']; ?>
                                   </td>
                                   
                                  <td>
                                    <a class="btn btn-danger btn-xs" id="delete_product" style="width:30px;height:25px" data-id="<?php echo $did; ?>" ><i class="fa fa-trash-o "></i></a>
                                  </td>
                              </tr>

                              
                              <?php $cnt=$cnt+1; }?>
                             
                              </tbody>
                <tfoot>
                <tr>
                  <th>Sr. no.</th>
                  <th>Account Type</th>
              
                   <th>Edit</th>
    
                                      <th>Delete</th>
                </tr>
                </tfoot>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
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


<!-- page script -->
<script>
  $(function () {
    $('#example1').DataTable()
    $('#example2').DataTable({
      'paging'      : true,
      'lengthChange': true,
      'searching'   : true,
      'processing' :true,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false,
        

	 'dom':"<'row'<'col-sm-4'l><'col-sm-4 text-center'B><'col-sm-4'f>>" +
      "<'row'<'col-sm-12'tr>>" +
      "<'row'<'col-sm-5'i><'col-sm-7'p>>",
   
		
       buttons: [
             {
                extend:    'copyHtml5',
                text:      '<i class="fa fa-files-o"> Copy </i>',
		 className: "btn-sm btn btn-danger",
                titleAttr: 'Copy',
			
            },
            {
                extend:    'excelHtml5',
                text:      '<i class="fa fa-file-excel-o">&nbsp; Excel</i>',
		 className: "btn-sm btn btn-danger",
                titleAttr: 'Excel'
            },
            {
                extend:    'csvHtml5',
                text:      '<i class="fa fa-file-text-o">&nbsp; CSV</i>',
		 className: "btn-sm btn btn-danger",
                titleAttr: 'CSV'
            },
            {
                extend:    'pdfHtml5',
                text:      '<i class="fa fa-file-pdf-o">&nbsp; PDF</i>',
  className: "btn-sm btn btn-danger",            
   titleAttr: 'PDF'
            },     
  {
                extend:    'print',
                text:      '<i class="fa fa-print">&nbsp;Print</i>',
		 className: "btn btn-sm  btn-danger",	
                titleAttr: 'Print'
            },

  ],
   
	    initComplete: function () {
            var btns = $('.dt-button');
            btns.addClass('btn btn-primary btn-sm btn-group');
            btns.removeClass('dt-button');

        },        "lengthMenu": [[10, 50, 150, -1], [10, 50, 150, "All"]]
      } );
 


    })
  
</script>
<script>
  $(document).ready(function(){
    
    //readProducts(); /* it will load products when document loads */
    
    $(document).on('click', '#delete_product', function(e){
      
      var productId = $(this).data('id');
      SwalDelete(productId);
      e.preventDefault();
      console.log(productId);
    });
    
  });
  
  function SwalDelete(productId){
    
    swal({
      title: 'Are you sure?',
      text: "It will be deleted permanently!",
      type: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yes, delete it!',
      showLoaderOnConfirm: true,
        
      preConfirm: function() {
        return new Promise(function(resolve) {
             
           $.ajax({
            url: 'ajax/delete client.php',
            type: 'POST',
              data: 'delete='+productId,
              dataType: 'json'
           })
           .done(function(response){
            swal('Deleted!', response.message, response.status);
          readProducts();
           })
           .fail(function(){
            swal('Oops...', 'Something went wrong with ajax !', 'error');
           });
        });
        },
      allowOutsideClick: false        
    }); 
    
  }
  
  function readProducts(){
    setTimeout(function(){
            window.location.href = 'manage-clients.php';
         }, 3000);
    //$('#load-products').load('manage-clients.php'); 
  }
  
</script>
</body>
</html>
