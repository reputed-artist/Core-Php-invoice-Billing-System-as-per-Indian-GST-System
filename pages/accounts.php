<?php
session_start();
include'dbconnection.php';
include("checklogin.php");
 check_login();

include 'inc/getState.php';

$current_page="accounts";
$current_page1="accounts1";
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AdminLTE 2 | Data Tables</title>
 <?php include_once "links.php"; ?>
 <!-- <script type="text/javascript" src="/script/dataTables.export.js"></script>  -->

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
      Manage Accounts
        
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        
        <li class="active">Manage Accounts</li>
      </ol>
    </section>


    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          
          <div class="box box-info" style="overflow: auto;">
            <div class="box-header">
              <h3 class="box-title" style="padding-top: 10px;">All Account Details </h3>
            </div>
            <!-- /.box-header -->
             <button type="button" id="btnplus" class="btn btn-success btn-sm pull-right" style="margin: 2px 20px 2px 2px;" onclick="window.location.href = 'add-account.php'";><span class="glyphicon glyphicon-plus"></span></button><br>

            <div class="box-body">
              <table id="example2" class="table table-bordered table-striped">
                            
                            <hr>
                              <thead>
                              <tr>
                                  <th>Sno.</th>
                                 <th class="hidden-phone">Company Name</th>
                                  <th >Account Type</th>
                                  <th>Phone</th>
                                  <th>Address</th>
                                  <th>Opening Balance</th>
                                  <th>Created</th>
                                      <th>Edit</th>
                                      <th>View</th>
                                      <th>Delete</th>
                              </tr>
                              </thead>
                              <tbody>
                              
                             
                              </tbody>
                <tfoot>
                <tr>
                 <th class="hidden-phone">Sno.</th>
                <th class="hidden-phone">Company Name</th>
                                  <th class="hidden-phone">Account Type</th>
                                  <th class="hidden-phone">Phone</th>
                                  <th class="hidden-phone">Address</th>
                                  <th class="hidden-phone">Opening Balance</th>
                                  <th class="hidden-phone">Created</th>
                   <th>Edit</th>
                   <th>View</th>
    
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
   var table= $('#example2').DataTable({
      'paging'      : true,
      'lengthChange': true,
      'searching'   : true,
      'processing' :false,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false,
        

   // 'dom':"<'row'<'col-sm-4'l><'col-sm-4 text-center'B><'col-sm-4'f>>" +
   //    "<'row'<'col-sm-12'tr>>" +
   //    "<'row'<'col-sm-5'i><'col-sm-7'p>>",
   dom: "<'row'<'col-sm-3'l><'col-sm-9'<'pull-center'fB>>>rtip",
    
       buttons: [
             {
                extend:    'copyHtml5',
                text:      '<i class="fa fa-files-o"> Copy </i>',
                className: "btn-sm btn btn-danger",
                titleAttr: 'Copy',
                exportOptions: {
                    columns: [ 0, 1, 2, 3,4,5,6 ]
                }

      
            },
             {
                text: '{ } JSON',
                className: "btn-sm btn btn-danger",
                titleAttr: 'JSON',
                exportOptions: {
                    columns: [ 0, 1, 2, 3,4,5,6 ]
                },
                action: function ( e, dt, button, config ) {
                     var data = dt.buttons.exportData();
 
                    $.fn.dataTable.fileSave(
                        new Blob( [ JSON.stringify( data ) ] ),
                        'Export.json'
                    );
                }
            },
            {
                extend:    'excelHtml5',
                text:      '<i class="fa fa-file-excel-o">&nbsp; Excel</i>',
                className: "btn-sm btn btn-danger",
                titleAttr: 'Excel',
                exportOptions: {
                    columns: [ 0, 1, 2, 3,4,5,6 ]
                }

            },
            {
                extend:    'csvHtml5',
                text:      '<i class="fa fa-file-text-o">&nbsp; CSV</i>',
                className: "btn-sm btn btn-danger",
                titleAttr: 'CSV',
                exportOptions: {
                    columns: [ 0, 1, 2, 3,4,5,6 ]
                }

            },
            {
                extend:    'pdfHtml5',
                text:      '<i class="fa fa-file-pdf-o">&nbsp; PDF</i>',
                className: "btn-sm btn btn-danger",            
                 
                  orientation: 'landscape',
                              pageSize: 'A3',           
                              titleAttr: 'PDF',
                              customize: function(doc) {
                  doc.content[1].table.widths =Array(doc.content[1].table.body[0].length + 1).join('*').split('');
                  doc.defaultStyle.alignment = 'center';
                  doc.styles.tableHeader.alignment = 'center';
              },
               exportOptions: {
                    columns: [ 0, 1, 2, 3,4,5,6 ]
                }

            },     
          {
                extend:    'print',
                text:      '<i class="fa fa-print">&nbsp;Print</i>',
                className: "btn btn-sm  btn-danger", 

                titleAttr: 'Print',
                exportOptions: {
                    columns: [ 0, 1, 2, 3,4,5,6 ]
                }

            },  

            {
                              
             className: "btn btn-sm  btn-danger",  
             titleAttr: 'TXT',
             text: '<i class="fa fa-fw fa-file-text-o">&nbsp; TXT</i>',
             action: function (e, dt, node, config) {


        // Trigger the Ultimate Export plugin to export data from the textarea
             doExport('#example2', { type: 'txt' });
           },
  
          },
          
          {
                              
             className: "btn btn-sm  btn-danger",  
             titleAttr: 'sql',
             text: '<i class="fa fa-fw fa-database">&nbsp; SQL</i>',
             action: function (e, dt, node, config) {


        // Trigger the Ultimate Export plugin to export data from the textarea
             doExport('#example2', { type: 'sql' });
           },
              exportOptions: {
                    modifier: {
                        page: 'all'
                    }
                }
              },
          
          {
                              
             className: "btn btn-sm  btn-danger",  
             titleAttr: 'doc',
             text: '<i class="fa fa-fw fa-file-word-o">&nbsp; Docx</i>',
              action: function (e, dt, node, config) {

        // Trigger the Ultimate Export plugin to export data from the textarea
             doExport('#example2', { type: 'doc',mso: {pageOrientation: 'landscape'} });
              },
            exportOptions: {
                  modifier: {
                      page: 'all'
                  }
              }
            },
  

          {
                              
             className: "btn btn-sm  btn-danger",  
             titleAttr: 'PNG',
             text:'<i class="fa fa-fw fa-image">&nbsp; PNG</i>',
             action: function (e, dt, node, config) {

                // Trigger the Ultimate Export plugin to export data from the textarea
                doExport('#example2', { type: 'png'});
            },
          exportOptions: {
                modifier: {
                    page: 'all'
                }
            }
          }

        ],
    "ajax": "ajax/accounts-data.php",
    
  
    //"pageLength": 15,
    "columns": [
      {

    //custom functions for particular column
    "data": "id",
    render: function (data, type, row, meta) {
        return meta.row + meta.settings._iDisplayStart + 1;
    }
},
      { mData: 'pcname'},
      { mData: 'type',
      render: function (data, type, row, meta) {
        if(data == "Supplier")
        {
          return '<span class="label label-success">' + data + '</span>';
        }else {
          return  '<span class="label label-warning">' + data + '</span>'; 
        }
       } 
      },
      { mData: 'pcmob' },
      { mData: 'location' },
      { mData: 'opening_bal' },
      { mData: 'created',
          render: function (data, type, row, meta) {
            var parts = data.split('-');
            var formattedDate = parts[2] + '-' + parts[1] + '-' + parts[0];

            // Returning the formatted date
            return formattedDate;
        
          }
       },
      {mData:'editaction',

            render: function (data, type, row, meta) {
              var cidValue = row.aid;


      return '<a href="update-acc.php?aid=' + cidValue + '"><button class="btn btn-primary btn-xs" style="width:30px;height:25px"><i class="fa fa-pencil"></i></button></a>';
    }},
    {
      mData:'viewaction',
      render: function (data, type, row, meta) {
              var cidValue = row.pcid;


      return  '<a href="accdetails.php?aid=' + cidValue + '"><button class="btn btn-warning btn-xs" style="width:30px;height:25px"><i class="fa fa-fw fa-eye"></i></button></a>';
    }},

    {
      mData:'deleteaction',
      render: function (data, type, row, meta) {
              var cidValue = row.aid;


      return '<a class="btn btn-danger btn-xs" id="delete_product" style="width:30px;height:25px" data-id=' + cidValue + '"><i class="fa fa-trash-o "></i></a>';
    }}

    ],
 initComplete: function () {
            var btns = $('.dt-button');
            btns.addClass('btn btn-primary btn-sm btn-group');
            btns.removeClass('dt-button');

        },        "lengthMenu": [[10, 50, 150, -1], [10, 50, 150, "All"]]
      
  }); 
 


    })
  
</script>
<script>
  $(document).ready(function(){
    
    //readProducts(); /* it will load products when document loads */
    
    $(document).on('click', '#delete_product', function(e){
      
      var productId = $(this).data('id');
      console.log(productId);

      Swal.fire({
  title: 'Are you sure?',
  text: "It will be deleted permanently!",
  icon: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Yes, delete it!',
  // Remove the showLoaderOnConfirm option
  // showLoaderOnConfirm: true,
  allowOutsideClick: false        
}).then((result) => {
  if (result.isConfirmed) {
    // Perform the deletion operation using AJAX
    $.ajax({
      url: 'ajax/delete_account.php',
      type: 'GET',
      data: { delete: parseInt(productId) },
      dataType: 'json'
    })
    .done(function(response){
      // Display success message using Swal.fire
       Swal.fire({
        title: 'Deleted!',
        text: response.message,
        icon: response.status,
        showConfirmButton: false
      });
      // Refresh the product list or perform other actions as needed
      readProducts();
    })
    .fail(function(){
      // Display error message using Swal.fire
      Swal.fire('Oops...', 'Something went wrong with ajax !', 'error');
    });
  }
});
      e.preventDefault();
      console.log(parseInt(productId));
    });
    
  });
  

  function readProducts(){
    setTimeout(function(){
            window.location.href = 'accounts.php';
         }, 3000);
    //$('#load-products').load('manage-clients.php'); 
  }
  
</script>
</body>
</html>
