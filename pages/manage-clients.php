<?php
session_start();
include'dbconnection.php';
include("checklogin.php");
 check_login();

include 'inc/getState.php';

$current_page="manage-clients";
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AdminLTE 2 | Data Tables</title>

 <?php include_once "links.php"; ?>

<script type="text/javascript" src="/script/dataTables.export.js"></script> 

<!-- <script type="text/javascript" src="/script/script.js"></script> -->

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
    
<?php include_once"navbar.php"; ?>


  <!-- Content Wrapper. Contains page content -->
  
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
      Manage Clients
        
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        
        <li class="active">Manage Clients</li>
      </ol>
    </section>


    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          
          <div class="box box-info" style="overflow: auto;">
            <div class="box-header">
              <h3 class="box-title" style="padding-top: 10px;"> All Client Details</h3>
            </div>
            <!-- /.box-header -->
             <button type="button" id="btnplus" class="btn btn-success btn-sm pull-right" style="margin: 2px 20px 2px 2px;" onclick="window.location.href = 'add-client.php'";><span class="glyphicon glyphicon-plus"></span></button><br>

            <div class="box-body">
              <table id="example2" class="table table-bordered table-striped">
                            
                            <hr>
                              <thead>
                              <tr>
                                  <th>Sr. no.</th>
                                  <th class="hidden-phone">Company Name</th>
                                  <th> Address</th>
                                  <th> Mobile</th>
                                  <th> GST No.</th>
                                  <th> Type </th>
                                   <!-- <th>Reg. Date</th> -->
                                      <th>Edit</th>
                                      <th>Info</th>
                                      <th>Delete</th>
                              </tr>
                              </thead>
                              <tbody>
                             
                             
                              </tbody>
                <tfoot>
                <tr>
                  <th>Sr. no.</th>
                  <th>Company Name</th>
                  <th>Address</th>
                  <th>Mobile</th>
                  <th>GST No.</th>
                  <th>Type</th>
                  <th>Edit</th>
                  <th>Info</th>
                  <th>Delete</th>
                </tr>
                </tfoot>
              </table>
          
                 <div  class="btn-group" data-toggle="buttons" role="group">
                <input type="button" class="toggle-vis btn btn-primary" data-column="0" value="Sr. No.">
                <input type="button" class="toggle-vis btn btn-primary" data-column="1" value="Company Name">
                <input type="button" class="toggle-vis btn btn-primary" data-column="2" value="Address">
                <input type="button" class="toggle-vis btn btn-primary" data-column="3" value="Mob">
                <input type="button" class="toggle-vis btn btn-primary" data-column="4" value="Gst No.">
                <input type="button" class="toggle-vis btn btn-primary" data-column="5" value="Type">
                
   
                </br>

  </div>

            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <hr>
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
      'processing' :true,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false,
      'footer': true,

   // 'dom':"<'row'<'col-sm-1'l><'col-sm-9 text-center'B><'col-sm-2'f>>" +
  //     "<'row'<'col-sm-12'tr>>" +
  //     "<'row'<'col-sm-5'i><'col-sm-7'p>>",
   dom: "<'row'<'col-sm-3'l><'col-sm-9'<'pull-center'fB>>>rtip",
    
       buttons: [
             {
                extend:    'copyHtml5',
                text:      '<i class="fa fa-files-o">&nbsp; Copy </i>',
                className: "btn-sm btn btn-danger",
                titleAttr: 'Copy',
                exportOptions: {
                    columns: [ 0, 1, 2, 3,4,5 ]
                }
      
            },
            {
                text: '{ } &nbsp; JSON',
                className: "btn-sm btn btn-danger",
                titleAttr: 'JSON',
                exportOptions: {
                    columns: [ 0, 1, 2, 3,4,5 ]
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
                                title: 'AdminLT || Clients Data',
                exportOptions: {
                    columns: [ 0, 1, 2, 3,4,5 ]
                }
            },
            {
                extend:    'csvHtml5',
                text:      '<i class="fa fa-file-text-o">&nbsp; CSV</i>',
                className: "btn-sm btn btn-danger",
                titleAttr: 'CSV',
                                title: 'AdminLT || Clients Data',
                exportOptions: {
                    columns: [ 0, 1, 2, 3,4,5 ]
                }
            },
            {
                extend:    'pdfHtml5',
                text:      '<i class="fa fa-file-pdf-o">&nbsp; PDF</i>',
                className: "btn-sm btn btn-danger",  
                orientation: 'landscape',
                pageSize: 'A3',          
                titleAttr: 'PDF',
                title: 'AdminLT || Clients Data',
                customize: function(doc) {  
                doc.pageMargins = [10,10,10,10];
                doc.defaultStyle.fontSize = 7;
                doc.styles.tableHeader.fontSize = 7;

               
                doc.styles.tableFooter.fontSize=15;
                doc.styles.title.fontSize = 15;
        // Remove spaces around page title
        doc.content[0].text = doc.content[0].text.trim();
        // Create a footer
        doc['footer']=(function(page, pages) {
            return {
                columns: [
                {
                        // This is the right column
                        alignment: 'center',
                        text: ['Clients Data from CodeTech Engineers'],
                        
                    },
                    {
                        // This is the right column
                        alignment: 'right',
                        text: ['page ', { text: page.toString() },  ' of ', { text: pages.toString() }],
                        //fontSize:10
                    }
                ],
                margin: [10, 0]
            }
        });


        // doc['header'] = (function (page, pages) {
        //         return {
        //           columns: [
        //             {
        //               // 'This is your left footer column',
        //               alignment: 'left',
        //               //fontSize: 8,
        //               text: ['test'],
        //              // margin: [0, 10]
        //             },
        //             {
        //               // This is the right column
        //               alignment: 'right',
        //               text: ['ama'],
        //               //margin: [0, 10]
        //             }
        //           ],
        //           margin: [30, 0]
        //         }
        //       });

        // Styling the table: create style object
        var objLayout = {};
        // Horizontal line thickness
        objLayout['hLineWidth'] = function(i) { return .5; };
        // Vertikal line thickness
        objLayout['vLineWidth'] = function(i) { return .5; };
        // Horizontal line color
        objLayout['hLineColor'] = function(i) { return '#aaa'; };
        // Vertical line color
        objLayout['vLineColor'] = function(i) { return '#aaa'; };
        // Left padding of the cell
        objLayout['paddingLeft'] = function(i) { return 4; };
        // Right padding of the cell
        objLayout['paddingRight'] = function(i) { return 4; };
        // Inject the object in the document
        doc.content[1].layout = objLayout;
    
                doc.content[1].table.widths =Array(doc.content[1].table.body[0].length + 1).join('*').split('');
                doc.defaultStyle.alignment = 'center';
                doc.styles.tableHeader.alignment = 'center';
                },
                exportOptions: {
                    columns: [ 0, 1, 2, 3,4,5 ]
                }
            },

            {
                extend:    'print',
                text:      '<i class="fa fa-print">&nbsp; Print</i>',
                className: "btn btn-sm  btn-danger",  
                titleAttr: 'Print',
                                                title: 'AdminLT || Clients Data',
                exportOptions: {
                    columns: [ 0, 1, 2, 3,4,5]
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
    "ajax": "ajax/client-data.php",
    
  
    //"pageLength": 15,
    "columns": [
      {

    //custom functions for particular column
    "data": "id",
    render: function (data, type, row, meta) {
        return meta.row + meta.settings._iDisplayStart + 1;
    }
},
      { mData: 'c_name'},
      { mData: 'c_add' },
      { mData: 'mob' },
      { mData: 'gst' },
      { mData: 'c_type',
      //custom functions for particular column
      render: function (data, type, row, meta) {
        if(data == "IGST")
        {
          return '<span class="label label-success">' + data + '</span>';
        }else {
          return  '<span class="label label-warning">' + data + '</span>'; 
        }
       }
      },
      // { mData: 'created',
      //     render: function (data, type, row, meta) {
      //       var parts = data.split('-');
      //       var formattedDate = parts[2] + '-' + parts[1] + '-' + parts[0];

      //       // Returning the formatted date
      //       return formattedDate;
        
      //     }
      //  },
      {mData:'editaction',

            render: function (data, type, row, meta) {
              var cidValue = row.cid;


      return '<a href="update-client.php?clid=' + cidValue + '"><button class="btn btn-primary btn-xs" style="width:30px;height:25px"><i class="fa fa-pencil"></i></button></a>';
    }},
    {
      mData:'viewaction',
      render: function (data, type, row, meta) {
              var cidValue = row.cid;


      return  '<a href="get-info.php?infoid=' + cidValue + '"><button class="btn btn-warning btn-xs" style="width:30px;height:25px"><i class="fa fa-fw fa-eye"></i></button></a>';
    }},

    {
      mData:'deleteaction',
      render: function (data, type, row, meta) {
              var cidValue = row.cid;


      return '<a class="btn btn-danger btn-xs" id="delete_product" style="width:30px;height:25px" data-id="' + cidValue + '"><i class="fa fa-trash-o"></i></a>';

    }}

    ],
 initComplete: function () {
            var btns = $('.dt-button');
            btns.addClass('btn btn-primary btn-sm btn-group');
            btns.removeClass('dt-button');

        },        "lengthMenu": [[10, 50, 150, -1], [10, 50, 150, "All"]]
      
  }); 
  // setInterval( function () {
  //   table.ajax.reload(null, false);
  // }, 5000 );  

   
 document.querySelectorAll('.toggle-vis').forEach((el) => {
    el.addEventListener('click', function (e) {
        e.preventDefault();
 
        let columnIdx = e.target.getAttribute('data-column');
        let column = table.column(columnIdx);
        
        // Toggle the visibility
        column.visible(!column.visible());
    });
});


    })
  
</script>
<script>
  $(document).ready(function(){
    
    //readProducts(); /* it will load products when document loads */
    
    $(document).on('click', '#delete_product', function(e){
      
      var productId = $(this).data('id');
      
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
      url: 'ajax/delete client.php',
      type: 'POST',
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
            window.location.href = 'manage-clients.php';
         }, 3000);
    //$('#load-products').load('manage-clients.php'); 
  }
  
</script>
<script type="text/javascript">
  $('.btn-primary').on("click",function(){

        //$(".btn-primary").not(this).removeClass('active');
        if($(this).hasClass('active')){
            //$('.Resume-click-open').css({'height' : '100px'});
            $(this).removeClass('active');
            $(this).removeClass('btn-danger');
            //$(this).addClass("btn-primary");
        }else{
            $(this).addClass('active');
            $(this).addClass("btn-danger");
        }


    //$(".btn-success").removeClass('btn-danger');
    
});

</script>
 
</body>
</html>
