<?php
session_start();
include'dbconnection.php';
include("checklogin.php");
 check_login();

include 'inc/getState.php';

$current_page="manage-suppliers";

If(isset($_GET['infoid']))
{
  $val=$_GET['infoid'];


  $cinfo=mysqli_query($con,"SELECT COALESCE(SUM(purchaseinv2.totalitems), 0) AS 'totalitems', COALESCE(COUNT(purchaseinv2.invid), 0) AS 'invid', COALESCE(SUM(purchaseinv2.totalamount), 0) AS 'purchases', purchasecom.pcname, purchasecom.pcadd, purchasecom.pcmob, purchasecom.gst, purchasecom.pcomtype, purchasecom.country, purchasecom.created FROM purchaseinv2 INNER JOIN purchasecom ON purchaseinv2.cid = purchasecom.pcid where pcid=$val")  or die("Error: " . mysqli_error($con));

 
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AdminLTE 2 | Data Tables</title>
 <?php include_once "links.php"; ?>

 <link rel="stylesheet" href="../bower_components/morris.js/morris.css">
 

<!-- jQuery UI 1.11.4 -->
<script src="../bower_components/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>

<!-- Morris.js charts -->
<script src="../bower_components/raphael/raphael.min.js"></script>
<script src="../bower_components/morris.js/morris.min.js"></script>

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
      Manage Suppliers
        
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        
        <li class="active">Manage Suppliers</li>
      </ol>
    </section>
    </br> 
<?php     

 while($row=mysqli_fetch_array($cinfo))

{

?>
     <div class="col-md-4">
          <!-- Widget: user widget style 1 -->
          <div class="box box-widget widget-user">
            <!-- Add the bg color to the header using any of the bg-* classes -->
            <div class="widget-user-header bg-aqua-active">
              <h3 class="widget-user-username"><?php echo $row['pcname']; ?></h3>
              <h5 class="widget-user-desc">Since <?php
                    $c=date("d-M-Y",strtotime($row['created']));
                      echo $c;
               //echo $row['created']; ?> </h5>
            </div>
            <div class="widget-user-image">
              <img class="img-circle" src="../dist/img/avatar5.png" alt="User Avatar">
            </div>
            <div class="box-footer" style="padding-top: 52px;">
              <div class="row">
                <div class="col-sm-4 border-right">
                  <div class="description-block">
                    <h5 class="description-header"><?php
          
                               echo $row['purchases']; 
                             ?>
                      
                    </h5>
                    <span class="description-text">Purchases</span>
                  </div>
                  <!-- /.description-block -->
                </div>
                <!-- /.col -->
                <div class="col-sm-4 border-right">
                  <div class="description-block">
                    <h5 class="description-header"><?php

                
                     echo $row['totalitems']; 
                     ?> </h5>
                    <span class="description-text">Products</span>
                  </div>
                  <!-- /.description-block -->
                </div>
                <!-- /.col -->
                <div class="col-sm-4">
                  <div class="description-block">
                    <h5 class="description-header"><?php echo $row['invid']; ?> </h5>
                    <span class="description-text">Invoice</span>
                  </div>
                  <!-- /.description-block -->
                </div>
                <!-- /.col -->

              </div>
              <!-- /.row -->
              </br>
            </div>
          </div>
          <!-- /.widget-user -->
        </div>
     


                              <div class="col-md-4" id="examplez">
                                    <div class="box box-info">
                                            
                                            <div class="box-header with-border center">
                                               <h3 class="box-title"> Information </h3> </div>

                                      <div class="box-body">
                                          <div class="form-group" style="padding-left: 6px">
                                      <strong><p align="center" style="color:black;"></p></strong>
                                      <p align="left"><strong>Supplier Name:</strong> <?php echo $row['pcname'];?>  </p>
                                      <p align="left"><strong>Address:</strong> <?php echo $row['pcadd'];?></p>
                                      <p align="left"><strong> Mob: </strong><?php echo $row['pcmob']; ?> </p>
                                      <p align="left"><strong> GST No.: </strong><?php echo $row['gst']; ?></p>
                                      <p align="left"><strong> Supplier Type.: </strong><?php echo $row['pcomtype'];  ?></p>  <p align="left"><strong> Nationality: </strong><?php echo $row['country']; }} ?>

                                         </a>
                                    
                                       <!--  <a href="edittest.php?invid=<?php echo $row['invid'];?>"> 
                                     <button class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i></button></a>
                                            
                                    <a class="btn btn-danger btn-xs pull-right" id="delete_product" data-id="<?php echo $id; ?>" ><i class="fa fa-trash-o "></i></a> -->
                                  </div> 
                                </div>

                              </div>
                              </div> 



                                <div class="col-md-4" id="examplez">
                                    <div class="box box-info" style="height: 255px;">
                                            
                                        <div class="box-header with-border center">
                                              <h3 class="box-title">Total Purchase as per FY  </h3> </div>

                                      <div class="box-body" style="margin-top: -20px;">
                                          <div class="form-group" style="padding-left: 6px">

                                      <div class="box-body chart-responsive">
                          <div class="chart_morris" id="chart_pie_1" style="height: 180px;"></div>
                                      <div id='chart_pie_1_legend' class='text-center'></div>
                                      </br></br>
                        </div>
                                    
                                     
                                  </div> 
                                </div>

                              </div>
                              </div> 



    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          
          <div class="box box-info">
            <div class="box-header">
              <h3 class="box-title" style="padding-top: 10px;">Supplier Invoice Details</h3>
            </div>
            <!-- /.box-header -->
            <!--  <button type="button" id="btnplus"class="btn btn-success btn-sm pull-right" style="margin: 2px 20px 2px 2px;" onclick="window.location.href = 'add-client.php'";><span class="glyphicon glyphicon-plus"></span></button><br> -->

            <div class="box-body">
              <table id="example2" class="table table-bordered table-striped">
                            
                            <hr>
                              <thead>
                              <tr>
                                  <th>Sno.</th>
                                  <th class="hidden-phone">Invoice Id</th>
                                  <th> Company Name</th>
                                  <th> Location</th>
                                  <th> Item Name </th>
                                  <th> Amount</th>
                                  <th> Created </th>
                                   <!-- <th>Reg. Date</th> -->
                                      <th>Edit</th>
                                      <th>View</th>
                                      <th>Delete</th>
                              </tr>
                              </thead>
                              <tbody>
                              <?php $ret=mysqli_query($con,"select purchaseinv.item_name 'Item', purchaseinv.orderid,purchaseinv2.invid,purchaseinv2.created, purchasecom.pcname,substring_index(purchasecom.pcadd, ',', -1) as location,purchaseinv2.totalamount 'totalamount' from purchaseinv2 inner join purchaseinv on purchaseinv.orderid = purchaseinv2.orderid inner join purchasecom on purchaseinv2.cid = purchasecom.pcid and purchasecom.pcid=$val GROUP by purchaseinv.orderid")or die("Error: " . mysqli_error($con));
     
                $cnt=1;
                while($row=mysqli_fetch_array($ret))
                {?>
                              <tr>
                              <td><?php echo $cnt;?></td>
                                  <td><?php echo $row['invid'];?></td>
                                  <td>&nbsp;<?php echo $row['pcname'];?></td>
                                  <td>&nbsp;<?php echo $row['location'];?></td>
                                  <td>&nbsp;<?php echo $row['Item'];?></td>
                                  <td>&nbsp;<?php echo $row['totalamount'];?></td> 
                                  
                                  
                                  <td>&nbsp;<?php 
                                    $c=date("d-M-Y",strtotime($row['created']));
                                        echo $c;
                                  ?></td> 
                                 <td>
                                     
                                     <a href="editpur.php?orderid=<?php echo $row['orderid'];?>"> 
                                     <button class="btn btn-primary btn-xs" style="width:30px;height:25px"><i class="fa fa-pencil"></i></button></a>
                                            
                                    
                                   <?php $did=$row['orderid']; ?>
                                   </td>
                                   <td>
                                     <a href="purinv copy.php?orderid=<?php echo $row['orderid'];?>" target="_blank"> 
                                     <button class="btn btn-warning btn-xs" style="width:30px;height:25px"><i class="fa fa-fw fa-eye"></i></button></a>
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
                  <th>Invoice Id</th>
                  <th>Company Name</th>
                  <th>Location</th>
                  <th> Item Name </th>
                  <th>Amount </th> <th>Created</th>
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
    $('#example2').DataTable({
           'paging'      : true,
      'lengthChange': true,
      'searching'   : true,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false,
  
  // 'dom':"<'row'<'col-sm-4'l><'col-sm-4 text-center'B><'col-sm-4'f>>" +
   //   "<'row'<'col-sm-12'tr>>" +
   //   "<'row'<'col-sm-5'i><'col-sm-7'p>>",
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
  exportOptions: {
          columns: [ 0, 1, 2, 3,4,5],
    }
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
   
      initComplete: function () {
            var btns = $('.dt-button');
            btns.addClass('btn btn-primary btn-sm btn-group');
            btns.removeClass('dt-button');

        },        "lengthMenu": [[15, 50, 150, -1], [15, 50, 150, "All"]]
      });
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

<!-- <script>
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
            url: 'delete_inv.php',
            type: 'GET',
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
            window.location.href = 'get-info.php?infoid='+ <?php echo $val; ?>;
         }, 50);


    //$('#load-products').load('manage-clients.php'); 
  }
  
</script> -->
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
      url: 'ajax/delete supplier.php',
      type: 'POST',
      data: { delete: parseInt(productId) },
      dataType: 'json'
    })
    .done(function(response){
      // Display success message using Swal.fire
      // Swal.fire('Deleted!', response.message, response.status);
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
            window.location.href = 'manage-suppliers.php';
         }, 3000);
    //$('#load-products').load('manage-clients.php'); 
  }
  

  
</script>

<script>
  $(document).ready(function(){
    

    var infoid = '<?php echo $val; ?>';
    console.log(infoid);

 var bootstrapColors = [
        '#007bff', // Primary
        // '#6c757d', // Secondary
        '#28a745', // Success
        '#dc3545', // Danger
        '#ffc107', // Warning
        '#17a2b8', // Info
        // '#343a40', // Dark
        '#e83e8c', // Pink
        '#6610f2', // Purple
        '#fd7e14', // Orange
    ];
        // var formData = $(this).serialize();
         
        //  formData += '&pname=' + encodeURIComponent(p_name);

    //readProducts(); /* it will load products when document loads */
    
     $.ajax({
        url: 'ajax/charts4.php', // Replace with the path to your PHP script
        type: 'GET',
        data: {infoid: infoid},
        dataType: 'json',
        success: function(data) {
            // Access data for each pie chart
            var pie1Data = data.pie1;

              //console.log(pie1Data);
            //var colors = generateRandomColors(pie1Data.length);
              

            Morris.Donut({
                element: 'chart_pie_1',
                data: pie1Data,
                dataLabels: true,
            showPercentage: true,
            colors:bootstrapColors.slice(0, pie1Data.length),

            }).options.colors.forEach(function(color, index) {
              if (pie1Data[index] != undefined) {
              var node = document.createElement('span');
              node.innerHTML += '<span style="color:'+color+'"><i style="margin-left: 15px;" class="fas fa-square"></i> '+pie1Data[index].label+'</span>';
              document.getElementById("chart_pie_1_legend").appendChild(node);
            }
                // Your legend generation logic here
            });

       }

    })

    // Function to generate random colors
    // function generateRandomColors(numColors) {
    //     var colors = [];
    //     for (var i = 0; i < numColors; i++) {
    //         var color = '#'+(Math.random()*0xFFFFFF<<0).toString(16); // Generate random hex color
    //         colors.push(color);
    //     }
    //     return colors;
    // }
  });
  
</script>
</body>
</html>
